<?php
class ImagesController extends AppController {

	var $name = 'Images';
	var $helpers = array('Html', 'Form');
	var $components = array('Upload');
	var $uses = array('Image','Page','Project', 'User');

	function beforeFilter(){
		$this->Auth->allow('share');
		$this->Auth->allow('view');
		parent::beforeFilter();
	}
	function index() {
		$this->redirect(array('controller' => 'homepage','action'=>'index'));
	}
	
	function share($hash_id = null){
		$id = base64_decode($hash_id);
		$img = $this->Image->find("all", array(
			"conditions" => array(
				'Image.id'=>$id)));
		$this->set("img", $img);
	}
	
	function view($id = null) {
		$this->set('removeheader',true);
		$user = $this->Auth->user();
		if (!$id) {
			$this->Session->setFlash(__('Invalid page', true));
			$this->redirect(array('action' => 'index'));
		}
		//$this->set('page', $this->Page->read(null, $id));
		$main_image = $this->Image->find("first", array(
		"conditions" => array(
		    "Image.id"=> $id
		)));
		$images = $this->Image->find("all", array(
			"conditions" => array(
			    "page_id"=> $main_image['Page']['id']
			), "order"=> array(
			    	"Image.created"=>"desc"
			    
			)));
		$date = date("jS M. Y", strtotime($main_image['Image']['created']));
		if(!empty($images)){
			$page = $this->Page->find("first", array(
				"conditions" => array(
					"Page.id"=> $main_image['Page']['id']
			)));
		}
		$this->set('page', $page );
		$this->set('main_image', $main_image);
		$this->set('date', $date );
		$this->set("images",$images); //sends it to the view
		$this->set("user", $user);	
	}

	function add() {
		ini_set('memory_limit', '64M');
		$user = $this->Auth->user();
		if (!empty($this->data)) {
			//create the project if it doesn't exist
			$projectid = 0;
			if(strpos($this->data['project'],"project_") === false) {
				$projectdata = array('user_id'=>$user['User']['id']);
				$projectdata['name'] = $this->data['project'];
				$projectdata['description'] = $this->data['project'];
				$this->Project->save($projectdata);
				$projectid = $this->Project->id;
			} else {
				$projectid = str_replace("project_","",$this->data['project']);
				$project = $this->Project->findById($projectid);
				if(empty($project)) {
					echo "fail project";
				}
			}
			//create the page if it doesn't exist
			$pageid = 0;
			if(strpos($this->data['page'],"page_") === false) {
				$pagedata = array('project_id'=>$projectid);
				$pagedata['name'] = $this->data['page'];
				$this->Page->save($pagedata);
				$pageid = $this->Page->id;
			} else {
				$pageid = str_replace("page_","",$this->data['page']);
				$page = $this->Page->findById($pageid);
				if(empty($page)) {
					echo "fail page";
				}
			}
			//create images for each of the files
			$files = $_FILES['files'];
			$numberoffiles = sizeOf($files['name']);
			$successfulupload = true;
			$failedfiles = array();
			for($i=0; $i<$numberoffiles; $i++) {
				$date = getdate();
				$unique_date = $date['0'];
				$page = $this->Page->findById($pageid);
				$imagedata = array();
				$imagedata['Image']['page_id'] = $pageid;
				$imagedata['Image']['url'] = 'files/'.$user['User']['username']. "/".str_replace(" ", "_", $page['Project']['name'])."/".str_replace(" ", "_", $page['Page']['name'])."/".$unique_date."_".$i;
				$imagedata['Image']['filename'] = array();
				$imagedata['Image']['filename']['name'] = $files['name'][$i];
				$imagedata['Image']['filename']['type'] = $files['type'][$i];
				$imagedata['Image']['filename']['tmp_name'] = $files['tmp_name'][$i];
				$imagedata['Image']['filename']['error'] = $files['error'][$i];
				$imagedata['Image']['filename']['size'] = $files['size'][$i];
				$this->Image->theURL = $imagedata['Image']['url'];
				$this->Image->create();
				if ($this->Image->save($imagedata)) {
					$this->Project->id = $page['Project']['id'];
					$this->Image->theURL = $user['User']['username']."/";
					$this->Project->saveField('updated',date('Y-m-d H:i:s'));
					$this->Page->id = $page['Page']['id'];
					$this->Page->saveField('updated',date('Y-m-d H:i:s'));
				} else {
					$successfulupload = false;
					$failedfiles[] = $files['name'][$i];
				}
			}
			if($successfulupload) {
				$this->Session->setFlash(__('The image has been saved', true));
			} else {
				$this->Session->setFlash(__('Some images could not be saved: '.implode(", ",$failedfiles), true));
			}
			$this->redirect(array('action' => 'index'));
			die();
		}
		//for displaying the page
		$projectids = $this->Project->find('list',array('conditions'=>array('user_id'=>$user['User']['id']),'fields'=>array('id')));
		$pages = $this->Image->Page->find('list',array('conditions'=>array('project_id'=>$projectids)));
		$this->set(compact('pages'));
		
		$projects = $this->Project->find('list',array('conditions'=>array('user_id'=>$user['User']['id'])));
		$pages = $this->Image->Page->find('all',array('conditions'=>array('project_id'=>$projectids)));
		$pagelist = array();
		foreach($pages as $page) {
			$pagelist['project_'.$page['Project']['id']]['page_'.$page['Page']['id']] = $page['Page']['name'];
		}
		$this->set('projects',$projects);
		$this->set('pagelist',$pagelist);
	}
	
	/* PROBABLY CRAP */
	/*function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid image', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Image->save($this->data)) {
				$this->Session->setFlash(__('The image has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The image could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Image->read(null, $id);
		}
		$pages = $this->Image->Page->find('list');
		$this->set(compact('pages'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for image', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Image->delete($id)) {
			$this->Session->setFlash(__('Image deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Image was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}*/
}
