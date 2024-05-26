<?php
/*
 * @wordpress-plugin
 * Plugin Name:       elComplement
 * Plugin URI:        https://datadelico.com
 * Description:       Aixó es una practica de com fer un plugin de Wordpress per M9 
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Esteban Garcia Ruiz
 * Author URI:        https://datadelico.com
 * Text Domain:       plugin-elComplement
 * License:           GPL v2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 *
*/

// Evita l'accés directe al fitxer
if (!defined('ABSPATH')) {
    exit;
}

// Inclou el fitxer de funcions
include(plugin_dir_path(__FILE__) . 'includes/pl1eg_functions.php');

// Hooks d'activació, desactivació i desinstal·lació
register_activation_hook(__FILE__, 'pl1eg_activate_plugin');
register_deactivation_hook(__FILE__, 'pl1eg_deactivate_plugin');
register_uninstall_hook(__FILE__, 'pl1eg_uninstall_plugin');

// Accions per encolar scripts i estils
add_action('wp_enqueue_scripts', 'pl1eg_enqueue_scripts');
add_action('admin_enqueue_scripts', 'pl1eg_admin_enqueue_scripts');

// Afegeix un element al menú d'administració
add_action('admin_menu', 'pl1eg_add_admin_menu');

// Afegeix un enllaç de configuració a la pàgina de plugins
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'pl1eg_settings_link');

// Accions i filtres personalitzats per al frontend
add_filter('the_content', 'pl1eg_modify_post_content');
add_filter('the_title', 'pl1eg_modify_post_title', 10, 2);

?>
