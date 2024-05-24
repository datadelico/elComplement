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
// Si el archivo es llamado directamente, die.
if ( ! defined( 'WPINC' ) ) {
	die;
}
// Incluir el archivo con las funciones del plugin
include(plugin_dir_path(__FILE__) . 'includes/pl1eg_functions.php');
/*
// Función para activar el plugin
function pl1eg_activate() {
    // Activar las modificaciones en el frontend y backend
    pl1eg_frontend_modifications();
}
*/
add_action('admin_menu', 'pl1eg_elcomplement_admin_menu');

/*
// Función para desactivar el plugin
function pl1eg_deactivate() {
    // Desactivar las modificaciones en el frontend y backend
    pl1eg_remove_frontend_modifications();
    
}

// Función de desinstalación para limpiar la base de datos
function pl1eg_uninstall() {
    // Limpiar
    
}

// Registrar la función de desinstalación
//register_uninstall_hook(__FILE__, 'pl1eg_uninstall');
*/
