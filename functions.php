<?php
/**
 * Theme functions and definitions
 *
 * @subpackage the-run-up
 * @since 1.0.0
 */

/**
 * tru_scripts_styles function.
 *
 * @access public
 * @return void
 */
function tru_scripts_styles() {
    global $wp_scripts;

    $theme = wp_get_theme();

    // enqueue our scripts for theme
    wp_enqueue_script( 'jquery' );

    if ( is_singular() ) {
        wp_enqueue_script( 'comment-reply' );
    }

    /**
     * Load our IE specific scripts for a range of older versions:
     * <!--[if lt IE 9]> ... <![endif]-->
     * <!--[if lte IE 8]> ... <![endif]-->
    */
    // HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries //
    wp_enqueue_script( 'html5shiv', get_stylesheet_directory_uri() . '/inc/js/html5shiv.js', array(), '3.7.3-pre' );
    wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

    wp_enqueue_script( 'respond', get_stylesheet_directory_uri() . '/inc/js/respond.js', array(), '1.4.2' );
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

    // enqueue stylesheets
    wp_enqueue_style( 'google-fonts-arvo', 'https://fonts.googleapis.com/css?family=Arvo:400,700,400italic' );
    wp_enqueue_style( 'bootstrap-grid-style', get_stylesheet_directory_uri() . '/inc/css/bootstrap-grid.min.css', array(), '5.4.1' );
    wp_enqueue_style( 'fontawesome-style', get_stylesheet_directory_uri() . '/inc/css/fa.min.css', array(), '5.10.1' );
    wp_enqueue_style( 'tru-theme-style', get_stylesheet_uri(), array(), $theme->Version );
}
add_action( 'wp_enqueue_scripts', 'tru_scripts_styles' );

/**
 * tru_theme_posted_on function.
 *
 * @access public
 * @return void
 */
function tru_theme_posted_on() {
    if ( is_sticky() && is_home() && ! is_paged() ) {
        echo '<span class="featured-post"><span class="glyphicon glyphicon-pushpin"></span>' . __( 'Sticky', 'koksijde' ) . '</span>';
    }

    // Set up and print post meta information. -- hide date if sticky
    if ( ! is_sticky() ) :
        echo '<span class="entry-date"><span class="glyphicon glyphicon-time"></span><time class="entry-date" datetime="' . get_the_date( 'c' ) . '">' . get_the_date() . '</time></span>';
    endif;
}

/**
 * tru_excerpt_by_id function.
 *
 * @access public
 * @param mixed  $post object or id.
 * @param int    $length (default: 25).
 * @param string $tags (default: '<a><em><strong>').
 * @param string $extra (default: '...').
 * @return html
 */
function tru_excerpt_by_id( $post, $length = 25, $tags = '<a><em><strong>', $extra = '...' ) {
    if ( is_int( $post ) ) {
        $post = get_post( $post ); // get the post object of the passed ID.
    } elseif ( ! is_object( $post ) ) {
        return false;
    }

    if ( has_excerpt( $post ) && ! empty( trim( $post->post_excerpt ) ) ) {
        $the_excerpt = $post->post_excerpt;
        return apply_filters( 'the_content', $the_excerpt );
    } else {
        $the_excerpt = $post->post_content;
    }

    $the_excerpt = strip_shortcodes( strip_tags( $the_excerpt ), $tags );
    $the_excerpt = preg_split( '/\b/', $the_excerpt, $length * 2 + 1 );
    $excerpt_waste = array_pop( $the_excerpt );
    $the_excerpt = implode( $the_excerpt );
    $the_excerpt .= $extra;

    // remove jetpack sharing.
    remove_filter( 'the_content', 'sharing_display', 19 );

    return apply_filters( 'the_content', $the_excerpt );
}

