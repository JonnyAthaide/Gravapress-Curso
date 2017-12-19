<?php
    /*  
    *   Plugin Name: Gravapress
    *   Plugin URI: http://jsacode.com.br/gravapress
    *   Description: Provides widgets and shortcodes to allow you display your gravatar profile on your WordPress site
    *   Version: 0.1
    *   Author: Jonnhatan Athaide
    *   Author URI: http://jsacode.com.br/
    *   License: GPL2
    */

    /*
    * Global Variables
    */
    $plugin_url = WP_PLUGIN_URL . '/gravapress';
    $options    = array();

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


    // GRAVAPRESS FORM SUBMIT
    if( isset($_POST['email_submitted'])){
        $hidden_field = esc_html( $_POST['email_submitted'] );

        if( $hidden_field == 'Y'){
            
            //GRAVATAR USER NAME
            $gravapress_email = esc_html( $_POST['gravatar_email'] );

            $options['user_email']  = $gravapress_email;
            $options['last_update'] = time();

            //UPDATE OPTIONS TABLE
            update_option( 'gravapress', $options );
        }
    }

    //GET OPTIONS TABLE
    $options = get_option( 'gravapress' );

    if($options != ''){
        $gravapress_email =$options['user_email'];
    }



    require('inc/options-page.php');
}

    /*
    *   Enqueue Styles
    */
    function gravapress_styles() {
        
                wp_enqueue_style( 'gravapress_styles', plugins_url( 'gravapress/gravapress.css' ) );
        
            }
            add_action( 'admin_head', 'gravapress_styles' );
?>