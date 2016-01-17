<?php


class td_popular_categories extends td_block {


    function __construct() {
        $this->block_id = 'td_popular_categories';
        add_shortcode('td_popular_categories', array($this, 'render'));
    }


    function render($atts){
        $this->block_uid = td_global::td_generate_unique_id(); //update unique id on each render
        extract(shortcode_atts(
            array(
                'limit' => '6',
                'custom_title' => '',
                'custom_url' => '',
                'hide_title' => '',
                'header_color' => ''
            ), $atts));

        $cat_args = array(
            'show_count' => true,
            'orderby' => 'count',
            'hide_empty' => false,
            'order' => 'DESC',
            'number' => $limit,
            'exclude' => get_cat_ID(TD_FEATURED_CAT)
        );


        if (TD_DEPLOY_MODE == 'demo' or TD_DEPLOY_MODE == 'dev') {
            $cat_args['exclude'] = '251, 252, 253, 254, 255, 256, 257, 258, 305, 306, ' . get_cat_ID(TD_FEATURED_CAT);
        }

        $categories = get_categories($cat_args);

        $buffy = '';

        $buffy .= '<div class="td_block_wrap td_popular_categories widget widget_categories">';
            $buffy .= $this->get_block_title_raw($atts, 'Popular category');

            if (!empty($categories)) {
                $buffy .= '<ul>';
                    foreach ($categories as $category) {
                        if (strtolower($category->cat_name) != 'uncategorized') {
                            $buffy .= '<li><a href="' . get_category_link($category->cat_ID) . '">' . $category->name . '<span class="td-cat-no">' . $category->count . '</span></a></li>';
                        }
                    }
                $buffy .= '</ul>';
            }
        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }

    function inner($posts, $td_column_number = '') {

    }


    function get_map () {
        return array(
            "name" => __("Popular category", TD_THEME_NAME),
            "base" => "td_popular_categories",
            "class" => "td_popular_categories",
            "controls" => "full",
            "category" => __('Blocks', TD_THEME_NAME),
            'icon' => 'icon-pagebuilder-popular_categories',
            "params" => array(
                array(
                    "param_name" => "limit",
                    "type" => "textfield",
                    "value" => "6",
                    "heading" => __("Limit the number of categories shown):", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "type" => "colorpicker",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Header color", TD_THEME_NAME),
                    "param_name" => "header_color",
                    "value" => '', //Default Red color
                    "description" => __("Choose a custom header color for this block", TD_THEME_NAME)
                ),
                array(
                    "param_name" => "custom_title",
                    "type" => "textfield",
                    "value" => "",
                    "heading" => __("Optional - custom title for this block:", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "custom_url",
                    "type" => "textfield",
                    "value" => "",
                    "heading" => __("Optional - custom url for this block (when the module title is clicked):", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "title_style",
                    "type" => "dropdown",
                    "value" => array('- default style -' => '', 'Style 1' => 'td_title_style_1'),
                    "heading" => __("Title style:", TD_THEME_NAME),
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
                )
            )
        );
    }

}



td_global_blocks::add_instance('td_popular_categories', new td_popular_categories());




