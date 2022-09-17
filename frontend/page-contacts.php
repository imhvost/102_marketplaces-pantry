<?php
/*
Template Name: Контакты
*/
?>
<?php get_header(); ?>
<?php the_post(); ?>
<?php get_template_part( 'inc/page-promo' ); ?>
<div class="page-body">
	<div class="container">
		<?php 
			$tels = carbon_get_the_post_meta( 'tels' );
			$emails = carbon_get_the_post_meta( 'emails' );
			$addresses = carbon_get_the_post_meta( 'addresses' );
			$social = carbon_get_the_post_meta( 'social' );
			if ( $tels || $emails || $addresses || $social ) :
		?>
		<div class="contacts-row flex-row">
			<?php if ( $tels ) : ?>
			<div class="contacts-col contacts-col-tels flex-row-item">
				<ul class="contacts-list">
					<?php foreach ( $tels as $item ) : ?>
					<li>
						<a href="tel:<?php echo preg_replace( '![^0-9]+!', '', $item['tel'] ); ?>" class="contact-item contact-item-tel">
							<i><svg width="14" height="20"><use xlink:href="#icon-phone"/></svg></i>
							<span><?php echo $item['tel']; ?></span>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
			<?php if ( $emails ) : ?>
			<div class="contacts-col contacts-col-emails flex-row-item">
				<ul class="contacts-list">
					<?php foreach ( $emails as $item ) : ?>
					<li>
						<a href="mailto:<?php echo $item['email']; ?>" class="contact-item contact-item-email">
							<i><svg width="18" height="18"><use xlink:href="#icon-email"/></svg></i>
							<span><?php echo $item['email']; ?></span>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
			<?php if ( $addresses ) : ?>
			<div class="contacts-col contacts-col-addresses flex-row-item">
				<ul class="contacts-list">
					<?php foreach ( $addresses as $item ) : ?>
					<li>
						<div class="contact-item contact-item-address">
							<i><svg width="15" height="20"><use xlink:href="#icon-marker"/></svg></i>
							<span><?php echo $item['address']; ?></span>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
			<?php if ( $social ) : ?>
			<div class="contacts-col contacts-col-social flex-row-item">
				<?php include( TEMPLATEPATH . '/inc/social-list.php' ); ?>
			</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<?php include( TEMPLATEPATH . '/inc/contacts-map.php' ); ?>
	</div>
</div>
<?php include( TEMPLATEPATH . '/inc/feedback.php' ); ?>
<?php get_footer(); ?>