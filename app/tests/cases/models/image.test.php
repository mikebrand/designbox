<?php
/* Image Test cases generated on: 2011-09-18 14:49:00 : 1316321340*/
App::import('Model', 'Image');

class ImageTestCase extends CakeTestCase {
	var $fixtures = array('app.image', 'app.page', 'app.project', 'app.user', 'app.connection');

	function startTest() {
		$this->Image =& ClassRegistry::init('Image');
	}

	function endTest() {
		unset($this->Image);
		ClassRegistry::flush();
	}

}
