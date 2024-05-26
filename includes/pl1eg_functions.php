<?php

if (!defined('ABSPATH')) {
    exit; // Evita l'accés directe al fitxer
}

// Funció per encolar scripts i estils per al frontend
function pl1eg_enqueue_scripts() {
    wp_enqueue_style('pl1eg-styles', plugin_dir_url(__FILE__) . '../public/css/pl1eg-styles.css'); // Encolar el CSS del frontend
    wp_enqueue_script('pl1eg-scripts', plugin_dir_url(__FILE__) . '../public/js/pl1eg-scripts.js', array('jquery'), null, true); // Encolar el JS del frontend
}

// Funció per encolar scripts i estils per a l'administració
function pl1eg_admin_enqueue_scripts() {
    wp_enqueue_style('pl1eg-admin-styles', plugin_dir_url(__FILE__) . '../admin/css/pl1eg-admin-styles.css'); // Encolar el CSS de l'admin
    wp_enqueue_script('pl1eg-admin-scripts', plugin_dir_url(__FILE__) . '../admin/js/pl1eg-admin-scripts.js', array('jquery'), null, true); // Encolar el JS de l'admin
}

// Funció per afegir un element al menú d'administració
function pl1eg_add_admin_menu() {
    $icon_url = plugin_dir_url(__FILE__) . 'images/ghost.svg';  // Ruta de la imatge d'icona
    add_menu_page('Configuració del Plugin', 'Configuració del Plugin', 'manage_options', 'pl1eg_settings', 'pl1eg_settings_page', $icon_url, 99); // Afegeix la pàgina de configuració amb la nova icona
}

// Funció per mostrar la pàgina de configuració
function pl1eg_settings_page() {
    ?>
    <div class="wrap">
        <h1>Configuració del Plugin</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('pl1eg_settings_group'); // Genera els camps de seguretat necessaris
            do_settings_sections('pl1eg_settings'); // Mostra totes les seccions i camps
            submit_button(); // Mostra el botó de guardar
            ?>
        </form>
    </div>
    <?php
}

// Funció per registrar les opcions del plugin
function pl1eg_register_settings() {
    register_setting('pl1eg_settings_group', 'pl1eg_word_count'); // Registra l'opció de comptar paraules
    register_setting('pl1eg_settings_group', 'pl1eg_new_days'); // Registra l'opció de dies per NEW

    add_settings_section('pl1eg_settings_section', 'Configuració', 'pl1eg_settings_section_callback', 'pl1eg_settings'); // Afegeix una secció de configuració

    add_settings_field('pl1eg_word_count', 'Comptar paraules', 'pl1eg_word_count_callback', 'pl1eg_settings', 'pl1eg_settings_section'); // Afegeix el camp de comptar paraules
    add_settings_field('pl1eg_new_days', 'Nombre de dies per afegir NEW als nous posts ', 'pl1eg_new_days_callback', 'pl1eg_settings', 'pl1eg_settings_section'); // Afegeix el camp de nombre de dies per NEW
}

add_action('admin_init', 'pl1eg_register_settings'); // Registra les opcions a l'inicialitzar l'admin

// Funció de callback per a la secció de configuració
function pl1eg_settings_section_callback() {
    echo 'Configura les opcions a continuació:'; // Text introductori de la secció
}

// Funció de callback per al camp de comptar paraules
function pl1eg_word_count_callback() {
    $setting = get_option('pl1eg_word_count'); // Obté el valor de l'opció
    echo "<input type='checkbox' name='pl1eg_word_count' value='1' " . checked(1, $setting, false) . " />"; // Mostra el checkbox
}

// Funció de callback per al camp de nombre de dies per NEW
function pl1eg_new_days_callback() {
    $setting = get_option('pl1eg_new_days', 7); // Obté el valor de l'opció, per defecte 7 dies
    echo "<input type='number' name='pl1eg_new_days' value='$setting' />"; // Mostra el camp numèric
}

// Funció per afegir un enllaç de configuració a la pàgina de plugins
function pl1eg_settings_link($links) {
    $settings_link = '<a href="admin.php?page=pl1eg_settings">Configuració</a>'; // Text de l'enllaç
    array_unshift($links, $settings_link); // Afegeix l'enllaç al principi de la llista
    return $links;
}

// Funció d'activació del plugin
function pl1eg_activate_plugin() {
    add_option('pl1eg_word_count', 1); // Afegeix l'opció de comptar paraules amb valor per defecte 1
    add_option('pl1eg_new_days', 7); // Afegeix l'opció de nombre de dies per NEW amb valor per defecte 7
    error_log('pl1eg plugin activated'); // Registra un missatge al log d'errors
}

// Funció de desactivació del plugin
function pl1eg_deactivate_plugin() {
    error_log('pl1eg plugin deactivated'); // Registra un missatge al log d'errors
}

// Funció de desinstal·lació del plugin
function pl1eg_uninstall_plugin() {
    delete_option('pl1eg_word_count'); // Elimina l'opció de comptar paraules
    delete_option('pl1eg_new_days'); // Elimina l'opció de nombre de dies per NEW
    error_log('pl1eg plugin uninstalled'); // Registra un missatge al log d'errors
}

// Modifica el contingut dels posts
function pl1eg_modify_post_content($content) {
    if (get_option('pl1eg_word_count') && is_single()) { // Comprova si l'opció de comptar paraules està activada i si és una entrada única
        $word_count = str_word_count(strip_tags($content)); // Compta les paraules del contingut
        $content .= '<p>Entrada amb ' . $word_count . ' paraules</p>'; // Afegeix el text amb el recompte de paraules
    }
    return $content;
}

// Modifica el títol dels posts
function pl1eg_modify_post_title($title, $id) {
    if (is_single()) { // Comprova si és una entrada única
        $new_days = get_option('pl1eg_new_days', 7); // Obté el valor de l'opció de nombre de dies per NEW, per defecte 7
        $post_date = get_the_date('Y-m-d', $id); // Obté la data de publicació del post
        $days_diff = (strtotime(date('Y-m-d')) - strtotime($post_date)) / (60 * 60 * 24); // Calcula la diferència en dies
        if ($days_diff <= $new_days) { // Comprova si la diferència és menor o igual al nombre de dies especificat
            $title = '<span style="color:red;">NEW</span> ' . $title; // Afegeix "NEW" en vermell davant del títol
        }
    }
    return $title;
}

// Afegeix un shortcode
function pl1eg_custom_shortcode() {
    return '<p>Aquest és el contingut del shortcode personalitzat.</p>'; // Retorna el contingut del shortcode
}

?>