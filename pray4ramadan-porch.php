<?php
/**
 * Plugin Name: Pray4Ramadan Porch
 * Plugin URI: https://github.com/Pray4Movement/pray4ramadan-porch
 * Description: This is this microsite plugin to support the Ramadan 24/7 Campaign
 * Text Domain: pray4ramadan-porch
 * Domain Path: /languages
 * Version:  0.1
 * Author URI: https://github.com/DiscipleTools
 * GitHub Plugin URI: https://github.com/Pray4Movement/pray4ramadan-porch
 * Requires at least: 4.7.0
 * (Requires 4.7+ because of the integration of the REST API at 4.7 and the security requirements of this milestone version.)
 * Tested up to: 5.6
 *
 * @package Disciple_Tools
 * @link    https://github.com/DiscipleTools
 * @license GPL-2.0 or later
 *          https://www.gnu.org/licenses/gpl-2.0.html
 */


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Gets the instance of the `P4_Ramadan_Porch` class.
 *
 * @since  0.1
 * @access public
 * @return object|bool
 */
function p4r_porch() {
    $p4r_porch_required_dt_theme_version = '1.8.1';
    $wp_theme = wp_get_theme();
    $version = $wp_theme->version;

    /*
     * Check if the Disciple.Tools theme is loaded and is the latest required version
     */
    $is_theme_dt = strpos( $wp_theme->get_template(), "disciple-tools-theme" ) !== false || $wp_theme->name === "Disciple Tools";
    if ( $is_theme_dt && version_compare( $version, $p4r_porch_required_dt_theme_version, "<" ) ) {
        add_action( 'admin_notices', 'p4r_porch_hook_admin_notice' );
        add_action( 'wp_ajax_dismissed_notice_handler', 'dt_hook_ajax_notice_handler' );
        return false;
    }
    if ( !$is_theme_dt ){
        return false;
    }
    /**
     * Load useful function from the theme
     */
    if ( !defined( 'DT_FUNCTIONS_READY' ) ){
        require_once get_template_directory() . '/dt-core/global-functions.php';
    }

    return P4_Ramadan_Porch::instance();
}
add_action( 'after_setup_theme', 'p4r_porch', 20 );

/**
 * Singleton class for setting up the plugin.
 *
 * @since  0.1
 * @access public
 */
