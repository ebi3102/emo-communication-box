<?php

/**
 * @package ECB
 * ========================
 * ADMIN PAGE
 * ========================
 * Text Domain: emo_ecb
 */


function emo_ecb_add_admin_page() {
	global $ecb_plugin_url;
	//Generate ECB Admin Page
	//__( 'Blog Options', 'robintalk' )
	add_menu_page( __( 'Communication box settings', 'emo_ecb' ), __( 'Communication', 'emo_ecb' ), 'manage_options', 'emo_ecb_slug', 'emo_ecb_create_page', $ecb_plugin_url . 'assets/images/logo-icon.png', 110 );
	
	//Generate Sunset Admin Sub Pages
	add_submenu_page('emo_ecb_slug', __( 'Communication box settings', 'emo_ecb' ), __( 'Settings', 'emo_ecb' ) , 'manage_options' , 'emo_ecb_slug' , 'emo_ecb_create_page');
	
	//Activate custome settings
	add_action('admin_init' , 'emo_ecb_custom_settings');
}
add_action( 'admin_menu', 'emo_ecb_add_admin_page' );

//Template submenu functions
function emo_ecb_create_page() {
	global $ecb_plugin_directory;;
	$url_template = 'templates/emo-ecb-admin.php';
	require_once $url_template;
}

function emo_ecb_custom_settings(){
	register_setting('emo_ecb_settings_group', 'activate-ecb-plugin');
	register_setting('emo_ecb_settings_group', 'activate-ecb-whatsapp');
	register_setting('emo_ecb_settings_group', 'activate-ecb-phone');

	register_setting('emo_ecb_settings_group', 'wats-number');
	register_setting('emo_ecb_settings_group', 'phone-number');
	add_settings_section('emo_ecb_activation_settings', __( 'Activation Settings', 'emo_ecb' ), 'emo_ecb_activation_settings_callback', 'emo_ecb_slug');
	add_settings_field('emo_ecb_activation', __( 'Activate communication icon ', 'emo_ecb' ), 'emo_ecb_activation_callback', 'emo_ecb_slug', 'emo_ecb_activation_settings');
	add_settings_field('emo_ecb_whatsapp_activation', __( 'Activate whatsapp icon ', 'emo_ecb' ), 'emo_ecb_whatsapp_activation_callback', 'emo_ecb_slug', 'emo_ecb_activation_settings');
	add_settings_field('emo_ecb_phone_activation', __( 'Activate phone icon ', 'emo_ecb' ), 'emo_ecb_phone_activation_callback', 'emo_ecb_slug', 'emo_ecb_activation_settings');

	add_settings_field('emo_ecb_whatsapp_number', __( 'Your Whatsapp Number', 'emo_ecb' ), 'emo_ecb_whatsapp_number', 'emo_ecb_slug', 'emo_ecb_activation_settings');
	add_settings_field('emo_ecb_phone_number', __( 'Your Phone Number', 'emo_ecb' ), 'emo_ecb_phone_number', 'emo_ecb_slug', 'emo_ecb_activation_settings');

	register_setting('emo_ecb_settings_group', 'style-ecb-location');
	add_settings_section('emo_ecb_location_settings', __( 'Place settings', 'emo_ecb' ), 'emo_ecb_location_settings_callback', 'emo_ecb_slug');
	add_settings_field('emo_ecb_location', __( 'Set the icon place', 'emo_ecb' ), 'emo_ecb_location_callback', 'emo_ecb_slug', 'emo_ecb_location_settings');

	register_setting('emo_ecb_settings_group', 'style-ecb-color');
	register_setting('emo_ecb_settings_group', 'style-ecb-shadow');

	add_settings_section('emo_ecb_style_settings', __( 'Style settings', 'emo_ecb' ), 'emo_ecb_style_settings_callback', 'emo_ecb_slug');
	add_settings_field('emo_ecb_color', __( 'Set background color', 'emo_ecb' ), 'emo_ecb_color_callback', 'emo_ecb_slug', 'emo_ecb_style_settings');
	// add_settings_field('emo_ecb_shadow', __( 'Show shadow', 'emo_ecb' ), 'emo_ecb_shadow_callback', 'emo_ecb_slug', 'emo_ecb_style_settings');
}

