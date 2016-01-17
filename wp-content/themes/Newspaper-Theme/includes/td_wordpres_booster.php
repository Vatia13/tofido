<?php

/**
 * WordPress booster V1.0 by tagDiv
 */


// ~ app config ~ theme config
require_once('wp_booster/td_config.php');



/*  ----------------------------------------------------------------------------
    localization
 */

function td_load_text_domains(){
    $lt_text_domain = load_theme_textdomain(TD_THEME_NAME, get_template_directory() . '/translation');

    /*
    if ($lt_text_domain === false) {
        echo "Translation not loaded";
    }
    */

    // theme specific config values
    require_once('wp_booster/td_translate.php');

}
add_action('after_setup_theme', 'td_load_text_domains');




// theme specific config values
require_once('wp_booster/td_global.php');
require_once('wp_booster/td_global_blocks.php');

//add cookie support for demo only
if (TD_DEBUG_LIVE_THEME_STYLE) {
    require_once('wp_booster/demo/td_theme_demo_cookies.php' );
}

// Util class
require_once('wp_booster/td_util.php');


/*
 * the code that runs on the first install of the theme
 */
require_once('wp_booster/td_first_install.php');



//fonts support
require_once("wp_booster/td_fonts.php");





//theme menu
require_once('wp_booster/td_menu.php');


// ajax
require_once("wp_booster/td_ajax.php");


// The social icons
require_once('wp_booster/td_social_icons.php');

// Review
require_once('wp_booster/td_review.php');




// vide thumbnail support
require_once('wp_booster/td_video_support.php');


// page views counter
require_once('wp_booster/td_page_views.php');

// css buffer class
require_once('wp_booster/td_css_buffer.php');

// js buffer class
require_once('wp_booster/td_js_buffer.php');

// page generator
require_once('wp_booster/td_page_generator.php');

// block layout
require_once('wp_booster/td_block_layout.php');

// template layout
require_once('wp_booster/td_template_layout.php');

//unique posts (uses hooks + do_action('td_wp_boost_new_module'); )
require_once('wp_booster/td_unique_posts.php');

// data source
require_once('wp_booster/td_data_source.php');

// module builder
require_once('wp_booster/td_module.php');

// block builder
require_once('wp_booster/td_block.php');

// widget builder
require_once('wp_booster/td_widget_builder.php');







// css compiler
require_once('wp_booster/td_css_compiler.php');




// ~ app config ~ css generator
require_once('wp_booster/td_css_generator.php');


// ~ app config ~ css generator
require_once('wp_booster/td_js_generator.php');



//the background support
require_once('wp_booster/td_background.php');


//the responsive support
require_once('wp_booster/td_responsive.php');


//modules modifier
locate_template('includes/modules/module_modifier/td_module_blog.php', true);


//modules
//get_template_part('includes/modules/td_module_1');
locate_template('includes/modules/td_module_1.php', true);
locate_template('includes/modules/td_module_2.php', true);
locate_template('includes/modules/td_module_3.php', true);
locate_template('includes/modules/td_module_4.php', true);
locate_template('includes/modules/td_module_5.php', true);
locate_template('includes/modules/td_module_6.php', true);
locate_template('includes/modules/td_module_7.php', true);
locate_template('includes/modules/td_module_8.php', true);
locate_template('includes/modules/td_module_9.php', true);
locate_template('includes/modules/td_module_slide.php', true);
locate_template('includes/modules/td_module_slide_big.php', true);
locate_template('includes/modules/td_module_aj_search.php', true);
locate_template('includes/modules/td_module_search.php', true);
locate_template('includes/modules/td_module_mega_menu.php', true);
//locate_template('includes/modules/td_module_big_grid.php', true);


//blocks
require_once('shortcodes/td_block_1.php');
require_once('shortcodes/td_block_2.php');
require_once('shortcodes/td_block_3.php');
require_once('shortcodes/td_block_4.php');
require_once('shortcodes/td_block_5.php');
//new blocks
require_once('shortcodes/td_block_6.php');
require_once('shortcodes/td_block_7.php');
require_once('shortcodes/td_block_8.php');
require_once('shortcodes/td_block_9.php');
require_once('shortcodes/td_block_mega_menu.php');


