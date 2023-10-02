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
		<figure class="projects-thumbnail overlay rounded">
			<?php
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
			?>
			<?php if( 'yes' === $args['settings']['popup_thumb'] ){ ?>
			<a href="<?php echo esc_attr( $image_url ); ?>" class="project-glightbox" data-gallery="shots-group-<?php echo esc_attr( $args['id_int'] ) ?>">
			<?php }else{ ?>
			<a href="<?php the_permalink(); ?>">
			<?php } ?>
				<?php echo wp_kses_post( $thumbnail_html ); ?>
				<span class="bg"></span>
				<figcaption>
                	<h5 class="from-top mb-0"><?php the_title(); ?></h5>
                </figcaption>
			</a>
		</figure>
	</div>
</article>
<?php if(!empty( $args['is_latest'] )){ ?>
<div class="hidden_load_more"></div>
<?php } ?>
