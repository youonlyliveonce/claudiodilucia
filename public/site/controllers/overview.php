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
	// teaserlist
	$teaserlist = array();
	$children = $page->children()->visible();
	foreach ($children as $key => $value) {
		if($value->intendedTemplate() == 'gallery'){
			array_push($teaserlist, $value);
		}
	}

	return compact('gallery', 'slides', 'slide', 'teaserlist', 'next');
};

?>