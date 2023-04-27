<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));
}

/* HOOK FILTERS */
// Fonction pour ajouter le bouton d'administration
function ajouter_bouton_admin( $items, $args ) {
 
    if ( is_user_logged_in() && $args->theme_location == ('main_menu'|| 'mobile_menu')) { // Vérifie si l'utilisateur est connecté et si le menu est celui que vous voulez modifier
        $pos = strpos( $items, '</a>' ); // Trouve la fin du premier élément de menu
        $bouton_admin = '<li><a href="' . admin_url() . '">Admin</a></li>'; // Bouton d'administration à ajouter
        $items = substr_replace( $items, $bouton_admin, $pos + 4, 0 ); // Ajoute le bouton d'administration après le premier élément de menu
    }
    return $items;
}

// Hook pour ajouter la fonction à wp_nav_menu_items
add_filter( 'wp_nav_menu_items', 'ajouter_bouton_admin', 10, 2 );



