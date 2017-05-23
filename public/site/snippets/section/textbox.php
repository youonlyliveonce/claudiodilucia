<div class="Textpage [ Element ]" id="<?php echo $section->slug(); ?>"  data-view="TextpageView">
	<div class="Textbox">
		<div class="Textbox__wrapper">
			<div class="Textbox__body">
				<div>
					<?= $section->leftbar()->kt() ?>
				</div>
				<div>
					<?= $section->rightbar()->kt() ?>
				</div>
			</div>
		</div>
		<div class="Textbox__scroller"><span></span></div>
	</div>
	<?php snippet('down',  array('section' => $section)) ?>
</div>
