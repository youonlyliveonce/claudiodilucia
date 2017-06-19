<div class="Slider [ Element ]" id="<?php echo $section->slug(); ?>_gallery"  data-view="SliderView">
	<div class="Slider__body">
		<div class="swiper-container">
			<div class="swiper-wrapper">
			<?php foreach($slides as $slide): ?>
				<div class="swiper-slide">
					<div class="Slider__item">
						<div class="Slider__crop">
							<img src="<?= thumb($slide->image()->toFile(), array('width' => 1600, 'height' => 900, 'crop' => true))->url(); ?>" />
							<?php if($slide->videotitle()->isNotEmpty()) : ?>
								<div class="Slider__overlay">
									<span><?= $slide->videotitle() ?></span>
								</div>
							<?php endif; ?>
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
			<div class="swiper-slide">
				<div class="Slider__navitem">
					<ul>
						<li>
							<span>WHAT'S NEXT?</span><br/>
							<a href="/<?= $site->language() ?>/<?= $section->parent()->uri($site->language()) ?>/"><span><?= $section->parent()->title()->html() ?></span></a>
								<?php if( $section->parent()->hasVisibleChildren() ) : ?>
									<ul class="Navigation__sub">
										<?php $children = $section->parent()->children()->visible(); ?>
										<?php foreach($children as $subitem): ?>
											<li>
												<a class="<?php if($subitem->slug() === $section->slug()){ echo 'active'; } ?>" href="/<?= $site->language() ?>/<?= $subitem->uri($site->language()) ?>/"><span><?= $subitem->title()->html() ?></span></a>
											</li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
						</li>
					</ul>
				</div>
			</div>
			</div>
		</div>
	</div>
	<div class="Slider__fullscreen">
		<span class="Button--close">
			<span></span>
			<span></span>
		</span>
		<div class="Slider__fullscreenInner">
			<div class="swiper-container">
				<div class="swiper-wrapper">
				<?php foreach($slides as $key => $slide): ?>
					<div class="swiper-slide">
						<div class="Slider__item">
							<?php if($slide->videoid()->isNotEmpty()) : ?>
								<!-- YOUTUBE -->
								<div class="Slider__video">
									<iframe data-key="<?= $key ?>" id="yt-<?= $slide->videoid(); ?>" width="420" height="315" src="https://www.youtube.com/embed/<?= $slide->videoid(); ?>?autoplay=0&modestbranding=1&rel=0&loop=1&playlist=<?= $slide->videoid(); ?>&showinfo=0&controls=0&enablejsapi=1"></iframe>
									<!-- <div class="Hero__videoblocker"></div> -->
								</div>
							<?php else : ?>
								<div class="Slider__crop">
									<img src="<?= thumb($slide->image()->toFile(), array('width' => 1600, 'height' => 900, 'crop' => true))->url(); ?>" />
								</div>
							<?php endif; ?>

						</div>
					</div>
				<?php endforeach; ?>
				<div class="swiper-slide">
					<div class="Slider__navitem">
						<ul>
							<li>
								<span>WHAT'S NEXT?</span><br/>
								<a href="/<?= $site->language() ?>/<?= $section->parent()->uri($site->language()) ?>/"><span><?= $section->parent()->title()->html() ?></span></a>
									<?php if( $section->parent()->hasVisibleChildren() ) : ?>
										<ul class="Navigation__sub">
											<?php $children = $section->parent()->children()->visible(); ?>
											<?php foreach($children as $subitem): ?>
												<li>
													<a class="<?php if($subitem->slug() === $section->slug()){ echo 'active'; } ?>" href="/<?= $site->language() ?>/<?= $subitem->uri($site->language()) ?>/"><span><?= $subitem->title()->html() ?></span></a>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
							</li>
						</ul>
					</div>
				</div>
				</div>
			</div>
		</div>
		<div class="Slider__fullscreenBackground"></div>
	</div>
</div>
