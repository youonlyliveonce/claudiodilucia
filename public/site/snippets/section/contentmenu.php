<div class="Contentmenu [ Element ]" id="<?php echo $section->slug(); ?>_contentmenu">
	<div class="Contentmenu__inner">
		<ul class="Contentmenu__main">
			<?php foreach($site->children()->visible() as $item): ?>
					<?php if(!$item->isHomePage()): ?>
						<?php if($item->intendedTemplate() == 'redirect'): ?>
							<li>
								<div>
									<?php if( $item->intern()->isNotEmpty() ): ?>
										<a href="/<?= $site->language() ?>/<?= $item->intern(); ?>"><span><?= $item->title()->html() ?></span></a>
									<?php else: ?>
										<a href="<?= $item->redirect(); ?>" target="_blank"><span><?= $item->title()->html() ?></span></a>
									<?php endif; ?>
								</div>
							</li>
						<?php else : ?>
							<li>
								<div>
									<a href="/<?= $site->language() ?>/<?= $item->uri($site->language()) ?>/"><span><?= $item->title()->html() ?></span></a>
								</div>
							</li>
						<?php endif; ?>
					<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="Contentmenu__outer">
		<?php $counter = 0; ?>
		<?php foreach($site->children()->visible() as $item): ?>
			<?php if(!$item->isHomePage()): ?>
				<?php if( $item->hasVisibleChildren() ) : ?>
					<ul class="Contentmenu__sub" data-aos="blend" data-aos-duration="600" data-aos-delay="<?php echo $counter*500; ?>">
						<?php $children = $item->children()->visible(); ?>
						<?php foreach($children as $subitem): ?>
							<li>
								<a href="/<?= $site->language() ?>/<?= $subitem->uri($site->language()) ?>/"><span><?= $subitem->title()->html() ?></span></a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
				<?php $counter++; ?>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>
