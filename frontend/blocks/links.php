<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function marpan_crb_block_links() {
	$complex_labels = array(
		'plural_name'   => __( 'Элементы', DOMAIN ),
		'singular_name' => __( 'Элемент', DOMAIN ),
	);
	Block::make( 'links', __( 'Ссылки', DOMAIN ) )
		->add_fields( array(
			Field::make( 'complex', 'links', __( 'Ссылки', DOMAIN ) )
				->set_collapsed( true )
				->setup_labels( $complex_labels )
				->add_fields( array(
					Field::make( 'image', 'icon', __( 'Иконка', DOMAIN ) ),
					Field::make( 'text', 'title', __( 'Заголовок', DOMAIN ) ),
					Field::make( 'text', 'href', __( 'Ссылка', DOMAIN ) )
						->set_help_text( __( 'ID поста или URL', DOMAIN ) ),
					Field::make( 'checkbox', 'is_active', __( 'Это активная страница', DOMAIN ) ),
				) )
				->set_header_template( '<%= title %>' )
				->set_layout( 'tabbed-vertical' ),
		) )
		->set_description( __( 'Ссылки', DOMAIN ) )
		->set_preview_mode( true )
		->set_category( __( 'Блоки темы', DOMAIN ) )
		->set_render_callback( function ( $fields ) {
			if ( $fields['links'] ):
?>
<div class="content-custom-block content-custom-block-links">
	<div class="links-row flex-row">
		<?php
			foreach ( $fields['links'] as $item ) :
			$href = get_the_permalink( $item['href'] ) ?: $item['href'];
		?>
		<div class="links-col flex-row-item">
			<<?php echo $item['is_active'] ? 'span' : 'a href="' . $href . '"' ?> class="link-item">
				<?php if ( $item['icon'] ) : ?>
				<div class="link-item-icon">
					<img
						src="<?php echo image_downsize( $item['icon'], 'full' )[0]; ?>"
						alt="<?php echo get_post_meta( $item['icon'], '_wp_attachment_image_alt', true ); ?>"
					>
				</div>
				<?php endif; ?>
				<?php if ( $item['title'] ) : ?>
				<div class="link-item-title"><?php echo $item['title']; ?></div>
				<?php endif; ?>
			</<?php echo $item['is_active'] ? 'span' : 'a' ?>>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<?php
			endif;
		});
}

add_action( 'carbon_fields_register_fields', 'marpan_crb_block_links' );