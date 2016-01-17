<?php

class td_css_buffer {
    static $css_header_buffer = '';

    static function add($css) {
        self::$css_header_buffer .= "\n" . $css;
    }

    static function render() {

        //run the filter
        self::$css_header_buffer = apply_filters("td_css_buffer_render", self::$css_header_buffer);

        if (trim(self::$css_header_buffer) != '') {
            self::$css_header_buffer = "\n<!-- Style compiled by theme -->" . "\n\n<style>\n    " . self::$css_header_buffer . "\n</style>\n\n";
            return self::$css_header_buffer;
        } else {
            return;
        }
    }
}


function td_css_buffer_render() {
    echo td_css_buffer::render();
}


function td_css_buffer_footer_render() {
    echo td_css_buffer::render_footer();
}

if (defined('TD_SPEED_BOOSTER')) {
    //if we have the speed booster plugin, we will render the css at the end of the page
    add_action('wp_footer', 'td_css_buffer_render', 100);
} else {
    //default, render at the top of the page
    add_action('wp_head', 'td_css_buffer_render', 15); //priority 10 is used by the css compiler
}



