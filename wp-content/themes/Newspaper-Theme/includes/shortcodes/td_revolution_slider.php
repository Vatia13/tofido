<?php


class td_revolution_slider extends td_block {


    function __construct() {
        $this->block_id = 'td_revolution_slider';
        add_shortcode('td_revolution_slider', array($this, 'render'));
    }


    function render($atts){
        $this->block_uid = td_global::td_generate_unique_id(); //update unique id on each render
        extract(shortcode_atts(
            array(
                'alias' => ''
            ),$atts));

        $buffy = '';


        $buffy .= '<div class="td_block_wrap td_revolution_slider">';
        $buffy .= $this->get_block_title_raw($atts, '');


        $buffy .= '<div class="td_mod_wrap">';
            $buffy .= do_shortcode('[rev_slider ' . $alias . ']');
        $buffy .= '</div>';
        $buffy .= '</div>';


        return $buffy;
    }




    function get_map () {
        global $wpdb;
        $rs = $wpdb->get_results(
            "
            SELECT id, title, alias
            FROM ".$wpdb->prefix."revslider_sliders
  	ORDER BY id ASC LIMIT 100
  	"
        );
        $revsliders = array();
        if ($rs) {
            foreach ( $rs as $slider ) {
                $revsliders[$slider->title] = $slider->alias;
            }
        } else {
            $revsliders["No sliders found"] = 0;
        }



        return array(
            "name" => __("Revolution slider", TD_THEME_NAME),
            "base" => "td_revolution_slider",
            "class" => "td_revolution_slider",
            "controls" => "full",
            "category" => __('Blocks', TD_THEME_NAME),
            'icon' => 'icon-pagebuilder-slide',
            "params" =>
            array(
                array(
                    "type" => "dropdown",
                    "heading" => __("Revolution Slider", "js_composer"),
                    "param_name" => "alias",
                    "admin_label" => true,
                    "value" => $revsliders,
                    "description" => __("Select your Revolution Slider.", "js_composer")
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
                )
            )
        );
    }

}


//detect the slider
if (isset($revSliderVersion)) {
    //add this shortcode only when rev slider is active
    td_global_blocks::add_instance('Revolution slider', new td_revolution_slider());
}
