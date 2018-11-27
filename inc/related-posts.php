<?php $related_posts = fitclub_related_posts_function(); ?>

<?php if ( $related_posts->have_posts() ): ?>

	<div class="related-posts-wrapper">

		<h4 class="related-posts-main-title">
			<i class="fa fa-thumbs-up"></i><span><?php esc_html_e( 'You May Also Like', 'fitclub' ); ?></span>
		</h4>

		<div class="related-posts clearfix">

			<?php
			$count = 1;
			while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
				<div class="tg-column-3">

					<?php if ( has_post_thumbnail() ): ?>
						<?php $title_attribute = esc_attr( get_the_title( $post->ID ) );
						$thumb_id              = get_post_thumbnail_id( get_the_ID() );
						$img_altr              = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
						$img_alt               = ! empty( $img_altr ) ? $img_altr : $title_attribute;
						$post_thumbnail_attr   = array(
							'title' => esc_attr( $title_attribute ),
							'alt'   => esc_attr( $img_alt ),
						); ?>
						<div class="post-thumbnails">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php the_post_thumbnail( 'fitclub-testimonial', $post_thumbnail_attr ); ?>
							</a>
						</div>
					<?php endif; ?>

					<div class="wrapper">

						<h3 class="entry-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						</h3><!--/.post-title-->

						<div class="entry-meta">
							<span class="posted-on">
								<a href="<?php esc_url( get_permalink() ); ?>">
									<span class="date">
										<?php esc_attr( the_time(' d ') ); ?>
									</span>
									<span class="month">
										<?php esc_attr( the_time(' M ') ); ?>
									</span>
								</a>
							</span>

							<span class="byline author vcard"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><i class="fa fa-user"></i><?php echo esc_html( get_the_author() ); ?></a></span>

						</div>

					</div>

				</div><!--/.related-->
			<?php
			$count ++;
		endwhile; ?>

		</div><!--/.post-related-->

	</div>
<?php endif; ?>

<?php wp_reset_query(); ?>
