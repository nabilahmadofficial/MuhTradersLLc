<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sandbox
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area form-floating">

    <?php
    // You can start editing here -- including this comment!
    if ( have_comments() ) : ?>

        <h3 class="comments-title center-line"><?php comments_number( esc_html__('0 Comments', 'sandbox'), esc_html__('1 Comment', 'sandbox'), esc_html__(  '% Comments', 'sandbox') ); ?></h3>

        <ol class="comment-list">
            <?php wp_list_comments('callback=sandbox_comment_list'); ?>
        </ol><!-- .comment-list -->

        <?php
        the_comments_navigation();

        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() ) :
            ?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'sandbox' ); ?></p>
        <?php
        endif;

    endif; // Check for have_comments().

    // Custom comments_args here: https://codex.wordpress.org/Function_Reference/comment_form
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    $comments_args = array(
        'title_reply'   => esc_html__('Would you like to share your thoughts?', 'sandbox'),
        'comment_field' => '<p class="comment-form-comment form-floating"><textarea id="comment" class="form-control" name="comment" cols="35" rows="8" aria-required="true" placeholder="'. esc_attr__( 'Comment*', 'sandbox' ) .'" required></textarea><label>'. esc_html__( 'Comment *', 'sandbox' ) .'</label></p>',

        'fields'        => apply_filters( 'comment_form_default_fields', array(
            'author' =>
                '<p class="comment-form-author form-floating"><input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                '" size="30" placeholder="'. esc_attr__( 'Name*', 'sandbox' ) .'" required /><label for="c-name">'. esc_html__( 'Name *', 'sandbox' ) .'</label></p>',

            'email' =>
                '<p class="comment-form-email form-floating"><input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                '" size="30" placeholder="'. esc_attr__( 'Email*', 'sandbox' ) .'" required /><label for="c-name">'. esc_html__( 'Email *', 'sandbox' ) .'</label></p>',
        )),
        'class_submit' => 'octf-btn',
        'format'       => 'xhtml'
    );
    comment_form( $comments_args );
    ?>

</div><!-- #comments -->