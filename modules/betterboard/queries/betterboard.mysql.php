<?php
function betterboard_addQueries() {
	return array(
		// SELECT
		'getCategoryByShortName' => '
			SELECT * FROM !prefix!betterboard_categories
			WHERE shortName = :shortName
			LIMIT 1
		',
		'getForumByShortName' => '
			SELECT * FROM !prefix!betterboard_forums
			WHERE shortName = :shortName
			LIMIT 1
		',
		'getTopicByShortName' => '
			SELECT * FROM !prefix!betterboard_topics
			WHERE shortName = :shortName
			LIMIT 1
		',
		'getCategories' => '
			SELECT * FROM !prefix!betterboard_categories
			ORDER BY `sortOrder` ASC
		',
		'getForums' => '
			SELECT * FROM !prefix!betterboard_forums
			ORDER BY `sortOrder` ASC
		',
		'getTopicsByForum' => '
			SELECT * FROM !prefix!betterboard_topics
			WHERE parentForum = :parentForum
			ORDER BY `added` ASC
		',
		'getPostsByTopic' => '
			SELECT * FROM !prefix!betterboard_posts
			WHERE parentTopic = :parentTopic
			ORDER BY `added` ASC
		',
		// INSERT
		'newTopic' => '
			INSERT INTO !prefix!betterboard_topics
			       ( owner, parentForum, name, shortName, content, sortOrder)
			VALUES (:owner,:parentForum,:name,:shortName,:content,:sortOrder)
		',
		'newPost' => '
			INSERT INTO !prefix!betterboard_posts
			       ( owner, parentTopic, content, weight)
			VALUES (:owner,:parentTopic,:content,:weight)
		',
	);
}