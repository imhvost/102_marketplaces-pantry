<?php
/*
Template Name: Услуги
*/
?>
<?php get_header(); ?>
<?php the_post(); ?>
<?php get_template_part( 'inc/page-promo' ); ?>
<div class="page-body">
	<div class="container">
		<?php 
			$title = carbon_get_the_post_meta( 'title' );
			$desc = carbon_get_the_post_meta( 'desc' );
			$services = carbon_get_the_post_meta( 'services' );
			if ( $title || $desc || $services ) : 
		?>
		<div class="services-row flex-row">
			<?php if ( $title || $desc ) : ?>
			<div class="services-col services-col-large flex-row-item">
				<?php if ( $title ) : ?>
				<div class="section-title h1"><?php echo $title; ?></div>
				<?php endif; ?>
				<?php if ( $desc ) : ?>
				<div class="section-desc"><?php echo nl2br( $desc ); ?></div>
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
		<?php endif; ?>
	</div>
</div>
<?php include( TEMPLATEPATH . '/inc/feedback.php' ); ?>
<?php if ( get_the_content() ) :?>
<div class="page-seo section">
	<div class="container">
		<div class="content-text"><?php the_content(); ?></div>
	</div>
</div>
<?php endif; ?>
<?php get_footer(); ?>