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

    function pl1eg_display_elcomplement_page() {
        echo 'el Complement!';
    }

    
}

function pl1eg_count_words() {
    // Obtener el contenido de la página actual
    $content = get_the_content();

    // Contar el número de palabras
    $word_count = str_word_count(strip_tags($content));

    // Mostrar el número de palabras
    echo 'Número de palabras: ' . $word_count;
}
add_shortcode('wordcount', 'pl1eg_count_words');

function pl1eg_count_words_in_title($title) {
    // Obtener el contenido de la página actual
    $content = get_the_content();

    // Contar el número de palabras
    $word_count = str_word_count(strip_tags($content));

    // Agregar el número de palabras al título
    $title .= ' (Número de palabras: ' . $word_count . ')';

    return $title;
}
add_filter('the_title', 'pl1eg_count_words_in_title');

