<?php
// Assegura que el fitxer és cridat des de WordPress
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

// Elimina les opcions del plugin de la base de dades
delete_option('pl1eg_word_count');
delete_option('pl1eg_new_days');
