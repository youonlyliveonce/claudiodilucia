<?php
	$gallery = false;
	if($section->typetoggle() == 'yes'){
		$gallery = true;
		$slides = $section->galleryfield()->toStructure();
	} else {
		$slide = $section->imagefield();
	}
?>

<div class="Hero [ Element ]" id="<?php echo $section->slug(); ?>_hero"  data-view="HeroView">
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
	<?php if($scrollhint) : ?>
		<div class="Hint Hint--scroll">
			<svg version="1.2" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 23 34" xml:space="preserve">
				<path id="mouse" fill="#FFFFFF" d="M11.5,0C5.199-0.041,0.054,5.028,0,11.33v11.34c0,6.351,5.149,11.5,11.5,11.5, c6.352,0,11.5-5.149,11.5-11.5l0,0V11.33C22.945,5.028,17.801-0.041,11.5,0z M21.721,22.67C21.641,28.314,17,32.824,11.355,32.744, C5.824,32.666,1.359,28.201,1.28,22.67V11.33C1.36,5.685,6,1.174,11.645,1.255c5.531,0.078,9.996,4.543,10.076,10.075V22.67z"/>
				<line id="wheel" fill="none" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-miterlimit="10" x1="11.5" y1="4.412" x2="11.5" y2="10.105"/>
			</svg>
		</div>
	<?php endif; ?>
</div>
