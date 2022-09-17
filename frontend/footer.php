<footer class="footer">
	<?php 
		if ( get_page_template_slug() !== 'page-contacts.php' ) :
			$contacts_page_id = marpan_get_page_id_by_template( 'page-contacts.php' );
			$tels = carbon_get_post_meta( $contacts_page_id, 'tels' );
			if ( $tels ) {
				$tel = $tels[0]['tel'];
			}
			$emails = carbon_get_post_meta( $contacts_page_id, 'emails' );
			if ( $emails ) {
				$email = $emails[0]['email'];
			}
			$addresses = carbon_get_post_meta( $contacts_page_id, 'addresses' );
			if ( $addresses ) {
				$addresses = array( $addresses[0] );
			}
			$social = carbon_get_post_meta( $contacts_page_id, 'social' );
			$footer_btn = carbon_get_theme_option( 'footer_btn' );
	?>
	<div class="footer-body">
		<div class="container">
			<div class="footer-content">
				<div class="footer-row flex-row">
					<?php if ( has_nav_menu( 'services' ) ) : ?>
					<div class="footer-col footer-col-services flex-row-item">
						<div class="footer-menu-title"><?php _e( 'Услуги', DOMAIN ); ?></div>
						<?php 
							wp_nav_menu( [
								'theme_location' => 'services',
								'container'      => false,
								'menu_class'     => 'services-menu',
							] );
						?>
					</div>
					<?php endif; ?>
					<?php if ( has_nav_menu( 'footer' ) ) : ?>
					<div class="footer-col footer-col-menu flex-row-item">
						<?php 
							wp_nav_menu( [
								'theme_location' => 'footer',
								'container'      => false,
								'menu_class'     => 'footer-menu',
							] );
						?>
					</div>
					<?php endif; ?>
					<?php if ( $tel || $emails || $addresses || $social || $footer_btn ) : ?>
					<div class="footer-col footer-col-contacts flex-row-item">
						<div class="footer-contacts">
							<?php if ( $tel || $emails || $addresses || $social ) : ?>
							<ul class="contacts-list">
								<?php if ( $tel ) : ?>
								<li>
									<a href="tel:<?php echo preg_replace( '![^0-9]+!', '', $tel ); ?>" class="contact-item contact-item-tel">
										<i><svg width="13" height="16"><use xlink:href="#icon-phone"/></svg></i>
										<span><?php echo $tel; ?></span>
									</a>
								</li>
								<?php endif; ?>
								<?php if ( $email ) : ?>
								<li>
									<a href="mailto:<?php echo $email; ?>" class="contact-item contact-item-email">
										<i><svg width="14" height="14"><use xlink:href="#icon-email"/></svg></i>
										<span><?php echo $email; ?></span>
									</a>
								</li>
								<?php endif; ?>
								<?php if ( $social ) : ?>
								<li>
									<?php include( TEMPLATEPATH . '/inc/social-list.php' ); ?>
								</li>
								<?php endif; ?>
								<?php if ( $addresses ) : ?>
								<li>
									<div class="contact-item contact-item-address">
										<i><svg width="13" height="16"><use xlink:href="#icon-marker"/></svg></i>
										<span><?php echo $addresses[0]['address']; ?></span>
									</div>
								</li>
								<?php endif; ?>
							</ul>
							<?php endif; ?>
							<?php if ( $footer_btn ) : ?>
							<a href="#" class="btn footer-btn" data-modal-open="modal-order"><?php echo $footer_btn; ?></a>
							<?php endif; ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<?php include( TEMPLATEPATH . '/inc/contacts-map.php' ); ?>
		</div>
	</div>
	<?php endif; ?>
	<div class="foot">
		<?php $copyright = carbon_get_theme_option( 'copyright' ); ?>
		<div class="container">
			<a href="https://palladiumlab.com/" class="developer-link" target="_blank">
				<?php _e( 'Разработано в', DOMAIN ); ?>
				<span>Palladiumlab</span>
				<?php echo $copyright ? str_replace( '{Y}', date( 'Y' ), $copyright ) : ''; ?>
			</a>
			<?php if ( get_privacy_policy_url() ) : ?>
			<a href="<?php echo get_privacy_policy_url(); ?>" class="privacy-policy-link"><?php _e( 'Политика конфиденциальности', DOMAIN ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</footer>
<?php 
	$modal_title = carbon_get_theme_option( 'modal_title' );
	$modal_img = carbon_get_theme_option( 'modal_img' );
	$modal_sent_title = carbon_get_theme_option( 'modal_sent_title' );
	$modal_sent_desc = carbon_get_theme_option( 'modal_sent_desc' );
	$front_page_id = get_option( 'page_on_front' );
	$feedback_form_agreement = carbon_get_post_meta( $front_page_id, 'feedback_form_agreement' );
 ?>
<div id="modal-order" aria-hidden="true" class="modal modal-order">
	<div tabindex="-1" class="modal-wrapp">
		<div role="dialog" aria-modal="true" class="modal-body">
			<a href="#" class="modal-close-btn" aria-label="<?php _e( 'Закрыть', DOMAIN ); ?>" data-modal-close>
				<svg width="20" height="20"><use xlink:href="#icon-close"/></svg>
			</a>
			<?php if ( $modal_img ) : ?>
			<div class="modal-order-img cover-img">
				<img
					src="<?php echo image_downsize( $modal_img, 'marpan-modal-slide' )[0]; ?>"
					srcset="<?php echo image_downsize( $modal_img, 'full' )[0]; ?> 2x"
					alt="<?php echo get_post_meta( $modal_img, '_wp_attachment_image_alt', true ); ?>"
					loading="lazy"
				>
			</div>
			<?php endif; ?>
			<div class="modal-order-body">
				<?php if ( $modal_title ) : ?>
				<div class="modal-title"><?php echo $modal_title; ?></div>
				<?php endif; ?>
				<form action="?" class="modal-form form" data-alert="<?php _e( 'Ошибка. Пожалуйста, попробуйте еще раз, или свяжитесь с нами по телефону.', DOMAIN ); ?>">
					<?php wp_nonce_field( 'modal', 'modal_nonce_field' ); ?>
					<input type="hidden" name="title" value="<?php _e( 'Новая заявка', DOMAIN ); ?>" data-title="<?php _e( 'Новая заявка', DOMAIN ); ?>">
					<div class="form-block">
						<label class="input-block" aria-label="<?php _e( 'Ваше имя *', DOMAIN ); ?>">
							<input type="text" class="input" name="name" placeholder="<?php _e( 'Ваше имя *', DOMAIN ); ?>" required>
							<span class="input-icon">
								<svg width="13" height="14"><use xlink:href="#icon-user"/></svg>
							</span>
						</label>
					</div>
					<div class="form-block">
						<label class="input-block" aria-label="<?php _e( 'Телефон', DOMAIN ); ?>">
							<input type="tel" class="input" name="tel" placeholder="<?php _e( '+7 (___) ___-__-__', DOMAIN ); ?>" required>
							<span class="input-icon">
								<svg width="12" height="12"><use xlink:href="#icon-tel"/></svg>
							</span>
						</label>
					</div>
					<div class="modal-form-submit-wrapp">
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
			</div>
		</div>
	</div>
</div>
<div id="modal-sent" aria-hidden="true" class="modal modal-sent">
	<div tabindex="-1" class="modal-wrapp">
		<div role="dialog" aria-modal="true" class="modal-body">
			<a href="#" class="modal-close-btn" aria-label="<?php _e( 'Close', DOMAIN ); ?>" data-modal-close>
				<svg width="20" height="20"><use xlink:href="#icon-close"/></svg>
			</a>
			<?php if ( $modal_sent_title ) : ?>
			<div class="modal-title"><?php echo $modal_sent_title; ?></div>
			<?php endif; ?>
			<?php if ( $modal_sent_desc ) : ?>
			<div class="modal-desc"><?php echo nl2br( $modal_sent_desc ); ?></div>
			<?php endif; ?>
			<svg class="modal-sent-icon" width="146" height="139" viewBox="0 0 146 139" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path class="modal-sent-icon-circle" stroke-dasharray="350" stroke-dashoffset="350" d="M135.4 63.2338V69.5085C135.392 84.0581 130.749 98.2151 122.163 109.868C113.578 121.521 101.511 130.045 87.7608 134.171C74.0111 138.296 59.315 137.801 45.8651 132.759C32.4151 127.717 20.9317 118.398 13.1276 106.192C5.32349 93.9872 1.61672 79.5482 2.56015 65.0306C3.50357 50.5128 9.04667 36.6933 18.3627 25.6333C27.6787 14.5733 40.2685 6.86529 54.2545 3.65888C68.2405 0.452469 82.8735 1.91944 95.9701 7.84101" stroke="#EC7653" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
			<path class="modal-sent-icon-check" stroke-dasharray="136" stroke-dashoffset="-136" d="M143.586 7.18945L69.6414 82.9631L49.4746 62.2977" stroke="#202348" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</div>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>