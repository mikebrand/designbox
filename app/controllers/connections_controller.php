<?php
class ConnectionsController extends AppController {

	var $name = 'Connections';

	function index() {
		$this->redirect(array('controller' => 'homepage','action'=>'index'));
	}

	//Probably Crap
	/*function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid connection', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('connection', $this->Connection->read(null, $id));
	}

	function add($id=null) {
	$user = $this->Auth->user();
		if (!empty($id)) {
		
			$this->data['Connection']['following_user_id']= $user['User']['id'];
			$this->data['Connection']['user_id'] =$id ;
			
			
			$this->Connection->create();
			if ($this->Connection->save($this->data)) {
				$this->Session->setFlash(__('Commence Following', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The connection could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Connection->User->find('list',
			array('conditions'=>
				array('NOT'=>
					array('id'=>$user['User']['id']))));
		$this->set(compact('users'));
		$this->redirect(array('action' => 'index'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid connection', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Connection->save($this->data)) {
				$this->Session->setFlash(__('The connection has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The connection could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Connection->read(null, $id);
		}
		$users = $this->Connection->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for connection', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Connection->delete($id)) {
			$this->Session->setFlash(__('Unfollow successful.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Connection was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}*/
}
