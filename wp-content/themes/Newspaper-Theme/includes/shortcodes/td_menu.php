<?php
function td_menu_home($atts, $content = null) {
    return '<span class="menu_icon td-sp td-sp-ico-home"></span><span class="menu_hidden">' . __td('Home', TD_THEME_NAME) . '</span>' ;
}
add_shortcode('menu_home', 'td_menu_home');


function td_menu_category($atts, $content = null) {
    return '<span class="menu_icon td-sp td-sp-ico-categ"></span><span class="menu_hidden">' . __td('Categories', TD_THEME_NAME) . '</span>' ;
}
add_shortcode('menu_category', 'td_menu_category');


function td_menu_contact($atts, $content = null) {
    return '<span class="menu_icon td-sp td-sp-ico-contact"></span><span class="menu_hidden">' . __td('Contact', TD_THEME_NAME) . '</span>' ;
}
add_shortcode('menu_contact', 'td_menu_contact');


function td_menu_menu($atts, $content = null) {
    return '<span class="menu_icon td-sp td-sp-ico-menu"></span><span class="menu_hidden">' . __td('Menu', TD_THEME_NAME) . '</span>' ;
}
add_shortcode('menu_menu', 'td_menu_menu');


function td_menu_video($atts, $content = null) {
    return '<span class="menu_icon td-sp td-sp-ico-video"></span><span class="menu_hidden">' . __td('Videos', TD_THEME_NAME) . '</span>' ;
}
add_shortcode('menu_video', 'td_menu_video');

function td_menu_social($atts, $content = null) {
    return '<span class="menu_icon td-sp td-sp-ico-social"></span><span class="menu_hidden">' . __td('Social', TD_THEME_NAME) . '</span>' ;
}
add_shortcode('menu_social', 'td_menu_social');

