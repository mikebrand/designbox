<?php
/* Images Test cases generated on: 2011-09-18 14:51:57 : 1316321517*/
App::import('Controller', 'Images');

class TestImagesController extends ImagesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ImagesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.image', 'app.page', 'app.project', 'app.user', 'app.connection');

	function startTest() {
		$this->Images =& new TestImagesController();
		$this->Images->constructClasses();
	}

	function endTest() {
		unset($this->Images);
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
