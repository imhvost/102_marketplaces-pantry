<div class="section-head">
	<?php if ( $cases_title ) : ?>
	<div class="section-title h1"><?php echo $cases_title; ?></div>
	<?php endif; ?>
	<?php
		if ( $cases ) {
			include( TEMPLATEPATH . '/inc/slider-nav.php' );
		}
	?>
</div>
<?php if ( $cases ) : ?>
<div class="cases-slider swiper">
	<div class="swiper-wrapper">
		<?php
			foreach ( $cases as $post_id ) :
			$desc = carbon_get_post_meta( $post_id, 'desc' );
			$enter_point = carbon_get_post_meta( $post_id, 'enter_point' );
			$current_point = carbon_get_post_meta( $post_id, 'current_point' );
			$currency = carbon_get_post_meta( $post_id, 'currency' );
			$we_did = carbon_get_post_meta( $post_id, 'we_did' );
			$btn = carbon_get_post_meta( $post_id, 'btn' );
		?>
		<div class="cases-slide swiper-slide">
			<div class="case-item">
				<div class="case-item-title"><?php echo get_the_title( $post_id ); ?></div>
				<?php if ( $desc ) : ?>
				<div class="case-item-desc"><?php echo nl2br( $desc ); ?></div>
				<?php endif; ?>
				<?php if ( $enter_point || $current_point ) : ?>
				<div class="case-item-progress">
					<?php if ( $enter_point ) : ?>
					<div class="case-item-progress-enter-title"><?php _e( 'Входная точка', DOMAIN ); ?></div>
					<?php endif; ?>
					<div class="case-item-progress-line">
						<?php if ( $enter_point ) : ?>
						<div class="case-item-progress-line-enter"><?php echo number_format( $enter_point, 0, '', ' ' ); ?> <?php echo $currency; ?></div>
						<?php endif; ?>
						<?php if ( $current_point ) : ?>
						<div class="case-item-progress-line-current"><?php echo number_format( $current_point, 0, '', ' ' ); ?> <?php echo $currency; ?></div>
						<?php endif; ?>
					</div>
					<?php if ( $current_point ) : ?>
					<div class="case-item-progress-current-title"><?php _e( 'Текущий оборот', DOMAIN ); ?></div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
				<?php
					if ( $we_did ) :
					$we_did = preg_split( '/\r\n|\r|\n/', $we_did );
				?>
				<div class="case-item-we-did">
					<div class="case-item-we-did-title"><?php _e ( 'Мы провели:', DOMAIN ); ?></div>
					<ul class="case-item-we-did-list content-custom-list">
						<?php foreach ( $we_did as $item ) : ?>
						<li>
							<svg width="18" height="18"><use xlink:href="#icon-check-circle"/></svg>
							<span><?php echo $item; ?></span>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>
				<?php if ( $btn ) : ?>
				<a href="#" class="case-item-btn item-btn" data-modal-open="modal-order" data-title="<?php echo $btn; ?>: <?php echo get_the_title( $post_id ); ?>">
					<span><?php echo $btn; ?></span>
					<i><svg width="7" height="12"><use xlink:href="#icon-angle-right"></use></svg></i>
				</a>
				<?php endif; ?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<?php endif; ?>