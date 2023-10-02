<?php
/**
 * Template part for displaying single post content
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

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post post-box'); ?>>
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

        <div class="entry-media">
            <?php if( function_exists( 'rwmb_meta' ) ) { ?>
                <?php $images = rwmb_meta( 'post_image', array( 'size' =>'full' ) ); ?>
                <?php if($images){ ?>              
                    <?php foreach ( $images as $image ) {  ?>                           
                        <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
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
    <div class="entry-media">
        <?php the_post_thumbnail(); ?>
    </div>
    <?php } ?>
    <div class="inner-post">
        <header class="post-header">

            <?php if( sandbox_get_option( 'ptitle_post' ) ) the_title( '<h3 class="entry-title">', '</h3>' ); ?>

        </header><!-- .entry-header -->

        <div class="entry-summary">

            <?php

                the_content(sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'sandbox'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ));

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'sandbox'),
                    'after' => '</div>',
                ));
            ?>

        </div><!-- .entry-content -->
        <div class="entry-footer dflex">
            <?php sandbox_entry_footer(); ?>
        </div>

        <?php if( sandbox_get_option('author_box') ) sandbox_author_info_box(); ?>
        <?php if( sandbox_get_option('related_post') ) sandbox_related_posts(); ?>
    
