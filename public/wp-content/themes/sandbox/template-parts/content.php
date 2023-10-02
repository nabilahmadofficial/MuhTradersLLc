<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sandbox
 */

?>

<?php                                                     
	$format = get_post_format();
	$link_video  = get_post_meta(get_the_ID(),'post_video', true);
	$link_audio  = get_post_meta(get_the_ID(),'post_audio', true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-box'); ?>>
	<div class="post-inner">
		<?php if( $format == 'gallery' ) { ?>

			<div class="entry-media">
				<div class="gallery-post ot-carousel owl-carousel owl-theme">
				<?php if( function_exists( 'rwmb_meta' ) ) { ?>
		            <?php $images = rwmb_meta( 'post_gallery', array( 'size' =>'full' ) ); ?>
		            <?php if($images){ ?>              
		                <?php foreach ( $images as $image ) {  ?>		
							<div class="item-image">
								<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
							</div>                
		                <?php } ?>                
		            <?php } ?>
		        <?php } ?>
		        </div>
			</div>			

	    <?php }elseif( $format == 'image' ) { ?>

	    	<div class="entry-media hover-scale">
				<?php if( function_exists( 'rwmb_meta' ) ) { ?>
				    <?php $images = rwmb_meta( 'post_image', array( 'size' =>'full' ) ); ?>
				    <?php if($images){ ?>              
				        <?php foreach ( $images as $image ) {  ?>				            
				            <a href="<?php the_permalink(); ?>">
				            	<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
                				<?php if(sandbox_get_option('blog_read_more')) { echo '<div class="bg-overlay"><h5>'.sandbox_get_option('blog_read_more').'</h5></div>'; } ?>
				            </a>
				        <?php } ?>                
				    <?php } ?>
				<?php } ?>
			</div>
			
	    <?php }elseif( $format == 'audio' ){ ?>

			<div class="audio-box padding-box">
				<iframe scrolling="no" frameborder="no" src="<?php echo esc_url( $link_audio ); ?>"></iframe>
			</div>

	    <?php }elseif( $format == 'video' ){ ?>

			<div class="entry-media">
				<?php if( function_exists( 'rwmb_meta' ) ) { ?>
                    <div class="player" data-plyr-provider="youtube" data-plyr-embed-id="<?php echo esc_attr($link_video); ?>"></div>
				<?php } ?>
			</div>

		<?php }elseif ( has_post_thumbnail() ) { ?>
		<div class="entry-media hover-scale">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail(); ?>
                <?php if(sandbox_get_option('blog_read_more')) { echo '<div class="bg-overlay"><h5>'.sandbox_get_option('blog_read_more').'</h5></div>'; } ?>
            </a>
        </div>
        <?php } ?>
		<div class="inner-post">
	        <div class="post-header">

            	<?php sandbox_posted_in(); ?>

	            <?php the_title( '<h2 class="entry-title"><a class="title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

	        </div><!-- .entry-header -->

	        <div class="entry-summary the-excerpt">

	            <?php the_excerpt(); ?>

	        </div><!-- .entry-content -->
	    </div>
	    <?php if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta">
        	<?php if( sandbox_get_option( 'post_entry_meta' ) ) { sandbox_post_meta(); } ?>
        </div><!-- .entry-meta -->
        <?php endif; ?>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
