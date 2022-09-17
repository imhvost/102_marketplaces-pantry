<?php 

add_filter( 'nav_menu_css_class', 'marpan_nav_menu_css_class', 10, 2 );
function marpan_nav_menu_css_class($classes, $item){
	$post_types = array(
		// 'services' => 'service',
	);
	foreach ( $post_types as $page_slug => $post_type ) {
		if ( get_post_type() !== $post_type ) {
			continue;
		}
		$page_id = marpan_get_page_id_by_template( 'page-' . $page_slug . '.php' );
		if ( $item->object_id == $page_id ) {
			$classes[] = 'current-menu-item';
		}
	}
	return $classes;
}

?>