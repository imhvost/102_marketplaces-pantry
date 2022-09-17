<?php 

add_action( 'after_setup_theme', 'marpan_crb_add_blocks' );
function marpan_crb_add_blocks() {
	require_once( TEMPLATEPATH . '/blocks/steps.php' );
	require_once( TEMPLATEPATH . '/blocks/additional-services.php' );
	require_once( TEMPLATEPATH . '/blocks/accordion.php' );
	require_once( TEMPLATEPATH . '/blocks/prices.php' );
	require_once( TEMPLATEPATH . '/blocks/advantages.php' );
	require_once( TEMPLATEPATH . '/blocks/partners.php' );
	require_once( TEMPLATEPATH . '/blocks/docs.php' );
	require_once( TEMPLATEPATH . '/blocks/cases.php' );
	require_once( TEMPLATEPATH . '/blocks/links.php' );
	\Carbon_Fields\Carbon_Fields::boot();
}

?>