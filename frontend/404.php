<?php get_header(); ?>
<?php the_post(); ?>
<div class="page-404">
	<main class="page-body">
		<div class="container">
			<?php get_template_part( 'inc/breadcrumbs' ); ?>
			<h1 class="section-title h0"><b><?php _e( 'Ошибка 404', DOMAIN ); ?></b></h1>
			<div class="section-desc"><?php _e( 'Страница не существует', DOMAIN ); ?></div>
			<a href="<?php echo home_url( '/' ); ?>" class="btn btn-large"><?php _e( 'На главную', DOMAIN ); ?></a>
		</div>
	</main>
</div>
<?php get_footer(); ?>