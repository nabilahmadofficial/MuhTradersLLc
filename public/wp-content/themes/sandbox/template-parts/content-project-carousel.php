<?php
/**
 * Template part for displaying widget Portfolio Carousel
 *
 * @package Sandbox
 */
?>
<?php 
	$tag_body_open = '';
	$tag_body_close = '';
	$projects_box_class = 'projects-box';
	$figure_class = 'projects-thumbnail overlay hover-scale rounded mb-6';
	$footer_class = 'post-footer';
	if( $args['settings']['style_layout'] == 'style-2' ){
		$tag_body_open = '<div class="card-body">';
		$tag_body_close = '</div">';
		$projects_box_class = 'projects-box card';
		$figure_class = 'projects-thumbnail overlay hover-scale card-img-top';
		$footer_class = 'card-footer';
	}
	
?>
<article class="project-item">
	<div class="<?php echo esc_attr( $projects_box_class ); ?>">
		<figure class="<?php echo esc_attr( $figure_class ); ?>">
			<a href="<?php the_permalink(); ?>">
				<?php
					if ( has_post_thumbnail() ) {
						$args['settings']['post_thumbnail'] = [
							'id' => get_post_thumbnail_id(),
						];
						$thumbnail_html = Elementor\Group_Control_Image_Size::get_attachment_image_html( $args['settings'], 'post_thumbnail' );
					}else{
						$thumbnail_html = '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/thumbnail-default.png" />';
					}
					echo wp_kses_post( $thumbnail_html );
				?>
				<span class="bg"></span>

				<?php if( !empty( $args['settings']['caption_hover'] ) ){ ?> 
				<figcaption>
					<h5 class="from-top mb-0"><?php echo wp_kses_post( $args['settings']['caption_hover'] ); ?></h5>
				</figcaption>
				<?php } ?>
			</a>
		</figure>
		<?php echo wp_kses_post( $tag_body_open ); ?>
			<div class="post-header">
	        	<h2 class="post-title h3 mb-3">
	        		<a class="title-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	        	</h2>
	        </div>
	        <?php if( $args['settings']['is_exc'] == 'yes' ){ ?>
	        <div class="post-content">
	        	<?php echo the_excerpt(); ?>
	        </div>
        	<?php } ?>
        <?php echo wp_kses_post( $tag_body_close ); ?>
        <div class="<?php echo esc_attr( $footer_class ); ?>">
        	<ul class="post-meta">
        		<?php sandbox_portfolio_meta(); ?>
        	</ul>
        </div>
	</div>
</article>

