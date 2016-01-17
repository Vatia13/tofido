<?php


class td_block_2 extends td_block {


    function __construct() {
        $this->block_id = 2;
        add_shortcode('td_block2', array($this, 'render'));
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
                'header_color' => ''
            ),$atts));

        $buffy = ''; //output buffer
        $td_unique_id = td_global::td_generate_unique_id();


        $td_query = &td_data_source::get_wp_query($atts); //by ref  do the query

        //get the js for this block
        $buffy .= $this->get_block_js($atts, $td_query);

        $buffy .= '<div class="td_block_wrap td_block2">';

        //get the block title
        $buffy .= $this->get_block_title($atts);

        //get the sub category filter for this block
        $buffy .= $this->get_block_sub_cats($atts, $td_unique_id);

        $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner">';
        //inner content of the block
        $buffy .= $this->inner($td_query->posts);
        $buffy .= '</div>';

        //get the ajax pagination for this block
        $buffy .= $this->get_block_pagination($atts, $td_unique_id);
        $buffy .= '</div> <!-- ./block1 -->';
        return $buffy;
    }

    function inner($posts, $td_column_number = '') {
        //global $post;



        $buffy = '';

        $td_block_layout = new td_block_layout();
        if (empty($td_column_number)) {
            $td_column_number = $td_block_layout->get_column_number(); // get the column width of the block
        }



        $td_post_count = 0; // the number of posts rendered
        $td_current_column = 1; //the current column

        if (!empty($posts)) {
            foreach ($posts as $post) {

                $td_module_3 = new td_module_3($post);
                $td_module_5 = new td_module_5($post);


                switch ($td_column_number) {

                    case '1': //one column layout
                        if ($td_post_count == 0) { //first post
                            $buffy .= $td_module_5->render();
                        } else {
                            $buffy .= $td_module_3->render();
                        }
                        break;

                    case '2': //two column layout
                        $buffy .= $td_block_layout->open_row();

                        if ($td_post_count <= 1) { // big posts
                            $buffy .= $td_block_layout->open6();
                            $buffy .= $td_module_5->render();
                            $buffy .= $td_block_layout->close6();
                        }

                        if ($td_post_count == 1) { //close big posts
                            $buffy .= $td_block_layout->close_row();
                        }

                        if ($td_post_count > 1) { //4th post (big posts are rendered)
                            if ($td_current_column == 1) { // column 1
                                $buffy .= $td_block_layout->open_row();
                            }

                            $buffy .= $td_block_layout->open6();
                            $buffy .= $td_module_3->render();
                            $buffy .= $td_block_layout->close6();

                            if ($td_current_column == 2) { // column 2
                                $buffy .= $td_block_layout->close_row();
                            }
                        }
                        break;

                    case '3': //three column layout
                        $buffy .= $td_block_layout->open_row();

                        if ($td_post_count <= 2) { // big posts
                            $buffy .= $td_block_layout->open4();
                            $buffy .= $td_module_5->render();
                            $buffy .= $td_block_layout->close4();
                        }

                        if ($td_post_count == 2) { //close big posts
                            $buffy .= $td_block_layout->close_row();
                        }

                        if ($td_post_count > 2) { //4th post (big posts are rendered)
                            if ($td_current_column == 1) { // column 1
                                $buffy .= $td_block_layout->open_row();
                            }

                            $buffy .= $td_block_layout->open4();
                            $buffy .= $td_module_3->render();
                            $buffy .= $td_block_layout->close4();

                            if ($td_current_column == 3) { // column 3
                                $buffy .= $td_block_layout->close_row();
                            }
                        }
                        break;
                }

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
        return $buffy;
    }


    function get_map () {

        //get the generic filter array
        $generic_filter_array = td_generic_filter_array::get_array();

        //add custom filter fields to generic filter array
        array_push ($generic_filter_array,
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
            ),
            array(
                "param_name" => "sub_cat_ajax",
                "type" => "dropdown",
                "value" => array('- Use ajax -' => '', 'Do not use ajax' => 'n'),
                "heading" => __("Use ajax in child categories menu:", TD_THEME_NAME),
                "description" => "",
                "holder" => "div",
                "class" => ""
            ),
            array(
                "param_name" => "ajax_pagination",
                "type" => "dropdown",
                "value" => array('- No pagination -' => '', 'Next Prev ajax' => 'next_prev', 'Load More button' => 'load_more', 'Infinite load' => 'infinite'),
                "heading" => __("Pagination:", TD_THEME_NAME),
                "description" => "",
                "holder" => "div",
                "class" => ""
            )
        );

        return array(
            "name" => __("Block 2", TD_THEME_NAME),
            "base" => "td_block2",
            "class" => "td_block2",
            "controls" => "full",
            "category" => __('Blocks', TD_THEME_NAME),
            'icon' => 'icon-pagebuilder-block2',
            "params" => $generic_filter_array
        );


    }

}



td_global_blocks::add_instance('Block 2', new td_block_2());




