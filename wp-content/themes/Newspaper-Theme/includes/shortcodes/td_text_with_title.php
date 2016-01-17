<?php
class td_text_with_title extends td_block {
    function __construct() {
        $this->block_id = 'td_text_with_title';
        add_shortcode('td_text_with_title', array($this, 'render'));
    }



    function render($atts, $content = null) {

        extract(shortcode_atts(
            array(
                'image_pos' => ''
            ),$atts));


        $td_img_first_class = '';
        if ($image_pos == 'img_first') {
            $td_img_first_class = ' td_img_first';
        }


        $buffy = '';
        $buffy .= '<div class="td_block_wrap td_text_with_title' . $td_img_first_class . '">';
            $buffy .= $this->get_block_title_raw($atts, 'Please select a title');


            $buffy .= '<div class="td_mod_wrap">';
                //only run the filter if we have visual composer
                if (function_exists('wpb_js_remove_wpautop')) {
                    $buffy .= wpb_js_remove_wpautop($content);
                } else {
                    $buffy .= $content;   //no visual composer
                }

            $buffy .= '</div>';
        $buffy .= '</div>';


        return $buffy;

    }



    function get_map() {

        return  array(
            "name" => __("Text with title", TD_THEME_NAME),
            "base" => "td_text_with_title",
            "class" => "",
            "controls" => "full",
            "category" => __('Content', TD_THEME_NAME),
            'icon' => 'icon-pagebuilder-title',
            "params" => array(
                array(
                    "param_name" => "custom_title",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => "Block title",
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "content",
                    "type" => "textarea_html",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Text", TD_THEME_NAME),
                    "value" => "",
                    "description" => __("Enter your content.", TD_THEME_NAME)
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
                    "param_name" => "title_style",
                    "type" => "dropdown",
                    "value" => array('- default style -' => '', 'Style 1' => 'td_title_style_1'),
                    "heading" => __("Title style:", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "image_pos",
                    "type" => "dropdown",
                    "value" => array('- text first -' => '', 'image first' => 'img_first'),
                    "heading" => __("Alignment:", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                )
            )
        );
    }
}

td_global_blocks::add_instance('Text with title', new td_text_with_title());


