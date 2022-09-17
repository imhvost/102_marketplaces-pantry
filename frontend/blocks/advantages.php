<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function marpan_crb_block_advantages() {
	$complex_labels = array(
		'plural_name'   => __( 'Элементы', DOMAIN ),
		'singular_name' => __( 'Элемент', DOMAIN ),
	);
	Block::make( 'advantages', __( 'Преимущества', DOMAIN ) )
		->add_fields( array(
			Field::make( 'complex', 'advantages', __( 'Преимущества', DOMAIN ) )
				->set_collapsed( true )
				->setup_labels( $complex_labels )
				->add_fields( array(
					Field::make( 'image', 'icon', __( 'Иконка', DOMAIN ) ),
					Field::make( 'text', 'title', __( 'Заголовок', DOMAIN ) ),
					Field::make( 'textarea', 'desc', __( 'Описание', DOMAIN ) )
						->set_required( true )
						->set_rows( 3 ),
				) )
				->set_header_template( '<%= desc %>' )
				->set_layout( 'tabbed-vertical' ),
			Field::make( 'checkbox', 'to_center', __( 'По центру', DOMAIN ) ),
		) )
		->set_description( __( 'Преимущества', DOMAIN ) )
		->set_preview_mode( true )
		->set_category( __( 'Блоки темы', DOMAIN ) )
		->set_render_callback( function ( $fields ) {
			if ( $fields['advantages'] ):
?>
<div class="content-custom-block content-custom-block-advantages">
	<div class="advantages-row advantages-row-<?php echo count( $fields['advantages'] ); ?> flex-row<?php echo $fields['to_center'] ? ' advantages-row-center' : ''; ?>">
		<?php
			foreach ( $fields['advantages'] as $item ) {
				include ( TEMPLATEPATH . '/inc/advantages-col.php' );
			}
		?>
	</div>
</div>
<?php
			endif;
		});
}

add_action( 'carbon_fields_register_fields', 'marpan_crb_block_advantages' );