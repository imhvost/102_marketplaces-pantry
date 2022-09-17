<?php 
	$card_icon = carbon_get_post_meta( $post_id, 'card_icon' );
	$card_title = carbon_get_post_meta( $post_id, 'card_title' );
	$card_desc = carbon_get_post_meta( $post_id, 'card_desc' );
?>
<div class="services-col flex-row-item">
	<div class="services-item">
		<?php if ( $card_icon ) : ?>
		<div class="services-item-icon">
			<img
				src="<?php echo image_downsize( $card_icon, 'full' )[0]; ?>"
				alt="<?php echo get_post_meta( $card_icon, '_wp_attachment_image_alt', true ); ?>"
			>
		</div>
		<?php endif; ?>
		<div class="services-item-title"><?php echo $card_title ?: get_the_title( $post_id ); ?></div>
		<?php if ( $card_desc ) : ?>
		<div class="services-item-desc"><?php echo nl2br( $card_desc ); ?></div>
		<?php endif; ?>
		<a href="<?php echo get_the_permalink( $post_id ) ?>" class="item-link" aria-label="<?php _e( 'На страницу услуги', DOMAIN ); ?>"></a>
	</div>
</div>