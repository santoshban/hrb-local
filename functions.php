<?php

require __DIR__ . '/includes/admin/init.php';

function theme_enqueue_styles() {
    wp_register_style( 'swiper-css', 'https://unpkg.com/swiper/swiper-bundle.css' );
    wp_enqueue_style('swiper-css');

    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', [] );
	wp_enqueue_style( 'appcss', get_stylesheet_directory_uri() . '/assets/css/app.css');
	wp_enqueue_style( 'responsivecss', get_stylesheet_directory_uri() . '/assets/css/responsive.css');

}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 20 );

//Enqueuing scripts
function custom_scripts_enqueue() {
    wp_register_script( 'ScrollReveal', 'https://cdnjs.cloudflare.com/ajax/libs/scrollReveal.js/4.0.9/scrollreveal.min.js', '', '', true );
    wp_enqueue_script('ScrollReveal');

    if( is_front_page() ){
        wp_register_script( 'bodymovin', 'https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.13/lottie.min.js', null, null, true );
        wp_enqueue_script('bodymovin');
    }

    wp_register_script( 'swiperjs', 'https://unpkg.com/swiper/swiper-bundle.js', '', '', true );
    wp_enqueue_script('swiperjs');

    wp_register_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js', '', '', true );
    wp_enqueue_script('gsap');

	wp_enqueue_script( 'app-js', get_stylesheet_directory_uri() . '/assets/js/app.js', '', array( 'jquery' ), true);
}
add_action( 'wp_enqueue_scripts', 'custom_scripts_enqueue' );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );

// Add custom loader gravity form
add_filter( 'gform_ajax_spinner_url', 'spinner_url', 10, 2 );
function spinner_url( $image_src, $form ) {
    return "https://buildformdev.wpengine.com/wp-content/uploads/2021/09/loader.svg";
}


// Project Gallery - Slider
function fn_gallery() { 
 
    $html= '';
    $gItems = get_field('gallery_images');
    if( $gItems ):
        $html .= '<div class="swiper-container gallery__container">';
            $html .= '<div class="swiper-wrapper gallery__wrapper drag__cursor">';
                foreach( $gItems as $gItem ):
                    $html .= '<div class="swiper-slide gallery__slide" style="background-image: url('.$gItem['url'].')">';
                    $html .= '</div>';
                endforeach;
            $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="control__wrapper">';
            $html .= '<div class="swiper-button-next"></div>';
            $html .= '<div class="swiper-button-prev"></div>';
        $html .= '</div>';
    endif;
    return $html;
}

add_shortcode('project_gallery', 'fn_gallery');