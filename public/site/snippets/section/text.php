<div class="Text [ Element ]" id="<?php echo $section->slug(); ?>_text"  data-view="TextView">
	<div class="Text__headline"><h1><?= $section->title(); ?></h1></div>
	<?php if($hasimage): ?>
		<div class="Text__image">
			<div class="Text__inner">
				<img src="<?= thumb($section->image(), array('width' => 1200, 'crop' => true))->url(); ?>" />
			</div>
		</div>
	<?php endif; ?>
	<div class="Text__body">
		<div class="Text__inner">
			<?= $section->textarea()->kirbytext(); ?>
			<p><br/><br/></p>
			<div class="Next">
				<a class="Button Button--down" href="/<?= $site->language() ?>/<?= $next->slug() ?>/">
					<span>Next Section:</span>
					<span><?= $next->title() ?></span>
				</a>
			</div>
		</div>

	</div>
</div>
