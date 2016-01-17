<?php


//here we store the global statet

class td_global {

    static $td_options; //here we store all the options of the theme will be used in td_first_install.php

    static $current_template = ''; //used by page-homepage-loop, 404


    static $current_author_obj; //set by the author page template, used by widgets

    static $cur_url_page_id; //the id of the main page (if we have loopp in loop, it will return the id of the page that has the uri)

    static $load_sidebar_from_template; //used by some templates for custom sidebars (setted by page-homepage-loop.php etc)

    static $load_featured_img_from_template; //used by single.php to instruct td_module_1 to load the full with thumb when necessary (ex. no sidebars)

    static $cur_single_template_sidebar_pos = ''; // set in single.php - used by the gallery short code to show appropriate images

    static $is_bbpress_forum_home = false; //used by breadcrumbs


    static $category_background = '';



    static $http_or_https = 'http'; //is set below with either http or https string



    private static $post = '';
    private static $primary_category = '';
    private static $td_unique_counter = 0;


    //the list of post templates (filename without extension -> template name)
    static $post_templates_list = array (
        'single_template_1' => 'Single template 1',
        'single_template_2' => 'Single template 2',
        'single_template_3' => 'Single template 3',
        'single_template_4' => 'Single template 4',
        'single_template_5' => 'Single template 5'
    );



    //the js files that we use
    static $js_files = array (
        'td_external' => 'td_external.js',
        'td_detect' => 'td_detect.js',
        'td_local_cache' => 'td_local_cache.js',
        'td_util' => 'td_util.js',
        'td_affix' => 'td_affix.js',
        'td_site' => 'td_site.js',
        'td_loading_box' => 'td_loading_box.js',
        'td_blocks' => 'td_blocks.js',
        'td_sprite_3d' => 'td_sprite_3d.js',
        'td_events' => 'td_events.js',
        'td_post_images' => 'td_post_images.js',
        'td_backstretch' => 'td_backstretch.js',
        'td_template_single_1' => 'td_template_single_1.js',
        'td_login' => 'td_login.js',
        'td_style_customizer' => 'td_style_customizer.js',
        'td_ajax_count' => 'td_ajax_count.js'
    );


    static function load_single_post($post) {

            self::$post = $post;


        /*  ----------------------------------------------------------------------------
            update the primary category Only on single posts :0
         */
        if (is_single()) {
            //read the post setting
            $td_post_theme_settings = get_post_meta(self::$post->ID, 'td_post_theme_settings', true);
            if (!empty($td_post_theme_settings['td_primary_cat'])) {
                self::$primary_category = $td_post_theme_settings['td_primary_cat'];
                return;
            }

            $categories = get_the_category(self::$post->ID);
            foreach($categories as $category) {
                if ($category->name != TD_FEATURED_CAT) { //ignore the featured category name
                    self::$primary_category = $category->cat_ID;
                    break;
                }
            }
        }
    }


    //used on single posts
    static function get_primary_category_id() {
        if (empty(self::$post->ID)) {
            return get_queried_object_id();
        }
        return self::$primary_category;
    }


    //generate unique_ids
    static function td_generate_unique_id() {
        self::$td_unique_counter++;
        return 'td_uid_' . self::$td_unique_counter . '_' . uniqid();
    }

}


if (is_ssl()) {
    td_global::$http_or_https = 'https';
}