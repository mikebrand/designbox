<?php
class AjaxController extends AppController {
	var $name = 'Api';
	var $uses = array('User','Project', 'Page','Image');
	var $components = array('Auth','Security');
	var $response = array();


	function beforeFilter() {

		header('Content-Type: application/json');
		$this->Auth->allow('*');
		/*
		$this->Security->loginOptions = array(
			'type'=>'basic',
			'login'=>'authenticate',
			'realm'=>'API'
		);
		$this->Security->loginUsers = array();
		$this->Security->validatePost = false;
		$usr = $this->Auth->user();
		$this->Auth->allow('*');
		$this->Security->requireLogin();
		/*$myFile = $_SERVER['DOCUMENT_ROOT']."/jojo.txt";
		$fh = fopen($myFile, 'a');
		fwrite($fh, "START\n");
		fwrite($fh, print_r($_REQUEST,true));
		fwrite($fh, print_r($_POST,true));
		fwrite($fh, print_r($_FILES,true));
		fwrite($fh, "END\n");
		fclose($fh);*/
		parent::beforeFilter();
	}
	
	function checkAuth() {
		echo '1';
		die();
	}


	Function authenticate($args) {
		
		$data[$this->Auth->fields['username']] = $args['username']; 
    	$data[$this->Auth->fields['password']] = $this->Auth->password($args['password']); 
    	if ($this->Auth->login($data) ) { 
        	return true; 
	    } else { 
    	    //$this->Security->blackHole($this, 'login');  //WTF?
        	return false; 
	    } 
	}

	
	
	Function create_project(){
	
	}
	
	function get_page_modified($page_id, $page_modified){
		$page = $this->Page->find("first", array(
				"conditions" => array(
					"Page.id"=> $page_id
				)));
		if(strtotime($page["Page"]["updated"]) == $page_modified){
			$response = 'same';
		} else {
			$response = 'diff';
		}
		echo json_encode($response);
		die();
		
		
	}
	
	Function create_page(){
	
	}
	
	
	
	Function add_images(){
		ini_set('memory_limit', '64M');
		$user = $this->Auth->user();
		if(empty($user)) {
			$user = $this->User->find('first',array('conditions'=>array('id'=>2)));
		}
		$date = getdate();
		$unique_date = $date['0'];
		if (!empty($this->data)) {
			//$page = $this->Page->find($this->data['Image']['page_id']);
			$this->data['Image']['url'] = 'files/'.$user['User']['username']. "/".str_replace(" ", "_", $page['Project']['name'])."/".str_replace(" ", "_", $page['Page']['name'])."/".$unique_date;
			$this->Image->theURL = $this->data['Image']['url'];
			$this->Image->create();
			if ($this->Image->save($this->data)) {
				$this->Image->theURL = $user['User']['username']."/";
				$this->Session->setFlash(__('The image has been saved', true));
				$this->Project->id = $page['Project']['id'];
				$this->Project->saveField('updated',date('Y-m-d H:i:s'));
				$this->redirect(array('action' => 'index'));
				
				
				
			} else {
				$this->Session->setFlash(__('The image could not be saved. Please, try again.', true));
			}
		}
		
		//for displaying the page
		$projectids = $this->Project->find('list',array('conditions'=>array('user_id'=>$user['User']['id']),'fields'=>array('id')));
		$pages = $this->Image->Page->find('list',array('conditions'=>array('project_id'=>$projectids)));
		$this->set(compact('pages'));
	}

	function runOutput() {
		print_r(json_encode($this->response));
		die();
	}

}
?>