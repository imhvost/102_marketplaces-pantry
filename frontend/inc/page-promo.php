<div class="page-promo">
	<?php 
		$promo_img = carbon_get_the_post_meta( 'promo_img' );
		$promo_show_form = carbon_get_the_post_meta( 'promo_show_form' );
		if ( $promo_img ) :
	?>
	<div class="page-promo-img cover-img">
		<img
			src="<?php echo image_downsize( $promo_img, 'marpan-promo' )[0]; ?>"
			srcset="<?php echo image_downsize( $promo_img, 'full' )[0]; ?> 2x"
			alt="<?php echo get_post_meta( $promo_img, '_wp_attachment_image_alt', true ); ?>"
			loading="lazy"
		>
	</div>
	<?php endif; ?>
	<div class="container">
		<?php get_template_part( 'inc/breadcrumbs' ); ?>
		<h1 class="page-title h0"><?php the_title(); ?></h1>
		<?php
			if ( $promo_show_form ) :
			$promo_form_submit = carbon_get_the_post_meta( 'promo_form_submit' );
			$front_page_id = get_option( 'page_on_front' );
			$feedback_form_agreement = carbon_get_post_meta( $front_page_id, 'feedback_form_agreement' );
		?>
		<form action="?" class="page-promo-form form" data-alert="<?php _e( 'Ошибка. Пожалуйста, попробуйте еще раз, или свяжитесь с нами по телефону.', DOMAIN ); ?>">
			<?php wp_nonce_field( 'promo', 'promo_nonce_field' ); ?>
			<input type="hidden" name="title" value="<?php echo $promo_form_submit ?: __( 'Рассчитать стоимость', DOMAIN ); ?>">
			<div class="page-promo-form-body">
				<div class="form-block">
					<label class="input-block" aria-label="<?php _e( 'Телефон', DOMAIN ); ?>">
						<input type="tel" class="input" name="tel" placeholder="<?php _e( '+7 (___) ___-__-__', DOMAIN ); ?>" required>
						<span class="input-icon">
							<svg width="12" height="12"><use xlink:href="#icon-tel"/></svg>
						</span>
					</label>
				</div>
				<button type="submit" class="btn submit">
					<span><?php echo $promo_form_submit ?: __( 'Рассчитать стоимость', DOMAIN ); ?></span>
					<svg width="12" height="15"><use xlink:href="#icon-arrow-right"/></svg>
				</button>
			</div>
			<?php if ( $feedback_form_agreement ) : ?>
			<div class="form-agreement">
				<?php echo nl2br ( $feedback_form_agreement ); ?>
			</div>
			<?php endif; ?>
		</form>
		<?php endif; ?>
	</div>
</div>