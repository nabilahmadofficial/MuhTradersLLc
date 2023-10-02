<?php
/**
 * Template part for displaying widget Portfolio Carousel 2
 *
 * @package Sandbox
 */
?>
<?php 
	$cates = get_the_terms( get_the_ID(), 'portfolio_cat' );
	$is_gallery = !empty( $args['settings']['is_gallery'] );
?>
<article class="project-item">
	<div class="projects-box">
		<figure class="projects-thumbnail rounded mb-6">
			<?php if( !$is_gallery ){ ?>
				<a href="<?php the_permalink(); ?>">
			<?php } 
				if ( has_post_thumbnail() ) {
					$image_url = get_the_post_thumbnail_url();
					$args['settings']['post_thumbnail'] = [
						'id' => get_post_thumbnail_id(),
					];
					$thumbnail_html = Elementor\Group_Control_Image_Size::get_attachment_image_html( $args['settings'], 'post_thumbnail' );
				}else{
					$image_url = get_bloginfo( 'stylesheet_directory' ) . '/images/thumbnail-default.png';
					$thumbnail_html = '<img src="' . $image_url . '"/>';
				}
				echo wp_kses_post( $thumbnail_html );
			if( !$is_gallery ){ ?>
				</a>
			<?php }
				if( $is_gallery ){ ?>
				<a class="item-link" href="<?php echo esc_attr( $image_url ); ?>" data-glightbox data-gallery="projects-group-<?php echo esc_attr( $args['id_int'] ) ?>"><i class="uil uil-focus-add"></i>
				</a>
			<?php } ?>
		</figure>
		<div class="project-details dflex">
			<div class="post-header">
	        	<h2 class="post-title h3">
	        		<a class="title-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	        	</h2>
	        	<div class="post-cates">
	        		<?php 
						if ( ! is_wp_error( $cates ) && ! empty( $cates ) ) :
							foreach ( $cates as $key => $term ) {
								// The $term is an object, so we don't need to specify the $taxonomy.
								$term_link = get_term_link( $term );
								// If there was an error, continue to the next term.
								if ( is_wp_error( $term_link ) ) {
									continue;
								}
								// We successfully got a link. Print it out.
								echo wp_kses_post( '<a href="' . esc_url( $term_link ) . '">' . $term->name . '</a>' );
							}
						endif; 
					?> 
	        	</div>
	        </div>
		</div>
	</div>
</article>

