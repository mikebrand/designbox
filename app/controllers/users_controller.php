<?php

class UsersController extends AppController {

	var $name = 'Users';
	var $uses = array("Project","Page", "Image", "User", "Connection");
	var $components = array('Email');
	
	function beforeFilter() {
		$this->Auth->allow('add','register', 'forgotpassword','resetpassword');
	}

	function index() {
		$this->redirect(array('controller' => 'homepage','action'=>'index'));
	}

	function view($username = null) {
		$currentUser = $this->Auth->user();
		if (!$username) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$user = $this->User->find("first", array(
			"conditions" => array(
				"username"=> $username
			)
		));
		$connection = $this->Connection->find("first", array(
			"conditions" => array(
				"user_id"=> $user['User']['id'], "following_user_id"=>$currentUser['User']['id']
			)
		));
		if( $currentUser['User']['id']==$user['User']['id']){
			$linkText="";
		} else if($connection){
			$linkText="<a class = 'follow' href = '/connections/delete/".$connection['Connection']['id']."'>Unfollow ".$user['User']['name']."</a>";
		} else {
			$linkText="<a class = 'follow' href = '/connections/add/".$user['User']['id']."'>Follow ".$user['User']['name']."</a>";
		}
		$projects = $this->Project->find("all", array(
			"conditions" => array(
				"user_id"=> $user['User']['id']
			), "order"=> array(
					"Project.updated"=>"desc"
			)
		)); //grabs from model. returned as array
		foreach($projects as &$project){
			$page_ids = array();
			foreach($project["Page"] as $page){
				$page_ids[] = $page["id"];
			}
			$latest_image = $this->Image->find("first", array(
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
		$this->set("projects",$projects);
		$this->set('user', $user);
		$this->set('currentUser', $currentUser);
		$this->set('linkText',$linkText);	
	}
	
	function add() {
		$this->redirect(array('action'=>'register'));
	}

	function register() {
		if (!empty($this->data)) {
			$correctbetacode = false;
			if($this->data['User']['betacode'] == 'foolab') {
				$correctbetacode = true;
			}
			if($correctbetacode) {
				$this->User->create();
				if ($this->User->save($this->data)) {
					$this->Email->reset();
					$this->set('username',$this->data['User']['username']);
					$this->Email->from = 'Design Box <noreply@designbox.es>';
					$this->Email->to = $this->data['User']['name'].' <'.$this->data['User']['email'].'>';
					$this->Email->subject = 'Thank you for registering with Design Box';
					$this->Email->sendAs = 'both';
					$this->Email->template = 'registration';
					$this->Email->send();
					$this->Session->setFlash(__('Thank you for registering', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('You could not be registered at this time, please try again later', true));
				}
			} else {
				$this->Session->setFlash(__('Invalid beta code', true));
			}
		}
	}
	
	function forgotpassword() {
		if(!empty($this->data)) {
			$user = $this->User->find('first',array('conditions'=>array('email'=>$this->data['User']['email'])));
			if(!empty($user)) {
				$resetkey = substr(md5(uniqid(mt_rand(), true)), 0, 24);
				$this->User->id = $user['User']['id'];
				$this->User->saveField('resethash',$resetkey);
				$this->set('resetkey',$resetkey);
				$this->set('userid',$user['User']['id']);
			    $this->Email->reset();
				$this->Email->from = 'Design Box <noreply@designbox.es>';
				$this->Email->to = $user['User']['name'].' <'.$user['User']['email'].'>';
				$this->Email->subject = 'Password Retrieval';
				$this->Email->sendAs = 'both';
				$this->Email->template = 'forgotpassword';
				$this->Email->send();
				$this->Session->setFlash(__('Please check your email', true));
				$this->redirect(array('action'=>'login'));
				die();
			} else {
				$this->Session->setFlash(__('This email account is not registered', true));
				$this->redirect(array('action'=>'login'));
				die();
			}
		}
	}
	
	function resetpassword($userid=-1,$resethash='') {
		if(isset($this->data)) {
			$userid = $this->data['User']['userid'];
			$resethash = $this->data['User']['hash'];
			$user = $this->User->find('first',array('conditions'=>array('id'=>$userid,'resethash'=>$resethash)));
			if($this->data['User']['password'] == $this->data['User']['confirm_password']) {
				$this->User->id = $user['User']['id'];
				$this->User->saveField('password',$this->Auth->password($this->data['User']['password']));
				$this->User->id = $user['User']['id'];
				$this->User->saveField('resethash','');
				$this->Session->setFlash(__('Your password has been reset', true));
				$this->redirect('/');
			} else {
				$this->Session->setFlash(__('Passwords do not match', true));
			}
		}
		$this->set('userid',$userid);
		$this->set('resethash',$resethash);
		$user = $this->User->find('first',array('conditions'=>array('id'=>$userid,'resethash'=>$resethash)));
		if(empty($user)) {
			$this->Session->setFlash(__('Invalid link, please try again', true));
			$this->redirect(array('action'=>'login'));
			die();
		}
	}
	
	function login() {

    }
    
    function logout() {
    	$this->redirect($this->Auth->logout());
    }
    
    
    /* PROBABLY CRAP */
    /*function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}*/
    
}
