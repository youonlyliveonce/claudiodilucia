<?php snippet('head') ?>

<?php snippet('view-start', array('pageclass' => " Page--multi"))?>

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
				$sections = $page->children()->visible();
				foreach($sections as $section):
						$snippet = implode("/", explode("_", $section->intendedTemplate()));
						snippet($snippet, array('section' => $section));
				endforeach;
			}
			?>

<?php snippet('view-end')?>
<?php snippet('footer') ?>
