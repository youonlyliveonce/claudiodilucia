<?php

return function($site, $pages, $page) {
	// next
	if($page->hasNextVisible()){
		$next = $page->nextVisible();
	} else {
		if($page->parent()->hasNextVisible()){
			$next = $page->parent()->nextVisible();
		} else {
			$next = $site->homePage();
		}
	}
	// hasimage
	$hasimage = $page->image()->isNotEmpty();

	return compact('next', 'hasimage');
};

?>
