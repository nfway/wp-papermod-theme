<?php

if ( ! function_exists( 'papermod_setup' ) ) :
    function papermod_setup() {
        load_theme_textdomain( 'papermod', get_template_directory() . '/languages' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        register_nav_menus(
            array(
                'primary-menu' => esc_html__( 'Primary Menu', 'papermod' ),
            )
        );
        add_theme_support(
            'html5',
            array(
                'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
            )
        );
    }
endif;
add_action( 'after_setup_theme', 'papermod_setup' );

function papermod_enqueue_styles_scripts() {
    wp_enqueue_style( 'papermod-theme-vars', get_template_directory_uri() . '/assets/css/core/theme-vars.css', array(), '1.0' );
    wp_enqueue_style( 'papermod-reset', get_template_directory_uri() . '/assets/css/core/reset.css', array(), '1.0' );
    
    $common_styles = array(
        '404', 'archive', 'footer', 'header', 'main', 
        'post-entry', 'post-single', 'profile-mode', 'search', 'terms', 'comments'
    );
    foreach ($common_styles as $style) {
        wp_enqueue_style( 'papermod-common-' . $style, get_template_directory_uri() . '/assets/css/common/' . $style . '.css', array('papermod-theme-vars'), '1.0' );
    }

    wp_enqueue_style( 'papermod-chroma-styles', get_template_directory_uri() . '/assets/css/includes/chroma-styles.css', array(), '1.0' );
    wp_enqueue_style( 'papermod-scroll-bar', get_template_directory_uri() . '/assets/css/includes/scroll-bar.css', array(), '1.0' );
    
    // Enqueue JS
    wp_enqueue_script( 'papermod-main-js', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'papermod_enqueue_styles_scripts' );


// Post Meta Data function
if ( ! function_exists( 'papermod_posted_on' ) ) :
function papermod_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    $time_string = sprintf( $time_string, esc_attr( get_the_date( DATE_W3C ) ), esc_html( get_the_date() ) );
    $posted_on = sprintf( esc_html_x( '%s', 'post date', 'papermod' ), $time_string );

    $content = get_post_field( 'post_content', get_the_ID() );
    $word_count = str_word_count( strip_tags( $content ) );
    $reading_time = ceil($word_count / 200);
    $reading_time_str = $reading_time . ' ' . ($reading_time == 1 ? esc_html__('min', 'papermod') : esc_html__('min', 'papermod'));

    echo '<span class="posted-on">' . $posted_on . '</span>';
    echo ' · ';
    echo '<span class="reading-time">' . esc_html($reading_time_str) . '</span>';
    
    $tags = get_the_tags();
    if ( $tags ) {
        echo ' · <span class="post-tags">';
        $tag_links = array();
        foreach ( $tags as $tag ) {
            $tag_links[] = '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a>';
        }
        echo implode( ', ', $tag_links );
        echo '</span>';
    }
}
endif;

// Breadcrumbs function
if ( ! function_exists( 'papermod_breadcrumbs' ) ) :
function papermod_breadcrumbs() {
    if ( is_front_page() || !is_singular('post') ) {
        return;
    }
    echo '<div class="breadcrumbs">';
    echo '<a href="' . esc_url( home_url() ) . '">' . esc_html__( 'Home', 'papermod' ) . '</a>';
    $categories = get_the_category();
    if ( ! empty( $categories ) ) {
        $category = $categories[0];
        echo ' » <a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>';
    }
    echo '</div>';
}
endif;
?>