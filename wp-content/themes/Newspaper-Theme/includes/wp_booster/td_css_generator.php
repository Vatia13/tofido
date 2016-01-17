<?php

function td_css_generator() {

    $raw_css = "
    <style>

    /* @theme_color */
    .block-title a, .block-title span, .td-tags a:hover, .td-scroll-up-visible, .td-scroll-up, .sf-menu ul
    .current-menu-item > a, .sf-menu ul a:hover, .sf-menu ul .sfHover > a, .sf-menu ul .td-not-mega > a:hover, .td-rating-bar-wrap div, .iosSlider .slide-meta-cat, .sf-menu ul
    .current-menu-ancestor > a, .td-404-sub-sub-title a, .widget_tag_cloud .tagcloud a:hover, .td-mobile-close a,
    ul.td-category a, .td_social .td_social_type .td_social_button a, .dropcap, .td-forum-category-title
    .td-forum-category-name, .td_display_err, .td_block_mega_menu .td-ajax-next-page:hover, .td_block_mega_menu .td_ajax-prev-page:hover, .post-via span {
        background-color: @theme_color;
    }
    .block-title, .sf-menu li a:hover, .sf-menu .sfHover a, .sf-menu .current-menu-ancestor a, .header-search-wrap
    .dropdown-menu, .sf-menu > .current-menu-item > a, .ui-tabs-nav,
    .woocommerce .product .woocommerce-tabs ul.tabs, .td-forum-list-head, .td-login-panel-title {
        border-color: @theme_color;
    }

    .widget_price_filter .ui-slider-handle {
        border-color: @theme_color !important;
    }

    .author-box-wrap .td-author-name a, blockquote p, .page-nav a:hover, .widget_pages .current_page_item a,
    .widget_calendar td a, .widget_categories .current-cat > a, .widget_pages .current_page_parent > a,
    .td_pull_quote p, .page-nav-post a:hover span, .td-forum-last-comment-content .td-forum-last-author,
    .td-topics-title-details a, .td-posted-in a {
        color: @theme_color;
    }

    .woocommerce .button, .woocommerce .form-submit #submit, .widget_price_filter .ui-slider-handle,
    .jetpack_subscription_widget input[type=\"submit\"], .pp_woocommerce .pp_close, .pp_woocommerce .pp_expand,
    .pp_woocommerce .pp_contract, .pp_woocommerce .pp_arrow_previous, .pp_woocommerce .pp_arrow_next, .pp_woocommerce
     .pp_next:before, .pp_woocommerce .pp_previous:before, #bbpress-forums .button {
        background: @theme_color !important;
    }

    .woocommerce .woocommerce-message, .woocommerce .woocommerce-info, .bbp-template-notice, .td-reply-list-header {
        border-color: @theme_color !important;
    }
    .woocommerce .woocommerce-message:before, .woocommerce .woocommerce-info:before, .td-login-button {
        background-color: @theme_color !important;
    }


    .buddypress #buddypress div.dir-search input[type=\"submit\"], .buddypress #buddypress .message-search
    input[type=\"submit\"], .buddypress #buddypress .item-list-tabs ul li.selected a,
    .buddypress #buddypress .generic-button a, .buddypress #buddypress .submit input[type=\"submit\"],
    .buddypress #buddypress .ac-reply-content input[type=\"submit\"], .buddypress #buddypress .standard-form
    input[type=\"submit\"], .buddypress #buddypress .standard-form .button-nav .current a, .buddypress #buddypress .standard-form .button, .buddypress #buddypress input[type=\"submit\"],
        .buddypress #buddypress a.accept, .buddypress #buddypress #activate-page .standard-form input[type=\"submit\"],
        .buddypress #buddypress .standard-form #group-create-body input[type=\"button\"],
        .post-password-required input[type=\"submit\"]  {
        background: @theme_color !important;
    }

    .buddypress #buddypress .groups .item-meta, .bbp-forum-title:hover, .td_login_tab_focus, .block-mega-child-cats a.cur-sub-cat {
        color: @theme_color !important;
    }

    .page-nav .current, .page-nav-post span {
        background-color: @theme_color;
        border-color: @theme_color;
    }
    .wpb_btn-inverse, .ui-tabs-nav .ui-tabs-active a, .post .wpb_btn-danger, .form-submit input, .wpcf7-submit,
    .wpb_default, .woocommerce .product .woocommerce-tabs ul.tabs li.active, .woocommerce.widget_product_search
    input[type=\"submit\"], .more-link-wrap, .td_read_more {
        background-color: @theme_color !important;
    }
    .header-search-wrap .dropdown-menu:before {
        border-color: transparent transparent @theme_color;
    }
    .td-mobile-content .current-menu-item > a, .td-mobile-content a:hover {
        color: @theme_color !important;
    }
    .category .entry-content, .tag .entry-content, .td_quote_box {
        border-color: @theme_color;
    }

    .td-timeline-block-title {
        background-color: @theme_color !important;
    }

    .td-timeline-wrapper-links {
       border-color: @theme_color !important;
    }

    .td-timline-h1-link  span {
        background-color: @theme_color !important;
    }

    .td-page-title .td-search-query {
         color: @theme_color;
    }

     /* @slider_text */
    .td-sbig-title-wrap .td-sbig-title, .td-slide-item-sec .td-sbig-title-wrap, .td-big-grid-title .td-sbig-title-wrap {
        background-color: @slider_text;
    }


    /* @jetpack caption hover */
    .tiled-gallery-caption {
        background: @slide_text !important;
    }



    /* @select_color */
    ::-moz-selection {
        background: @select_color;
        color: #fff;
    }

    ::selection {
        background: @select_color;
        color: #fff;
    }



    /* @menu_color */
    .td-full-layout .td-menu-background {
        background: @menu_color !important;
    }

    .td-boxed-layout .td-menu-background .td-menu-wrap {
        background: @menu_color !important;
    }


    /* @header_wrap_color */
    .td-full-layout .td-header-bg {
        background-color: @header_wrap_color !important;
    }

    .td-boxed-layout .td-logo-rec-wrap,
    .td-boxed-layout .td-affix .td-logo-rec-wrap,
    .td-full-logo
    {
        background-color: @header_wrap_color !important;
    }


    /* @logo_text_color */
    .header-logo-wrap .td-logo-text, .header-logo-wrap .td-tagline-text {
        color: @logo_text_color !important;
    }



    /* @header_align_top */
    .td-logo-rec-wrap .span4,
    .td-logo-rec-wrap .span8 {
        top: @header_align_top !important;
        position: relative !important;
    }

    @media (max-width: 767px) {
        .td-logo-rec-wrap {
            top: 0px !important;
        }
    }

    /* @transparent_header */
    .td-logo-rec-wrap, .td-full-logo {
        background-color: transparent !important;
    }


    /* @top_menu_color */
    .td-full-layout .td-header-menu-wrap {
        background-color: @top_menu_color !important;
    }

    .td-boxed-layout .td-header-menu-wrap .container {
        background-color: @top_menu_color !important;
    }

	
	/* @link_color */
	a, .widget_recent_comments .recentcomments .url {
		color: @link_color;
    }
    .cur-sub-cat {
      color:@link_color !important;
    }
    .blog-stack .sf-menu .current-menu-item a,
    .blog-stack .sf-menu .current-menu-parent .current-menu-item a,
    .blog-stack .sf-menu .current-menu-parent > a,
    .blog-stack .sf-menu > li:hover > a,
    .blog-stack .sf-menu ul li:hover > a,
    .blog-stack .td-post-text-content .more-link-wrap:hover a,
    .blog-stack .sf-menu ul .td_mega_menu_sub_cats a.cur-sub-cat,
    .blog-stack .sf-menu ul .td_mega_menu_sub_cats a.cur-sub-cat:hover,
    .blog-stack .td-mega-menu .block-mega-child-cats a:hover,
    .blog-stack .td_mod_mega_menu:hover .item-details a{
        color:@link_color !important;
    }

    .blog-stack .sf-menu ul li {
        background-color: @link_color;
    }

    .blog-stack .td-post-text-content .more-link-wrap a:hover {
        outline-color: @link_color;
    }

	
	/* @link_hover_color */
	a:hover, .widget_recent_comments .recentcomments .url:hover {
		color: @link_hover_color;
    }


    /* @footer_color */
    .td-full-layout .td-footer-wrap, .td-boxed-layout .td-footer-wrap .span12 {
         background: @footer_color url('@get_template_directory_uri/images/footer/top-shadow.png') repeat-x top;
    }

    /* @footer_bottom_color */
    .td-full-layout .td-sub-footer-wrap, .td-boxed-layout .td-sub-footer-wrap .container  {
        background-color: @footer_bottom_color;
    }

    /* @footer_text_color */
    .td-footer-wrap, .td-footer-wrap a, .td-footer-wrap .td_top_authors .td-authors-name a {
        color: @footer_text_color;
    }
    .td-footer-wrap .entry-title a {
        color: @footer_text_color !important;
    }
    .td_top_authors .td_mod_wrap:hover  {
        background-color: transparent !important;
    }

    /* @footer_bottom_text_color */
    .td-sub-footer-copy, .td-sub-footer-wrap a {
        color: @footer_bottom_text_color !important;
    }
    .td-sub-footer-menu li a:before {
        background-color: @footer_bottom_line;
    }


    /* @top_menu_line */
    .top-header-menu li a:before {
        background-color: @top_menu_line;
    }


    /* @menu_icon_color */
    .td-menu-header .td-sp, .sf-sub-indicator{
        background-image: url('@get_template_directory_uri/images/header/elements-menu.png');
    }
    @media only screen and (-webkit-min-device-pixel-ratio: 2),
    only screen and (-moz-min-device-pixel-ratio: 2),
    only screen and (min-device-pixel-ratio: 2) {
        .td-menu-header .td-sp, .sf-sub-indicator{
            background-image: url('@get_template_directory_uri/images/header/elements-menu@2x.png');
        }
    }







    /* ------------------------------------------------------ */
    /* @post_title */
    .post header h1, .post header h1 a {
        @post_title
    }

    /* @content */
    body .td-post-text-content {
        @content
    }

    /* @post_h1_tag */
    .post .td-post-text-content h1 {
        @post_h1_tag
    }

    /* @post_h2_tag */
    .post .td-post-text-content h2 {
        @post_h2_tag
    }

    /* @post_h3_tag */
    .post .td-post-text-content h3 {
        @post_h3_tag
    }

    /* @post_h4_tag */
    .post .td-post-text-content h4 {
        @post_h4_tag
    }

    /* @post_h5_tag */
    .post .td-post-text-content h5 {
        @post_h5_tag
    }

    /* @post_h6_tag */
    .post .td-post-text-content h6 {
        @post_h6_tag
    }

    /* @post_blue_quote */
    .td-post-text-content blockquote.td_quote_left p,
    .td-post-text-content blockquote.td_quote_right p,
    .td-post-text-content blockquote:not(.td-quote-classic):not(.td_quote_box):not(.td_pull_quote) p {
        @post_blue_quote
    }


    /* @post_black_quote */
    .post .td-post-text-content blockquote.td-quote-classic p {
        @post_black_quote
    }

    /* @post_black_quote_author */
    .td-post-text-content .td-quote-author p {
        @post_black_quote_author
    }

    /* @post_template_style_1 */
    .single_template_1 header h1.entry-title {
        @post_template_style_1
    }

    /* @post_template_style_2 */
    .single_template_2 header h1.entry-title {
        @post_template_style_2
    }

    /* @post_template_style_3 */
    .single_template_3 header h1.entry-title {
        @post_template_style_3
    }

    /* @post_template_style_4 */
    .single_template_4 header h1.entry-title {
        @post_template_style_4
    }

    /* @post_template_style_5 */
    .single_template_5 header h1.entry-title {
        @post_template_style_5
    }

    /* @page_title */
    .page-template-default h1.td-page-title span,
    .page-template-page-pagebuilder-title-php h1.td-page-title span{
        @page_title
    }


    /* @top_menu */
    .td-header-menu-wrap li a, .td-header-menu-wrap .td_data_time {
        @top_menu
    }

    /* @menu */
    .sf-menu > .td-not-mega > a {
        @menu
    }

    /* @mega_menu */
    .td_mod_mega_menu .item-details a {
        @mega_menu
    }

    /* @sub_menu */
    .sf-menu ul .td-not-mega a, .td_mega_menu_sub_cats .block-mega-child-cats a{
        @sub_menu
    }


    /* @big_slide_main */
    .td-big-grid-post-0 .td-sbig-title-wrap .td-sbig-title, .td-big-grid-post-0 .td-sbig-title-wrap .td-sbig-title:hover, .td-big-grid-post-0 .td-sbig-title-wrap a {
        @big_slide_main
    }

    /* @big_slide_sec */
    .td-big-grid-post-sec .td-sbig-title-wrap a, .td-big-grid-post-sec .td-sbig-title-wrap a {
        @big_slide_sec
    }

    /* @normal_slide */
    .td_normal_slide .td-sbig-title-wrap .td-sbig-title {
        @normal_slide
    }

    .td_normal_slide .td-sbig-title-wrap a, .td_normal_slide .iosSlider-col-2 .item .td-sbig-title-wrap a, .td_normal_slide .iosSlider-col-1 .item .td-sbig-title-wrap a {
        @normal_slide
    }

    /* @widget_title */
    .td_block_wrap .block-title a, .block-title span, .block-title label {
        @widget_title
    }

    /* @widget_art_big_title */
    .td_mod2 .entry-title a, .td_mod5 .entry-title a, .td_mod6 .entry-title a, .td_mod_search .entry-title a {
        @widget_art_big_title
    }

    /* @widget_art_small_title */
    .td_mod3 .entry-title a, .td_mod4 .entry-title a, .td_mod_mega_menu .item-details a {
        @widget_art_small_title
    }

    /* @excerpt */
    body .td-post-text-excerpt {
        @excerpt
    }

    /* @tabs_title */
    .ui-tabs-nav a, .ui-tabs-nav .ui-tabs-active a {
        @tabs_title
    }


    </style>
    ";



    $td_css_compiler = new td_css_compiler($raw_css);
    //the template directory uri
    $td_css_compiler->load_setting_raw('get_template_directory_uri', get_template_directory_uri());


    //add the typography css to the theme generated css
    foreach(td_fonts::$typography_sections as $section_id => $section_name) {
        if(!empty(td_global::$td_options['td_fonts'][$section_id])) {
            $section_css_array = td_global::$td_options['td_fonts'][$section_id];

            if(!empty($section_css_array['font_family'])) {
                $section_css_array = td_fonts::css_get_font_family(td_global::$td_options['td_fonts'][$section_id]);
            }

            //check if we have font_family in the array
            if(!empty($section_css_array)) {
                $td_css_compiler->load_setting_array(array($section_id => $section_css_array));
            }
        }
    }


    //load the user settings
    $td_css_compiler->load_setting('theme_color');
    $td_css_compiler->load_setting('header_wrap_color');
    $td_css_compiler->load_setting('menu_color');//header background color


    $td_css_compiler->load_setting('menu_text_color');
    $td_css_compiler->load_setting('top_menu_color');
    $td_css_compiler->load_setting('logo_text_color');
	$td_css_compiler->load_setting('link_color');
	$td_css_compiler->load_setting('link_hover_color');
    $td_css_compiler->load_setting('small_text_slide');
    $td_css_compiler->load_setting('header_align_top');
    $td_css_compiler->load_setting('transparent_header');

    $td_css_compiler->load_setting('footer_color');
    $td_css_compiler->load_setting('footer_bottom_color');
    $td_css_compiler->load_setting('footer_text_color');
    $td_css_compiler->load_setting('footer_bottom_text_color');
    $td_css_compiler->load_setting('menu_icon_color');
    $td_css_compiler->load_setting('big_slide_transform');
    $td_css_compiler->load_setting('main_menu_transform');

    //top menu + line color
    $tds_top_menu_text_color = td_util::get_option('td_fonts');
    if (!empty($tds_top_menu_text_color['top_menu']['color'])) {
        $td_css_compiler->load_setting_raw('top_menu_line', td_util::hex2rgba($tds_top_menu_text_color['top_menu']['color'], 0.3));
    }

    //footer menu + line color
    $td_css_compiler->load_setting('footer_bottom_text_color');
    $tds_footer_bottom_text_color = td_util::get_option('tds_footer_bottom_text_color');
    if (!empty($tds_footer_bottom_text_color)) {
        $td_css_compiler->load_setting_raw('footer_bottom_line', td_util::hex2rgba($tds_footer_bottom_text_color, 0.3));
    }

    //load the selection color
    $tds_theme_color = td_util::get_option('tds_theme_color');
    if (!empty($tds_theme_color)) {
        //the select
        $td_css_compiler->load_setting_raw('select_color', td_util::adjustBrightness($tds_theme_color, 50));

        //the sliders text
        $td_css_compiler->load_setting_raw('slider_text', td_util::hex2rgba($tds_theme_color, 0.7));
    }


    //add fonts css buffer
    $td_fonts_css_buffer = td_util::get_option('td_fonts_css_buffer');
    if(!empty($td_fonts_css_buffer)) {
        td_css_buffer::add($td_fonts_css_buffer);
    }

    //output the style
    td_css_buffer::add($td_css_compiler->compile_css());

}

add_action('wp_head', 'td_css_generator', 10);

