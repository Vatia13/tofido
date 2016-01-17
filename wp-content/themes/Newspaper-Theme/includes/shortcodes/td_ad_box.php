<?php
class td_ad_box extends td_block {
    function __construct() {
        $this->block_id = 'td_ad_box';
        add_shortcode('td_ad_box', array($this, 'render'));
    }


    /**
     * renders the ads
     * @param $atts
     * @return string
     */
    function render( $atts ) {
        extract(shortcode_atts(
            array(
                'spot_id' => '', //header / sidebar etc
                'align' => '', //align left or right in inline content
            ), $atts));


        if (empty($spot_id)) {
            return;
        }

        $ad_array = td_util::get_td_ads($spot_id);

        // return if the ad for a specific spot id is empty
        if (empty($ad_array[$spot_id]) or empty($ad_array[$spot_id]['ad_code'])) {
            return;
        }


        $buffy = '';

        if (!empty($ad_array[$spot_id]['current_ad_type'])) {


            switch ($ad_array[$spot_id]['current_ad_type']) {

                case 'other':
                    //render the normal ads
                    $buffy .= $this->render_ads($ad_array[$spot_id], $atts);
                    break;

                case 'google':
                    //render the magic google ads :)
                    $buffy .= $this->render_google_ads($ad_array[$spot_id], $atts);
                    break;

            }
        }


        //print_r($ad_array);

        return $buffy;

    }


