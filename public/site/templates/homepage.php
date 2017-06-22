<?php snippet('head') ?>

<?php snippet('view-start', array('pageclass' => " Page--single"))?>

			<?php
				if($page->isErrorPage()){
					?>
					<div class="TextBlock TextBlock--center">
						<div class="TextBlock-body">
							<div>
									<h2><?php echo $page->title() ?></h2>
									<?php echo $page->text()->kt() ?>
							</div>
						</div>
					</div>
			<?php
			} else {
				snippet('section/hero', array('section' => $page, 'scrollhint' => false));
				snippet('section/contentmenu', array('section' => $page));
				snippet('section/instagram', array('section' => $page));
				snippet('down',  array('section' => $page));
			}
			?>

<?php snippet('view-end')?>
<?php snippet('footer') ?>
