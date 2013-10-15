<?php
class HomepageController extends AppController {

	var $name = 'Homepage';
	var $uses = array("Project", "Image", "Page", "Connection");
	var $pagelimit = 2;
	var $startpage = 1;
	var $user;
	

	/*function index2() {
		$this->user = $this->Auth->user();
		if(!empty($this->user)) {
			$this->Connection->recursive = 1;
			$following_projects = $this->__getFollowingProjects($this->startpage);
			$this->set("following_projects", $following_projects);
			$projects = $this->__getMyProjects($this->startpage);
			$this->__setProjectSizes();
			$this->set("projects",$projects); //sends it to the view
		}
	}*/
	
	function index() {
		$this->pagelimit = 99999;
		$this->user = $this->Auth->user();
		if(!empty($this->user)) {
			$this->Connection->recursive = 1;
			$this->__setProjectSizes();
			$following_projects = $this->__formatProjects($this->__getFollowingProjects($this->startpage));
			$this->set("following_projects", $following_projects);
			$projects = $this->__formatProjects($this->__getMyProjects($this->startpage));
			$this->__setProjectSizes();
			$this->set("projects",$projects); //sends it to the view
		}
	}
	
	function __formatProjects($projects) {
		$formattedprojects = array();
		foreach($projects as $project) {
			$formattedproject = array();
			$formattedproject['image_url'] = $project['latest_image']['url'];
			$formattedproject['image_filename'] = $project['latest_image']['filename'];
			$formattedproject['project_id'] = $project['Project']['id'];
			$formattedproject['project_name'] = $project['Project']['name'];
			$formattedproject['user'] = $project['User']['username'];
			$formattedproject['user_name'] = $project['User']['name'];
			$formattedprojects[] = $formattedproject;
		}
		return json_encode($formattedprojects);
	}
	
	function __setProjectSizes() {
		$myprojectcount = $this->Project->find("count", array(  //paginate
			"conditions" => array(
				"user_id"=> $this->user['User']['id']
			), 
		));
		$following_people = $this->Connection->find("all", array( //not-paginate
			"conditions"=> array(
				"following_user_id"=>$this->user['User']['id']
		)));
		$user_ids = array();
		foreach($following_people as $following_person){
			$user_ids[] = $following_person['User']['id'];
		}
		$followingprojectcount = $this->Project->find('count',array(  //paginate
			'conditions'=>array(
				'user_id'=>$user_ids
			),
			'recursive'=>0,
			'order'=>array('Project.updated'=>'desc'),
		));
		
		$this->set('myprojectcount',$myprojectcount);
		$this->set('followingprojectcount',$followingprojectcount);
		$this->set('currentpage',$this->startpage);
		$this->set('itemsperpage',$this->pagelimit);
	}
	
	function __getMyProjects($page=1) {
		//The User's Projects
		$projects = $this->Project->find("all", array(  //paginate
			"conditions" => array(
				"user_id"=> $this->user['User']['id']
			), 
			"order"=> array(
				"Project.updated"=>"desc",
			),
			"limit"=>$this->pagelimit,
			"offset"=>$this->pagelimit*($page-1)
		)); //grabs from model. returned as array
		foreach($projects as &$project){
			$page_ids = array();
			foreach($project["Page"] as $page){
				$page_ids[] = $page["id"];
			}
			$latest_image = $this->Image->find("first", array(  //paginate
				"conditions" => array(
					"page_id"=>$page_ids
				), 
				"order"=> array(
					"Image.created"=>"desc"
				)
			));
			$project["latest_image"]=$latest_image["Image"];
			$image_folder = str_replace(" ", "-", $project['Project']['name']);
			$project["image_folder"]=$image_folder;
		}
		return $projects;
	}
	
	function __getFollowingProjects($page=1) {
		$following_people = $this->Connection->find("all", array( //not-paginate
			"conditions"=> array(
				"following_user_id"=>$this->user['User']['id']
			)));
		//$following_project
		$user_ids = array();
		foreach($following_people as $following_person){
			$user_ids[] = $following_person['User']['id'];
		}
		$following_projects = $this->Project->find('all',array(  //paginate
			'conditions'=>array(
				'user_id'=>$user_ids
			),
			'recursive'=>0,
			'order'=>array('Project.updated'=>'desc'),
			"limit"=>$this->pagelimit,
			"offset"=>$this->pagelimit*($page-1)
		));
		//getting the image for the 
		foreach($following_projects as &$following_project){
			$following_page_ids = $this->Page->find('all',array(  //paginate
			'conditions'=>array(
				'project_id'=>$following_project['Project']['id'])));
			//print_r($following_page_ids);
			$following_page_id_array = array();
			foreach($following_page_ids as $following_page_id){
				$following_page_id_array[] = $following_page_id['Page']['id'];
			}
			$latest_following_image = $this->Image->find("first", array(  //paginate
				"conditions" => array(
					"page_id"=>$following_page_id_array
				), 
				"order"=> array(
					"Image.created"=>"desc"
				)
			));
			$following_project["latest_image"]=$latest_following_image["Image"];
			$following_image_folder = str_replace(" ", "-", $following_project['Project']['name']);
			$following_project["image_folder"]=$following_image_folder;
		}
		return $following_projects;
	}

}
