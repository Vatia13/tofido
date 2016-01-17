<?php
/*  ----------------------------------------------------------------------------
    user contact info
 */

function extra_contact_info($contactmethods) {
    unset($contactmethods['aim']);
    unset($contactmethods['yim']);
    unset($contactmethods['jabber']);

    foreach (td_social_icons::$td_social_icons_array as $td_social_id => $td_social_name) {
        $contactmethods[$td_social_id] = $td_social_name;
    }

    return $contactmethods;
}
add_filter('user_contactmethods', 'extra_contact_info');


