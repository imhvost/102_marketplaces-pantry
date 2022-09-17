<!DOCTYPE html>
<html lang="<?php bloginfo( 'language' ); ?>">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="format-detection" content="telephone=no">
	<script>window.SITE_URL = '<?php echo site_url(); ?>';</script>
	<?php wp_site_icon(); ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php get_template_part( 'inc/sprite' ); ?>
<header class="header">
	<?php 
		$logo = carbon_get_theme_option( 'logo' );
		$header_btn = carbon_get_theme_option( 'header_btn' );
		$contacts_page_id = marpan_get_page_id_by_template( 'page-contacts.php' );
		$tels = carbon_get_post_meta( $contacts_page_id, 'tels' );
		if ( $tels ) {
			$tel = $tels[0]['tel'];
		}
		$social = carbon_get_post_meta( $contacts_page_id, 'social' );
	?>
	<div class="container">
		<?php
			if ( $logo ) :
				if ( is_front_page() ) :
		?>
		<span class="header-logo">
			<img
				src="<?php echo image_downsize( $logo, 'full' )[0]; ?>"
				alt="<?php echo get_post_meta( $logo, '_wp_attachment_image_alt', true ); ?>"
			>
		</span>
			<?php else : ?>
		<a href="<?php echo home_url( '/' ); ?>" class="header-logo" aria-label="<?php _e( 'На главную', DOMAIN ); ?>">
			<img
				src="<?php echo image_downsize( $logo, 'full' )[0]; ?>"
				alt="<?php echo get_post_meta( $logo, '_wp_attachment_image_alt', true ); ?>"
			>
		</a>
			<?php endif; ?>
		<?php endif; ?>
		<?php if ( has_nav_menu( 'header' ) || $tel || $social ) : ?>
		<div class="header-nav">
			<div class="header-nav-body">
				<?php
					if ( has_nav_menu( 'header' ) ) {
						wp_nav_menu( [
							'theme_location' => 'header',
							'link_before'    => '<span>',
							'link_after'     => '</span><i><svg><use xlink:href="#icon-angle-down"/></svg></i>',
							'container'      => false,
							'menu_class'     => 'header-menu',
						] );
					}
				?>
				<?php if ( $tel ) :  ?>
				<a href="tel:<?php echo preg_replace( '![^0-9]+!', '', $tel ); ?>" class="header-tel contact-item contact-item-tel">
					<i><svg width="14" height="20"><use xlink:href="#icon-phone"/></svg></i>
					<span><?php echo $tel; ?></span>
				</a>
				<?php endif; ?>
				<?php
					if ( $social ) {
						include( TEMPLATEPATH . '/inc/social-list.php' );
					}
				?>
				<?php if ( $header_btn ) : ?>
				<a href="#" class="btn header-btn" data-modal-open="modal-order"><?php echo $header_btn; ?></a>
				<?php endif; ?>
			</div>
			<a href="#" class="header-nav-close" aria-label="<?php _e( 'Закрыть', DOMAIN ); ?>">
				<svg width="20" height="20"><use xlink:href="#icon-close"/></svg>
			</a>
		</div>
		<?php endif; ?>
		<?php if ( $tel ) :  ?>
		<a href="tel:<?php echo preg_replace( '![^0-9]+!', '', $tel ); ?>" class="header-tel contact-item contact-item-tel visible-tablet">
			<i><svg width="14" height="20"><use xlink:href="#icon-phone"/></svg></i>
			<span><?php echo $tel; ?></span>
		</a>
		<?php endif; ?>
		<?php if ( has_nav_menu( 'header' ) || $tel || $social ) : ?>
		<a href="#" class="header-nav-open" aria-label="<?php _e( 'Меню', DOMAIN ); ?>">
			<svg width="24" height="24"><use xlink:href="#icon-menu"/></svg>
		</a>
		<?php endif; ?>
	</div>
</header>