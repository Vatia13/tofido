<?php 
/*
 * This is the config file for the theme.
 */


//the deploy mode
define("TD_DEPLOY_MODE", 'deploy');




define("TD_THEME_NAME", "Newspaper");
define("TD_THEME_NAME_URL", "Newspaper");

define("TD_THEME_VERSION", "4.2");

define("TD_THEME_DOC_URL", "http://forum.tagdiv.com/newspaper-documentation/");
define("TD_THEME_DEMO_URL", "http://demo.tagdiv.com/" . strtolower(TD_THEME_NAME));



define("TD_FEATURED_CAT", "Featured"); //featured cat name
define("TD_FEATURED_CAT_SLUG", "featured"); //featured cat slug
define("TD_THEME_OPTIONS_NAME", "td_008"); //where to store our options

define("TD_THEME_WP_CAKE_VER", "1.1"); //used by plugins to determine if they can run ok or not.

define("TD_THEME_WP_BOOSTER", true); //used by plugins to determine if they can run ok or not.

//if no deploy mode is selected, we use the final deploy built
if (!defined('TD_DEPLOY_MODE')) {
    define("TD_DEPLOY_MODE", 'deploy');
}

switch (TD_DEPLOY_MODE) {
    case 'dev':
        //dev version
        define("TD_DEBUG_LIVE_THEME_STYLE", true);
        define("TD_DEBUG_IOS_REDIRECT", true);
        define("TD_DEBUG_USE_LESS", true); //use less on dev
        break;

    case 'demo':
        //demo version
        define("TD_DEBUG_LIVE_THEME_STYLE", true);
        define("TD_DEBUG_IOS_REDIRECT", true); // remove themeforest iframe from ios devices on demo only!
        define("TD_DEBUG_USE_LESS", false);
        break;

    default:
        //deploy version
        define("TD_DEBUG_LIVE_THEME_STYLE", false);
        define("TD_DEBUG_IOS_REDIRECT", false);
        define("TD_DEBUG_USE_LESS", false);
        break;
}


