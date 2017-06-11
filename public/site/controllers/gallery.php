<?php

return function($site, $pages, $page) {
	// next
	$slides = $page->gallery()->structure();


	return compact('slides');
};

?>
