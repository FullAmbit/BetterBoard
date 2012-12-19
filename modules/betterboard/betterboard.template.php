<?php
function betterboard_template_showMain($data){
	echo 'categories:<ul>';
	foreach($data->output['categories'] as $category){
		echo '<li>',$category['name'],'</li>';
	}
	echo '</ul>forums:<ul>';
	foreach($data->output['forums'] as $forum){
		echo '<li>
			<a href="',$data->output['forumRoot'],'forum/',$forum['shortName'],'">
				',$forum['name'],'
			</a>
		</li>';
	}
	echo '</ul>';
}
function betterboard_template_showForum($data){
	echo 'forum info:';
	var_dump($data->output['forum']);
	echo 'topics:<ul>';
	foreach($data->output['topics'] as $topic){
		echo '<li>
			<a href="',$data->output['forumRoot'],'topic/',$topic['shortName'],'">
				',$topic['name'],'
			</a>
		</li>';
	}
	echo '</ul>';
}
function betterboard_template_showTopic($data){
	echo 'topic:';
	var_dump($data->output['topic']);
	echo 'replies:';
	var_dump($data->output['posts']);
}
function betterboard_template_showDefault($data){
	echo '404 page?';
}