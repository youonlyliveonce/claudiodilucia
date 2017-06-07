<div class="Contentmenu [ Element ]" id="<?php echo $section->slug(); ?>_contentmenu">
	<div class="Contentmenu__inner">
		<ul class="Contentmenu__main">
			<?php foreach($site->children()->visible() as $item): ?>
					<?php if($item->intendedTemplate() == 'redirect'): ?>
						<li>
							<div>
								<a href="<?= $item->redirect(); ?>" target="_blank"><span><?= $item->title()->html() ?></span></a>
							</div>
						</li>
					<?php else : ?>
						<li>
							<div>
								<a href="/<?= $site->language() ?>/<?= $item->slug() ?>/"><span><?= $item->title()->html() ?></span></a>
							</div>
						</li>
					<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="Contentmenu__outer">
		<?php foreach($site->children()->visible() as $item): ?>
			<?php if( $item->hasVisibleChildren() ) : ?>
				<ul class="Contentmenu__sub">
					<?php $children = $item->children()->visible(); ?>
					<?php foreach($children as $subitem): ?>
						<li>
							<a href="/<?= $site->language() ?>/<?= $subitem->slug() ?>/"><span><?= $subitem->title()->html() ?></span></a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		<?php endforeach; ?>
	</div
</div>
