<?php get_header(); ?>
<?php the_post(); ?>
<?php get_template_part( 'inc/page-promo' ); ?>
<main class="page-body">
	<div class="container">
		<div class="article-content content-text">
			<?php the_content(); ?>
		</div>
	</div>
</main>
<?php 
	if ( $post->post_type === 'service' ) :
		$services_page_id = marpan_get_page_id_by_template( 'page-services.php' );
		$services = carbon_get_post_meta( $services_page_id, 'services' );
		$other_services_title = carbon_get_post_meta( $services_page_id, 'other_services_title' );
		$other_services_sub_title = carbon_get_post_meta( $services_page_id, 'other_services_sub_title' );
		if ( $services ) {
			$services = wp_list_pluck( $services, 'id' );
		}
		if ( $services ) {
			if ( ( $key = array_search( $post->ID, $services ) ) !== false ) {
				 unset( $services[$key] );
			}
			$service_main = carbon_get_the_post_meta( 'services' );
			if ( $service_main ) {
				$service_main = $service_main[0]['id'];
				if ( ( $key = array_search( $service_main, $services ) ) !== false ) {
					 unset( $services[$key] );
				}
			}
		}
		if ( $services ) :
?>
<div class="other-services section section-alt">
	<div class="container">
		<?php if ( $other_services_title || $feedback_sub_title ) : ?>
		<div class="section-head">
			<?php if ( $other_services_title ) : ?>
			<div class="section-title h1"><?php echo $other_services_title; ?></div>
			<?php endif; ?>
			<?php if ( $other_services_sub_title ) : ?>
			<div class="section-sub-title"><?php echo $other_services_sub_title; ?></div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<div class="services-row other-services-row flex-row">
			<?php
				foreach ( $services as $post_id ) {
					include( TEMPLATEPATH . '/inc/services-col.php' );
				}
			?>
		</div>
	</div>
</div>
<?php
		endif;
	endif;	
?>
<?php include( TEMPLATEPATH . '/inc/feedback.php' ); ?>
<?php get_footer(); ?>