<?php
class ProjectsController extends AppController {

	var $name = 'Projects';
	var $uses = array("Project","Page", "Image", 'User');

	function index() {
		$user = $this->Auth->user();
		$projects = $this->Project->find("all", array(
				"conditions" => array(
					"user_id"=> $user['User']['id']
				)
				
			));
		$this->redirect(array('controller' => 'homepage','action'=>'index'));
	}
	
	function view($id=null) {
		$project = $this->Project->findById($id);
		if (!$id || empty($project)) {
			$this->Session->setFlash(__('Invalid project', true));
			$this->redirect(array('action' => 'index'));
		}
		$formattedpages = array();
		$pages = $this->Page->find("all", array(
			"conditions" => array(
				"project_id"=> $id
			), "order"=> array(
				"Page.updated"=>"desc"
			)
		));
		foreach($pages as &$page){
			$formattedpage = array();
			$formattedpage['page_id'] = $page['Page']['id'];
			$formattedpage['page_id_64'] = base64_encode($page['Page']['id']);
			$formattedpage['page_name'] = $page['Page']['name'];
			$latest_image = $this->Image->find("first", array(
				"conditions" => array(
					"page_id"=>$page['Page']['id']
				), 
				"order"=> array(
					"Image.created"=>"desc"
				)
			));
			$formattedpage['image_url'] = $latest_image["Image"]['url'];
			$formattedpage['image_filename'] = $latest_image["Image"]['filename'];
			$formattedpages[] = $formattedpage;
		}
		$this->set("project_name",$project['Project']['name']);
		$this->set("pagedata",json_encode($formattedpages));
	}

	function view2($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid project', true));
			$this->redirect(array('action' => 'index'));
		}
		$pages = $this->Page->find("all", array(
			"conditions" => array(
				"project_id"=> $id
			), "order"=> array(
				"Page.updated"=>"desc"
			)
		)); //grabs from model. returned as array
		foreach($pages as &$page){
			$image_ids = array();
			foreach($page["Image"] as $image){
				$image_ids[] = $image["id"];
			}
			$latest_image = $this->Image->find("first", array(
				"conditions" => array(
					"page_id"=>$page['Page']['id']
				), 
				"order"=> array(
					"Image.created"=>"desc"
				)
			));
			$page["latest_image"]=$latest_image["Image"];
		}
		$this->set("pages",$pages);
	}

	function add() {
	$user = $this->Auth->user();
		
		if (!empty($this->data)) {
			$projectdata = array();
			$projectdata['Project']['user_id'] = $user['User']['id'];
			$projectdata['Project']['name'] = $this->data['Image']['name'];
			//$projectdata['Project']['description'] = $this->data['Image']['description'];
			$this->Project->create();
			if ($this->Project->save($projectdata)) {
				$pagedata = array();
				$pagedata['Page']['name'] = $this->data['Image']['page'];
				$pagedata['Page']['project_id'] = $this->Project->id;
				$this->Page->save($pagedata);
				
				$imagedata = array();
				$date = getdate();
				$unique_date = $date['0'];
				$page = $this->Page->findById($this->Page->id);
				$imagedata['Image']['url'] = 'files/'.$user['User']['username']. "/".str_replace(" ", "_", $page['Project']['name'])."/".str_replace(" ", "_", $page['Page']['name'])."/".$unique_date;
				$imagedata['Image']['filename'] = $this->data['Image']['filename'];
				$imagedata['Image']['page_id'] = $page['Page']['id'];
				$this->Image->theURL = $imagedata['Image']['url'];
				$this->Image->create();
				if ($this->Image->save($imagedata)) {
					$this->Image->theURL = $user['User']['username']."/";
				}			
				$this->Session->setFlash(__('The project has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.', true));
			}				
		}
		$users = $this->Project->User->find('list',array('conditions'=>array('id'=>$user['User']['id'])));
		$this->set(compact('users'));	
	}
	
	function newProject(){ 				//working on new upload manager
		if (!empty($this->data)) 
			{
			$projectdata = array();
			$projectdata['Project']['user_id'] = $user['User']['id'];
			$projectdata['Project']['name'] = $this->data['Image']['name'];
			$projectdata['Project']['description'] = $this->data['Image']['description'];
			$this->Project->create();
			if ($this->Project->save($projectdata)) {
				$pagedata = array();
				$pagedata['Page']['name'] = $this->data['Image']['page'];
				$pagedata['Page']['project_id'] = $this->Project->id;
				$this->Page->save($pagedata);
				
				$imagedata = array();
				$date = getdate();
				$unique_date = $date['0'];
				$page = $this->Page->findById($this->Page->id);
				$imagedata['Image']['url'] = 'files/'.$user['User']['username']. "/".str_replace(" ", "_", $page['Project']['name'])."/".str_replace(" ", "_", $page['Page']['name'])."/".$unique_date;
				$imagedata['Image']['filename'] = $this->data['Image']['filename'];
				$imagedata['Image']['page_id'] = $page['Page']['id'];
				$this->Image->theURL = $imagedata['Image']['url'];
				$this->Image->create();
				if ($this->Image->save($imagedata)) 
				{
					$this->Image->theURL = $user['User']['username']."/";
				}			
				$this->Session->setFlash(__('The project has been saved', true));
				$this->redirect(array('action' => 'index'));
				} else 
				{
				$this->Session->setFlash(__('The project could not be saved. Please, try again.', true));
				}
			}
		die();
	}
	
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid project', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Project->save($this->data)) {
				$this->Session->setFlash(__('The project has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Project->read(null, $id);
		}
		$users = $this->Project->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for project', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Project->delete($id)) {
			$this->Session->setFlash(__('Project deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Project was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function clean_input($i){
    	if(!get_magic_quotes_gpc()) $i = addslashes($i);
    	$i = rtrim($i);
    	$look = array_merge(
        array_map('chr', range(0,31)),
        array("<", ">", ":", '"', "/", "\\", "|", "?", "*"));;
    	
    	$i = str_replace($look, "", $i);
    	return $i;
	}
}
