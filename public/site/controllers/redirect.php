<?php

return function($site, $pages, $page) {
	// target
	if($page->intern()->isNotEmpty()){
		$target = $page->intern();
	}else {
		$target = $page->redirect();
	}

	return compact('target');
};

?>
