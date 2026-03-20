<?php
add_action('pre_get_posts', 'modify_home_query'); // Modificar la query de homepage. Evita que se rompa el paginador
add_action('acf/init', 'add_new_options_page'); // Agregar página ACF Options
add_action('wp_dashboard_setup', 'wpse_73561_keep_only_monsterinsights_widget', 999); // Quitar los widgets del Dashboard
add_action('init', 'change_post_object_labels'); // Renombrar "posts"
add_action('admin_menu', 'rename_posts_to_articles'); // Renombrar "posts"
add_action('load-index.php', 'disable_welcome_panel');
add_action('admin_bar_menu', 'remove_admin_bar_items', 999);
add_action('login_enqueue_scripts', 'custom_login_styles_inline'); // Agregar CSS al login

add_filter('use_block_editor_for_post', '__return_false', 10); // Desactivar el editor Gutenberg
add_filter( 'get_user_option_screen_layout_dashboard', 'wpse_4552_one_column_layout' ); // Una sola columna en Dashboard

function remove_admin_bar_items($wp_admin_bar) {
    $wp_admin_bar->remove_node('wp-logo');      // WordPress logo
    $wp_admin_bar->remove_node('about');        // About WordPress
    $wp_admin_bar->remove_node('comments');     // Comments
    $wp_admin_bar->remove_node('new-content');  // + New
    $wp_admin_bar->remove_node('updates');      // Updates
    $wp_admin_bar->remove_node('view-site');    // View site
    $wp_admin_bar->remove_node('monsterinsights_frontend_button'); 
}

function disable_welcome_panel() {
    remove_action('welcome_panel', 'wp_welcome_panel');
}

function rename_posts_to_articles() {
    global $menu;
    global $submenu;

    $menu[5][0] = 'Cómics';
    $submenu['edit.php'][5][0] = 'Cómics';
    $submenu['edit.php'][10][0] = 'Agregar Cómic';
    $submenu['edit.php'][16][0] = 'Tags';
}

function change_post_object_labels() {
    global $wp_post_types;

    $labels = &$wp_post_types['post']->labels;

    $labels->name = 'Cómics';
    $labels->singular_name = 'Cómic';
    $labels->add_new = 'Agregar Cómic';
    $labels->add_new_item = 'Agregar Cómic';
    $labels->edit_item = 'Editar Cómic';
    $labels->new_item = 'Cómic';
    $labels->view_item = 'Ver Cómic';
    $labels->search_items = 'Buscar Cómics';
    $labels->not_found = 'Cómic no encontrado';
    $labels->not_found_in_trash = 'Cómic no encontrado';
    $labels->all_items = 'Todos los Cómics';
    $labels->menu_name = 'Cómics';
    $labels->name_admin_bar = 'Cómic';
}

function wpse_73561_keep_only_monsterinsights_widget() {
    global $wp_meta_boxes;

    if (!isset($wp_meta_boxes['dashboard'])) {
        return;
    }

    foreach ($wp_meta_boxes['dashboard'] as $context => $priorities) {
        foreach ($priorities as $priority => $widgets) {
            foreach ($widgets as $widget_id => $widget) {
                if ($widget_id !== 'monsterinsights_reports_widget') {
                    unset($wp_meta_boxes['dashboard'][$context][$priority][$widget_id]);
                }
            }
        }
    }
}

function wpse_4552_one_column_layout( $cols ) {
    if( current_user_can( 'basic_contributor' ) )
        return 1;
    return $cols;
}

function add_new_options_page() {
  if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Configuración',
        'menu_title'    => 'Configuración',
        'menu_slug'   => 'general-settings',
    ));
  }
}

function modify_home_query($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_home()) {
        $query->set('posts_per_page', 8);
        $query->set('meta_key', 'fecha_de_publicacion');
        $query->set('orderby', 'meta_value');
        $query->set('order', 'DESC');
    }
}

function custom_login_styles_inline() {
    $bg = get_field('image_de_portada', 'option');

    if ($bg) {
        echo "<style>
            body.login {
                position: relative;
                z-index: 0;
            }
            body.login::before {
                content: '';
                position: fixed;
                inset: 0;
                background:url('{$bg}');
                background-size: cover;
                filter: grayscale(100%);
                z-index: -1;
            }
            #login {
                background-color: rgba(255,255,255,0.9);
                padding: 40px !important;
                margin: 40px auto 0 !important;
            }
            .wp-login-logo {
                display: none;
            }
        </style>";
    }
}