<?php
    /*  
    *   Plugin Name: Gravapress
    *   Plugin URI: http://jsacode.com.br/gravapress
    *   Description: Provides widgets and shortcodes to allow you display your gravatar profile on your WordPress site
    *   Version: 0.2
    *   Author: Jonnhatan Athaide
    *   Author URI: http://jsacode.com.br/
    *   License: GPL2
    */

    /*
    * Global Variables
    */
    $plugin_url = WP_PLUGIN_URL . '/gravapress';
    $options    = array();
    $display_json = true;

    /*
    *   Link in the admin menu
    */
    function gravapress_menu(){        
        // https://codex.wordpress.org/Function_Reference/add_options_page
        // add_options_page( $page_title, $menu_title, $capability, $menu-slug, $function )
        
        add_options_page(
            'Gravatar WordPress Profile Integration',
            'Gravapress',
            'manage_options',
            'gravapress',
            'gravapress_options_page'
        );
    }
    add_action( 'admin_menu', 'gravapress_menu' );

    /*
    *   Configuration page
    */
    function gravapress_options_page(){
        // Test to see if the user can manage the plugin
        if ( !current_user_can( 'manage_options' ) ) {
            wp_die( 'Access denied to this page.' );
        }

    global $plugin_url;
    global $options;
    global $display_json;


    // GRAVAPRESS FORM SUBMIT
    if( isset($_POST['email_submitted'])){
        $hidden_field = esc_html( $_POST['email_submitted'] );

        if( $hidden_field == 'Y'){
            
            //GRAVATAR USER NAME
            $gravapress_email = esc_html( $_POST['gravatar_email'] );
            //GRAVATAR USER HASH EMAIL
            $gravapress_email_hash = gravapress_email_hash( $gravapress_email );
            //GRAVATAR JSON USER PROFILE
            $gravapress_profile = gravapress_get_profile( $gravapress_email_hash );

            $options['user_email']              = $gravapress_email;
            $options['last_update']             = time();
            $options['gravapress_email_hash']   = $gravapress_email_hash;
            $options['gravapress_profile']      = $gravapress_profile;

            //UPDATE OPTIONS TABLE
            update_option( 'gravapress', $options );
        }
    }

    //GET OPTIONS TABLE
    $options = get_option( 'gravapress' );

    if($options != ''){
        $gravapress_email   = $options['user_email'];
        $gravapress_profile = $options['gravapress_profile'];
    }

    require('inc/options-page.php');
}

    /*
    *   Hash the Gravatar user email
    */
    function gravapress_email_hash( $gravapress_email ){

        // Creating the Hash - https://br.gravatar.com/site/implement/hash
        $gravapress_email_hash = md5( strtolower( trim( $gravapress_email ) ) );

        return $gravapress_email_hash;
    }


    /*
    *   GET GRAVATAR USER PROFILE
    */
    function gravapress_get_profile( $gravapress_email_hash ){
        $json_user_url  = 'http://www.gravatar.com/' . $gravapress_email_hash . '.json';
        $args           = array ( 'timeout' => 120 );
        $json_feed      = wp_remote_get( $json_user_url, $args );
        $user_profile   = json_decode($json_feed['body']);

        return $user_profile;
    }


    /*
    *   Enqueue Styles
    */
    function gravapress_styles() {
        
                wp_enqueue_style( 'gravapress_styles', plugins_url( 'gravapress/gravapress.css' ) );
        
            }
            add_action( 'admin_head', 'gravapress_styles' );
?>