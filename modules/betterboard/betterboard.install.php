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
			'featured'          => SQR_boolean.' DEFAULT 0',
			'commentCount'      => SQR_ID.' DEFAULT 0',
			'sticky'            => SQR_boolean.' DEFAULT 0',
			'locked'            => SQR_boolean.' DEFAULT 0',
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
	$statement=$db->prepare('newCategory','admin_betterboard');
	$statement->execute(array(
		'name'              => 'My Category',
		'shortName'         => 'my-category',
		'sortOrder'         => 1,
	)) or var_dump($statement->errorInfo());
	$statement=$db->prepare('newForum','admin_betterboard');
	$statement->execute(array(
		'name'              => 'My Forum',
		'parentCategory'    => $db->lastInsertId(),
		'parentForum'       => 0,
		'shortName'         => 'my-forum',
		'sortOrder'         => 1,
	)) or var_dump($statement->errorInfo());
	$statement=$db->prepare('newTopic','betterboard');
	$statement->execute(array(
		'owner'             => 1,
		'parentForum'       => $db->lastInsertId(),
		'name'              => 'My Topic',
		'shortName'         => 'my-topic',
		'content'           => 'Welcome to BetterBoard, a better board!',
		'sortOrder'         => 1,
	)) or var_dump($statement->errorInfo());
	$statement=$db->prepare('newPost','betterboard');
	$statement->execute(array(
		'owner'             => 1,
		'parentTopic'       => $db->lastInsertId(),
		'content'           => 'Wow! Your first reply!',
		'weight'            => 1,
	)) or var_dump($statement->errorInfo());
	return TRUE;
}
function betterboard_uninstall($db,$lang='en_us'){
	$db->dropTable('betterboard_forums');
	$db->dropTable('betterboard_topics');
	$db->dropTable('betterboard_posts');
	$db->dropTable('betterboard_categories');
}