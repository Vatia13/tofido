<?php
class td_footer_logo_widget extends WP_Widget {

    var $td_widget_builder;

    function __construct() {

        $this->td_widget_builder = new td_widget_builder($this);
        $this->td_widget_builder->td_map(
            array(
                "name" => __("Footer logo", TD_THEME_NAME),
                "base" => "footer_logo",
                "class" => "",
                "controls" => "full",
                "category" => __('Content', TD_THEME_NAME),
                "params" => array(
                    array(
                        "param_name" => "logo_url",
                        "type" => "textfield",
                        "value" => '',
                        "heading" => __("Logo url:", TD_THEME_NAME),
                        "holder" => "div",
                        "class" => ""
                    ),
                    array(
                        "param_name" => "logo_url_r",
                        "type" => "textfield",
                        "value" => '',
                        "heading" => __("Logo url retina:", TD_THEME_NAME),
                        "holder" => "div",
                        "class" => ""
                    ),
                    array(
                        "param_name" => "footer_text",
                        "type" => "textfield",
                        "value" => '',
                        "heading" => __("Footer text:", TD_THEME_NAME),
                        "holder" => "div",
                        "class" => ""
                    ),
                    array(
                        "param_name" => "footer_text_2",
                        "type" => "textfield",
                        "value" => '',
                        "heading" => __("Footer text line 2:", TD_THEME_NAME),
                        "holder" => "div",
                        "class" => ""
                    ),
                    array(
                        "param_name" => "footer_email",
                        "type" => "textfield",
                        "value" => '',
                        "heading" => __("Footer email:", TD_THEME_NAME),
                        "holder" => "div",
                        "class" => ""
                    )

                )
            )
        );

    }

    function form($instance) {
        $this->td_widget_builder->form($instance);
    }

    function update($new_instance, $old_instance) {
        return $this->td_widget_builder->update($new_instance, $old_instance);
    }

    function widget($args, $instance) {
        $buffy = '';
        $buffy .= '<div class="footer-logo-wrap">';
            if(!empty($instance['logo_url_r'])) {
                $buffy .= '<img  class="td-retina-data" src="' . $instance['logo_url'] . '" data-retina="'
                    . htmlentities($instance['logo_url_r']) . '" alt=""/>';
            } else {
                $buffy .= '<img src="' . $instance['logo_url'] . '" alt=""/>';
            }
        $buffy .= '</div>';

        $buffy .= '<div class="footer-text-wrap">';
            $buffy .= $instance['footer_text'];
        $buffy .= '</div>';

        if (!empty($instance['footer_text_2'])) {
            $buffy .= '<div class="footer-text-wrap">';
            $buffy .= $instance['footer_text_2'];
            $buffy .= '</div>';
        }


        if (!empty($instance['footer_email'])) {
            $buffy .= '<div class="footer-email-wrap">';
            $buffy .= __td('Contact us') . ': <a href="mailto:' . $instance['footer_email']  . '">' . $instance['footer_email'] . '</a>';
            $buffy .= '</div>';
        }
        //print_r($instance);
        echo $buffy;

    }



}

add_action('widgets_init', create_function('', 'return register_widget("td_footer_logo_widget");'));