class P4_Ramadan_Porch {

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct() {
        if ( ! defined( 'PORCH_TITLE' ) ) {
            define( 'PORCH_TITLE', 'Ramadan' ); // Used in tabs and titles, avoid special characters. Spaces are okay.
        }
        if ( ! defined( 'PORCH_ROOT' ) ) {
            define( 'PORCH_ROOT', 'porch_app' ); // Alphanumeric key. Use underscores not hyphens. No special characters.
        }
        if ( ! defined( 'PORCH_TYPE' ) ) {
            define( 'PORCH_TYPE', '5' ); // Alphanumeric key. Use underscores not hyphens. No special characters.
        }
        if ( ! defined( 'PORCH_TOKEN' ) ) {
            define( 'PORCH_TOKEN', 'porch_app_5' ); // Alphanumeric key. Use underscores not hyphens. No special characters. Must be less than 20 characters
        }
        if ( ! defined( 'PORCH_LANDING_ROOT' ) ) {
            define( 'PORCH_LANDING_ROOT', 'prayer' ); // Alphanumeric key. Use underscores not hyphens. No special characters.
        }
        if ( ! defined( 'PORCH_LANDING_TYPE' ) ) {
            define( 'PORCH_LANDING_TYPE', 'fuel' ); // Alphanumeric key. Use underscores not hyphens. No special characters. Must be less than 20 characters
        }
        if ( ! defined( 'PORCH_LANDING_META_KEY' ) ) {
            define( 'PORCH_LANDING_META_KEY', PORCH_LANDING_ROOT . '_' . PORCH_LANDING_TYPE . '_magic_key' ); // Alphanumeric key. Use underscores not hyphens. No special characters. Must be less than 20 characters
        }
        if ( ! defined( 'PORCH_LANDING_POST_TYPE' ) ) {
            define( 'PORCH_LANDING_POST_TYPE', 'landing' ); // Alphanumeric key. Use underscores not hyphens. No special characters. Must be less than 20 characters
        }
        if ( ! defined( 'PORCH_LANDING_POST_TYPE_SINGLE' ) ) {
            define( 'PORCH_LANDING_POST_TYPE_SINGLE', 'Landing' ); // Alphanumeric key. Use underscores not hyphens. No special characters. Must be less than 20 characters
        }
        if ( ! defined( 'PORCH_LANDING_POST_TYPE_PLURAL' ) ) {
            define( 'PORCH_LANDING_POST_TYPE_PLURAL', 'Landings' ); // Alphanumeric key. Use underscores not hyphens. No special characters. Must be less than 20 characters
        }

        /**
         * This template includes 6 color schemes set by the definition below.
         * preset, teal, forestgreen, green, purple, orange
         */
        $theme = get_option( PORCH_LANDING_META_KEY . '_theme_color', 'preset' );
        if ( ! defined( 'PORCH_COLOR_SCHEME' ) ) {
            define( 'PORCH_COLOR_SCHEME', $theme ); // Alphanumeric key. Use underscores not hyphens. No special characters. Must be less than 20 characters
            switch( $theme ) {
                case 'preset':
                    $hex = '#4676fa';
                    break;
                case 'forestgreen':
                    $hex = '#1EB858';
                    break;
                case 'green':
                    $hex = '#94C523';
                    break;
                case 'orange':
                    $hex = '#F57D41';
                    break;
                case 'purple':
                    $hex = '#6B58CD';
                    break;
                case 'teal':
                    $hex = '#1AB7D8';
                    break;
            }
            define( 'PORCH_COLOR_SCHEME_HEX', $hex );
        }

        // POST TYPE and ACCESS
        require_once( 'site/roles-and-permissions.php' );
        require_once( 'site/landing-post-type.php' );

        // MICROSITE Magic Links
        require_once( 'site/home.php' );
        require_once( 'site/archive.php' );
        require_once( 'site/landing.php' );
        require_once( 'site/rest.php' );

        // Admin Pages
        if ( is_admin() ) {
            $required_admin_files = scandir( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'admin' );
            foreach ( $required_admin_files as $file ) {
                if ( substr( $file, -4, '4' ) === '.php' ) {
                    require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'admin/' . $file );
                }
            }

            require_once( 'support/required-plugins/class-tgm-plugin-activation.php' );
            require_once( 'support/required-plugins/config-required-plugins.php' );

        }

        if ( is_admin() ){
            add_filter( 'plugin_row_meta', [ $this, 'plugin_description_links' ], 10, 4 ); // admin plugin page description
        }
        $this->i18n();
    }

    /**
     * Filters the array of row meta for each/specific plugin in the Plugins list table.
     * Appends additional links below each/specific plugin on the plugins page.
     */
    public function plugin_description_links( $links_array, $plugin_file_name, $plugin_data, $status ) {
        if ( strpos( $plugin_file_name, basename( __FILE__ ) ) ) {

            // You can still use `array_unshift()` to add links at the beginning.
            $links_array[] = '<a href="https://disciple.tools">Disciple.Tools Community</a>'; // @todo replace with your links.
        }

        return $links_array;
    }

    /**
     * Method that runs only when the plugin is activated.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public static function activation() {

    }

    /**
     * Method that runs only when the plugin is deactivated.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public static function deactivation() {
        // add functions here that need to happen on deactivation
    }

    /**
     * Loads the translation files.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public function i18n() {
        $domain = 'pray4ramadan-porch';
        load_plugin_textdomain( $domain, false, trailingslashit( dirname( plugin_basename( __FILE__ ) ) ). 'support/languages' );
    }

    /**
     * Magic method to output a string if trying to use the object as a string.
     *
     * @since  0.1
     * @access public
     * @return string
     */
    public function __toString() {
        return 'pray4ramadan-porch';
    }

    /**
     * Magic method to keep the object from being cloned.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public function __clone() {
        _doing_it_wrong( __FUNCTION__, 'Whoah, partner!', '0.1' );
    }

    /**
     * Magic method to keep the object from being unserialized.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public function __wakeup() {
        _doing_it_wrong( __FUNCTION__, 'Whoah, partner!', '0.1' );
    }

    /**
     * Magic method to prevent a fatal error when calling a method that doesn't exist.
     *
     * @param string $method
     * @param array $args
     * @return null
     * @since  0.1
     * @access public
     */
    public function __call( $method = '', $args = array() ) {
        _doing_it_wrong( "p4r_porch::" . esc_html( $method ), 'Method does not exist.', '0.1' );
        unset( $method, $args );
        return null;
    }
}


