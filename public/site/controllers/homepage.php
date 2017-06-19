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

	// awards
	$awards = $page->awards()->toStructure();
	$awarded = 0;
	foreach($awards as $key => $value){
		$awarded = $awarded + $value->awardcount()->int();
	}




	return compact('gallery', 'slides', 'slide', 'images', 'next', 'awards', 'awarded');
};

?>
