<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function marpan_crb_block_steps() {
	$complex_labels = array(
		'plural_name'   => __( 'Элементы', DOMAIN ),
		'singular_name' => __( 'Элемент', DOMAIN ),
	);
	Block::make( 'steps', __( 'Шаги', DOMAIN ) )
		->add_fields( array(
			Field::make( 'complex', 'steps', __( 'Шаги', DOMAIN ) )
				->setup_labels( $complex_labels )
				->set_collapsed( true )
				->add_fields( array(
					Field::make( 'text', 'title', __( 'Заголовок', DOMAIN ) ),
					Field::make( 'textarea', 'desc', __( 'Описание', DOMAIN ) )
						->set_rows( 3 ),
				) )
				->set_layout( 'tabbed-vertical' )
				->set_header_template( '<%- title %>' ),
		) )
		->set_description( __( 'Шаги', DOMAIN ) )
		->set_category( __( 'Блоки темы', DOMAIN ) )
		->set_render_callback( function ( $fields ) {
			if ( $fields['steps'] ):
?>
<div class="content-custom-block content-custom-block-steps">
	<div class="steps-row flex-row steps-row-<?php echo count ( $fields['steps'] ); ?>">
		<?php foreach ( $fields['steps'] as $item ) : ?>
		<div class="steps-col flex-row-item">
			<div class="steps-item">
				<?php if ( $item['title'] ) : ?>
				<div class="steps-item-title"><?php echo $item['title']; ?></div>
				<?php endif; ?>
				<?php if ( $item['desc'] ) : ?>
				<div class="steps-item-desc"><?php echo nl2br( $item['desc'] ); ?></div>
				<?php endif; ?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<?php
			endif;
		});
}

add_action( 'carbon_fields_register_fields', 'marpan_crb_block_steps' );
