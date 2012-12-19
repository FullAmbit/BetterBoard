<?php
function betterboard_settings($data){
	return array(
		'name' => 'customize',
		'shortName' => 'customize',
		'version' => '0.1a'
	);
}
function betterboard_install($db,$drop=false,$firstInstall=false,$lang='en_us'){	
	$structures = array(
		'betterboard_categories' => array(
			'id'                => SQR_IDKey,
			'name'              => SQR_name,
			'shortName'         => SQR_shortName,
			'sortOrder'         => SQR_sortOrder,
			'UNIQUE KEY (`shortName`)'
		),
		'betterboard_forums' => array(
			'id'                => SQR_IDKey,
			'parentForum'       => SQR_ID.' DEFAULT 0',
			'parentCategory'    => SQR_ID.' DEFAULT 0',
			'name'              => SQR_name,
			'shortName'         => SQR_shortName,
			'sortOrder'         => SQR_sortOrder,
			'UNIQUE KEY (`shortName`)'
		),
		'betterboard_topics' => array(
			'id'                => SQR_IDKey,
			'owner'             => SQR_ID,
			'parentForum'       => SQR_ID,
			'name'              => SQR_name,
			'shortName'         => SQR_shortName,
			'added'             => SQR_added,
			'content'           => 'MEDIUMTEXT NOT NULL',
			'featured'          => SQR_boolean,
			'commentCount'      => SQR_ID,
			'sticky'            => SQR_boolean,
			'locked'            => SQR_boolean,
			'sortOrder'         => SQR_sortOrder,
			'UNIQUE KEY (`shortName`)'
		),
		'betterboard_posts' => array(
			'id'                => SQR_IDKey,
			'owner'             => SQR_ID,
			'parentTopic'       => SQR_ID,
			'added'             => SQR_added,
			'content'           => 'MEDIUMTEXT NOT NULL',
			'weight'            => SQR_ID
		),
	);
	if($drop){
		foreach($structures as $table=>$structure){
			$db->dropTable($table);
		}
	}
	foreach($structures as $table=>$structure){
		$db->createTable($table,$structure);
	}
}
function betterboard_uninstall($db,$lang='en_us'){
	$db->dropTable('betterboard_forums');
	$db->dropTable('betterboard_topics');
	$db->dropTable('betterboard_posts');
	$db->dropTable('betterboard_categories');
}