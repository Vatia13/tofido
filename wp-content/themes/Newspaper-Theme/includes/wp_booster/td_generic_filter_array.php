<?php

/**
 *  generic filter array used in blocks, slides and templetes with article list
 */

class td_generic_filter_array {

    function __construct() {
    }

    static function get_array () {
        return array(
                array(
                    "param_name" => "category_id",
                    "type" => "dropdown",
                    "value" => td_util::get_category2id_array(),
                    "heading" => __("Category filter:", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "category_ids",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => __("Multiple categories filter:", TD_THEME_NAME),
                    "description" => "To filter multiple categories, enter here the category IDs separated by commas (example: 13,23,18)",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "tag_slug",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => __("Filter by tag slug:", TD_THEME_NAME),
                    "description" => "To filter multiple tag slug, enter here the tag slugs separated by commas (example: tag1,tag2,tag3)",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "sort",
                    "type" => "dropdown",
                    "value" => array('- Latest -' => '', 'Random posts Today' => 'random_today' , 'Random posts from last 7 Day' => 'random_7_day' , 'Alphabetical A -> Z' => 'alphabetical_order', 'Popular (all time)' => 'popular', 'Popular (last 7 days; enable first from ' . TD_THEME_NAME . ' Panel -> Post Settings -> Use 7 days post sorting)' => 'popular7' , 'Featured' => 'featured', 'Highest rated (reviews)' => 'review_high', 'Random Posts' => 'random_posts', 'Most Commented' => 'comment_count'),
                    "heading" => __("Sort order:", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "autors_id",
                    "type" => "dropdown",
                    "value" => td_util::create_array_authors(),
                    "heading" => "Autors Filter:",
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                     "param_name" => "hide_title",
                     "type" => "dropdown",
                     "value" => array('- Show title -' => '', 'Hide title' => 'hide_title'),
                     "heading" => __("Hide block title:", TD_THEME_NAME),
                     "description" => "",
                     "holder" => "div",
                     "class" => ""
                ),
                array(
                    "param_name" => "installed_post_types",
                    "type" => "textfield",
                    "value" =>  '',//td_util::create_array_installed_post_types(),
                    "heading" => __("Post Type:", TD_THEME_NAME),
                    "description" => "Usage: post OR post,events,pages ; write 1 or more post types delimited by comas",
                    "holder" => "div",
                    "class" => ""
                )
        );//end generic array
    }//end get_map function

}


