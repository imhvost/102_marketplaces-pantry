<div class="advantages-col flex-row-item">
	<div class="advantages-item">
		<?php if ( $item['icon'] ) : ?>
		<div class="advantages-item-icon">
			<img
				src="<?php echo image_downsize( $item['icon'], 'full' )[0]; ?>"
				alt="<?php echo get_post_meta( $item['icon'], '_wp_attachment_image_alt', true ); ?>"
			>
		</div>
		<?php endif; ?>
		<div class="advantages-item-desc"><?php echo nl2br( $item['desc'] ); ?></div>
	</div>
</div>