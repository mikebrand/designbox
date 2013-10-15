<?php
/* Connection Fixture generated on: 2011-09-18 14:49:40 : 1316321380 */
class ConnectionFixture extends CakeTestFixture {
	var $name = 'Connection';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'updated' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'following_user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'created' => '2011-09-18 14:49:40',
			'updated' => '2011-09-18 14:49:40',
			'user_id' => 1,
			'following_user_id' => 1
		),
	);
}
