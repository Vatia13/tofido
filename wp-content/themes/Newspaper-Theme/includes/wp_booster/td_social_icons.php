<?php

class td_social_icons {
    static $td_social_icons_array = array(
        'addthis' => 'Add This',
        'behance' => 'Behance',
        'blogger' => 'Blogger',
        'delicious' => 'Delicious',
        'deviantart' => 'Deviantart',
        'digg' => 'Digg',
        'dopplr' => 'Dopplr',
        'dribbble' => 'Dribbble',
        'evernote' => 'Evernote',
        'facebook' => 'Facebook',
        'flickr' => 'Flickr',
        'forrst' => 'Forrst',
        'github' => 'Github',
        'google' => 'Google',
        'googledrive' => 'Google Drive',
        'googlemaps' => 'Google Maps',
        'googleplus' => 'Google Plus',
        'grooveshark' => 'Grooveshark',
        'html5' => 'Html5',
        'instagram' => 'Instagram',
        'lastfm' => 'Lastfm',
        'linkedin' => 'Linkedin',
        'mail' => 'Mail',
        'myspace' => 'Myspace',
        'path' => 'Path',
        'paypal' => 'Paypal',
        'picasa' => 'Picasa',
        'pinterest' => 'Pinterest',
        'posterous' => 'Posterous',
        'reddit' => 'Reddit',
        'rss' => 'Rss',
        'sharethis' => 'Sharethis',
        'skype' => 'Skype',
        'slashdot' => 'Slashdot',
        'soundcloud' => 'Soundcloud',
        'spotify' => 'Spotify',
        'stackoverflow' => 'Stackoverflow',
        'steam' => 'Steam',
        'stumbleUpon' => 'StumbleUpon',
        'tehnorati' => 'Tehnorati',
        'tumblr' => 'Tumblr',
        'twitter' => 'Twitter',
        'viddler' => 'Viddler',
        'vimeo' => 'Vimeo',
        'virb' => 'Virb',
        'windows' => 'Windows',
        'woordpress' => 'Woordpress',
        'yahoo' => 'Yahoo',
        'youtube' => 'Youtube',
        'zerply' => 'Zerply'
    );


    static function get_service_name($serviceId) {
        return self::$td_social_icons_array['$serviceId'];
    }


    static function get_icon($url, $icon_id, $style = 1, $size = 32, $open_in_new_window = false) {
        if ($open_in_new_window !== false) {
            $td_a_target = ' target="_blank"';
        } else {
            $td_a_target = '';
        }
        return '<span class="td-social-icon-wrap"><a' . $td_a_target . ' href="' . $url . '"><span class="td-social-s' . $style . '-' . $size . ' td-s-s-' . $size . '-' . $icon_id . '"></span></a></span>';
        //return '<span class="td-social-icon-wrap"><a' . $td_a_target . ' href="' . $url . '"><img width="' . $size . '" class="td-retina td-social-icon td-social-' . $icon_id . ' td-style-1" src="' . get_template_directory_uri() . '/images/icons/social/style' . $style . '/' . $size . '/' . $icon_id . '.png' .'" alt=""/></a></span>';
    }

}
