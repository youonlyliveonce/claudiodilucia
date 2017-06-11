<div class="Slider [ Element ]" id="<?php echo $section->slug(); ?>_gallery"  data-view="SliderView">
	<div class="Slider__body">
		<div class="swiper-container">
			<div class="swiper-wrapper">
			<?php foreach($slides as $slide): ?>
				<div class="swiper-slide">
					<div class="Slider__item">
						<div class="Slider__crop">
							<img src="<?= thumb($slide->image()->toFile(), array('width' => 1600, 'height' => 900, 'crop' => true))->url(); ?>" />
							<span class="Slider__icon--zoom"><svg version="1.2" baseProfile="tiny" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
								 x="0px" y="0px" viewBox="0 0 27.21 27.21" xml:space="preserve">
							<path fill="#FFFFFF" d="M26.53,23.317l-5.908-5.907c-0.029-0.033-0.067-0.054-0.101-0.083c1.162-1.765,1.842-3.876,1.842-6.146
								C22.363,5.006,17.356,0,11.182,0C5.006,0,0,5.006,0,11.182c0,6.175,5.006,11.182,11.182,11.182c2.27,0,4.381-0.68,6.146-1.842
								c0.026,0.033,0.05,0.071,0.08,0.101l5.91,5.908c0.887,0.889,2.326,0.889,3.213,0C27.419,25.644,27.419,24.204,26.53,23.317z
								 M11.182,18.485c-4.034,0-7.306-3.27-7.306-7.304s3.271-7.306,7.306-7.306s7.304,3.271,7.304,7.306S15.216,18.485,11.182,18.485z"/>
							</svg></span>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			</div>
		</div>
	</div>
	<div class="Slider__fullscreen">
		<span class="Button--close">
			<span></span>
			<span></span>
		</span>
		<div class="swiper-container">
			<div class="swiper-wrapper">
			<?php foreach($slides as $slide): ?>
				<div class="swiper-slide">
					<div class="Slider__item">
						<div class="Slider__crop">
							<img src="<?= thumb($slide->image()->toFile(), array('width' => 1600, 'height' => 900, 'crop' => true))->url(); ?>" />
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>