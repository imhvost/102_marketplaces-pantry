<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function marpan_crb_block_docs() {
	$complex_labels = array(
		'plural_name'   => __( 'Элементы', DOMAIN ),
		'singular_name' => __( 'Элемент', DOMAIN ),
	);
	Block::make( 'docs', __( 'Документы', DOMAIN ) )
		->add_fields( array(
			Field::make( 'text', 'title', __( 'Заголовок', DOMAIN ) ),
			Field::make( 'media_gallery', 'docs', __( 'Документы', DOMAIN ) )
				->set_required( true )
				->set_type( array( 'image' ) ),
		) )
		->set_description( __( 'Документы', DOMAIN ) )
		->set_preview_mode( true )
		->set_category( __( 'Блоки темы', DOMAIN ) )
		->set_render_callback( function ( $fields ) {
			if ( $fields['docs'] ):
?>
<div class="content-custom-block content-custom-block-docs slider-wrapp">
	<div class="slider-head">
		<?php if ( $fields['title'] ) : ?>
		<div class="slider-title h2"><?php echo $fields['title']; ?></div>
		<?php endif; ?>
		<?php include( TEMPLATEPATH . '/inc/slider-nav.php' ); ?>
	</div>
	<div class="docs-slider swiper">
		<div class="swiper-wrapper">
			<?php foreach ( $fields['docs'] as $img ) : ?>
			<div class="docs-slide swiper-slide">
				<a href="<?php echo image_downsize( $img, 'full' )[0]; ?>" class="docs-item cover-img glightbox">
					<img
						src="<?php echo image_downsize( $img, 'doc' )[0]; ?>"
						srcset="<?php echo image_downsize( $img, 'medium' )[0]; ?>"
						alt="<?php echo get_post_meta( $img, '_wp_attachment_image_alt', true ); ?>"
						loading="lazy"
					>
				</a>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php
			endif;
		});
}

add_action( 'carbon_fields_register_fields', 'marpan_crb_block_docs' );