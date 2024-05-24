<?php
// Función para activar el plugin
// Activar las modificaciones en el frontend y administracio
function pl1eg_frontend_modifications (){   
    pl1eg_elcomplement_admin_menu();
}
function pl1eg_elcomplement_admin_menu() {
    add_menu_page(
        'el Complement',// page title
        'el Complement',// menu title
        'manage_options',// capability
        'el-complement',// menu slug
        'pl1eg_display_elcomplement_page' // callback function
    );    
}
/*
function pl1eg_display_elcomplement_page() {
    
}

*/
function pl1eg_count_words_in_title($title, $id = null) {
    if (is_admin()) {
        // No aplicar el filtro en el panel de administración
        return $title;
    }

    $post = get_post($id);
    if ($post && !is_wp_error($post)) {
        $content = $post->post_content;
        $word_count = str_word_count(strip_tags($content));
        if ($word_count > 0) {
            return $title . ' (' . $word_count . ' paraules)';
        }
    }

    return $title;
}

add_filter('the_title', 'pl1eg_count_words_in_title', 10, 2);

