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

	// hero
	$gallery = false;
	if($page->typetoggle() == 'yes'){
		$gallery = true;
		$slides = $page->galleryfield()->toStructure();
	} else {
		$slide = $page->imagefield();
	}
	return compact('gallery', 'slides', 'slide', 'images');
};

?>
