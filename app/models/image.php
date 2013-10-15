<?php
class Image extends AppModel {
	var $name = 'Image';
	var $displayField = 'url';
	var $theURL = "";
	var $actsAs = array(
        'MeioUpload' => array('filename'=>array(
        	'url' => 'files/{jojo}',
			'create_directory' => true,
			'allowed_mime' => array('image/jpeg', 'image/pjpeg', 'image/gif', 'image/png'),
			'allowed_ext' => array('.jpg', '.jpeg', '.png', '.gif'),
			'thumbsizes' => array(
				'index'  => array('width'=>460, 'height'=>200),
				'project' => array('width'=>300, 'height'=>187),
				'page'  => array('width'=>140, 'height'=>140)
			)
        ))
    );
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Page' => array(
			'className' => 'Page',
			'foreignKey' => 'page_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}