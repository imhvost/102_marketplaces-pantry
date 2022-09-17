<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function marpan_crb_block_additional_services() {
	$complex_labels = array(
		'plural_name'   => __( 'Элементы', DOMAIN ),
		'singular_name' => __( 'Элемент', DOMAIN ),
	);
	Block::make( 'additional_services', __( 'Дополнительные услуги', DOMAIN ) )
		->add_fields( array(
			Field::make( 'complex', 'additional_services', __( 'Дополнительные услуги', DOMAIN ) )
				->setup_labels( $complex_labels )
				->set_collapsed( true )
				->set_layout( 'tabbed-vertical' )
				->add_fields( array(
					Field::make( 'text', 'title', __( 'Заголовок', DOMAIN ) )
						->set_required( true ),
					Field::make( 'textarea', 'desc', __( 'Описание', DOMAIN ) )
						->set_rows( 6 ),
					Field::make( 'text', 'cost', __( 'Стоимость', DOMAIN ) ),
					Field::make( 'text', 'btn', __( 'Кнопка', DOMAIN ) )
						->set_default_value( __( 'Заказать услугу', DOMAIN ) ),
				) )
				->set_header_template( '<%- title %>' ),
		) )
		->set_description( __( 'Дополнительные услуги', DOMAIN ) )
		->set_preview_mode( true )
		->set_category( __( 'Блоки темы', DOMAIN ) )
		->set_render_callback( function ( $fields ) {
			if ( $fields['additional_services'] ):
?>
<div class="content-custom-block content-custom-block-additional-services">
	<div class="additional-services-row flex-row">
		<?php foreach ( $fields['additional_services'] as $item ) : ?>
		<div class="additional-services-col flex-row-item">
			<div class="additional-services-item">
				<div class="additional-services-item-title h4"><?php echo $item['title']; ?></div>
				<?php if ( $item['desc'] || $item['cost'] ) : ?>
				<div class="additional-services-item-body">
					<?php if ( $item['desc'] ) : ?>
					<div class="additional-services-desc"><?php echo nl2br( $item['desc'] ); ?></div>
					<?php endif; ?>
					<div class="additional-services-item-foot">
						<?php if ( $item['cost'] ) : ?>
						<div class="additional-services-item-cost">
							<svg width="18" height="18"><use xlink:href="#icon-check-circle"/></svg>
							<span><?php echo $item['cost']; ?></span>
						</div>
						<?php endif; ?>
						<?php if ( $item['btn'] ) : ?>
						<a href="#" class="additional-services-item-btn btn" data-modal-open="modal-order" data-title="<?php _e( 'Заказ дополнительной услуги', DOMAIN ) ?>: <?php echo $item['title']; ?>">
							<span><?php echo $item['btn']; ?></span>
							<svg width="12" height="15"><use xlink:href="#icon-arrow-right"/></svg>
						</a>
						<?php endif; ?>
					</div>
				</div>
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

add_action( 'carbon_fields_register_fields', 'marpan_crb_block_additional_services' );
