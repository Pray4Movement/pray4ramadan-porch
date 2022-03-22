<?php
$porch_fields = p4r_porch_fields();
$lang = dt_ramadan_get_current_lang();


// query for getting posts in the selected language.
$lang_query = [
    [
        'key'     => 'post_language',
        'value'   => $lang,
        'compare' => '=',
    ]
];
if ( $lang === "en_US" ){
    $lang_query[] = [
        'key'     => 'post_language',
        'compare' => 'NOT EXISTS',
    ];
    $lang_query["relation"] = "OR";
}

//get latest published post
$today = new WP_Query( [
    'post_type' => PORCH_LANDING_POST_TYPE,
    'post_status' => 'publish',
    'posts_per_page' => 1,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'meta_query' => $lang_query
] );
if ( empty( $today->posts ) ){
    //get earliest unpublished post
    $today = new WP_Query( [
        'post_type' => PORCH_LANDING_POST_TYPE,
        'post_status' => 'future',
        'posts_per_page' => 1,
        'orderby' => 'post_date',
        'order' => 'ASC',
        'meta_query' => $lang_query
    ] );
}
if ( empty( $today->posts ) ){
    //post in english
    $args = array(
        'post_type' => PORCH_LANDING_POST_TYPE,
        'post_status' => [ 'publish', 'future' ],
        'posts_per_page' => 1,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'meta_query' => [
            'relation' => 'OR',
            [
                'key'     => 'post_language',
                'value'   => 'en_US',
                'compare' => '=',
            ],
            [
                'key'     => 'post_language',
                'compare' => 'NOT EXISTS',
            ],
        ]
    );
    $today = new WP_Query( $args );
}


$list = new WP_Query( [
    'post_type' => PORCH_LANDING_POST_TYPE,
    'post_status' => [ 'publish' ],
    'posts_per_page' => -1,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'meta_query' => $lang_query
] );

if ( empty( $list->posts ) ){
    $args = array(
        'post_type' => PORCH_LANDING_POST_TYPE,
        'post_status' => [ 'publish' ],
        'posts_per_page' => -1,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'meta_query' => [
            'relation' => 'OR',
            [
                'key'     => 'post_language',
                'value'   => 'en_US',
                'compare' => '=',
            ],
            [
                'key'     => 'post_language',
                'compare' => 'NOT EXISTS',
            ],
        ]
    );
    $list = new WP_Query( $args );
}

add_action( 'wp_head', 'og_protocol' );
?>

<!-- TODAYS POST Section -->
<section id="contact" class="section">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-9 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="0.3s">
                <div class="fuel-block">
                    <div class="section-header">
                        <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s"><?php esc_html_e( "Today's Prayer Fuel", 'pray4ramadan-porch' ); ?></h2>
                        <hr class="lines wow zoomIn" data-wow-delay="0.3s">
                    </div>
                    <div class="">
                        <?php foreach ( $today->posts as $item ) : ?>
                            <?php echo wp_kses_post( $item->post_content ) ?>
                        <?php endforeach; ?>
                    </div>
                    <?php
                    if ( !isset( $porch_fields['show_prayer_timer']['value'] ) || empty( $porch_fields['show_prayer_timer']['value'] ) || $porch_fields['show_prayer_timer']['value'] === 'yes' ) :
                        if ( function_exists( 'show_prayer_timer' ) ) : ?>
                            <div class="mt-5">
                                <?php echo do_shortcode( "[dt_prayer_timer color='" . PORCH_COLOR_SCHEME_HEX . "' duration='15']" ); ?>
                            </div>
                        <?php endif;
                    endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<!-- LIST OF POSTS Section -->
<section id="blog" class="section">
    <!-- Container Starts -->
    <div class="container">
        <div class="section-header">
            <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s"><?php esc_html_e( 'All Days', 'pray4ramadan-porch' ); ?></h2>
            <hr class="lines wow zoomIn" data-wow-delay="0.3s">
            <p class="section-subtitle wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="0.3s"><?php esc_html_e( 'Use these resources to help pray specifically each day for the month of Ramadan.', 'pray4ramadan-porch' ); ?></p>
        </div>
        <div class="row">
            <?php foreach ( $list->posts as $item ) :
                $date = gmdate( $item->post_date );
                ?>

                <?php $public_key = get_post_meta( $item->ID, PORCH_LANDING_META_KEY, true ); ?>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 blog-item">
                <!-- Blog Item Starts -->
                <div class="blog-item-wrapper wow fadeInUp" data-wow-delay="0.3s">
                    <div class="blog-item-img">
                        <a href="/prayer/fuel/<?php echo esc_attr( $public_key ) ?>">
                            <img src="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>landing-pages/img/300x1.png" alt="">
                        </a>
                    </div>
                    <div class="blog-item-text">
                        <h3>
                            <a href="#"><?php echo esc_html( $item->post_title ) ?></a>
                        </h3>
                        <div class="meta-tags">
                            <span class="date"><i class="lnr lnr-calendar-full"></i>on <?php echo esc_html( gmdate( 'Y-m-d', strtotime( $item->post_date ) ) )  ?></span>
                        </div>
                        <p>
                            <?php echo wp_kses_post( esc_html( $item->post_excerpt ) ) ?>
                        </p>
                        <a href="/prayer/fuel/<?php echo esc_attr( $public_key ) ?>" class="btn btn-common btn-rm"><?php esc_html_e( 'Read', 'pray4ramadan-porch' ); ?></a>
                    </div>
                </div>
                <!-- Blog Item Wrapper Ends-->
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- blog Section End -->

<!-- Footer Section Start -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="social-icons wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="0.3s">
                    <ul>
                        <!-- facebook -->
                        <?php if ( isset( $porch_fields['facebook']["value"] ) && !empty( $porch_fields['facebook']["value"] ) ) : ?>
                            <li class="facebook"><a href="<?php echo esc_url( $porch_fields['facebook']["value"] ) ?>"><i class="fa fa-facebook"></i></a></li>
                        <?php endif; ?>

                        <!-- instagram -->
                        <?php if ( isset( $porch_fields['instagram']["value"] ) && !empty( $porch_fields['instagram']["value"] ) ) : ?>
                            <li class="instagram"><a href="<?php echo esc_url( $porch_fields['instagram']["value"] ) ?>"><i class="fa fa-instagram"></i></a></li>
                        <?php endif; ?>

                        <!-- twitter -->
                        <?php if ( isset( $porch_fields['twitter']["value"] ) && !empty( $porch_fields['twitter']["value"] ) ) : ?>
                            <li class="twitter"><a href="<?php echo esc_url( $porch_fields['twitter']["value"] ) ?>"><i class="fa fa-twitter"></i></a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="site-info wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="0.3s">
                    <p>
                        Made with &#10084;&#65039; by <a href="https://pray4movement.org">Pray4Movement.org</a><br>
                        Powered by <a href="https://disciple.tools">Disciple.Tools</a><br>
                        &copy; <?php echo esc_html( gmdate( "Y" ) ); ?>
                    </p>
                </div>
                <div class="site-info wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="0.3s">
                    <p><a href="<?php echo esc_html( site_url( '/contacts' ) ); ?>">Login</a> | <a href="<?php echo esc_html( admin_url( 'edit.php?post_type=landing&page=dt_porch_template' ) ); ?>">Page Settings</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Go To Top Link -->
<a href="#" class="back-to-top" aria-label="back to top">
    <i class="lnr lnr-arrow-up"></i>
</a>

<div id="loader">
    <div class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
    </div>
</div>