function emo_ecb_location_settings_callback() {
	//echo 'Customize your Sidebar Information';
}

function emo_ecb_style_settings_callback() {
	//echo 'Customize your Sidebar Information';
}

function emo_ecb_activation_settings_callback() {
	//echo 'Customize your Sidebar Information';
}

function emo_ecb_activation_callback(){
	$options = get_option('activate-ecb-plugin');
	echo '<lable for="style-ecb-activation"><input type= "checkbox" id="style-ecb-activation" name="activate-ecb-plugin" value="1"'.@checked($options , "1" , false).'></lable>';
}

function emo_ecb_whatsapp_activation_callback(){
	$options = get_option('activate-ecb-whatsapp');
	echo '<lable for="activate-ecb-whatsapp"><input type= "checkbox" id="activate-ecb-whatsapp" name="activate-ecb-whatsapp" value="1"'.@checked($options , "1" , false).'></lable>';
}

function emo_ecb_phone_activation_callback(){
	$options = get_option('activate-ecb-phone');
	echo '<lable for="activate-ecb-phone"><input type= "checkbox" id="activate-ecb-phone" name="activate-ecb-phone" value="1"'.@checked($options , "1" , false).'></lable>';
}


function emo_ecb_whatsapp_number() {
	$whatsapp_number = esc_attr( get_option('wats-number') );
	echo '<input type="text" name="wats-number" value="' . $whatsapp_number . '" placeholder="'.  __( 'Whatsapp number', 'emo_ecb' ) .'" style="width:300px" />
		<p class ="description" >'. __( 'Put your whatsapp number', 'emo_ecb' ) .'</p>';
}

function emo_ecb_phone_number() {
	$phone_number = esc_attr( get_option('phone-number') );
	echo '<input type="text" name="phone-number" value="' . $phone_number . '" placeholder="'.  __( 'Phone number', 'emo_ecb' ) .'" style="width:300px" />
		<p class ="description" >'. __( 'Put your phone number', 'emo_ecb' ) .'</p>';
}

function emo_ecb_location_callback(){
	$options = get_option('style-ecb-location');

	echo "<input type='radio' id='bottom_left' name='style-ecb-location' value='fab-left'" . @checked($options , "fab-left" , false) . ">";
  	echo "<label for='bottom_left'>". __( 'Bottom left', 'emo_ecb')."</label><br>";
	echo "<input type='radio' id='bottom_right' name='style-ecb-location' value='fab-right' " . @checked($options , "fab-right" , false) . " >";
  	echo "<label for='bottom_right'>". __( 'Bottom right', 'emo_ecb')."</label><br>";
}

function emo_ecb_color_callback(){
	$options = get_option('style-ecb-color');

	echo "<input type='radio' id='#06D755' name='style-ecb-color' value='fb-06D755'" . @checked($options , "fb-06D755" , false) . ">";
  	echo "<label for='#06D755'><div style='width:80px; height:30px; display: inline-flex; border-radius: 20px; background-color:#06D755'></div></label><br>";

	echo "<input type='radio' id='#009688' name='style-ecb-color' value='fb-009688'" . @checked($options , "fb-009688" , false) . ">";
  	echo "<label for='#009688'><div style='width:80px; height:30px; display: inline-flex; border-radius: 20px; background-color:#009688'></div></label><br>";

	echo "<input type='radio' id='#BDA263' name='style-ecb-color' value='fb-01366a'" . @checked($options , "fb-BDA263" , false) . ">";
  	echo "<label for='#BDA263'><div style='width:80px; height:30px; display: inline-flex; border-radius: 20px; background-color:#BDA263'></div></label><br>";

	echo "<input type='radio' id='#00448b' name='style-ecb-color' value='fb-00448b'" . @checked($options , "fb-00448b" , false) . ">";
  	echo "<label for='#00448b'><div style='width:80px; height:30px; display: inline-flex; border-radius: 20px; background-color:#00448b'></div></label><br>";

}

// function emo_ecb_shadow_callback(){
// 	$options = get_option('style-ecb-shadow');
// 	echo '<lable for="style-ecb-shadow"><input type= "checkbox" id="style-ecb-shadow" name="style-ecb-shadow" value="1"'.@checked($options , "1" , false).' '.$disabled.'></lable>';
// }
