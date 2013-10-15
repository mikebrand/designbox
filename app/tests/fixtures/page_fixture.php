<?php
/* Page Fixture generated on: 2011-09-18 14:48:08 : 1316321288 */
class PageFixture extends CakeTestFixture {
	var $name = 'Page';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'updated' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'project_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'created' => '2011-09-18 14:48:08',
			'updated' => '2011-09-18 14:48:08',
			'project_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet'
		),
	);
}
