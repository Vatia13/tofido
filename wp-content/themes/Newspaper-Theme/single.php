<?php
global $loop_module_id, $loop_sidebar_position, $post;


td_global::load_single_post($post);


/*  ----------------------------------------------------------------------------
    the post template (single article template)
 */

get_header();


/* used by
    /includes/app/modules/module_modifier/td_module_blog.php
    /sidebar.php
*/



//set the template id, used to get the template specific settings
$template_id = 'home';  //home = blog index = blog - use the same settings from the blog index

//prepare the loop variables

//read the global settings
$loop_sidebar_position = td_util::get_option('tds_' . $template_id . '_sidebar_pos'); //sidebar right is default (empty)
$loop_module_id = 1; //use the default 1 module (full post)



//print_r($td_post_theme_settings);

//read the primary category sidebar position! - we have to make the page after the primary category or after the global setting
$primary_category_id = td_global::get_primary_category_id();
if (!empty($primary_category_id)) {
    $tax_meta_sidebar = td_util::get_category_option($primary_category_id, 'tdc_sidebar_pos');//swich by RADU A, get_tax_meta($primary_category_id, 'tdc_sidebar_pos');
    if (!empty($tax_meta_sidebar)) {
        //update the sidebar position from the category setting
        $loop_sidebar_position = $tax_meta_sidebar;
    }
}


//read the custom single post settings - this setting overids all of them
$td_post_theme_settings = get_post_meta($post->ID, 'td_post_theme_settings', true);
if (!empty($td_post_theme_settings['td_sidebar_position'])) {
    $loop_sidebar_position = $td_post_theme_settings['td_sidebar_position'];
}

//send the sidebar position to gallery
td_global::$cur_single_template_sidebar_pos = $loop_sidebar_position;

//increment the views counter
td_page_views::update_page_views($post->ID);


//added by Radu A. check if this post have a post template to be display with.
//if not use the default site post template from Theme Panel -> Post Settings -> Default site post template
$td_default_site_post_template = td_util::get_option('td_default_site_post_template');

if(empty($td_post_theme_settings['td_post_template']) and !empty($td_default_site_post_template)) {
    $td_post_theme_settings['td_post_template'] = $td_default_site_post_template;
}


if (empty($td_post_theme_settings['td_post_template'])) {
    // the default single template

    // we check the sidebar position and for each one we have a different case
    switch ($loop_sidebar_position) {


        default: // sidebar right - the default sidebar position
            echo td_page_generator::wrap_start();
            ?>
                <div class="span8 column_container td-post-content" role="main" itemprop="mainContentOfPage">
                    <?php
                    locate_template('loop-single.php', true);
                    comments_template('', true);
                    ?>
                </div>
                <div class="span4 column_container td-post-sidebar" role="complementary" itemscope="itemscope" itemtype="<?php echo td_global::$http_or_https?>://schema.org/WPSideBar">
                    <?php get_sidebar(); ?>
                </div>
            <?php
            echo td_page_generator::wrap_end();
            break;


        case 'sidebar_left':
            echo td_page_generator::wrap_start();
            ?>
            <div class="span4 column_container td-post-sidebar" role="complementary" itemscope="itemscope" itemtype="<?php echo td_global::$http_or_https?>://schema.org/WPSideBar">
                <?php get_sidebar(); ?>
            </div>
            <div class="span8 column_container td-post-content" role="main" itemprop="mainContentOfPage">
                <?php
                locate_template('loop-single.php', true);
                comments_template('', true);
                ?>
            </div>
            <?php
            echo td_page_generator::wrap_end();
            break;

        case 'no_sidebar':
            //td_global::$load_featured_img_from_template = 'art-slide-big';
            td_global::$load_featured_img_from_template = 'full';
            echo td_page_generator::wrap_start();
            ?>
            <div class="span12 column_container td-post-content" role="main" itemprop="mainContentOfPage">
                <?php
                locate_template('loop-single.php', true);
                comments_template('', true);
                ?>
            </div>
            <?php
            echo td_page_generator::wrap_end();
            break;




    }

} else {
    //the user has selected a different template & we make sure we only load our templates - the list of allowed templates is in includes/wp_booster/td_global.php
    if (array_key_exists ($td_post_theme_settings['td_post_template'], td_global::$post_templates_list)) {
        locate_template($td_post_theme_settings['td_post_template'] . '.php', true);
    }
}
get_footer();