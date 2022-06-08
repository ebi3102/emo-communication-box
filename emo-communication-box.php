<?php
 
/**
 * @package ECB
 * Plugin Name: Emo Commiunication Box 
 * Plugin URI: 
 * Description: Emo communication box is a plugin for communicate between site manager and site viewers
 * Version: 1.0.0
 * Author: Ebrahim Moeini 
 * Author URI: https://padiab.com/ebrahimmoeini/
 * License: Gplv2 or later
 * Text Domain: emo_ecb
 * Domain Path: /languages
 * 
 * Emo Commiunication Box  is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * Emo Commiunication Box  is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
**/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $ecb_plugin_url;
global $ecb_plugin_directory;
$ecb_plugin_url = plugin_dir_url( __FILE__ );
$ecb_plugin_directory = __DIR__ ;

require __DIR__ . '/includes/Class_icon_representation.php';

if( get_option('activate-ecb-plugin') && (get_option('activate-ecb-whatsapp') || get_option('activate-ecb-phone') || get_option('activate-ecb-custom'))){
    add_action( 'wp_footer', 'ecb_chat' );
}

function ecb_chat(){
    global $ecb_plugin_url;
    $chat_icon = new Class_icon_representation;
    //$args array(array1(url => , icon_url => , tooltip =>), array2... )
    $args = array();
    if(get_option('activate-ecb-whatsapp')){
        $arg = array(
            'url' => "https://wa.me/". esc_attr( get_option('wats-number') ),
            'icon_url' => $ecb_plugin_url . 'assets/images/whats.png',
            'tooltip' => __( 'Whatsapp', 'emo_ecb' )
        );
        array_push($args, $arg);
    }

    if(get_option('activate-ecb-phone')){
        $arg = array(
            'url' => "tel:". esc_attr( get_option('phone-number') ),
            'icon_url' => $ecb_plugin_url . 'assets/images/phone.png',
            'tooltip' => __( 'Call', 'emo_ecb' )
        );
        array_push($args, $arg);
    }

    if(get_option('activate-ecb-custom')){
        $arg = array(
            'url' => esc_attr( get_option('custom_link') )  ,
            'icon_url' => esc_attr( get_option('custom_icon') ),
            'tooltip' => esc_attr( get_option('custom_tooltip') )
        );
        array_push($args, $arg);
    }

    $chat_icon->render_icon_template($args);

}


function ecb_scripts() {
    wp_enqueue_style( 'emo_ecb-css', plugin_dir_url( __FILE__ ) . 'assets/css/style.css' );
    wp_enqueue_script( 'emo_ecb-js',plugin_dir_url( __FILE__ ) . 'assets/js/main-script.js', array(), '1.0', true );
}

add_action( 'wp_enqueue_scripts', 'ecb_scripts');

function ecb_admin_scripts($hook){
    if( 'toplevel_page_emo_ecb_slug' != $hook ){ return; }
    wp_enqueue_media();
    wp_enqueue_script( 'emo_ecb-admin-js',plugin_dir_url( __FILE__ ) . 'assets/js/scripts.admin.js', array('jquery'), '1.0', true );
}
add_action( 'admin_enqueue_scripts', 'ecb_admin_scripts' );

require __DIR__ . '/includes/function-admin.php';

/**
 * Load the plugin text domain for translation.
 */
add_action( 'init', 'wpdocs_load_textdomain' );
 
function wpdocs_load_textdomain() {
    load_plugin_textdomain( 'emo_ecb', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}