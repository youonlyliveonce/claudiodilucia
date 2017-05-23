<?php
	$clients = $section->clients()->structure();
	$clientsrows = $clients->chunk(6);

?>
<div class="Linkgrid [ Element ]" id="<?php echo $section->slug(); ?>" data-view="LinkGridView">
	<div class="Linkgrid__background"></div>
		<div class="Linkgrid__headline"><span><?= $section->title(); ?></span></div>
		<div class="Linkgrid__header"></div>
		<div class="Linkgrid__body">
			<?php foreach($clientsrows as $row): ?>
				<div class="Linkgrid__row">
					<?php foreach($row as $item): ?>
						<div>
							<figure>
								<?php if($item->link()->isNotEmpty()): ?>
									<a href="<?= $item->link(); ?>" target="_blank">
								<?php endif; ?>
								<img src="<?php echo $section->image($item->logo())->url(); ?>" alt="<?php echo html($item->alttext()) ?>">
								<?php if($item->link()->isNotEmpty()): ?>
									</a>
								<?php endif; ?>
							</figure>
						</div>
					<?php endforeach ?>
				</div>
			<?php endforeach ?>
		</div>
		<?php snippet('down',  array('section' => $section)) ?>
</div>
