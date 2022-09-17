<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function marpan_crb_block_partners() {
	$complex_labels = array(
		'plural_name'   => __( 'Элементы', DOMAIN ),
		'singular_name' => __( 'Элемент', DOMAIN ),
	);
	Block::make( 'partners', __( 'Партнеры', DOMAIN ) )
		->add_fields( array(
			Field::make( 'text', 'title', __( 'Заголовок', DOMAIN ) ),
			Field::make( 'media_gallery', 'logos', __( 'Логотипы', DOMAIN ) )
				->set_required( true )
				->set_type( array( 'image' ) ),
		) )
		->set_description( __( 'Партнеры', DOMAIN ) )
		->set_preview_mode( true )
		->set_category( __( 'Блоки темы', DOMAIN ) )
		->set_render_callback( function ( $fields ) {
			if ( $fields['logos'] ):
?>
<div class="content-custom-block content-custom-block-partners slider-wrapp">
	<div class="slider-head">
		<?php if ( $fields['title'] ) : ?>
		<div class="slider-title h2"><?php echo $fields['title']; ?></div>
		<?php endif; ?>
		<?php include( TEMPLATEPATH . '/inc/slider-nav.php' ); ?>
	</div>
	<div class="partners-slider swiper">
		<div class="swiper-wrapper">
			<?php foreach ( $fields['logos'] as $logo ) : ?>
			<div class="partners-slide swiper-slide">
				<div class="partners-item">
					<img
						src="<?php echo image_downsize( $logo, 'full' )[0]; ?>"
						alt="<?php echo get_post_meta( $logo, '_wp_attachment_image_alt', true ); ?>"
						loading="lazy"
					>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php
			endif;
		});
}

add_action( 'carbon_fields_register_fields', 'marpan_crb_block_partners' );