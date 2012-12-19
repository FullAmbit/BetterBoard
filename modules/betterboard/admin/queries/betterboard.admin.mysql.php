<?php
function admin_betterboard_addQueries() {
	return array(
		'newCategory' => '
			INSERT INTO !prefix!betterboard_categories
			       ( name, shortName, sortOrder)
			VALUES (:name,:shortName,:sortOrder)
		',
		'newForum' => '
			INSERT INTO !prefix!betterboard_forums
			       ( parentForum, parentCategory, name, shortName, sortOrder)
			VALUES (:parentForum,:parentCategory,:name,:shortName,:sortOrder)
		',
	);
}