<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function marpan_crb_block_persons() {
	$complex_labels = array(
		'plural_name'   => __( 'Элементы', DOMAIN ),
		'singular_name' => __( 'Элемент', DOMAIN ),
	);
	Block::make( 'persons', __( 'Люди', DOMAIN ) )
		->add_fields( array(
			Field::make( 'complex', 'persons', __( 'Люди', DOMAIN ) )
				->set_collapsed( true )
				->setup_labels( $complex_labels )
				->add_fields( array(
					Field::make( 'image', 'img', __( 'Фото', DOMAIN ) ),
					Field::make( 'text', 'name', __( 'Имя', DOMAIN ) ),
					Field::make( 'text', 'desc', __( 'Описание', DOMAIN ) ),
				) )
				->set_header_template( '<%= name %>' )
				->set_layout( 'tabbed-vertical' ),
		) )
		->set_description( __( 'Люди', DOMAIN ) )
		->set_preview_mode( true )
		->set_category( __( 'Блоки темы', DOMAIN ) )
		->set_render_callback( function ( $fields ) {
			if ( $fields['persons'] ):
?>
<div class="content-custom-block content-custom-block-persons">
	<div class="persons-row flex-row">
		<?php foreach ( $fields['persons'] as $item ) : ?>
		<div class="persons-col flex-row-item">
			<div class="person-item">
				<?php if ( $item['img'] ) : ?>
				<div class="person-item-img cover-img">
					<img
						src="<?php echo image_downsize( $item['img'], 'thumbnail' )[0]; ?>"
						srcset="<?php echo image_downsize( $item['img'], 'full' )[0]; ?> 2x"
						alt="<?php echo get_post_meta( $item['img'], '_wp_attachment_image_alt', true ); ?>"
					>
				</div>
				<?php endif; ?>
				<?php if ( $item['name'] ) : ?>
				<div class="person-item-name"><?php echo $item['name']; ?></div>
				<?php endif; ?>
				<?php if ( $item['desc'] ) : ?>
				<div class="person-item-desc"><?php echo $item['desc']; ?></div>
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

add_action( 'carbon_fields_register_fields', 'marpan_crb_block_persons' );