// Register activation hook.
register_activation_hook( __FILE__, [ 'P4_Ramadan_Porch', 'activation' ] );
register_deactivation_hook( __FILE__, [ 'P4_Ramadan_Porch', 'deactivation' ] );


if ( ! function_exists( 'p4r_porch_hook_admin_notice' ) ) {
    function p4r_porch_hook_admin_notice() {
        global $p4r_porch_required_dt_theme_version;
        $wp_theme = wp_get_theme();
        $current_version = $wp_theme->version;
        $message = "'Pray4Ramadan Porch' plugin requires 'Disciple Tools' theme to work. Please activate 'Disciple Tools' theme or make sure it is latest version.";
        if ( $wp_theme->get_template() === "disciple-tools-theme" ){
            $message .= ' ' . sprintf( esc_html( 'Current Disciple Tools version: %1$s, required version: %2$s' ), esc_html( $current_version ), esc_html( $p4r_porch_required_dt_theme_version ) );
        }
        // Check if it's been dismissed...
        if ( ! get_option( 'dismissed-pray4ramadan-porch', false ) ) { ?>
            <div class="notice notice-error notice-pray4ramadan-porch is-dismissible" data-notice="pray4ramadan-porch">
                <p><?php echo esc_html( $message );?></p>
            </div>
            <script>
                jQuery(function($) {
                    $( document ).on( 'click', '.notice-pray4ramadan-porch .notice-dismiss', function () {
                        $.ajax( ajaxurl, {
                            type: 'POST',
                            data: {
                                action: 'dismissed_notice_handler',
                                type: 'pray4ramadan-porch',
                                security: '<?php echo esc_html( wp_create_nonce( 'wp_rest_dismiss' ) ) ?>'
                            }
                        })
                    });
                });
            </script>
        <?php }
    }
}

/**
 * AJAX handler to store the state of dismissible notices.
 */
if ( ! function_exists( "dt_hook_ajax_notice_handler" )){
    function dt_hook_ajax_notice_handler(){
        check_ajax_referer( 'wp_rest_dismiss', 'security' );
        if ( isset( $_POST["type"] ) ){
            $type = sanitize_text_field( wp_unslash( $_POST["type"] ) );
            update_option( 'dismissed-' . $type, true );
        }
    }
}

add_action( 'plugins_loaded', function (){
    if ( is_admin() ){
        // Check for plugin updates
        if ( ! class_exists( 'Puc_v4_Factory' ) ) {
            if ( file_exists( get_template_directory() . '/dt-core/libraries/plugin-update-checker/plugin-update-checker.php' )){
                require( get_template_directory() . '/dt-core/libraries/plugin-update-checker/plugin-update-checker.php' );
            }
        }
        if ( class_exists( 'Puc_v4_Factory' ) ){
            Puc_v4_Factory::buildUpdateChecker(
                'https://raw.githubusercontent.com/Pray4Movement/pray4ramadan-porch/master/version-control.json',
                __FILE__,
                'pray4ramadan-porch'
            );

        }
    }
} );

if ( ! function_exists( 'pray4ramadan_porch_fields' ) ) {
    function pray4ramadan_porch_fields() {
        $defaults = [
            'title' => [
                'label' => 'Site Title',
                'value' => '',
                'type' => 'text',
            ],
            'logo_url' => [
                'label' => 'Logo URL',
                'value' => '',
                'type' => 'text',
            ],
            'header_background_url' => [
                'label' => 'Header Background URL',
                'value' => '',
                'type' => 'text',
            ],
            'what_content' => [
                'label' => 'What is Ramadan Content',
                'value' => '',
                'type' => 'textarea',
            ],
            'what_image' => [
                'label' => 'What is Ramadan Image',
                'value' => '',
                'type' => 'text',
            ]
        ];

        $saved_fields = get_option('pray4ramadan_porch_fields', [] );

        return p4r_recursive_parse_args($saved_fields,$defaults);
    }
}
if ( ! function_exists( 'p4r_recursive_parse_args' ) ) {
    function p4r_recursive_parse_args( $args, $defaults ) {
        $new_args = (array) $defaults;

        foreach ( $args as $key => $value ) {
            if ( is_array( $value ) && isset( $new_args[ $key ] ) ) {
                $new_args[ $key ] = p4r_recursive_parse_args( $value, $new_args[ $key ] );
            }
            else {
                $new_args[ $key ] = $value;
            }
        }

        return $new_args;
    }
}



