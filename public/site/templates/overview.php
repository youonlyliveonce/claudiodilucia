<?php snippet('head'); ?>
<?php snippet('view-start', array('pageclass' => " Page--single")); ?>
<?php snippet('section/hero', array('section' => $page, 'scrollhint' => true)); ?>
<?php snippet('section/teaser', array('section' => $page)); ?>
<?php snippet('down',  array('section' => $page)) ?>
<?php snippet('view-end'); ?>
<?php snippet('footer'); ?>