/**
 * Display excerpt by id.
 *
 * @access public
 * @param mixed  $post object or id.
 * @param int    $length (default: 25).
 * @param string $tags (default: '<a><em><strong>').
 * @param string $extra (default: '...').
 * @return void
 */
function tru_show_excerpt_by_id( $post, $length = 25, $tags = '<a><em><strong>', $extra = '...' ) {
    echo tru_excerpt_by_id( $post, $length, $tags, $extra );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since the-run-up 1.0.0
 */
function tru_theme_setup() {
    // Set the content width based on the theme's design and stylesheet //
    $GLOBALS['content_width'] = apply_filters( 'tru_content_width', 1200 );

    /**
     * add our theme support options
     */
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'menus' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );

    /**
     * add our image size(s)
     */
    add_image_size( 'single', 1400, 480, true );
    add_image_size( 'blog-landing', 1200, 400, true );
    add_image_size( 'blog-power-ranking', 280, 160, true );
    add_image_size( 'blog-single', 550, 240, true );

    /**
     * This theme styles the visual editor to resemble the theme style
     */
    add_editor_style( 'inc/css/editor-style.css' );

    /**
     * Include files
     */
    include_once( get_stylesheet_directory() . '/inc/custom-login.php' );
}
add_action( 'after_setup_theme', 'tru_theme_setup' );

/**
 * Register widget area.
 *
 * @since the-run-up 1.0.0
 */
function tru_theme_widgets_init() {

    register_sidebar(
        array(
            'name' => 'Footer 1',
            'id' => 'footer-1',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        )
    );
    
    register_sidebar(
        array(
            'name' => 'Footer 2',
            'id' => 'footer-2',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        )
    );    

}
add_action( 'widgets_init', 'tru_theme_widgets_init' );

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 *
 * @since the-run-up 1.0
 * @based on twentyfourteen
 *
 * @return image
 */
function tru_post_thumbnail( $size = 'full' ) {
    global $post;

    $html = null;
    $attr = array(
        'class' => 'img-responsive',
    );

    if ( post_password_required() || ! has_post_thumbnail() ) {
        return;
    }

    if ( is_singular() ) :
        $html .= '<div class="post-thumbnail">';
            $html .= get_the_post_thumbnail( $post->ID, $size, $attr );
        $html .= '</div>';
    else :
        $html .= '<a class="post-thumbnail" href="' . esc_url( get_permalink( $post->ID ) ) . '">';
            $html .= get_the_post_thumbnail( $post->ID, $size, $attr );
        $html .= '</a>';
    endif;

    $image = apply_filters( 'tru_post_thumbnail', $html, $size, $attr );

    echo $image;
}

/**
 * Print HTML with meta information for the current post-date/time and author.
 *
 * @since the-run-up 1.0
 * @based on twentyfourteen
 *
 * @return html
 */
function tru_posted_on() {
    $html = null;

    if ( is_sticky() && is_home() && ! is_paged() ) :
        $html = '<span class="featured-post"><span class="glyphicon glyphicon-pushpin"></span>' . __( 'Sticky', 'koksijde' ) . '</span>';
    elseif ( ! is_sticky() ) :     // Set up and print post meta information. -- hide date if sticky
        $html = '<span class="entry-date"><span class="glyphicon glyphicon-time"></span><a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><time class="entry-date" datetime="' . get_the_date( 'c' ) . '">' . get_the_date() . '</time></a></span>';
    else :
        $html = '<span class="byline"><span class="glyphicon glyphicon-user"></span><span class="author vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" rel="author">' . get_the_author() . '</a></span></span>';
    endif;

    echo apply_filters( 'tru_posted_on', $html );
}

/**
 * tru_display_meta_description function.
 *
 * a custom function to display a meta description for our site pages
 *
 * @access public
 * @return void
 */
