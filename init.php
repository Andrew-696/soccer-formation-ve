<?php
/*
Plugin Name: Soccer Formation VE
Description: Create vertical soccer formations in your posts.
Version: 1.01
Author: DAEXT
Author URI: https://daext.com
Text Domain: soccer-formation-ve
*/

//Prevent direct access to this file
if ( ! defined( 'WPINC' ) ) { die(); }

//Class shared across public and admin
require_once( plugin_dir_path( __FILE__ ) . 'shared/class-daextsfve-shared.php' );

//Public
require_once( plugin_dir_path( __FILE__ ) . 'public/class-daextsfve-public.php' );
add_action( 'plugins_loaded', array( 'Daextsfve_Public', 'get_instance' ) );

//Admin
if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
    
    //Admin
    require_once( plugin_dir_path( __FILE__ ) . 'admin/class-daextsfve-admin.php' );
    add_action( 'plugins_loaded', array( 'Daextsfve_Admin', 'get_instance' ) );
    
    //Activate/Deactivate/Uninstall
    register_activation_hook( __FILE__, array( Daextsfve_Admin::get_instance(), 'ac_activate' ) );
    register_deactivation_hook( __FILE__, array( Daextsfve_Admin::get_instance(), 'de_deactivate' ) );
    
}
//Customize the action links in the "Plugins" menu
function daextsfve_customize_action_links( $actions ) {
    $actions[] = '<a href="https://daext.com/soccer-engine/">' . esc_html__('Buy Soccer Engine', 'soccer-formation-ve') . '</a>';
    return $actions;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'daextsfve_customize_action_links' );