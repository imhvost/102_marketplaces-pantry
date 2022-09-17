<?php
	$front_page_id = get_option( 'page_on_front' );
	$feedback_img = carbon_get_post_meta( $front_page_id, 'feedback_img' );
	$feedback_title = carbon_get_post_meta( $front_page_id, 'feedback_title' );
	$feedback_form_btn = carbon_get_post_meta( $front_page_id, 'feedback_form_btn' );
	$feedback_form_agreement = carbon_get_post_meta( $front_page_id, 'feedback_form_agreement' );
?>
<div class="feedback">
	<div class="container">
		<form action="?" class="feedback-form form" data-alert="<?php _e( 'Ошибка. Пожалуйста, попробуйте еще раз, или свяжитесь с нами по телефону.', DOMAIN ); ?>">
			<?php wp_nonce_field( 'feedback', 'feedback_nonce_field' ); ?>
			<input type="hidden" name="title" value="<?php _e( 'Новая заявка', DOMAIN ); ?>">
			<?php if ( $feedback_title ) : ?>
			<div class="section-title h1"><?php echo $feedback_title; ?></div>
			<?php endif; ?>
			<div class="form-row flex-row">
				<div class="form-col flex-row-item">
					<div class="form-block">
						<label class="input-block" aria-label="<?php _e( 'Ваше имя *', DOMAIN ); ?>">
							<input type="text" class="input" name="name" placeholder="<?php _e( 'Ваше имя *', DOMAIN ); ?>" required>
							<span class="input-icon">
								<svg width="13" height="14"><use xlink:href="#icon-user"/></svg>
							</span>
						</label>
					</div>
				</div>
				<div class="form-col flex-row-item">
					<div class="form-block">
						<label class="input-block" aria-label="<?php _e( 'Телефон', DOMAIN ); ?>">
							<input type="tel" class="input" name="tel" placeholder="<?php _e( '+7 (___) ___-__-__', DOMAIN ); ?>" required>
							<span class="input-icon">
								<svg width="12" height="12"><use xlink:href="#icon-tel"/></svg>
							</span>
						</label>
					</div>
				</div>
			</div>
			<div class="feedback-submit-wrapp">
				<?php if ( $feedback_form_agreement ) : ?>
				<div class="form-agreement">
					<?php echo nl2br ( $feedback_form_agreement ); ?>
				</div>
				<?php endif; ?>
				<button type="submit" class="btn submit">
					<span><?php echo $feedback_form_btn ?: __( 'Отправить', DOMAIN ); ?></span>
					<svg width="12" height="15"><use xlink:href="#icon-arrow-right"/></svg>
				</button>
			</div>
		</form>
		<?php if ( $feedback_img ) : ?>
		<div class="feedback-img">
			<img
				src="<?php echo image_downsize( $feedback_img, [ 412, 465 ] )[0]; ?>"
				srcset="<?php echo image_downsize( $feedback_img, 'full' )[0]; ?> 2x"
				alt="<?php echo get_post_meta( $feedback_img, '_wp_attachment_image_alt', true ); ?>"
				loading="lazy"
			>
		</div>
		<?php endif; ?>
	</div>
</div>