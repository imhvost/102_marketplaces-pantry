<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function marpan_crb_block_prices() {
	$complex_labels = array(
		'plural_name'   => __( 'Элементы', DOMAIN ),
		'singular_name' => __( 'Элемент', DOMAIN ),
	);
	Block::make( 'prices', __( 'Цены', DOMAIN ) )
		->add_fields( array(
			Field::make( 'complex', 'accordion', __( 'Аккордеон', DOMAIN ) )
				->set_collapsed( true )
				->setup_labels( $complex_labels )
				->add_fields( array(
					Field::make( 'text', 'title', __( 'Заголовок', DOMAIN ) )
						->set_required( true ),
					Field::make( 'complex', 'services', __( 'Услуги', DOMAIN ) )
						->set_collapsed( true )
						->setup_labels( $complex_labels )
						->add_fields( array(
							Field::make( 'text', 'service', __( 'Услуга', DOMAIN ) )
								->set_required( true ),
							Field::make( 'text', 'cost', __( 'Стоимость', DOMAIN ) )
								->set_required( true ),
							Field::make( 'textarea', 'comment', __( 'Комментарий', DOMAIN ) )
								->set_rows( 3 ),
						) )
						->set_header_template( '<%- service %>' )
						->set_layout( 'tabbed-vertical' ),
				) )
				->set_header_template( '<%- title %>' )
				->set_layout( 'tabbed-vertical' ),
		) )
		->set_description( __( 'Цены', DOMAIN ) )
		->set_preview_mode( true )
		->set_category( __( 'Блоки темы', DOMAIN ) )
		->set_render_callback( function ( $fields ) {
			if ( $fields['accordion'] ):
?>
<div class="content-custom-block content-custom-block-prices">
	<div class="accordion">
		<?php foreach ( $fields['accordion'] as $item ) : ?>
		<div class="accordion-item">
			<a href="#" class="accordion-item-toggle">
				<span><?php echo $item['title']; ?></span>
				<i></i>
			</a>
			<div class="accordion-item-body">
				<div class="accordion-item-content">
					<?php if ( $item['services'] ) : ?>
					<div class="wp-block-table">
						<table class="prices-table">
							<thead>
								<tr>
									<th><?php _e( 'Услуга', DOMAIN ) ?></th>
									<th><?php _e( 'Стоимость', DOMAIN ) ?></th>
									<th><?php _e( 'Комментарий', DOMAIN ) ?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $item['services'] as $key => $service ) : ?>
								<tr>
									<td><?php echo $key + 1; ?>. <?php echo $service['service']; ?></td>
									<td><?php echo $service['cost']; ?></td>
									<td><?php echo nl2br( $service['comment'] ); ?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<?php
			endif;
		});
}

add_action( 'carbon_fields_register_fields', 'marpan_crb_block_prices' );