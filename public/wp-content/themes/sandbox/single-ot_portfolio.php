<?php
/**
 * The template for displaying all portfolios
 *
 * This is the template that displays all portfolio by default.
 * Please note that this is the WordPress construct of portfolios
 * and that other 'portfolios' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sandbox
 */

get_header();
?>

<?php
    while ( have_posts() ) : the_post();
        the_content();                            
    endwhile; // End of the loop.
?>

<?php if( sandbox_get_option('pf_nav') || sandbox_get_option('pf_social_share_switch') ) { ?>
<div class="wrapper-border"></div>
<div class="portfolio-bottom">
    <div class="container">    
        <div class="row">
            <div class="col-md-8 text-center text-md-start"> 
                <?php if( sandbox_get_option('pf_nav') ) { ?>
                <div class="single-portfolio-navigation">
                    <?php sandbox_single_post_nav(); ?>
                </div>
                 <?php } ?>
            </div>

            <?php if( sandbox_get_option('pf_social_share_switch') ) { ?>
            <div class="col-md-4 text-center text-md-end">
                <?php sandbox_entry_footer(); ?>
            </div>  
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>

<?php
get_footer();