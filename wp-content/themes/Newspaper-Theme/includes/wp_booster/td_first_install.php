<?php


$td_defaultOptions['sidebars'] = '';
$td_defaultOptions['td_ad_spots'] = '';

//add and autoload the option
add_option(TD_THEME_OPTIONS_NAME, $td_defaultOptions, '', 'yes' );

//moved in a new function in td_util.php
//td_global::$td_options = get_option(TD_THEME_OPTIONS_NAME);


function td_on_theme_activate($oldname, $oldtheme=false) {

    //the pagebuilder templates
    $td_pagebuilder_templates = array
    (
        'homepage_3256' => Array (
            'name' => 'Homepage',
            'template' => '[vc_row][vc_column width="1/1"][td_slide_big limit="8"][/vc_column][/vc_row][vc_row][vc_column width="2/3"][td_block2 limit="6" custom_title="DON\'T MISS" ajax_pagination="next_prev"][td_block1 limit="5" header_color="#f65261" custom_title="TECH AND GADGETS" ajax_pagination="next_prev"][td_ad_box spot_id="custom_ad_1"][td_block2 limit="6" custom_title="TRAVEL GUIDES" ajax_pagination="next_prev" header_color="#82b440"][/vc_column][vc_column width="1/3"][vc_widget_sidebar sidebar_id="td-default"][/vc_column][/vc_row][vc_row][vc_column width="2/3"][td_block2 limit="6" custom_title="FASHION AND TRENDS" ajax_pagination="next_prev" header_color="#ff3e9f"][/vc_column][vc_column width="1/3"][td_block4 limit="1" custom_title="EDITOR PICKS" ajax_pagination="next_prev" header_color="#2b2b2b"][td_ad_box spot_id="sidebar"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][td_ad_box spot_id="custom_ad_1"][/vc_column][/vc_row]'
        ),

        'homepage_4160' => Array (
            'name' => 'Homepage - Infinite scroll',
            'template' => '[vc_row][vc_column width="1/1"][td_slide_big limit="8" hide_title="hide_title"][td_block2 limit="3" custom_title="Infinite scroll" offset="3"][/vc_column][/vc_row][vc_row][vc_column width="2/3"][td_block3 limit="10" ajax_pagination="infinite" custom_title="Latest articles"][/vc_column][vc_column width="1/3"][vc_widget_sidebar sidebar_id="td-default"][/vc_column][/vc_row]'
        ),

        'homepage_5160' => Array (
            'name' => 'Homepage - Magazinly',
            'template' => '[vc_row][vc_column width="2/3"][td_slide limit="5" hide_title="hide_title"][td_block1 limit="5" custom_title="MOST POPULAR" ajax_pagination="load_more"][td_block2 limit="6" ajax_pagination="next_prev"][vc_row_inner][vc_column_inner width="1/2"][td_slide limit="3"][/vc_column_inner][vc_column_inner width="1/2"][td_block4 limit="5"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/3"][td_social_counter facebook="themeforest" twitter="envato" youtube="jonlajoie"][td_block3 limit="3" custom_title="LATEST VIDEO"][td_ad_box spot_name="Ad spot -- sidebar ad" spot_id="sidebar"][td_block2 limit="4" custom_title="TRAVEL"][/vc_column][/vc_row]'
        ),

        'contact_533' => Array(
            'name' => 'Contact',
            'template' => '[vc_row el_position=\"first last\"][vc_column width=\"2/3\"][vc_column_text]

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse non nunc ac quam congue fermentum et vel massa. Proin imperdiet pulvinar rhoncus. Integer in elit accumsan, ullamcorper ante non, commodo velit. Nunc luctus scelerisque dui, vitae luctus est auctor eu.

[/vc_column_text][vc_gmaps link=\"http://maps.google.com/maps?q=Town+Hall+Square,+Kent+Street,+Sydney,+New+South+Wales,+Australia&amp;hl=en&amp;sll=-33.887464,151.187968&amp;sspn=0.007472,0.016512&amp;oq=square+australia+sy&amp;t=h&amp;hq=Town+Hall+Square,&amp;hnear=Kent+St,+New+South+Wales+2000,+Australia&amp;z=16\" size=\"308\" type=\"m\" zoom=\"14\"][vc_row_inner][vc_column_inner width=\"1/2\"][td_text_with_title title=\"Contact\" style=\"style_2\" el_position=\"first last\" custom_title=\"CONTACT DETAILS\"]

Newspaper Comunication Service

425 Santa Teresa St.

Stanford, CA 452 14 521


(650) 723-2558 (main number)

(650) 725-0247 (fax)


Email: contact@newspaper.com

[/td_text_with_title][/vc_column_inner][vc_column_inner width=\"1/2\"][td_social custom_title=\"OUR SOCIAL PROFILES\" icon_style=\"1\" icon_size=\"32\" dribbble=\"http://www.tagdiv.com\" facebook=\"http://www.tagdiv.com\" googleplus=\"#\" grooveshark=\"http://www.tagdiv.com\" linkedin=\"#\" twitter=\"http://www.tagdiv.com\" youtube=\"http://www.tagdiv.com\" el_position=\"first\"][td_text_with_title custom_title=\"WORKING HOUR\"]

The office is open from 8 a.m. to 5 p.m. Monday through Friday except university holidays.

[/td_text_with_title][/vc_column_inner][/vc_row_inner][contact-form-7 id=\"1\" title=\"LEAVE US A MESSAGE\"][/vc_column][vc_column width=\"1/3\"][vc_widget_sidebar sidebar_id=\"td-default\" el_position=\"first last\"][/vc_column][/vc_row]',
            'sidebar-right_28390' => array (
                'name' => 'Sidebar right',
                'template' => '[vc_row][vc_column width=\"2/3\"][/vc_column][vc_column width=\"1/3\"][vc_widget_sidebar sidebar_id=\"td-default\"][/vc_column][/vc_row]'
            ),

            'sidebar-left_18719' => array (
                'name' => 'Sidebar left',
                'template' => '[vc_row][vc_column width=\"1/3\"][vc_widget_sidebar sidebar_id=\"td-default\"][/vc_column][vc_column width=\"2/3\"][/vc_column][/vc_row]'
            ),
        )
    );

    update_option('wpb_js_templates',$td_pagebuilder_templates);

    //update the wordpress default time format
    update_option('date_format', 'M j, Y');
    //echo get_option('date_format');
}
add_action("after_switch_theme", "td_on_theme_activate", 10 ,  2);

//update_option('wpb_js_templates',unserialize(''));

//td_on_theme_activate('', false);



//echo str_replace(array("\r\n","\r"),"",serialize(get_option('wpb_js_templates'))); ;

//print_r(get_option('wpb_js_templates'));

$td_isFirstInstall = td_util::get_option('firstInstall');
if (empty($td_isFirstInstall)) {
    wp_insert_term('Featured', 'category', array(
        'description' => 'Featured posts',
        'slug' => 'featured',
        'parent' => 0
    ));
    td_util::update_option('firstInstall', 'themeInstalled');
}

