<?php 

add_action( 'init', 'marpan_register_post_types_and_taxonomies' );

function marpan_register_post_types_and_taxonomies(){
	$services_page_id = marpan_get_page_id_by_template( 'page-services.php' );
	register_post_type(
		'service',
		array(
			'labels'             => [
				'name'          => __( 'Услуги', DOMAIN ),
				'singular_name' => __( 'Услуга', DOMAIN ),
				'menu_name'     => __( 'Услуги', DOMAIN ),
			],
			'public'             => true,
			'menu_icon'          => 'dashicons-book',
			'menu_position'      => 5,
			'rewrite'            => array( 'slug' => get_post_field( 'post_name', $services_page_id ), 'with_front' => false ),
			'supports'           => array( 'title', 'editor', 'thumbnail' ),
			'show_in_rest'       => true,
			'hierarchical'       => true,
		)
	);
	
	register_post_type(
		'case',
		array(
			'labels'             => [
				'name'          => __( 'Кейсы', DOMAIN ),
				'singular_name' => __( 'Кейс', DOMAIN ),
				'menu_name'     => __( 'Кейсы', DOMAIN ),
			],
			'public'             => true,
			'menu_icon'          => 'dashicons-portfolio',
			'menu_position'      => 5,
			'publicly_queryable' => false,
			'supports'           => array( 'title' ),
			'show_in_rest'       => true,
		)
	);
	
}

?>