<ul class="social-list">
	<?php foreach ( $social as $item ) : ?>
	<li>
		<a href="<?php echo $item['link']; ?>" target="_blank" aria-label="<?php echo $item['title']; ?>">
			<img
				src="<?php echo image_downsize( $item['icon'], 'full' )[0]; ?>"
				alt="<?php echo get_post_meta( $item['icon'], '_wp_attachment_image_alt', true ); ?>"
			>
		</a>
	</li>
	<?php endforeach; ?>
</ul>