function tru_display_meta_description() {
    global $post;

    $title = null;

    if ( isset( $post->post_title ) ) {
        $title = $post->post_title;
    }

    if ( is_single() ) :
        return apply_filters( 'tru_display_meta_description', single_post_title( '', false ) );
    else :
        return apply_filters( 'tru_display_meta_description', $title . ' - ' . get_bloginfo( 'name' ) . ' - ' . get_bloginfo( 'description' ) );
    endif;

    return false;
}

/**
 * tru_back_to_top function.
 *
 * @access public
 * @return void
 */
function tru_back_to_top() {
    $html = null;

    $html .= '<a href="#0" class="tru-back-to-top"></a>';

    echo apply_filters( 'tru_back_to_top', $html );
}
add_action( 'wp_footer', 'tru_back_to_top' );

/**
 * tru_wp_parse_args function.
 *
 * Similar to wp_parse_args() just a bit extended to work with multidimensional arrays
 *
 * @access public
 * @param mixed &$a
 * @param mixed $b
 * @return void
 */
function tru_wp_parse_args( &$a, $b ) {
    $a = (array) $a;
    $b = (array) $b;
    $result = $b;

    foreach ( $a as $k => &$v ) {
        if ( is_array( $v ) && isset( $result[ $k ] ) ) {
            $result[ $k ] = tru_wp_parse_args( $v, $result[ $k ] );
        } else {
            $result[ $k ] = $v;
        }
    }

    return $result;
}

/**
 * Move JP sharing to before and after post.
 *
 * @access public
 * @param mixed $content string.
 * @return html
 */
function tru_move_jp_sharing( $content ) {

    if ( is_singular( 'post' ) && function_exists( 'sharing_display' ) ) {
        remove_filter( 'the_content', 'sharing_display', 19 );

        $content = sharing_display() . $content . sharing_display();
    }

    return $content;
}
add_filter( 'the_content', 'tru_move_jp_sharing' );

/**
 * Remove JP sharing from excerpt.
 *
 * @access public
 * @return void
 */
function tru_remove_excerpt_jp_sharing() {
    remove_filter( 'the_excerpt', 'sharing_display', 19 );
}

add_action( 'loop_start', 'tru_remove_excerpt_jp_sharing' );

/**
 * Post categories.
 *
 * @access public
 * @param string $spacer (default: ' ').
 * @param string $excl (default: '').
 * @return void
 */
function tru_post_categories( $spacer = ' ', $excl = '' ) {
    global $post;

    $categories = get_the_category( $post->ID );

    if ( ! empty( $categories ) ) :
        $exclude = $excl;
        $exclude = explode( ',', $exclude );
        $thecount = count( get_the_category() ) - count( $exclude );

        foreach ( $categories as $cat ) :
            $html = '';

            if ( ! in_array( $cat->cat_ID, $exclude ) ) {
                $html .= '<a href="' . get_category_link( $cat->cat_ID ) . '" ';
                $html .= 'title="' . $cat->cat_name . '">' . $cat->cat_name . '</a>';

                if ( $thecount > 0 ) {
                    $html .= $spacer;
                }

                $thecount--;

                echo $html;
            }
        endforeach;
    endif;
}

/**
 * Has categories.
 *
 * @access public
 * @param string $excl (default: '').
 * @return voi
 */
function tru_has_categories( $excl = '' ) {
    global $post;

    $categories = get_the_category( $post->ID );

    if ( ! empty( $categories ) ) :
        $exclude = $excl;
        $exclude = explode( ',', $exclude );

        foreach ( $categories as $key => $cat ) :
            if ( in_array( $cat->cat_ID, $exclude ) ) :
                unset( $categories[ $key ] );
            endif;
        endforeach;

        if ( count( $categories ) >= 1 ) :
            return true;
        endif;
    endif;

    return false;
}

/**
 * Move comment field to bottom.
 *
 * @access public
 * @param mixed $fields array.
 * @return array
 */
function tru_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;

    return $fields;
}

add_filter( 'comment_form_fields', 'tru_move_comment_field_to_bottom' );
