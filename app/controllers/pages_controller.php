<?php
class PagesController extends AppController {

	var $name = 'Pages';
	var $uses = array("Project","User","Page", "Image", "Connection");

	function index() {
		$this->redirect(array('controller' => 'homepage','action'=>'index'));
	}
	
	function beforeFilter() {
        $this->Auth->allow('share');
    }
	
	function share($user = null, $hash_id = null, $imageID = null){
		$id = base64_decode($hash_id); //page ID
		if (!$id) {
			$this->Session->setFlash(__('Invalid page', true));
			$this->redirect(array('action' => 'index'));
		}
		$page = $this->Page->find("all", array( 
			"conditions" => array(
				"Page.id"=> $id
			)
		));
		$userID = $page[0]['Project']['user_id'];
		$user = $this->User->find("all", array(
			"conditions" => array(
				"User.id"=>  $userID
			)
		));
		$loggedInUser = $this->Auth->user();
		$connections = $this->Connection->find("all", array(
			"conditions" => array(
				"user_id"=> $loggedInUser['User']['id']
			)
		));
		$following = 0; //Checks if the logged in user exists and if they follow the uploader
		if($loggedInUser){		
			for ($i = 0; $i < count($user[0]['Connection']); $i++) {
			    if(	$user[0]['User']['id'] == $connections[$i]['Connection']['following_user_id'] || $user[0]['User']['id']==$loggedInUser['User']['id'] ){
			    	$following = 1;
			    }
			}
		}
		$history = "";
		//building the image arrays
		$images = array();
		
		$showBreadcrumbs = 0;
		
		//checks if you're following the user
		if($following == 1){
			$showBreadcrumbs = 1;
			if($imageID){
				$images[0] = $this->Image->find("first", array( // find first
				"conditions" => array(
						"Image.id"=> $imageID
					)));
					
				$moreImages = $this->Image->find("all", array( // find all
				"conditions" => array(
						"page_id"=> $id
					),"order"=> array(
						"Image.created"=>"desc"
					)));
				for ($i = 0; $i < count($moreImages); $i++){
					if($moreImages[$i]["Image"]["id"]!=$imageID){
						array_push($images,$moreImages[$i]);
					}
				}
			} else {
				$moreImages = $this->Image->find("all", array( // find all
				"conditions" => array(
						"page_id"=> $id
					),"order"=> array(
						"Image.created"=>"desc"
					)));
				for ($i = 0; $i < count($moreImages); $i++){
					array_push($images,$moreImages[$i]);
				}
			}
			if(count($images)>1){
				$history = "<h2>Revision History</h2>";
			
			}
		} else { 
			if($imageID){
				$image = $this->Image->find("first", array( //find first
					"conditions" => array(
							"Image.id"=> $imageID
						),"order"=> array(
							"Image.created"=>"desc"
						)));	
			} else {
				$image = $this->Image->find("first", array( // find all
				"conditions" => array(
						"page_id"=> $id
					),"order"=> array(
						"Image.created"=>"desc"
					)));
			}
			$images[0]=$image; //put in an array to make it work with view
		}
				
		$url = "http://designbox.es/pages/share/".$user[0]['User']['username']['username']."/".base64_encode($images[0]['Page']['id'])."/".$images[0]['Image']['id'];
		//building share section
		if ($user[0]["User"]['id'] == $loggedInUser["User"]['id']){
		
		$shareSection =  "
		<div class ='shareLink'>
			<h2>Share Your Designs:</h2>
			Share This Revision:<a href = \"".$url."\">".$url."</a>
			Share Updating Link:<a href = \"http://designbox.es/pages/share/".$user[0]['User']['username']['username']."/".base64_encode($images[0]['Page']['id'])."\">http://designbox.es/pages/share/".$user[0]['User']['username']['username']."/".base64_encode($images[0]['Page']['id'])."</a>
		</div>
			<dl>
			<dt>Pin It:</dt>
				<dd><a href='http://pinterest.com/pin/create/button/?url=".$url."&media=http://www.designbox.es/". $images[0]['Image']['url'] ."/". $images[0]['Image']['filename']."&description=A%20Design%20from%20Designbox' class='pin-it-button' count-layout='horizontal'><img border='0' src='//assets.pinterest.com/images/PinExt.png' title='Pin It' /></a>
			<dt>Tweet:</dt>
				<dd><a href='https://twitter.com/share' class='twitter-share-button' data-text='Check out this image that I uploaded' data-via='DesignBoxes' data-related='DesignBoxes' data-hashtags='dbox'>Tweet</a></dd>
			<dt>Facebook:</dt>
			</dl>
		<div class='fb-like' data-href='".$url."\' data-send='true' data-layout='button_count' data-width='120' data-show-faces='false' data-colorscheme='dark' data-font='verdana'></div>";
		} else{
			$shareSection =  "";
		}
		$date = date("jS M. Y", strtotime($images[0]['Image']['created']));
		$this->set('date', $date );
		$this->set('page', $page );
		$this->set("images",$images); //sends it to the view
		$this->set("user", $user);
		$this->set("shareSection",$shareSection);
		$this->set("history", $history);
		$this->set("breadcrumbs",$showBreadcrumbs);
	}
		
	function share2($user = null, $hash_id = null) {
		$this->share($user,$hash_id);
	}	
		

	function view($id = null) {
		$user = $this->Auth->user();
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid page', true));
			$this->redirect(array('action' => 'index'));
		}
		//$this->set('page', $this->Page->read(null, $id));
		//g:ia jS M L
		$images = $this->Image->find("all", array(
				"conditions" => array(
						"page_id"=> $id
					),"order"=> array(
						"Image.created"=>"desc"
					)));
				
				
				
		//date with time ("g:ia jS M. Y"
		//print_r($images);
		
		$date = date("jS M. Y", strtotime($images[0]['Image']['created']));
		
		if(!empty($images)){
		
			$page = $this->Page->find("all", array(
				"conditions" => array(
					"Page.id"=> $id
				)));
		}
			$this->set('date', $date );
			$this->set('page', $page );
			$this->set("images",$images); //sends it to the view
			$this->set("user", $user);
	}

	function add() {
		$user = $this->Auth->user();
		if (!empty($this->data)) {
						
			$pagedata = array();
			$pagedata['Page']['name'] = $this->data['Image']['page'];
			$pagedata['Page']['project_id'] = $this->data['Image']['project_id'];
			
			
			
			$this->Page->create();
			if ($this->Page->save($pagedata)) {
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
					$this->Project->id = $pagedata['Page']['project_id'];
					$this->Project->saveField('updated',date('Y-m-d H:i:s'));
				}			
				$this->Session->setFlash(__('The project has been saved', true));
				$this->redirect(array('action' => 'index'));
				print_r("project");
			} else {
				//$this->Session->setFlash(__('The project could not be saved. Please, try again.', true));
			}				
		}
		$projects = $this->Page->Project->find('list',array('conditions'=>array('user_id'=>$user['User']['id'])));
		$this->set(compact('projects'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid page', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Page->save($this->data)) {
				$this->Session->setFlash(__('The page has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Page->read(null, $id);
		}
		$projects = $this->Page->Project->find('list');
		$this->set(compact('projects'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for page', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Page->delete($id)) {
			$this->Session->setFlash(__('Page deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Page was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	
	// Function for cleaning any input, submitted by any form etc.
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
