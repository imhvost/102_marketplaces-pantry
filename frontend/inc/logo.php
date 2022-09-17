<?php if ( is_front_page() ) : ?>
<span class="logo">
<?php else : ?>
<a href="<?php echo home_url( '/' ); ?>" class="logo" aria-label="<?php _e( 'На главную страницу', DOMAIN ); ?>">
<?php endif; ?>
	<picture>
		<?php if ( $logo_mobile ) : ?>
		<source media="(max-width:1023px)" srcset="<?php echo image_downsize( $logo_mobile, 'full' )[0]; ?>">
		<?php endif; ?>
		<img src="<?php echo image_downsize( $logo, 'full' )[0]; ?>" alt="<?php bloginfo( 'name' ); ?>">
	</picture>
<?php if ( is_front_page() ) : ?>
</span>
<?php else : ?>
</a>
<?php endif; ?>