    /**
     * This function renders and returns a google ad.
     * @param $ad_array - uses an ad array of the form:
        - current_ad_type - google or other
        - ad_code - the full ad code as entered by the user
        - disable_m - disable on monitor
        - disable_tl - disable on tablet landscape
        - disable_tp - disable on tablet p
        - disable_p - disable on phones
        - g_data_ad_client - the google ad client id (ca-pub-etc)
        - g_data_ad_slot - the google ad slot id
     * 'm_w' => '',  // big monitor - width
    'm_h' => '',  // big monitor - height
    'tl_w' => '', // tablet_landscape width
    'tl_h' => '', // tablet_landscape height
    'tp_w' => '', // tablet_portrait width
    'tp_h' => '', // tablet_portrait height
    'p_w' => '',  // phone width
    'p_h' => ''   // phone height
     * @param $atts test
     * @return the full rendered ad
     */
    // tagDiv google responsive renderer
    // copyright 2014 tagDiv
    function render_google_ads($ad_array, $atts) {


        $spot_id = ''; //the spot id header / sidebar etc we read it from shortcode

        extract(shortcode_atts(
            array(
                'spot_id' => '', //header / sidebar etc
                'align' => '', //align left or right in inline content
            ), $atts));


        //echo ($p_w);

        //print_r($ad_array);

        $default_ad_sizes = array (
            'header' => array (
                'm_w' => '728',  // big monitor - width
                'm_h' => '90',  // big monitor - height

                'tl_w' => '468', // tablet_landscape width
                'tl_h' => '60', // tablet_landscape height

                'tp_w' => '468', // tablet_portrait width
                'tp_h' => '60', // tablet_portrait height

                'p_w' => '320',  // phone width
                'p_h' => '50'   // phone height
            ),
            'sidebar' => array (
                'm_w' => '300',  // big monitor - width
                'm_h' => '250',  // big monitor - height

                'tl_w' => '250', // tablet_landscape width
                'tl_h' => '250', // tablet_landscape height

                'tp_w' => '200', // tablet_portrait width
                'tp_h' => '200', // tablet_portrait height

                'p_w' => '300',  // phone width
                'p_h' => '250'   // phone height
            ),


            'content_inline' => array (
                'm_w' => '728',  // big monitor - width
                'm_h' => '90',  // big monitor - height

                'tl_w' => '468', // tablet_landscape width
                'tl_h' => '60', // tablet_landscape height

                'tp_w' => '468', // tablet_portrait width
                'tp_h' => '60', // tablet_portrait height

                'p_w' => '320',  // phone width
                'p_h' => '50'   // phone height
            ),

            'content_top' => array (
                'm_w' => '728',  // big monitor - width
                'm_h' => '90',  // big monitor - height

                'tl_w' => '468', // tablet_landscape width
                'tl_h' => '60', // tablet_landscape height

                'tp_w' => '468', // tablet_portrait width
                'tp_h' => '60', // tablet_portrait height

                'p_w' => '300',  // phone width
                'p_h' => '250'   // phone height
            ),

            'content_bottom' => array (
                'm_w' => '728',  // big monitor - width
                'm_h' => '90',  // big monitor - height

                'tl_w' => '468', // tablet_landscape width
                'tl_h' => '60', // tablet_landscape height

                'tp_w' => '468', // tablet_portrait width
                'tp_h' => '60', // tablet_portrait height

                'p_w' => '300',  // phone width
                'p_h' => '250'   // phone height
            ),

            'custom_ad_1' => array (
                'm_w' => '300',  // big monitor - width
                'm_h' => '250',  // big monitor - height

                'tl_w' => '250', // tablet_landscape width
                'tl_h' => '250', // tablet_landscape height

                'tp_w' => '200', // tablet_portrait width
                'tp_h' => '200', // tablet_portrait height

                'p_w' => '300',  // phone width
                'p_h' => '250'   // phone height
            ),

            'custom_ad_2' => array (
                'm_w' => '300',  // big monitor - width
                'm_h' => '250',  // big monitor - height

                'tl_w' => '250', // tablet_landscape width
                'tl_h' => '250', // tablet_landscape height

                'tp_w' => '200', // tablet_portrait width
                'tp_h' => '200', // tablet_portrait height

                'p_w' => '300',  // phone width
                'p_h' => '250'   // phone height
            ),

            'custom_ad_3' => array (
                'm_w' => '300',  // big monitor - width
                'm_h' => '250',  // big monitor - height

                'tl_w' => '250', // tablet_landscape width
                'tl_h' => '250', // tablet_landscape height

                'tp_w' => '200', // tablet_portrait width
                'tp_h' => '200', // tablet_portrait height

                'p_w' => '300',  // phone width
                'p_h' => '250'   // phone height
            )
        );


        if ($align == 'left') {
            $default_ad_sizes['content_inline'] = array (
                'm_w' => '300',  // big monitor - width
                'm_h' => '250',  // big monitor - height

                'tl_w' => '250', // tablet_landscape width
                'tl_h' => '250', // tablet_landscape height

                'tp_w' => '200', // tablet_portrait width
                'tp_h' => '200', // tablet_portrait height

                'p_w' => '320',  // phone width
                'p_h' => '50'   // phone height
            );
        }
        elseif ($align == 'right') {
            $default_ad_sizes['content_inline'] = array (
                'm_w' => '300',  // big monitor - width
                'm_h' => '250',  // big monitor - height

                'tl_w' => '250', // tablet_landscape width
                'tl_h' => '250', // tablet_landscape height

                'tp_w' => '200', // tablet_portrait width
                'tp_h' => '200', // tablet_portrait height

                'p_w' => '320',  // phone width
                'p_h' => '50'   // phone height
            );
        }







        //overwrite the default values if we have some

        //monitor big ad
        if (!empty($ad_array['m_size'])) {
            $ad_size_parts = explode(' x ', $ad_array['m_size']);
            $default_ad_sizes[$spot_id]['m_w'] = $ad_size_parts[0];
            $default_ad_sizes[$spot_id]['m_h'] = $ad_size_parts[1];
        }


        //tablet landscape
        if (!empty($ad_array['tl_size'])) {
            $ad_size_parts = explode(' x ', $ad_array['tl_size']);
            $default_ad_sizes[$spot_id]['tl_w'] = $ad_size_parts[0];
            $default_ad_sizes[$spot_id]['tl_h'] = $ad_size_parts[1];
        }


        //tablet portrait
        if (!empty($ad_array['tp_size'])) {
            $ad_size_parts = explode(' x ', $ad_array['tp_size']);
            $default_ad_sizes[$spot_id]['tp_w'] = $ad_size_parts[0];
            $default_ad_sizes[$spot_id]['tp_h'] = $ad_size_parts[1];
        }


        //phone
        if (!empty($ad_array['p_size'])) {
            $ad_size_parts = explode(' x ', $ad_array['p_size']);
            $default_ad_sizes[$spot_id]['p_w'] = $ad_size_parts[0];
            $default_ad_sizes[$spot_id]['p_h'] = $ad_size_parts[1];
        }





        //init the disable variables
        if (!empty($ad_array['disable_m']) and $ad_array['disable_m'] == 'yes') {
            $default_ad_sizes[$spot_id]['disable_m'] = true;
        } else {
            $default_ad_sizes[$spot_id]['disable_m'] = false;
        }

        if (!empty($ad_array['disable_tl']) and $ad_array['disable_tl'] == 'yes') {
            $default_ad_sizes[$spot_id]['disable_tl'] = true;
        } else {
            $default_ad_sizes[$spot_id]['disable_tl'] = false;
        }

        if (!empty($ad_array['disable_tp']) and $ad_array['disable_tp'] == 'yes') {
            $default_ad_sizes[$spot_id]['disable_tp'] = true;
        } else {
            $default_ad_sizes[$spot_id]['disable_tp'] = false;
        }

        if (!empty($ad_array['disable_p']) and $ad_array['disable_p'] == 'yes') {
            $default_ad_sizes[$spot_id]['disable_p'] = true;
        } else {
            $default_ad_sizes[$spot_id]['disable_p'] = false;
        }




        $buffy = "\n <!-- A generated by theme --> \n\n";

        //google async script
        $buffy .= '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>';

        $buffy .= '<div class="td-g-rec td-g-rec-id-' . $spot_id . $align . '">' . "\n";
            $buffy .= '<script type="text/javascript">' . "\n";


            //$buffy .= 'var td_a_g_custom_size = ' . json_encode($default_ad_sizes[$spot_id]) . ';' . "\n";


            $buffy .= 'var td_screen_width = document.body.clientWidth;' . "\n";

        //print_r($ad_array);

            if ($default_ad_sizes[$spot_id]['disable_m'] == false and !empty($default_ad_sizes[$spot_id]['m_w']) and !empty($default_ad_sizes[$spot_id]['m_h'])) {
                $buffy .= '
                    if ( td_screen_width >= 1200 ) {
                        /* large monitors */
                        document.write(\'<ins class="adsbygoogle" style="display:inline-block;width:' . $default_ad_sizes[$spot_id]['m_w'] . 'px;height:' . $default_ad_sizes[$spot_id]['m_h'] . 'px" data-ad-client="' . $ad_array['g_data_ad_client'] . '" data-ad-slot="' . $ad_array['g_data_ad_slot'] . '"></ins>\');
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    }
            ';
            }

            if ($default_ad_sizes[$spot_id]['disable_tl'] == false and !empty($default_ad_sizes[$spot_id]['tl_w']) and !empty($default_ad_sizes[$spot_id]['tl_h'])) {
                $buffy .= '
                    if ( td_screen_width >= 1019  && td_screen_width < 1200 ) {
                        /* landscape tablets */
                        document.write(\'<ins class="adsbygoogle" style="display:inline-block;width:' . $default_ad_sizes[$spot_id]['tl_w'] . 'px;height:' . $default_ad_sizes[$spot_id]['tl_h'] . 'px" data-ad-client="' . $ad_array['g_data_ad_client'] . '" data-ad-slot="' . $ad_array['g_data_ad_slot'] . '"></ins>\');
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    }
                ';
            }


            if ($default_ad_sizes[$spot_id]['disable_tp'] == false and !empty($default_ad_sizes[$spot_id]['tp_w']) and !empty($default_ad_sizes[$spot_id]['tp_h'])) {
                $buffy .= '
                    if ( td_screen_width >= 768  && td_screen_width < 1019 ) {
                        /* portrait tablets */
                        document.write(\'<ins class="adsbygoogle" style="display:inline-block;width:' . $default_ad_sizes[$spot_id]['tp_w'] . 'px;height:' . $default_ad_sizes[$spot_id]['tp_h'] . 'px" data-ad-client="' . $ad_array['g_data_ad_client'] . '" data-ad-slot="' . $ad_array['g_data_ad_slot'] . '"></ins>\');
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    }
                ';
            }

            if ($default_ad_sizes[$spot_id]['disable_p'] == false and !empty($default_ad_sizes[$spot_id]['p_w']) and !empty($default_ad_sizes[$spot_id]['p_h'])) {
                $buffy .= '
                    if ( td_screen_width < 768 ) {
                        /* Phones */
                        document.write(\'<ins class="adsbygoogle" style="display:inline-block;width:' . $default_ad_sizes[$spot_id]['p_w'] . 'px;height:' . $default_ad_sizes[$spot_id]['p_h'] . 'px" data-ad-client="' . $ad_array['g_data_ad_client'] . '" data-ad-slot="' . $ad_array['g_data_ad_slot'] . '"></ins>\');
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    }
                ';
            }


            //$buffy .= 'console.log(td_a_g_custom_size)';

            $buffy .= '</script>' . "\n";

        $buffy .= '</div>' . "\n";
        $buffy .= "\n <!-- end A --> \n\n";
        return $buffy;
    }


    /**
     * This function renders and returns a normal ad.
     * @param $ad_array - uses an ad array of the form:
    - current_ad_type - google or other
    - ad_code - the full ad code as entered by the user
    - disable_m - disable on monitor
    - disable_tl - disable on tablet landscape
    - disable_tp - disable on tablet p
    - disable_p - disable on phones
    - g_data_ad_client - the google ad client id (ca-pub-etc)
    - g_data_ad_slot - the google ad slot id
     *
     * @return the full rendered ad
     */
    function render_ads($ad_array, $atts) {

        $spot_id = ''; //the spot id header / sidebar etc we read it from shortcode

        extract(shortcode_atts(
            array(
                'spot_id' => '', //header / sidebar etc
                'align' => '', //align left or right in inline content

            ), $atts));


        $buffy = '';




        $buffy .= '<div class="td-a-rec td-a-rec-id-' . $spot_id . $align . ' '
            . ((!empty($ad_array['disable_m'])) ? ' td-rec-hide-on-m' : '')
            . ((!empty($ad_array['disable_tl'])) ? ' td-rec-hide-on-tl' : '')
            . ((!empty($ad_array['disable_tp'])) ? ' td-rec-hide-on-tp' : '')
            . ((!empty($ad_array['disable_p'])) ? ' td-rec-hide-on-p' : '')
            . '">';
            $buffy .= do_shortcode(stripslashes($ad_array['ad_code']));
        $buffy .= '</div>';


        //print_r($ad_array);
        return $buffy;

    }





    function get_map() {
        //read the adspots
        $td_ad_spots = td_util::get_option('td_ad_spots');
        $td_pb_ad_spots = array();
        if (!empty($td_ad_spots)) {
            foreach ($td_ad_spots as $td_ad_spot) {
                $td_pb_ad_spots['Ad spot -- ' . $td_ad_spot['name']] = 'Ad spot -- ' . $td_ad_spot['name'];
            }
        }

        //read the google adspots
        $td_adsense_spots = td_util::get_option('td_adsense_spots');
        if (!empty($td_adsense_spots)) {
            foreach ($td_adsense_spots as $td_ad_spot) {
                $td_pb_ad_spots['Adsense spot -- ' . $td_ad_spot['name']] = 'Adsense spot -- ' . $td_ad_spot['name'];
            }
        }

        return  array(
            "name" => __("Ad box", TD_THEME_NAME),
            "base" => "td_ad_box",
            "class" => "",
            "controls" => "full",
            "category" => __('Content', TD_THEME_NAME),
            'icon' => 'icon-pagebuilder-ads',
            "params" => array(
                array(
                    "param_name" => "spot_id",
                    "type" => "dropdown",
                    "value" => array(
                        'sidebar' => 'sidebar',
                        'content_inline' => 'content_inline',
                        'content_top' => 'content_top',
                        'content_bottom' => 'content_bottom',
                        'header' => 'header',
                        'custom_ad_1' => 'custom_ad_1',
                        'custom_ad_2' => 'custom_ad_2',
                        'custom_ad_3' => 'custom_ad_3'
                    ),
                    "heading" => __("Use adspot :", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                )
            )
        );
    }
}

td_global_blocks::add_instance('Ad box', new td_ad_box());


