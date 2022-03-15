<?php
/**
 * Plugin Name: Pray4Ramadan Porch
 * Plugin URI: https://github.com/Pray4Movement/pray4ramadan-porch
 * Description: This is this microsite plugin to support the Ramadan 24/7 Campaign
 * Text Domain: pray4ramadan-porch
 * Domain Path: /languages
 * Version:  0.3.4
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
    $is_theme_dt = class_exists( "Disciple_Tools" );
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
add_action( 'after_setup_theme', 'p4r_porch', 15 );

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
        require_once( 'site/functions.php' );
        $fields = p4r_porch_fields();
        if ( ! defined( 'PORCH_TITLE' ) ) {
            $title = $fields['title']['value'] ?? 'Ramadan';
            define( 'PORCH_TITLE', $title ); // Used in tabs and titles, avoid special characters. Spaces are okay.
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
            define( 'PORCH_LANDING_POST_TYPE_SINGLE', 'Porch' ); // Alphanumeric key. Use underscores not hyphens. No special characters. Must be less than 20 characters
        }
        if ( ! defined( 'PORCH_LANDING_POST_TYPE_PLURAL' ) ) {
            define( 'PORCH_LANDING_POST_TYPE_PLURAL', 'Porch' ); // Alphanumeric key. Use underscores not hyphens. No special characters. Must be less than 20 characters
        }

        /**
         * This template includes 6 color schemes set by the definition below.
         * preset, teal, forestgreen, green, purple, orange
         */
        $theme = 'preset';
        $hex = '#4676fa';
        if ( isset( $fields['theme_color']['value'] ) && ! empty( $fields['theme_color']['value'] ) && ! defined( 'PORCH_COLOR_SCHEME' ) ) {
            $theme = $fields['theme_color']['value'];
            $hex = $fields['theme_color']['value'];
            switch ( $theme ) {
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
        }

        if ( isset( $fields['custom_theme_color']['value'] ) && ! empty( $fields['custom_theme_color']['value'] ) ){
            $theme = 'custom';
            $hex = $fields['custom_theme_color']['value'];
        }
        define( 'PORCH_COLOR_SCHEME', $theme );
        define( 'PORCH_COLOR_SCHEME_HEX', $hex );

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

            require_once( 'support/required-plugins/config-required-plugins.php' );

        }
        require_once( 'admin/campaigns-config.php' );

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
        $message = "'Pray4Ramadan Porch' plugin requires 'Disciple.Tools' theme to work. Please activate 'Disciple.Tools' theme or make sure it is latest version.";
        if ( $wp_theme->get_template() === "disciple-tools-theme" ){
            $message .= ' ' . sprintf( esc_html( 'Current Disciple.Tools version: %1$s, required version: %2$s' ), esc_html( $current_version ), esc_html( $p4r_porch_required_dt_theme_version ) );
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
if ( !function_exists( "dt_hook_ajax_notice_handler" ) ){
    function dt_hook_ajax_notice_handler(){
        check_ajax_referer( 'wp_rest_dismiss', 'security' );
        if ( isset( $_POST["type"] ) ){
            $type = sanitize_text_field( wp_unslash( $_POST["type"] ) );
            update_option( 'dismissed-' . $type, true );
        }
    }
}

add_action( 'plugins_loaded', function (){
    if ( is_admin() && !( is_multisite() && class_exists( "DT_Multisite" ) ) || wp_doing_cron() ){
        // Check for plugin updates
        if ( ! class_exists( 'Puc_v4_Factory' ) ) {
            if ( file_exists( get_template_directory() . '/dt-core/libraries/plugin-update-checker/plugin-update-checker.php' ) ){
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

if ( ! function_exists( 'p4r_porch_fields' ) ) {
    function p4r_porch_fields() {
        $defaults = [
            'theme_color' => [
                'label' => 'Theme Color',
                'value' => 'preset',
                'type' => 'theme_select',
            ],
            'custom_theme_color' => [
                'label' => 'Custom Theme Color',
                'value' => '',
                'type' => 'text'
            ],
            'country_name' => [
                'label' => 'Location Name',
                'value' => '',
                'type' => 'text',
                'translations' => [],
            ],
            'people_name' => [
                'label' => 'People Name',
                'value' => '',
                'type' => 'text',
                'translations' => [],
            ],
            'title' => [
                'label' => 'Campaign/Site Title',
                'value' => get_bloginfo( 'name' ),
                'type' => 'text',
                'translations' => [],
            ],
            'logo_url' => [
                'label' => 'Logo Image URL',
                'value' => '',
                'type' => 'text',
            ],
            'logo_link_url' => [
                'label' => 'Logo Link to URL',
                'value' => '',
                'type' => 'text',
            ],
            'header_background_url' => [
                'label' => 'Header Background URL',
                'value' => trailingslashit( plugin_dir_url( __FILE__ ) ) . 'site/img/stencil-header.png',
                'type' => 'text',
            ],
            'what_image' => [
                'label' => 'What is Ramadan Image',
                'value' => '',
                'type' => 'text',
            ],
            'show_prayer_timer' => [
                'label' => 'Show Prayer Timer',
                'default' => __( 'Yes', 'pray4ramadan-porch' ),
                'value' => 'yes',
                'type' => 'prayer_timer_toggle',
            ],
            "email" => [
                "label" => "Address to send sign-up and notification emails from",
                "value" => "no-reply@" . parse_url( home_url() )["host"],
                'type' => 'text'
            ],
            'facebook' => [
                'label' => 'Facebook Url',
                'value' => '',
                'type' => 'text',
            ],
            'instagram' => [
                'label' => 'Instagram Url',
                'value' => '',
                'type' => 'text',
            ],
            'twitter' => [
                'label' => 'Twitter Url',
                'value' => '',
                'type' => 'text',
            ],

            //strings
            'what_content' => [
                'label' => 'What is Ramadan Content',
                'default' =>__( 'Ramadan is one of the five requirements (or pillars) of Islam. During each of its 30 days, Muslims are obligated to fast from dawn until sunset. During this time they are supposed to abstain from food, drinking liquids, smoking, and sexual relations.

 In %1$s, women typically spend the afternoons preparing a big meal. At sunset, families often gather to break the fast. Traditionally the families break the fast with a drink of water, then three dried date fruits, and a multi-course meal. After watching the new Ramadan TV series, men (and some women) go out to coffee shops where they drink coffee, and smoke with friends until late into the night.

 Though many %2$s have stopped fasting in recent years, and lots of %2$s are turned off by the hypocrisy, increased crime rates, and rudeness that is pervasive through the month, lots of %2$s become more serious about religion during this time. Many attend the evening prayer services and do the other ritual prayers. Some even read the entire Quran (about a tenth the length of the Bible). This sincere seeking makes it a strategic time for us to pray for them.', 'pray4ramadan-porch' ),
                'value' => '',
                'type' => 'textarea',
                'translations' => [],
            ],
            'goal' => [
                'label' => 'Goal',
                'default' => __( "We want to cover the country of %s with continuous 24/7 prayer during the entire 30 days of Ramadan.", 'pray4ramadan-porch' ),
                'value' => "",
                'type' => 'text',
                'translations' => [],
            ],
            'google_analytics' => [
                'label' => 'Google Analytics',
                'default' => get_site_option( "p4r_porch_google_analytics" ),
                'value' => '',
                'type' => 'textarea',
            ],
        ];

        $defaults = apply_filters( 'p4r_porch_fields', $defaults );

        $saved_fields = get_option( 'p4r_porch_fields', [] );

        $lang = dt_ramadan_get_current_lang();
        $people_name = get_field_translation( $saved_fields["people_name"] ?? [], $lang );
        $country_name = get_field_translation( $saved_fields["country_name"] ?? [], $lang );

        $defaults["goal"]["default"] = sprintf( $defaults["goal"]["default"], !empty( $country_name ) ? $country_name : "COUNTRY" );

        $defaults["what_content"]["default"] = sprintf(
            $defaults["what_content"]["default"],
            !empty( $country_name ) ? $country_name : "COUNTRY",
            !empty( $people_name ) ? $people_name : "PEOPLE"
        );

        return p4r_recursive_parse_args( $saved_fields, $defaults );
    }
}
if ( ! function_exists( 'p4r_get_campaign' ) ) {
    function p4r_get_campaign() {

        $selected_campaign = get_option( 'pray4ramadan_selected_campaign', false );

        if ( empty( $selected_campaign ) ) {
            return [];
        }

        $campaign = DT_Posts::get_post( 'campaigns', (int) $selected_campaign, true, false );
        if ( is_wp_error( $campaign ) ) {
            return [];
        }

        /**
         *  Array
        (
        [peoplegroups] => Array
        (
        )

        [subscriptions] => Array
        (
        )

        [ID] => 3
        [post_date] => Array
        (
        [timestamp] => 1629483776
        [formatted] => 2021-08-20
        )

        [permalink] => {url}
        [post_type] => campaigns
        [post_author] => 7
        [post_author_display_name] => Chris
        [start_date] => Array
        (
        [timestamp] => 1648857600
        [formatted] => 2022-04-02
        )

        [last_modified] => Array
        (
        [timestamp] => 1630080963
        [formatted] => 2021-08-27
        )

        [end_date] => Array
        (
        [timestamp] => 1651276800
        [formatted] => 2022-04-30
        )

        [campaign_timezone] => Array
        (
        [key] => Europe/Amsterdam
        [label] => Europe/Amsterdam
        )

        [status] => Array
        (
        [key] => active
        [label] => Active
        )

        [campaign_app_24hour_magic_key] => 9caeaaf5336bcdb33e5dad0ea643ed207e38426c2b30ae939917a3e0cfb1ec6e
        [type] => Array
        (
        [key] => 24hour
        [label] => 24hr Prayer Calendar
        )

        [min_time_duration] => Array
        (
        [key] => 15
        [label] => 15 Minutes
        )

        [_edit_lock] => 1630066844:7
        [name] => Ramadan
        [title] => Ramadan
        )

         */

        return $campaign;
    }
}
if ( ! function_exists( 'p4r_recursive_parse_args' ) ) {
    function p4r_recursive_parse_args( $args, $defaults ) {
        $new_args = (array) $defaults;

        foreach ( $args ?: [] as $key => $value ) {
            if ( is_array( $value ) && isset( $new_args[ $key ] ) ) {
                $new_args[ $key ] = p4r_recursive_parse_args( $value, $new_args[ $key ] );
            }
            elseif ( $key !== "default" ){
                $new_args[ $key ] = $value;
            }
        }

        return $new_args;
    }
}
