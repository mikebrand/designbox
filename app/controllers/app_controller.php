<?php class AppController extends Controller {
    // AppController's components are NOT merged with defaults,
    // so session component is lost if it's not included here!
    var $components = array('Auth', 'Session');
    
  	function beforeRender() {
  		$this->set('userdetails',$this->Auth->User());
  	}
    
   }
   
   
   
   
   ?>