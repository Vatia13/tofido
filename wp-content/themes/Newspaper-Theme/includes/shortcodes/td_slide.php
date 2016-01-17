<?php


class td_slide extends td_block {


    function __construct() {
        $this->block_id = 'td_slide';
        add_shortcode('td_slide', array($this, 'render'));
    }


    function render($atts){
        $this->block_uid = td_global::td_generate_unique_id(); //update unique id on each render

        extract(shortcode_atts(
            array(
                'limit' => 5,
                'sort' => '',
                'category_id' => '',
                'category_ids' => '',
                'custom_title' => '',
                'custom_url' => '',
                'hide_title' => '',
                'show_child_cat' => '',
                'tag_slug' => '',
                'force_columns' => '', //used on categories
                'autoplay' => '',
                'header_color' => '',
                'class' => ''
            ),$atts));

        if (!empty($class)) {
            $class = ' ' . $class;
        }

        $buffy = ''; //output buffer
        $td_unique_id = td_global::td_generate_unique_id();


        $td_query = &td_data_source::get_wp_query($atts); //by ref  do the query


        if ($td_query->have_posts()) {
            //get the js for this block
            $buffy .= $this->get_block_js($atts, $td_query);


            $buffy .= '<div class="td_block_wrap td_block_slide td_normal_slide' . $class . '">';

            //get the block title
            $buffy .= $this->get_block_title($atts);

            //get the sub category filter for this block
            $buffy .= $this->get_block_sub_cats($atts, $td_unique_id);

            $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner">';
            //inner content of the block

            $buffy .= $this->inner($td_query->posts, $force_columns, $autoplay);

            $buffy .= '</div>';

            $buffy .= '</div> <!-- ./block1 -->';
        }
        return $buffy;
    }


    /**
     * @param $posts
     * @param string $td_column_number - get the column number
     * @param string $autoplay - not use via ajax
     * @param bool $is_ajax - if true the script will return the js inline, if not, it will use the td_js_buffer class
     * @return string
     */
    function inner($posts, $td_column_number = '', $autoplay = '', $is_ajax = false) {
        //global $post;

        $buffy = '';

        $td_block_layout = new td_block_layout();
        if (empty($td_column_number)) {
            $td_column_number = $td_block_layout->get_column_number(); // get the column width of the block
        }

        $td_post_count = 0; // the number of posts rendered
        $td_current_column = 1; //the current column

        $td_unique_id_slide = td_global::td_generate_unique_id();

        $buffy .= '<div id="' . $td_unique_id_slide . '" class="iosSlider iosSlider-col-' . $td_column_number . ' td_mod_wrap">';
        $buffy .= '<div class="slider ">';


        if (!empty($posts)) {
            foreach ($posts as $post) {
                //$buffy .= td_modules::mod_slide_render($post, $td_column_number, $td_post_count);
                $td_module_slide = new td_module_slide($post);
                $buffy .= $td_module_slide->render($td_column_number, $td_post_count);

                //current column
                if ($td_current_column == $td_column_number) {
                    $td_current_column = 1;
                } else {
                    $td_current_column++;
                }


                $td_post_count++;
            }
        }



        $buffy .= $td_block_layout->close_all_tags();





        $buffy .= '</div>'; //close slider


        $buffy .= '<div class = "prevButton"></div>';
        $buffy .= '<div class = "nextButton"></div>';

        $buffy .= '</div>'; //clos ios

        if (!empty($autoplay)) {
            $autoplay_string =  '
            autoSlide: true,
            autoSlideTimer: ' . $autoplay * 1000 . ',
            ';
        } else {
            $autoplay_string = '';
        }


        $slide_js = '
jQuery(document).ready(function() {
    jQuery("#' . $td_unique_id_slide . '").iosSlider({
        snapToChildren: true,
        desktopClickDrag: true,
        keyboardControls: false,
        ' . $autoplay_string. '

        infiniteSlider: true,
        navPrevSelector: jQuery("#' . $td_unique_id_slide . ' .prevButton"),
        navNextSelector: jQuery("#' . $td_unique_id_slide . ' .nextButton"),
        onSlideComplete: slideContentComplete,
        onSlideStart: slideStartedMoving
    });
});
    ';

        if ($is_ajax) {
            $buffy .= '<script>' . $slide_js . '</script>';
        } else {
            td_js_buffer::add_to_footer($slide_js);
        }

        return $buffy;
    }


    function get_map () {

        //get the generic filter array
        $generic_filter_array = td_generic_filter_array::get_array();

        //add custom filter fields to generic filter array
        array_push ($generic_filter_array,
            array(
                "param_name" => "autoplay",
                "type" => "textfield",
                "value" => '',
                "heading" => 'Autoplay slider (at x seconds)',
                "description" => "Leave empty do disable autoplay",
                "holder" => "div",
                "class" => ""
            ),
            array(
                "param_name" => "limit",
                "type" => "textfield",
                "value" => __("5", TD_THEME_NAME),
                "heading" => __("Limit post number:", TD_THEME_NAME),
                "description" => "",
                "holder" => "div",
                "class" => ""
            ),
            array(
                "param_name" => "offset",
                "type" => "textfield",
                "value" => __("", TD_THEME_NAME),
                "heading" => __("Offset posts:", TD_THEME_NAME),
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
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Header text color", TD_THEME_NAME),
                "param_name" => "header_text_color",
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
                "param_name" => "show_child_cat",
                "type" => "dropdown",
                "value" => array('- Hide -' => '', 'Show 1 category' => '1', 'Show 2 categories' => '2', 'Show 3 categories' => '3', 'Show 4 categories' => '4', 'Show 5 categories' => '5', 'Show 6 categories' => '6', 'Show 7 categories' => '7', 'Show 8 categories' => '8', 'Show all' => 'all'),
                "heading" => __("Show child categories menu:", TD_THEME_NAME),
                "description" => "This will show a menu at the top of the block that contains the child categories of the selected category. It only works when you're using a single category filter form the dropdown. It doss't work with multiple categories IDs",
                "holder" => "div",
                "class" => ""
            )
        );

        return array(
            "name" => __("Slide", TD_THEME_NAME),
            "base" => "td_slide",
            "class" => "td_slide",
            "controls" => "full",
            "category" => __('Blocks', TD_THEME_NAME),
            'icon' => 'icon-pagebuilder-slide',
            "params" => $generic_filter_array
        );


    }

}



td_global_blocks::add_instance('Slide', new td_slide());




