<?php 
	$markers = array();
	if ( $addresses ) {
		foreach ( $addresses as $item ) {
			if ( $item['lat'] && $item['lng'] ){
				$markers[] = array(
					'lat'     => $item['lat'],
					'lng'     => $item['lng'],
					'marker'  => $item['marker'],
					'address' => $item['address'],
				);
			}
		}
	}
	if ( count ( $markers ) ) :
?>
<div class="contacts-map">
	<script type="application/json"><?php echo json_encode( $markers ); ?></script>
</div>
<?php endif; ?>