<?php

return function($site, $pages, $page) {
	// slides
	$slides = $page->gallery()->structure();

	// navigation
	



	return compact('slides');
};

?>
