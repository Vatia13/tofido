<?php
/* Template Name: Homepage - bg - no article list */

get_header();


td_global::$current_template = 'page-homepage-loop';

global $paged, $loop_module_id, $loop_sidebar_position, $post;
$td_page = (get_query_var('page')) ? get_query_var('page') : 1; //rewrite the global var
$td_paged = (get_query_var('paged')) ? get_query_var('paged') : 1; //rewrite the global var


//paged works on single pages, page - works on homepage
if ($td_paged > $td_page) {
    $paged = $td_paged;
} else {
    $paged = $td_page;
}


$list_custom_title_show = true; //show the article list title by default


$td_slide_limit = 4; //number of posts to show on slider
$td_slide_background = ''; //the url for the background


/*
    read the settings for the loop
---------------------------------------------------------------------------------------- */
if (!empty($post->ID)) {
    td_global::load_single_post($post);

    $td_homepage_loop = get_post_meta($post->ID, 'td_homepage_loop', true);

    if (!empty($td_homepage_loop['td_layout'])) {
        $loop_module_id = $td_homepage_loop['td_layout'];
    }

    if (!empty($td_homepage_loop['td_sidebar_position'])) {
        $loop_sidebar_position = $td_homepage_loop['td_sidebar_position'];
    }

    if (!empty($td_homepage_loop['td_sidebar'])) {
        td_global::$load_sidebar_from_template = $td_homepage_loop['td_sidebar'];
    }

    if (!empty($td_homepage_loop['list_custom_title'])) {
        $td_list_custom_title = $td_homepage_loop['list_custom_title'];
    } else {
        $td_list_custom_title =__td('LATEST ARTICLES');
    }


    if (!empty($td_homepage_loop['list_custom_title_show'])) {
        $list_custom_title_show = false;
    }

}


/*
    big slide
---------------------------------------------------------------------------------------- */
//load the author box located in - parts/page-homepage-slider.php - can be overwritten by the child theme
locate_template('parts/page-homepage-slider.php', true);




echo td_page_generator::wrap_no_row_start();

/*
    the content if we have one
---------------------------------------------------------------------------------------- */
if(!empty($post->post_content)) { //show this only when we have content
    if (empty($paged) or $paged < 2) { //show this only on the first page

        ?>
        <div class="row-fluid">
            <div class="span12 column_container" role="complementary" itemscope="itemscope" itemtype="<?php echo td_global::$http_or_https?>://schema.org/WPSideBar">
                <?php
                if (have_posts()) {
                    while ( have_posts() ) : the_post();
                        //read the page settings
                        the_content();
                    endwhile; //end loop
                }
                ?>
            </div>
        </div>
    <?php

    }
}




echo td_page_generator::wrap_no_row_end();



get_footer();
?>