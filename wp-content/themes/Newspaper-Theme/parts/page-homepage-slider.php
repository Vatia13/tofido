<?php

/*  ----------------------------------------------------------------------------
    This is the slider used in:
    - page-homepage-bg.php
    - page-homepage-bg-loop.php
 */


global $post, $paged;

$td_slide_limit = 8; //number of posts to show on slider
$td_slide_background = ''; //the url for the background
$td_slide_b_color = '';


apply_filters("td_part_page_home_slider", ''); // used by td_unique_posts to hook up and keep track of the posts that are shown on the slider.


/*
    read the settings for the loop
---------------------------------------------------------------------------------------- */
if (!empty($post->ID)) {

    //get the slide settings:
    $td_homepage_loop_slide = get_post_meta($post->ID, 'td_homepage_loop_slide', true);
    if (!empty($td_homepage_loop_slide['td_slide_limit'])) {
        $td_slide_limit = $td_homepage_loop_slide['td_slide_limit'];
    }

    if (!empty($td_homepage_loop_slide['td_slide_background'])) {
        $td_slide_background = $td_homepage_loop_slide['td_slide_background'];
    }

    if (!empty($td_homepage_loop_slide['td_slide_b_color']) and $td_homepage_loop_slide['td_slide_b_color'] != '#') {
        $td_slide_b_color = $td_homepage_loop_slide['td_slide_b_color'];
    }
}



if (empty($paged) or $paged < 2) {
    echo td_page_generator::wrap_no_row_with_bg_start();
    if (empty($paged) or $paged < 2) { //show this only on the first page
    ?>
    <div class="row-fluid">
        <div class="span12 column_container">
            <?php
            echo td_global_blocks::get_instance('td_slide_big')->render(array(
                'sort' => 'featured',
                'hide_title' => 'hide_title',
                'force_columns' => 3,
                'limit' => $td_slide_limit
            ));
            ?>
        </div>
    </div>
    <?php
    }
    echo td_page_generator::wrap_no_row_with_bg_end();


    /*
    if (!empty($td_slide_background)) {
        echo '<script>' . "\n";
        echo 'jQuery().ready(function() {' . "\n";
        echo 'jQuery(".td-big-slide-background").backstretch("' . $td_slide_background . '", {fade:1200});' . "\n";
        echo '});' . "\n";
        echo '</script>' . "\n";
    }
    */

    if (!empty($td_slide_background)) {
        $buffy = '';
        $buffy .= 'jQuery().ready(function() {' . "\n";
        $buffy .= 'jQuery(".td-big-slide-background ").backstretch("' . $td_slide_background . '", {fade:1200});' . "\n";
        $buffy .= '});' . "\n";
        td_js_buffer::add_to_footer($buffy);
    }




    if (!empty($td_slide_b_color)) {
        echo '<style>';
        echo '.td-full-layout .td-big-slide-background { background-color:' . $td_slide_b_color . '; }';
        echo '.td-boxed-layout .td-big-slide-background .container { background-color:' . $td_slide_b_color . ' !important; }';
        echo '</style>';
    }
}