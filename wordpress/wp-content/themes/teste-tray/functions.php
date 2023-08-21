<?php 

function testeTray_adicionando_recursos_ao_tema(){
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'testeTray_adicionando_recursos_ao_tema');

function testeTray_carregando_recursos(){
    wp_enqueue_style('fonts-site', '//fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap', array(), null);

    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), filemtime(get_stylesheet_directory() . '/assets/js/bootstrap.min.js'), null, true);
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/bootstrap.min.css'));
    
    wp_enqueue_style('components-css', get_template_directory_uri() . '/assets/css/components.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/components.css'));
    wp_enqueue_script('components-js', get_bloginfo('template_directory') . '/assets/js/components.min.js', array('jquery'), filemtime(get_stylesheet_directory() . '/assets/js/components.min.js'), true);

    wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/js/lib/swiper.min.js', array('jquery'), '', true);

    if ( is_home() || is_front_page() ) {
        wp_enqueue_style('home-style', get_template_directory_uri() . '/assets/css/home.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/home.css'));
        wp_enqueue_script('home-js', get_template_directory_uri() . '/assets/js/home.min.js', array(), filemtime(get_stylesheet_directory() . '/assets/js/home.min.js'), true);
    } else {
        wp_enqueue_style('interna-style', get_template_directory_uri() . '/assets/css/interna.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/interna.css'));
        wp_enqueue_script('interna-js', get_template_directory_uri() . '/assets/js/interna.min.js', array(), filemtime(get_stylesheet_directory() . '/assets/js/interna.min.js'), true);
    }
}
add_action('wp_enqueue_scripts', 'testeTray_carregando_recursos');

function testeTray_registrando_menu(){
    register_nav_menu(
        'menu-navegacao',
        'Menu Navegação'
    );
}

add_action('init', 'testeTray_registrando_menu');
