<?php
	// $filtertags = $section->children()->pluck('filtertags', ',', true);
	$filtertags = $section->availablefilter()->split(',');
	$arrangements = $section->arrangement()->structure();
	$children = $section->children()->visible();
	$snippet = 'tiny/case_teaser';
?>
<div class="Portfolio [ Element ]" id="<?php echo $section->slug(); ?>" data-view="FilterGridView">
	<div class="Portfolio__background"></div>
		<div class="Portfolio__headline"><span><?= $section->title(); ?></span></div>
		<div class="Portfolio__filter">
			<ul>
				<li data-filter="all"><span>FILTER</span></li>
				<?php foreach($filtertags as $filter): ?>
				<li data-filter="<?= str_replace(" ", "-", $filter) ?>" class="active">
					<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-0.116 0 10.229 9.021" enable-background="new -0.116 0 10.229 9.021" xml:space="preserve">
					<polyline class="check-grey" fill="none" stroke="#484848" stroke-width="2.5" stroke-miterlimit="10" points="9.177,0.896 3.55,7.056 0.876,4.184 "/>
					<polyline class="check-white" fill="none" stroke="#FFFFFF" stroke-width="2.5" stroke-miterlimit="10" points="9.177,0.896 3.55,7.056 0.876,4.184 "/>
				</svg> <span><?= $filter ?></span>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="Portfolio__body [ <?php foreach($filtertags as $filter): ?><?= str_replace(" ", "-", $filter) ?><?php endforeach; ?> ]">
			<div class="Portfolio__mansry">
				<div class="Portfolio__sizer"></div>
				<?php foreach($children as $teaser) :
						if($teaser->teasersize() == "large") :
							snippet($snippet, array('item' => $teaser, 'itemclass' => 'Portfolio__item--large ', 'thumb' => 'large'));
						elseif($teaser->teasersize() == "medium") :
							snippet($snippet, array('item' => $teaser, 'itemclass' => 'Portfolio__item--medium ', 'thumb' => 'square'));
						elseif($teaser->teasersize() == "xmedium") :
							snippet($snippet, array('item' => $teaser, 'itemclass' => 'Portfolio__item--xmedium ', 'thumb' => 'xrect'));
						elseif($teaser->teasersize() == "small") :
							snippet($snippet, array('item' => $teaser, 'itemclass' => 'Portfolio__item--small ', 'thumb' => 'rect'));
						else :
							snippet($snippet, array('item' => $teaser, 'itemclass' => '', 'thumb' => 'square'));
						endif;
					endforeach; ?>
			</div>
		</div>
		<?php snippet('down',  array('section' => $section)) ?>
</div>
