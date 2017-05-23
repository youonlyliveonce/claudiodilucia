

<?php if( $section->hasNext() & $section->next()->isVisible() ): ?>
		<div class="Button Button--down">
			<?php if( isset($label) ) {
				echo '<i>'.$label.'</i>';
			} ?>
			
			<span>
				<svg version="1.1" baseProfile="tiny" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
					 x="0px" y="0px" viewBox="0 0 85.04 48.189" xml:space="preserve">
				<path fill="#FFFFFF" d="M41.132,9.018v24.27l-5.912-5.791c-0.518-0.507-1.357-0.507-1.875,0c-0.518,0.507-0.518,1.329,0,1.836
					l8.175,8.008c0.518,0.508,1.357,0.508,1.875,0l8.175-8.008c0.259-0.253,0.388-0.586,0.388-0.918c0-0.333-0.129-0.665-0.388-0.918
					c-0.518-0.507-1.357-0.507-1.875,0l-5.912,5.791V9.018c0-0.717-0.594-1.298-1.326-1.298C41.725,7.72,41.132,8.301,41.132,9.018z"/>
				</svg>
			</span>
		</div>
<?php else: ?>
	<div class="Button Button--down">
		THE END
	</div>
<?php endif; ?>
