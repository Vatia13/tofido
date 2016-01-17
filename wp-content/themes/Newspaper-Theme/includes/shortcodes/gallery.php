<?php
/*  ----------------------------------------------------------------------------
    This file works on top of the wordpress default shortcode.
 */



function td_shortcode_atts_gallery($atts) {
    //make medium size thumbnails
    if ($atts['size'] == 'thumbnail') {
        $atts['size'] = 'medium';
    }
    return $atts;
}

add_filter('shortcode_atts_gallery', 'td_shortcode_atts_gallery');
