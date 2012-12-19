<?php
function betterboard_buildContent($data,$db){
	$data->output['forumRoot']=$data->linkRoot.$data->action[0].'/'; // TODO detect if homepage, adjust then
	switch($data->action[1]){
		case FALSE: // main view
			$statement=$db->prepare('getCategories','betterboard');
			$statement->execute();
			$data->output['categories']=$statement->fetchAll(PDO::FETCH_ASSOC);
			$statement=$db->prepare('getForums','betterboard');
			$statement->execute();
			$data->output['forums']=$statement->fetchAll(PDO::FETCH_ASSOC);
			break;
		case 'forum':
			$statement=$db->prepare('getForumByShortName','betterboard');
			$statement->execute(array(
				'shortName' => $data->action[2]
			));
			$data->output['forum']=$forum=$statement->fetch(PDO::FETCH_ASSOC);
			$statement=$db->prepare('getTopicsByForum','betterboard');
			$statement->execute(array(
				'parentForum' => $forum['id']
			));
			$data->output['topics']=$statement->fetchAll(PDO::FETCH_ASSOC);
			break;
		case 'topic':
			$statement=$db->prepare('getTopicByShortName','betterboard');
			$statement->execute(array(
				'shortName' => $data->action[2]
			));
			$data->output['topic']=$topic=$statement->fetch(PDO::FETCH_ASSOC);
			$statement=$db->prepare('getPostsByTopic','betterboard');
			$statement->execute(array(
				'parentTopic' => $topic['id']
			));
			$data->output['posts']=$statement->fetchAll(PDO::FETCH_ASSOC);
			break;
	}
}
function betterboard_content($data){
	switch($data->action[1]){
		case FALSE:
			betterboard_template_showMain($data);
			break;
		case 'forum':
			betterboard_template_showForum($data);
			break;
		case 'topic':
			betterboard_template_showTopic($data);
			break;
		default:
			betterboard_template_showDefault($data);
			break;
	}
}