require_once('shortcodes/gallery.php');
require_once('shortcodes/td_menu.php');
require_once('shortcodes/td_misc.php');
require_once('shortcodes/td_ad_box.php');
require_once('shortcodes/td_social.php');
require_once('shortcodes/td_popular_categories.php');
require_once('shortcodes/td_authors.php');
require_once('shortcodes/td_text_with_title.php');
require_once('shortcodes/td_slide.php');
require_once('shortcodes/td_slide_big.php');
require_once('shortcodes/td_revolution_slider.php');
//require_once('shortcodes/td_block_big_grid.php');

//widgets
require_once('widgets/td_page_builder_widgets.php');
require_once('widgets/td_footer_logo_widget.php');
require_once('widgets/td_login_widget.php');


// the demo site
require_once('wp_booster/td_demo_site.php');





/*
 * generic filter support
 */
require_once('wp_booster/td_generic_filter_array.php');



/*
 * generic filter buider class
 */
require_once('wp_booster/td_generic_filter_builder.php');



/*
 * modal window for user login :)
 */
require_once('wp_booster/td_login.php');


/*
 * author meta support
 */
require_once('wp_booster/td_author.php' );










/*
 * if debug - the constants are used to load the live color customizer (demo) and to remove the tf bar on ios devices
 */
if (TD_DEBUG_LIVE_THEME_STYLE) {
    require_once('wp_booster/demo/td_theme_style.php' );
}

if (TD_DEBUG_IOS_REDIRECT) {
    require_once('wp_booster/demo/td_ios_redirect.php' );
}


/**
 * handles background click ad
 */
require_once('wp_booster/td_ads.php');


/**
 * handles more articles box
 */
require_once('wp_booster/td_more_article_box.php');







if (is_admin()) {
    /*  -----------------------------------------------------------------------------
        TGM_Plugin_Activation
     */
    require_once 'wp_booster/external/class-tgm-plugin-activation.php';

    add_action('tgmpa_register', 'td_required_plugins');

    function td_required_plugins() {

        /**
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
        $plugins = array(

            array(
                'name'     				=> 'tagDiv social counter', // The plugin name
                'slug'     				=> 'td-social-counter', // The plugin slug (typically the folder name)
                'source'   				=> get_template_directory_uri() . '/includes/plugins/td-social-counter.zip', // The plugin source
                'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
                'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
            ),
            array(
                'name'     				=> 'Revolution slider', // The plugin name
                'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
                'source'   				=> get_template_directory_uri() . '/includes/plugins/revslider.zip', // The plugin source
                'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
                'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
            ),


            // This is an example of how to include a plugin pre-packaged with a theme
            array(
                'name'			=> 'WPBakery Visual Composer', // The plugin name
                'slug'			=> 'js_composer', // The plugin slug (typically the folder name)
                'source'			=> get_stylesheet_directory() . '/includes/plugins/js_composer.zip', // The plugin source
                'required'			=> true, // If false, the plugin is only 'recommended' instead of required
                'version'			=> '3.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'		=> '', // If set, overrides default API URL and points to an external URL
            ),


            // This is an example of how to include a plugin from the WordPress Plugin Repository
            array(
                'name' 		=> 'Jetpack',
                'slug' 		=> 'jetpack',
                'required' 	=> false,
            ),
            array(
                'name' 		=> 'Animated Gif Resize',
                'slug' 		=> 'animated-gif-resize',
                'required' 	=> false,
            ),
            array(
                'name' 		=> 'Contact form 7',
                'slug' 		=> 'contact-form-7',
                'required' 	=> false,
            )

        );

        // Change this to your theme text domain, used for internationalising strings
        $theme_text_domain = 'tgmpa';

        /**
         * Array of configuration settings. Amend each line as needed.
         * If you want the default strings to be available under your own theme domain,
         * leave the strings uncommented.
         * Some of the strings are added into a sprintf, so see the comments at the
         * end of each line for what each argument will be.
         */
        $config = array(
            'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
            'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
            'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
            'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
            'menu'         		=> 'install-required-plugins', 	// Menu slug
            'has_notices'      	=> true,                       	// Show admin notices or not
            'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
            'message' 			=> '',							// Message to output right before the plugins table
            'strings'      		=> array(
                'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
                'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
                'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
                'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
                'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
                'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
                'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
                'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
                'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
                'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
                'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
                'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
                'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
                'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
                'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
                'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
                'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
                'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
            )
        );

        tgmpa( $plugins, $config );

    }
}





do_action('td_wp_booster_loaded'); //used by our plugins
do_action('td_wp_cake_loaded'); // DEPRECATED used by our plugins - makes old tagdiv plugins work with this theme