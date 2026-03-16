<?php

add_action('pre_get_posts', 'modify_home_query');

// Desactivar el editor Gutenberg
add_filter('use_block_editor_for_post', '__return_false', 10);

// Agregar página ACF Options
add_action('acf/init', function() {
  if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Configuración',
        'menu_title'    => 'Configuración',
        'menu_slug'   => 'general-settings',
    ));
  }
});

function modify_home_query($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_home()) {
        $query->set('posts_per_page', 8);
        $query->set('meta_key', 'fecha_de_publicacion');
        $query->set('orderby', 'meta_value');
        $query->set('order', 'DESC');
    }
}