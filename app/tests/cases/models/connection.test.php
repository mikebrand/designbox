<?php
/* Connection Test cases generated on: 2011-09-18 14:49:40 : 1316321380*/
App::import('Model', 'Connection');

class ConnectionTestCase extends CakeTestCase {
	var $fixtures = array('app.connection', 'app.user', 'app.project', 'app.page', 'app.image');

	function startTest() {
		$this->Connection =& ClassRegistry::init('Connection');
	}

	function endTest() {
		unset($this->Connection);
		ClassRegistry::flush();
	}

}
