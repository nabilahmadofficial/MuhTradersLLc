<?php
/**
 * Template part for displaying widget Portfolio Filter
 *
 * @package Sandbox
 */
?>
<?php 
	$cates = get_the_terms( get_the_ID(), 'portfolio_cat' );
	$cate_id   = '';
    if ( ! is_wp_error( $cates ) && ! empty( $cates ) ) :
	    foreach ( $cates as $cate ) {
	        $cate_id .= 'portfolio-category-id-' . $cate->term_id . ' ';
	    }
	endif;
?>
<article class="project-item <?php echo esc_attr( $cate_id ); ?>">
	<div class="projects-box">
		<figure class="projects-thumbnail lift rounded mb-6">
			<?php
				if ( has_post_thumbnail() ) {
					$args['settings']['post_thumbnail'] = [
						'id' => get_post_thumbnail_id(),
					];
					$thumbnail_html = Elementor\Group_Control_Image_Size::get_attachment_image_html( $args['settings'], 'post_thumbnail' );
				}else{
					$image_url = get_bloginfo( 'stylesheet_directory' ) . '/images/thumbnail-default.png';
					$thumbnail_html = '<img src="' . $image_url . '" alt=""/>';
				}
			?>
			
			<a href="<?php the_permalink(); ?>">
				<?php echo wp_kses_post( $thumbnail_html ); ?>
			</a>
		</figure>
		<div class="project-details text-left dflex">
			<div class="post-header">
              	<div class="post-cates text-line">
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
              	<h2 class="post-title h3">
              		<a class="title-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              	</h2>
            </div>
		</div>
	</div>
</article>
<?php if(!empty( $args['is_latest'] )){ ?>
<div class="hidden_load_more"></div>
<?php } ?>
