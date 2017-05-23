<nav class="Navigation" role="navigation">
	<ul>
		<?php foreach($site->page('home')->children()->visible() as $item): ?>
			<?php if($item->navigation() == "main"): ?>
				<?php if($item->intendedTemplate() == 'redirect'): ?>
					<li>
						<a href="<?= $item->redirect(); ?>" target="_blank"><span><?= $item->title()->html() ?><span></a>
					</li>
				<?php else : ?>
					<li>
						<a href="/<?= $site->language() ?>/?section=<?= $item->slug(); ?>"><span><?= $item->title()->html() ?><span></a>
					</li>
				<?php endif; ?>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
	<ul class="Navigation__third">
		<?php foreach($site->page('home')->children()->visible() as $item): ?>
			<?php if($item->navigation() == "third"): ?>
				<li>
					<a href="/<?= $site->language() ?>/?section=<?= $item->slug(); ?>"><span><?= $item->title()->html() ?><span></a>
				</li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
</nav>

<nav class="Scrollnavigation">
	<ul>
		<?php foreach($site->page('home')->children()->visible() as $item): ?>
			<?php if($item->intendedTemplate() != 'redirect'): ?>
				<li class="<?php if(!$item->scrollable()->empty()) : echo 'Scrollnavigation__item--large'; endif; ?>">
					<a href="/<?= $site->language() ?>/?section=<?= $item->slug(); ?>"><span><?= $item->title()->html() ?></span></a>
				</li>
			<?php endif; ?>
		<?php endforeach ?>
	</ul>
</nav>
