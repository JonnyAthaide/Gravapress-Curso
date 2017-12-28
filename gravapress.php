<?php
    /*  
    *   Plugin Name: Gravapress
    *   Plugin URI: http://jsacode.com.br/gravapress
    *   Description: Provides widgets and shortcodes to allow you display your gravatar profile on your WordPress site
    *   Version: 0.5
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
    *   REGISTER WIDGET
    */
    class Gravapress_Widget extends WP_Widget {

        function __construct() {
            // Instantiate the parent object
            parent::__construct(
                'Gravapress_Widget', // Base ID
                __('Gravapress'), // Name
                array( 'description' => __( 'Gravatar WordPress Profile Integration'), ) // Args
            );
        }

        function widget( $args, $instance ) {

            global $plugin_url;

            // Mostrar conteúdo no frontend do site
            extract($args); // extrair argumentos que são fornecidos ao widget
            $title = apply_filters( 'widget_title', $instance['title'] ); // título que aparecerá no topo do widget no frontend
            // a pessoa poderá personalizar o título

            // perfil armazenado do usuário que será exibido no frontend
            $options            = get_option( 'gravapress' );
            $gravapress_profile = $options['gravapress_profile'];
            $display_social     = $instance['display_social'];
            $display_contact    = $instance['display_contact'];

            // template do frontend do site
            require( 'inc/front-end-widget.php' );
        }

        function update( $new_instance, $old_instance ) {
            // Salvar opções do widget definidas pelo usuário
            // Substitui as antigas opções por novas opções salvas pelo usuário para o widget
            $instance = $old_instance;
            $instance['title']              = strip_tags($new_instance['title']);            
            $instance['display_social']     = strip_tags($new_instance['display_social']);
            $instance['display_contact']    = strip_tags($new_instance['display_contact']);

            return $instance;
        }

        function form( $instance ) {
            // Exibição do widget no admin
            // Aparência do Widget na área administrativa do WP
            // Inicialmente a única coisa a ser feita é exibir um campo para alteração do título do widget
            $title              = esc_attr( $instance['title'] ); // obter o título definido armazenado
            $display_social     = esc_attr( $instance['display_social'] );
            $display_contact    = esc_attr( $instance['display_contact'] );

            $options = get_option( 'gravapress' );
            $gravapress_profile = $options['gravapress_profile'];

            require( 'inc/widget-fields.php' );
        }
    }

    function gravapress_register_widgets() {
        register_widget( 'Gravapress_Widget' );
    }

    add_action( 'widgets_init', 'gravapress_register_widgets' );


    /*
    *   Gravapress Shortcode
    */
    function gravapress_shortcodes( $atts, $content = null ) {

        global $post; // obter informações sobre o post que a shotcode aparece
        global $plugin_url;

        $a = shortcode_atts( array(   // extrair parametros e converter em variáveis     
        'gallery' => 'off', // parametros e valores padrão
        'sites' => 'off',        
        'social' => 'off', 
        'contact' => 'off',
        ), $atts ); // agora parametros estão disponíveis como variáveis

        // habilidade do shorcode de definir quando os paramteros estão on e off
        if( $a['gallery'] == 'on' ) $gallery = 1; // 1 é on e 0 é off
        if( $a['gallery'] == 'off' ) $gallery = 0; 
        
        if( $a['sites'] == 'on' ) $sites = 1;
        if( $a['sites'] == 'off' ) $sites = 0;               

        if( $a['social'] == 'on' ) $social = 1;
        if( $a['social'] == 'off' ) $social = 0;

        if( $a['contact'] == 'on' ) $contact = 1;
        if( $a['contact'] == 'off' ) $contact = 0;

        // renomear parametro para aquele utilizado no frontend do site
        $display_gallery = $gallery; 
        $display_sites = $sites;
        $display_social = $social;
        $display_contact = $contact;

        // obter perfil do usuário
        $options = get_option( 'gravapress' );
        $gravapress_profile = $options['gravapress_profile'];

        // utilizar o require faz com que o shotcode seja chamado no topo do post
        // precisamos que o shortcode carregue exatamente quando ele for chamado no conteúdo
        // buffering - segurar informação temporária até que uma posição seja atinjida
        ob_start();        

        // solicitar template do frontend
        require( 'inc/front-end-shortcode.php' );

        $content = ob_get_clean();

        return $content;

    }
    add_shortcode( 'gravapress', 'gravapress_shortcodes' );   

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
    *   Profile Update
    */
    function gravapress_update_profile(){

        // quando o profile foi atualizado pela última vez
        $options = get_option( 'gravapress' ); 
        $last_updated = $options['last_updated'];

        // variável para a hora atual
        $time = time();

        // obter a diferença de tempo entre a atualização atual e a última atualização
        $update = $time - $last_updated;

        // se diferença for maior que 24 horas
        if( $update > 86400 ) {
            
            // atualize o perfil
            $gravapress_email_hash = $options['gravapress_email_hash'];

            $options['gravapress_profile'] = gravapress_get_profile( $gravapress_email_hash );
            $options['last_updated'] = time();

            update_option( 'gravapress', $options );

        }

        // ao chamarmos a função utilizando ajax, die ajudará o ajax a saber
        // quando a função terminou
        die();

    }
    add_action( 'wp_ajax_gravapress_update_profile', 'gravapress_update_profile' );

    /*
    *   Enable Frontend Ajax
    */
    function gravapress_ajax_frontend(){
?>
        <script>
            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        </script>
    
<?php    
        }
    add_action( 'wp_head', 'gravapress_ajax_frontend' );


    /*
    *   Enqueue Styles
    */
    function gravapress_backend_styles(){
        wp_enqueue_style( 'gravapress_backend_css', plugins_url( 'gravapress/gravapress.css' ) );
    }
    add_action( 'admin_head', 'gravapress_backend_styles' );

    function gravapress_frontend_styles(){
        wp_enqueue_style( 'gravapress_frontend_css', plugins_url( 'gravapress/gravapress.css' ) );
    }
    add_action( 'wp_enqueue_scripts', 'gravapress_frontend_styles' );

    /*
    *   Enqueue Scripts
    */
    function gravapress_frontend_scripts() {
        
        wp_enqueue_script( 'plugin_gravapress_frontend_js', plugins_url( 'gravapress/gravapress.js' ), array('jquery'), '', true );
        
    }
    add_action( 'wp_enqueue_scripts', 'gravapress_frontend_scripts' );

?>