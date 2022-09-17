<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function marpan_crb_block_cases() {
	Block::make( 'cases', __( 'Кейсы', DOMAIN ) )
		->add_fields( array(
			Field::make( 'text', 'cases_title', __( 'Заголовок', DOMAIN ) )
				->set_default_value( __( 'Наши кейсы', DOMAIN ) ),
			Field::make( 'association', 'cases', __( 'Кейсы', DOMAIN ) )
				->set_types( array(
					array(
						'type'      => 'post',
						'post_type' => 'case',
					)
				) ),
		) )
		->set_description( __( 'Кейсы', DOMAIN ) )
		->set_preview_mode( true )
		->set_category( __( 'Блоки темы', DOMAIN ) )
		->set_render_callback( function ( $fields ) {
			if ( $fields['cases'] ):
				$cases = wp_list_pluck( $fields['cases'], 'id' );
				$cases_title = $fields['cases_title'];
?>
<div class="content-custom-block content-custom-block-cases slider-wrapp">
	<?php include( TEMPLATEPATH . '/inc/cases.php' ); ?>
</div>
<?php
			endif;
		});
}

add_action( 'carbon_fields_register_fields', 'marpan_crb_block_cases' );
