<?php 

add_shortcode( 'site_url', 'marpan_shortcode_site_url' );
function marpan_shortcode_site_url() {
	return site_url();
}

add_shortcode( 'uploads' , 'marpan_shortcode_uploads' );
function marpan_shortcode_uploads() {
	return wp_get_upload_dir()['url'];
}

?>