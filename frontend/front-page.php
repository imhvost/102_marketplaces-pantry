<?php
/*
Template Name: Главная
*/
?>
<?php get_header(); ?>
<?php the_post(); ?>
<?php 
	$promo_img = carbon_get_the_post_meta( 'promo_img' );
	$promo_exp = carbon_get_the_post_meta( 'promo_exp' );
	$promo_title = carbon_get_the_post_meta( 'promo_title' );
	$promo_form_title = carbon_get_the_post_meta( 'promo_form_title' );
	$promo_form_btn = carbon_get_the_post_meta( 'promo_form_btn' );
	$feedback_form_agreement = carbon_get_the_post_meta( 'feedback_form_agreement' );
?>
<div class="page-promo home-promo">
	<div class="container">
		<div class="page-promo-content">
			<h1 class="page-title h0"><?php echo $promo_title; ?></h1>
			<form action="?" class="page-promo-form form" data-alert="<?php _e( 'Ошибка. Пожалуйста, попробуйте еще раз, или свяжитесь с нами по телефону.', DOMAIN ); ?>">
				<?php wp_nonce_field( 'promo', 'promo_nonce_field' ); ?>
				<input type="hidden" name="title" value="<?php echo $promo_form_submit ?: __( 'Узнать стоимость', DOMAIN ); ?>">
				<?php if ( $promo_form_title ) : ?>
				<div class="page-promo-form-title"><?php echo $promo_form_title; ?></div>
				<?php endif; ?>
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
						<span><?php echo $promo_form_submit ?: __( 'Узнать стоимость', DOMAIN ); ?></span>
						<svg width="12" height="15"><use xlink:href="#icon-arrow-right"/></svg>
					</button>
				</div>
				<?php if ( $feedback_form_agreement ) : ?>
				<div class="form-agreement">
					<?php echo nl2br ( $feedback_form_agreement ); ?>
				</div>
				<?php endif; ?>
			</form>
		</div>
		<?php if ( $promo_img ) : ?>
		<div class="home-promo-img">
			<img
				src="<?php echo image_downsize( $promo_img, [760, 816] )[0]; ?>"
				srcset="<?php echo image_downsize( $promo_img, 'full' )[0]; ?> 2x"
				alt="<?php echo get_post_meta( $promo_img, '_wp_attachment_image_alt', true ); ?>"
				loading="lazy"
			>
		</div>
		<?php endif; ?>
		<a href="#" class="home-promo-scroll-btn">
			<span><?php _e( 'Листайте вниз', DOMAIN ); ?></span>
			<i><svg width="12" height="15"><use xlink:href="#icon-arrow-bottom"/></svg></i>
		</a>
	</div>
</div>
<?php 
	$advantages_title = carbon_get_the_post_meta( 'advantages_title' );
	$advantages_sub_title = carbon_get_the_post_meta( 'advantages_sub_title' );
	$advantages = carbon_get_the_post_meta( 'advantages' );
	if ( $advantages_title || $advantages_sub_title || $advantages ) :
?>
<div class="home-advantages section">
	<div class="container">
		<?php if ( $advantages_title || $advantages_sub_title ) : ?>
		<div class="section-head">
			<?php if ( $advantages_title ) : ?>
			<div class="section-title h1"><?php echo $advantages_title; ?></div>
			<?php endif; ?>
			<?php if ( $advantages_sub_title ) : ?>
			<div class="section-sub-title"><?php echo $advantages_sub_title; ?></div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<?php if ( $advantages ) : ?>
		<div class="advantages-row flex-row">
			<?php
				foreach ( $advantages as $item ) {
					include ( TEMPLATEPATH . '/inc/advantages-col.php' );
				}
			?>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>
<?php 
	$services_title = carbon_get_the_post_meta( 'services_title' );
	$services_desc = carbon_get_the_post_meta( 'services_desc' );
	$services = carbon_get_the_post_meta( 'services' );
	$services_btn = carbon_get_the_post_meta( 'services_btn' );
	if ( $services_title || $services_desc || $services ) :
?>
<div class="home-services section">
	<div class="container">
		<div class="services-row flex-row">
			<?php if ( $services_title || $services_desc ) : ?>
			<div class="services-col services-col-large flex-row-item">
				<?php if ( $services_title ) : ?>
				<div class="section-title h1"><?php echo $services_title; ?></div>
				<?php endif; ?>
				<?php if ( $services_desc ) : ?>
				<div class="section-desc"><?php echo nl2br( $services_desc ); ?></div>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<?php
				if ( $services ) {
					foreach ( $services as $item ) {
						$post_id = $item['id'];
						include( TEMPLATEPATH . '/inc/services-col.php' );
					}
				}
			?>
		</div>
		<?php if ( $services_btn ) : ?>
		<div class="read-more-btn-wrapp">
			<a href="#" class="btn" data-modal-open="modal-order">
				<span><?php echo $services_btn; ?></span>
				<svg width="12" height="15"><use xlink:href="#icon-arrow-right"/></svg>
			</a>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>
<?php 
	$cases_title = carbon_get_the_post_meta( 'cases_title' );
	$cases = carbon_get_the_post_meta( 'cases' );
	if ( $cases ) {
		$cases = wp_list_pluck( $cases, 'id' );
	}
	if ( $cases_title || $cases ) :
?>
<div class="home-cases section section-alt">
	<div class="container slider-wrapp">
		<?php include( TEMPLATEPATH . '/inc/cases.php' ); ?>
	</div>
</div>
<?php endif; ?>
<?php if ( get_the_content() ) :?>
<div class="home-seo section ">
	<div class="container">
		<div class="content-text"><?php the_content(); ?></div>
	</div>
</div>
<?php endif; ?>
<?php include( TEMPLATEPATH . '/inc/feedback.php' ); ?>
<?php get_footer(); ?>