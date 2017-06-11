<div class="Teaser [ Element ]" id="<?php echo $section->slug(); ?>_teaser"  data-view="TeaserView">
	<div class="Teaser__body">
		<?php foreach($teaserlist as $teaser): ?>
			<div class="Teaser__item">
				<a href="/<?= $site->language() ?>/<?= $teaser->uri($site->language()) ?>/">
					<div class="Teaser__image">
						<?= thumb($teaser->teaser()->toFile(), array('width' => 600)); ?>
					</div>
					<div class="Teaser__title">
						<span><?= $teaser->title(); ?></span>
					</div>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
</div>
