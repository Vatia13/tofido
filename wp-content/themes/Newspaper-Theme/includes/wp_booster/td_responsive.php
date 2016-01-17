<?php

class td_responsive {

    var $responsive;

    function __construct() {


        add_action('wp_head', array($this, 'wp_head_hook'), 10);



        add_filter('body_class', array($this, 'body_class'));
    }


    function wp_head_hook() {
        $responsive = td_util::get_option('tds_responsive');
        td_js_buffer::add_variable('td_responsive', $responsive);
    }


    function body_class($classes) {
        $responsive = td_util::get_option('tds_responsive');
        switch ($responsive) {
            case '980_responsive':
                $classes[]= 'td_980_resp';
                $classes[]= 'td_responsive';
                break;

            case '980':
                $classes[]= 'td_980_not_resp';
                break;

            case '1170':
                $classes[]= 'td_1170_not_resp';
                break;

            default:
                $classes[]= 'td_responsive';
                break;
        }

        return $classes;
    }
}


new td_responsive();