<?php
	$mostsub = 0;
	foreach($site->children()->visible() as $count) {
		if( $count->hasVisibleChildren() ){
			$children = $count->children()->visible()->count();
			if($children > $mostsub){
				$mostsub = $children;
			}
		}
	}
?>

<nav class="Navigation" role="navigation">
	<div class="Navigation__inner">
		<ul>
			<?php foreach($site->children()->visible() as $item): ?>
					<?php if($item->intendedTemplate() == 'redirect'): ?>

						<li>
							<div>
								<?php if( $item->intern()->isNotEmpty() ): ?>
									<a href="<?= $item->intern(); ?>"><span><?= $item->title()->html() ?></span></a>
								<?php else: ?>
									<a href="<?= $item->redirect(); ?>" target="_blank"><span><?= $item->title()->html() ?></span></a>
								<?php endif; ?>

								<?php if( $item->hasVisibleChildren() ) : ?>
									<ul class="Navigation__sub">
											<?php $children = $item->children()->visible(); ?>
												<?php foreach($children as $subitem): ?>
													<li>
														<a href="/<?= $site->language() ?>/<?= $subitem->uri($site->language()) ?>/"><span><?= $subitem->title()->html() ?></span></a>
													</li>
												<?php endforeach; ?>

												<?php if($children->count() < $mostsub): ?>
													<?php $div = $mostsub - $children->count(); ?>
													<?php for($x=0; $x<$div; $x++):?>
														<li><span>&nbsp;</span></li>
													<?php endfor; ?>
												<?php endif; ?>

									</ul>
								<?php endif; ?>
							</div>
						</li>
					<?php else : ?>
						<li>
							<div>
							<a href="/<?= $site->language() ?>/<?= $item->uri($site->language()) ?>/"><span><?= $item->title()->html() ?></span></a>
								<?php if( $item->hasVisibleChildren() ) : ?>
									<ul class="Navigation__sub">
											<?php $children = $item->children()->visible(); ?>
												<?php foreach($children as $subitem): ?>
													<li>
														<a href="/<?= $site->language() ?>/<?= $subitem->uri($site->language()) ?>/"><span><?= $subitem->title()->html() ?></span></a>
													</li>
												<?php endforeach; ?>

												<?php if($children->count() < $mostsub): ?>
													<?php $div = $mostsub - $children->count(); ?>
													<?php for($x=0; $x<$div; $x++):?>
														<li><span>&nbsp;</span></li>
													<?php endfor; ?>
												<?php endif; ?>


									</ul>
								<?php endif; ?>
							</div>
						</li>
					<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	</div>
</nav>
