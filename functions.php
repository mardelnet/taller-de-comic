<?php

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