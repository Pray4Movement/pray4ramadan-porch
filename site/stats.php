<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

class P4_Ramadan_Porch_Stats extends DT_Magic_Url_Base
{
    public $page_title = 'Ramadan Posts';
    public $root = PORCH_LANDING_ROOT;
    public $type = 'stats';
    public $post_type = PORCH_LANDING_POST_TYPE;
    public $meta_key = PORCH_LANDING_META_KEY;

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    public function __construct() {
        parent::__construct();
        add_action( 'rest_api_init', [ $this, 'add_endpoints' ] );

        /**
         * tests if other URL
         */
        $url = dt_get_url_path();
        $length = strlen( $this->root . '/' . $this->type );
        if ( substr( $url, 0, $length ) !== $this->root . '/' . $this->type ) {
            return;
        }
        /**
         * tests magic link parts are registered and have valid elements
         */
        if ( !$this->check_parts_match( false ) ){
            return;
        }

        // load if valid url
        add_action( 'dt_blank_body', [ $this, 'body' ] ); // body for no post key

        require_once( 'landing-enqueue.php' );
        require_once( 'enqueue.php' );
        add_filter( 'dt_magic_url_base_allowed_css', [ $this, 'dt_magic_url_base_allowed_css' ], 10, 1 );
        add_filter( 'dt_magic_url_base_allowed_js', [ $this, 'dt_magic_url_base_allowed_js' ], 10, 1 );
        add_action( 'wp_enqueue_scripts', [ $this, 'wp_enqueue_scripts' ], 99 );
        add_filter( 'language_attributes', [ $this, 'dt_custom_dir_attr' ] );
    }
    public function dt_custom_dir_attr( $lang ){
        return ramadan_custom_dir_attr( $lang );
    }

    public function dt_magic_url_base_allowed_js( $allowed_js ) {
        $allowed_js[] = 'dt_campaign_core';
        $allowed_js[] = 'dt_campaign';
        $allowed_js[] = 'luxon';
        return array_merge( $allowed_js, P4_Ramadan_Porch_Landing_Enqueue::load_allowed_scripts() );
    }

    public function dt_magic_url_base_allowed_css( $allowed_css ) {
        return P4_Ramadan_Porch_Landing_Enqueue::load_allowed_styles();
    }

    public function wp_enqueue_scripts() {
        P4_Ramadan_Porch_Landing_Enqueue::load_scripts();
    }

