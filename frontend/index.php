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
<?php get_footer(); ?>