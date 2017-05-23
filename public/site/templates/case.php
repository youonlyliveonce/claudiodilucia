<?php snippet('head') ?>
<?php snippet('view-start', array('pageclass' => " Page--single"))?>

<div class="Case [ Element ]" id="<?php echo $page->slug(); ?>"  data-view="CaseView">
	<a href="<?= $parentlink ?>" class="Button--close"><span></span></a>
	<div class="Case__body">
	<?php if($hasvideo) : ?>
			<div class="Videobox__background">
					<iframe width="420" id="casevideo" height="315" src="https://www.youtube.com/embed/<?= $page->videoid(); ?>?autoplay=1&enablejsapi=1&showinfo=0&controls=0&rel=0"></iframe>
					<div class="Videobox__player">
						<div class="Playbar"></div>
						<div class="Controlbar">
							<span class="Controlbar__play"><img src="/assets/images/btn-play.svg"><img src="/assets/images/btn-pause.svg"></span>
							<span class="Controlbar__audio"><img src="/assets/images/btn-audio-on.svg"><img src="/assets/images/btn-audio-off.svg"></span>
							<span class="Controlbar__time"><span data-hook="current-time"></span> / <span data-hook="total-time"></span></span>
							<span class="Controlbar__fullscreen"><img src="/assets/images/btn-fullscreen.svg"></span>
							<span class="Controlbar__state Controlbar__state--clickzone">
									<span class="Controlbar__state Controlbar__state--played"></span>
									<span class="Controlbar__state Controlbar__state--loaded"></span>
							</span>
						</div>
					</div>
			</div>
	<?php else: ?>
		<?php if($isslideshow): ?>
			<!-- Slider -->
			<div class="Case__slideshow">
				<div class="swiper-container">
					<div class="swiper-wrapper">
					<?php foreach($slides as $slide): ?>
						<div class="swiper-slide">
							<?php if($image = $page->image($slide['img'])) echo thumb($image, array('width' => 1010, 'height' => 564, 'crop' => true)); ?>
						</div>
					<?php endforeach; ?>
					</div>
					<div class="swiper-pagination"></div>
				</div>
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
			</div>
		<?php else: ?>
			<!-- Single Image -->
			<div class="Case__image">
				<?php if($image = $page->image($slides[0]['img'])) echo $image->html() ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<div class="Case__info">
	</div>
	<!-- Description -->
	<div class="Case__intro">
		<div>
			<h1><?= $page->headline(); ?></h1>
		</div>
		<div>
			<?php if(!$page->subline()->empty()) :?>
				<h2><?= $page->subline(); ?></h2>
			<?php endif; ?>
			<?= $page->description()->markdown(); ?>
		</div>
	</div>
	<!-- Moodboard -->
	<?php if($hasmoodboard): ?>
		<div class="Case__board">
			<?php foreach($gallery as $index => $item): ?>
				<?php if($index == 0): ?>
					<div class="Case__item Case__item--first<?php if(isset($item['videoid']) && $item['videoid'] != null ) echo ' Case__item--youtube'; ?>">
						<div>
							<?php if($image = $page->image($gallery[0]['img'])) :
											echo thumb($image, array('width' => 1010, 'height' => 564, 'crop' => true));
										elseif($item['videoid'] != null ) : ?>
											<iframe width="420" height="315" src="https://www.youtube.com/embed/<?= $item['videoid']; ?>?autoplay=0&enablejsapi=1&showinfo=0&controls=1&rel=0"></iframe>
							<?php endif; ?>
							<?php if($gallery[0]['caption'] != null): ?>
								<figcaption><?= $gallery[0]['caption'] ?></figcaption>
							<?php endif; ?>
						</div>
					</div>
				<?php else: ?>
					<div class="Case__item<?php if( isset($item['videoid']) && $item['videoid'] != null) echo ' Case__item--first Case__item--youtube'; ?>">
						<div>
							<?php if($image = $page->image($item['img'])):
								echo thumb($image, array('width' => 500, 'height' => 500, 'crop' => true));
								if($item['caption'] != null): ?>
									<figcaption><?= $item['caption'] ?></figcaption>
								<?php endif; ?>
							<?php elseif($item['videoid'] != null ) : ?>
									<iframe width="420" height="315" src="https://www.youtube.com/embed/<?= $item['videoid']; ?>?autoplay=0&enablejsapi=1&showinfo=0&controls=1&rel=0"></iframe>
							<?php elseif($item['headline'] != null): ?>
								<div>
									<article>
										<h3><?= $item['headline'] ?></h3>
										<?= kirbytext($item['copy']) ?>
									</article>
								</div>
							<?php endif; ?>

						</div>
					</div>
				<?php endif; ?>

			<?php endforeach; ?>
		</div>
	<?php endif; ?>



	<!-- Backlink -->
		<div class="Case__back">
			<a href="<?= $parentlink ?>"><span>Zurück zur Übersicht</span></a>
		</div>
	</div>
</div>



<?php snippet('view-end')?>
<?php snippet('footer') ?>
