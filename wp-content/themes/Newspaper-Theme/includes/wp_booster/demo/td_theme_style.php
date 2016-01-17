<?php

function td_theme_style_load_js() {
    wp_enqueue_script('style-customizer', get_template_directory_uri() . '/js/td_style_customizer.js',array( 'jquery' ), 1, true); //load at begining
}
//add_action('init', 'td_theme_style_load_js');





//the bottom code for analitics and stuff
function td_theme_style_footer() {
    ?>

    <div id="td-theme-settings" class="td-theme-settings-small">
        <div class="td-skin-header">DEMO STACKS</div>
        <div class="td-skin-content">


                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/td_redirect.php?theme=newspaper&id=default" class="td-set-theme-style-link">DEFAULT</a></div>
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/td_redirect.php?theme=newspaper&id=classic_blog" class="td-set-theme-style-link" data-value="">CLASSIC BLOG <span>new</span></a></div>
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/td_redirect.php?theme=newspaper&id=style_3" class="td-set-theme-style-link">FASHION</a></div>
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/td_redirect.php?theme=newspaper&id=style_1" class="td-set-theme-style-link">SPORT</a></div>
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/td_redirect.php?theme=newspaper&id=style_2" class="td-set-theme-style-link">CAFE</a></div>
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/td_redirect.php?theme=newspaper&id=style_4" class="td-set-theme-style-link">TECH</a></div>


        </div>
        <div class="clearfix"></div>
        <div class="td-set-hide-show"><a href="#" id="td-theme-set-hide">HIDE</a></div>
    </div>

    <?php
}

add_action('wp_footer', 'td_theme_style_footer');

