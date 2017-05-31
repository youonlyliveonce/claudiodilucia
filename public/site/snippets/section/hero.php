<?php
	$gallery = false;
	if($section->typetoggle() == 'yes'){
		$gallery = true;
		$slides = $section->galleryfield()->toStructure();
	} else {
		$slide = $section->imagefield();
	}
?>

<div class="Hero [ Element ]" id="<?php echo $section->slug(); ?>"  data-view="HeroView">
	<div class="Hero__headline"><h1><?= $section->title(); ?></h1></div>
	<div class="Hero__body">
		<?php if($gallery) : ?>
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php foreach($slides as $slide): ?>
					<div class="swiper-slide">
						<?php if($slide->videoid()->isNotEmpty()) : ?>
							<!-- YOUTUBE -->
						<?php else : ?>
							<div class="Hero__slide" style="background-image:url(<?= thumb($slide->image()->toFile(), array('width' => 1680, 'height' => 949, 'crop' => true))->url(); ?>)"> </div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="swiper-pagination"></div>
		</div>
	<?php else: ?>
		<div class="Hero__image" style="background-image:url(<?= thumb($slide->image()->toFile(), array('width' => 1680, 'height' => 949, 'crop' => true))->url(); ?>)"> </div>
	<?php endif; ?>
	</div>
</div>
