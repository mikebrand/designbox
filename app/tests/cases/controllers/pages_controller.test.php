<?php
/* Pages Test cases generated on: 2011-09-18 14:52:12 : 1316321532*/
App::import('Controller', 'Pages');

class TestPagesController extends PagesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PagesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.page', 'app.project', 'app.user', 'app.connection', 'app.image');

	function startTest() {
		$this->Pages =& new TestPagesController();
		$this->Pages->constructClasses();
	}

	function endTest() {
		unset($this->Pages);
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
