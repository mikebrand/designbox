<?php
/* Page Test cases generated on: 2011-09-18 14:48:08 : 1316321288*/
App::import('Model', 'Page');

class PageTestCase extends CakeTestCase {
	var $fixtures = array('app.page', 'app.project', 'app.user', 'app.connection', 'app.image');

	function startTest() {
		$this->Page =& ClassRegistry::init('Page');
	}

	function endTest() {
		unset($this->Page);
		ClassRegistry::flush();
	}

}
