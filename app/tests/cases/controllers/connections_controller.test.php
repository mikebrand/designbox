<?php
/* Connections Test cases generated on: 2011-09-18 14:51:41 : 1316321501*/
App::import('Controller', 'Connections');

class TestConnectionsController extends ConnectionsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ConnectionsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.connection', 'app.user', 'app.project', 'app.page', 'app.image');

	function startTest() {
		$this->Connections =& new TestConnectionsController();
		$this->Connections->constructClasses();
	}

	function endTest() {
		unset($this->Connections);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