    public function body(){
//        require_once( 'top-section.php' );

        $porch_fields = p4r_porch_fields();
        $campaign_fields = p4r_get_campaign();
        $langs = dt_ramadan_list_languages();
        $post_id = $campaign_fields["ID"];


        $timezone = "America/Chicago";
        if ( isset( $campaign_fields["campaign_timezone"]["key"] ) ){
            $timezone = $campaign_fields["campaign_timezone"]["key"];
        }

        $min_time_duration = 15;
        if ( isset( $campaign_fields["min_time_duration"]["key"] ) ){
            $min_time_duration = (int) $campaign_fields["min_time_duration"]["key"];
        }
        $subscribers_count = DT_Subscriptions::get_subscribers_count( $post_id );
        $coverage_percent = DT_Campaigns_Base::query_coverage_percentage( $post_id );

        $coverage_levels = DT_Campaigns_Base::query_coverage_levels_progress( $post_id );
        $total_number_of_time_slots = DT_Campaigns_Base::query_coverage_total_time_slots( $post_id );
        $current_commitments = DT_Time_Utilities::subscribed_times_list( $post_id );

        arsort( $current_commitments );
        $total_mins_prayed = 0;
        $committed_time_slots = 0;
        if ( method_exists( "DT_Campaigns_Base", "query_total_events_count" ) ){
            $committed_time_slots = DT_Campaigns_Base::query_total_events_count( $post_id );
        }
        foreach ( $coverage_levels as $level ){
            $total_mins_prayed += $level["blocks_covered"] * $min_time_duration;
        }
        $lang = dt_ramadan_get_current_lang();

        $campaign_root = "campaign_app";
        $campaign_type = $campaign_fields["type"]["key"];
        $key_name = 'public_key';
        $key = "";
        if ( method_exists( "DT_Magic_URL", "get_public_key_meta_key" ) ){
            $key_name = DT_Magic_URL::get_public_key_meta_key( $campaign_root, $campaign_type );
        }
        if ( isset( $campaign_fields[$key_name] ) ){
            $key = $campaign_fields[$key_name];
        }
        $atts = [
            "root" => $campaign_root,
            "type" => $campaign_type,
            "public_key" => $key,
            "meta_key" => $key_name,
            "post_id" => (int) $campaign_fields["ID"],
            "rest_url" => rest_url(),
            "lang" => $lang
        ];
        $dt_ramadan_selected_campaign_magic_link_settings = $atts;
        $dt_ramadan_selected_campaign_magic_link_settings["color"] = PORCH_COLOR_SCHEME_HEX;
        if ( $dt_ramadan_selected_campaign_magic_link_settings["color"] === "preset" ){
            $dt_ramadan_selected_campaign_magic_link_settings["color"] = '#4676fa';
        }

        $thank_you = "";
        if ( !empty( $porch_fields["people_name"]["value"] ) && !empty( $porch_fields["country_name"]["value"] ) ){
            $thank_you = sprintf( _x( 'Thank you for joining us in prayer for the %1$s in %2$s.', 'Thank you for joining us in prayer for the French in France.', 'pray4ramadan-porch' ), $porch_fields["people_name"]["value"], $porch_fields["country_name"]["value"] );
        } else {
            $thank_you = __( 'Thank you for praying with us!', 'pray4ramadan-porch' );
        }
        ?>

        <style>
            .wow p {
                font-weight: 600;
            }
            #ramadan-stats .center {
                text-align: center;
            }
            #ramadan-stats .dt-magic-link-language-selector {
                border: 1px solid black;
                background-color: transparent;
                color: black;
                border-radius: 5px;
                padding: 5px;
                margin-inline-start: 1em;
            }
        </style>
        <div id="ramadan-stats">
            <section class="section" data-stellar-background-ratio="0.2" style="padding-bottom: 0; min-height: 800px">
                <div class="container">
                    <div class="section-header" style="margin-bottom: 20px">
                        <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s"><?php esc_html_e( 'Campaign Stats', 'pray4ramadan-porch' ); ?></h2>
                        <hr class="lines wow zoomIn" data-wow-delay="0.3s">
                    </div>
                    <div class="center" style="margin: 30px">
                        <select class="dt-magic-link-language-selector">
                            <?php foreach ( $langs as $code => $language ) : ?>
                                <option value="<?php echo esc_html( $code ); ?>" <?php selected( $lang === $code ) ?>>
                                    <?php echo esc_html( $language["flag"] ); ?> <?php echo esc_html( $language["native_name"] ); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <p class="center"><?php echo esc_html( $thank_you ); ?></p>

                    <div class="row" style="padding-top:40px">
                        <div class="col-sm-12 col-md-9">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="item-boxes wow fadeInDown" data-wow-delay="0.2s">
                                        <h4><?php esc_html_e( 'Prayer Commitments Needed', 'pray4ramadan-porch' ); ?></h4>
                                        <p>
                                            <?php echo esc_html( $total_number_of_time_slots ); ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="item-boxes wow fadeInDown" data-wow-delay="0.2s">
                                        <h4><?php esc_html_e( 'Percentage Covered', 'pray4ramadan-porch' ); ?></h4>
                                        <p>
                                            <?php echo esc_html( $coverage_percent ); ?>%
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="item-boxes wow fadeInDown" data-wow-delay="0.2s">
                                        <h4><?php esc_html_e( 'Prayer Commitments', 'pray4ramadan-porch' ); ?></h4>
                                        <p>
                                            <?php echo esc_html( $committed_time_slots ); ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="item-boxes wow fadeInDown" data-wow-delay="0.2s">
                                        <h4><?php esc_html_e( 'Time Committed', 'pray4ramadan-porch' ); ?></h4>
                                        <p>
                                            <?php echo esc_html( $total_mins_prayed / 60 ); ?> <?php esc_html_e( 'hours', 'pray4ramadan-porch' ); ?><br>
                                            (<?php echo esc_html( round( $total_mins_prayed / 60 / 24, 2 ) ); ?> <?php esc_html_e( 'days', 'pray4ramadan-porch' ); ?>)
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="item-boxes wow fadeInDown" data-wow-delay="0.2s">
                                        <h4><?php esc_html_e( 'Number of People who Prayed', 'pray4ramadan-porch' ); ?></h4>
                                        <p>
                                            <?php echo esc_html( $subscribers_count ); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <?php
                            if ( empty( $dt_ramadan_selected_campaign_magic_link_settings ) ) :?>
                                <p style="margin:auto">Choose campaign in settings <a href="<?php echo esc_html( admin_url( 'admin.php?page=dt_porch_template&tab=general' ) );?>"><?php esc_html_e( 'here', 'pray4ramadan-porch' ); ?></a></p>
                            <?php else :
                                $dt_ramadan_selected_campaign_magic_link_settings["section"] = "calendar";
                                echo dt_24hour_campaign_shortcode( //phpcs:ignore
                                    $dt_ramadan_selected_campaign_magic_link_settings
                                );
                            endif;
                            ?>
                        </div>
                    </div>

                </div>
            </section>

            <section class="section" data-stellar-background-ratio="0.2">
                <div class="container">
                    <div class="section-header" style="padding-bottom: 40px;">
                        <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s"><?php esc_html_e( 'Share with us your Prayer Stories', 'pray4ramadan-porch' ); ?></h2>
                        <hr class="lines wow zoomIn" data-wow-delay="0.3s">
                    </div>
                    <form onSubmit="submit_feedback_form();return false;" id="form-content">
                        <p>
                            <label style="width: 100%">
                                <?php esc_html_e( 'Email', 'pray4ramadan-porch' ); ?>
                                <br>
                                <input type="email" id="email" style="display: none">
                                <input type="email" id="email-2" required style="width: 100%">
                            </label>
                        </p>
                        <p>
                            <label style="width: 100%">
                                <?php esc_html_e( 'Share with us about your Ramadan prayer time (E.g. testimonies, insights, blessings, etc)', 'pray4ramadan-porch' ); ?>
                                <br>
                                <textarea id="ramadan-stories" required rows="4" type="text" style="width: 100%"></textarea>
                            </label>
                            <button id="stories-submit-button" class="btn btn-common" style="font-weight: bold">
                                <?php esc_html_e( 'Submit', 'pray4ramadan-porch' ); ?>
                                <img id="stories-submit-spinner" style="display: none; margin-left: 10px" src="<?php echo esc_url( trailingslashit( get_stylesheet_directory_uri() ) ) ?>spinner.svg" width="22px;" alt="spinner "/>
                            </button>
                        </p>
                    </form>
                    <div id="form-confirm" class="center" style="display: none">
                        <h3><?php esc_html_e( 'Thank You!', 'disciple_tools' ); ?></h3>
                    </div>
                </div>
            </section>
            <script>

                let submit_feedback_form = function (){

                    $('#stories-submit-spinner').show()
                    let honey = $('#email').val();
                    if ( honey ){
                        return;
                    }

                    let email = $('#email-2').val();
                    let story = $('#ramadan-stories').val()
                    window.makeRequest( "POST", '/stories', { parts: jsObject.parts, email, story }, jsObject.parts.root + /v1/ + jsObject.parts.type ).done(function(data){
                        $('#stories-submit-spinner').show()
                        $('#form-content').hide()
                        $('#form-confirm').show()
                    })
                    .fail(function(e) {
                        // jQuery('#error').html(e)
                    })
                }

            </script>


            <?php if ( $porch_fields["stats-p4m"]["value"] === "yes" ) : ?>
            <section class="section" data-stellar-background-ratio="0.2" style="padding-top: 0;">
                <div class="container">
                    <div class="section-header" style="padding-bottom: 40px;">
                        <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s"><?php esc_html_e( 'More Prayer Opportunities', 'pray4ramadan-porch' ); ?></h2>
                        <hr class="lines wow zoomIn" data-wow-delay="0.3s">
                    </div>

                        <p class="center"><?php esc_html_e( 'Would you like to hear about other prayer efforts and opportunities with Pray4Movement.org?', 'pray4ramadan-porch' ); ?></p>
                        <p class="center">
                            <a class="btn btn-common" href="https://pray4movement.org/subscribe/" style="font-weight: bold">
                                <?php esc_html_e( 'Sign Up', 'pray4ramadan-porch' ); ?>
                            </a>
                        </p>
                    <div class="row">
                        <div class="center">
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php endif; ?>

        <?php
        do_action( 'pray4ramadan_porch_stats_page' );
    }

    public function footer_javascript(){
        require_once( 'footer.php' );
    }

    public function header_javascript(){
        require_once( 'header.php' );
    }

    public function add_endpoints() {
        $namespace = $this->root . '/v1/'. $this->type;
        register_rest_route(
            $namespace, 'stories', [
                [
                    'methods'  => "POST",
                    'callback' => [ $this, 'add_story' ],
                    'permission_callback' => '__return_true',
                ],
            ]
        );
    }

    public function add_story( WP_REST_Request $request ) {
        $params = $request->get_params();
        $params = dt_recursive_sanitize_array( $params );
        if ( !isset( $params["story"], $params["email"] ) ){
            return false;
        }
        $params["story"] = wp_kses_post( $request->get_params()["story"] );

        $campaign_fields = p4r_get_campaign();
        $post_id = $campaign_fields["ID"];

        $comment = "Story feedback from " . site_url( "prayer/stats" ) . " by " . $params["email"] . ": \n" . $params["story"];
        DT_Posts::add_post_comment( "campaigns", $post_id, $comment, 'stories', [], false );

        $subs = DT_Posts::list_posts( "subscriptions", [ "campaigns" => [ $post_id ], "contact_email" => [ $params["email"] ] ], false );
        if ( sizeof( $subs["posts"] ) === 1 ){
            DT_Posts::add_post_comment( "subscriptions", $subs["posts"][0]["ID"], $comment, 'stories', [], false, true );
        }

        return true;
    }

}
P4_Ramadan_Porch_Stats::instance();
