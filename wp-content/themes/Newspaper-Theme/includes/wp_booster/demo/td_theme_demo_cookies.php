<?php

/*/add cookie support
add_action('init', 'td_theme_options_cookies', 1);

function td_theme_options_cookies() {
    if(!empty($_COOKIE["td-cookie-demo-theme-options"])) {
        echo $_COOKIE["td-cookie-demo-theme-options"];
    }
}*/

function td_theme_settings_read_for_demo() {
    $td_cookie_value = '';

    if(isset($_COOKIE["td-cookie-demo-theme-options"])) {
        $td_cookie_value = $_COOKIE["td-cookie-demo-theme-options"];
    }

    switch ($td_cookie_value) {
        case 'style_1':
            td_global::$td_options = unserialize(base64_decode(file_get_contents('files_cookies_settings/demo_style_1.txt', true)));
            break;

        case 'style_2':
            td_global::$td_options = unserialize(base64_decode(file_get_contents('files_cookies_settings/demo_style_2.txt', true)));
            break;

        case 'style_3':
            td_global::$td_options = unserialize(base64_decode(file_get_contents('files_cookies_settings/demo_style_3.txt', true)));
            break;

        case 'style_4':
            td_global::$td_options = unserialize(base64_decode(file_get_contents('files_cookies_settings/demo_style_4.txt', true)));
            break;

        //read the database theme options if no cookie is found
        default:
            td_global::$td_options = get_option(TD_THEME_OPTIONS_NAME);

    }
}

