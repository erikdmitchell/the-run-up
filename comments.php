<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @subpackage the-run-up
 * @since the-run-up 1.0.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>

    <h2 class="comments-title">
        <?php
            printf(
                _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'the-run-up' ),
                number_format_i18n( get_comments_number() ),
                get_the_title()
            );
        ?>
    </h2>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
        <h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'the-run-up' ); ?></h1>
        <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'the-run-up' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'the-run-up' ) ); ?></div>
    </nav><!-- #comment-nav-above -->
    <?php endif; // Check for comment navigation. ?>

    <ul class="comment-list">
        <?php
            wp_list_comments(
                array(
                    'short_ping' => true,
                )
            );
        ?>
    </ul><!-- .comment-list -->

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
        <h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'the-run-up' ); ?></h1>
        <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'the-run-up' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'the-run-up' ) ); ?></div>
    </nav><!-- #comment-nav-below -->
    <?php endif; // Check for comment navigation. ?>

        <?php if ( ! comments_open() ) : ?>
        <p class="no-comments"><?php _e( 'Comments are closed.', 'the-run-up' ); ?></p>
    <?php endif; ?>

    <?php endif; // have_comments() ?>

    <?php comment_form( array( 'title_reply' => __( 'Join the conversation', 'the-run-up' ) ) ); ?>

</div><!-- #comments -->
