<div class="Hero [ Element ]" id="<?php echo $section->slug(); ?>_hero"  data-view="HeroView">
	<div class="Hero__headline"><h1><?= $section->title(); ?></h1></div>
	<div class="Hero__body">
		<?php if($gallery) : ?>
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php foreach($slides as $key => $slide): ?>
					<div class="swiper-slide">
						<?php if($slide->videoid()->isNotEmpty()) : ?>
							<!-- YOUTUBE -->
							<div class="Hero__slide--video">
								<iframe data-key="<?= $key ?>" id="yt-<?= $slide->videoid(); ?>" width="420" height="315" src="https://www.youtube.com/embed/<?= $slide->videoid(); ?>?autoplay=0&modestbranding=1&rel=0&loop=1&playlist=<?= $slide->videoid(); ?>&showinfo=0&controls=0&enablejsapi=1"></iframe>
								<div class="Hero__videoblocker"></div>
							</div>
						<?php else : ?>
							<!-- SINGLE IMAGE -->
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
	<?php if($awarded > 0) : ?>
		<div class="Awards">
			<div class="Awards__title">
				<span><?= $awarded ?>X Awarded</span>
				<span>
					<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29 29" enable-background="new 0 0 29 29" xml:space="preserve"><path id="mauszeiger.svg" fill="#FFFFFF" d="M10.77,18.689l3.21,9.611c0.13,0.395,0.485,0.67,0.9,0.699h0.07, c0.395-0.002,0.754-0.227,0.93-0.58L28.891,1.46c0.193-0.39,0.117-0.861-0.19-1.17c-0.315-0.305-0.788-0.377-1.181-0.18L0.56,13.6, c-0.382,0.183-0.604,0.59-0.55,1.01c0.022,0.417,0.302,0.775,0.7,0.9L10.77,18.689z M25.77,3.26L15.13,25.27l-2.58-7.709, c-0.105-0.306-0.345-0.545-0.65-0.65L3.71,14.3L25.77,3.26z"/>
					</svg>
				</span>
			</div>
			<div class="Awards__bar">
				<?php foreach($awards as $key => $value): ?>
					<div class="Awards__item">
						<img src="<?= thumb($value->awardimage()->toFile(), array('width' => 300))->url(); ?>" />
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
	<?php if($scrollhint) : ?>
		<div class="Hint Hint--scroll">
			<svg version="1.2" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 23 34" xml:space="preserve">
				<path id="mouse" fill="#FFFFFF" d="M11.5,0C5.199-0.041,0.054,5.028,0,11.33v11.34c0,6.351,5.149,11.5,11.5,11.5, c6.352,0,11.5-5.149,11.5-11.5l0,0V11.33C22.945,5.028,17.801-0.041,11.5,0z M21.721,22.67C21.641,28.314,17,32.824,11.355,32.744, C5.824,32.666,1.359,28.201,1.28,22.67V11.33C1.36,5.685,6,1.174,11.645,1.255c5.531,0.078,9.996,4.543,10.076,10.075V22.67z"/>
				<line id="wheel" fill="none" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-miterlimit="10" x1="11.5" y1="4.412" x2="11.5" y2="10.105"/>
			</svg>
		</div>
	<?php endif; ?>
</div>
