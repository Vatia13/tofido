<?php

// quote
function td_quote_center($atts, $content = null) {
    extract(shortcode_atts(
            array(
                'color' => '', /* empty for default color OR color profile OR custom #color */
            ),
            $atts
        )
    );

    $style_output = '';
    if ($color != '') {
        $style_output .= 'color:' . $color . '; ';
    }

    return '<blockquote><p style="' . $style_output . '">' . $content . '</p></blockquote>' ;
}
add_shortcode('quote_center', 'td_quote_center');


function td_quote_right($atts, $content = null) {
    extract(shortcode_atts(
            array(
                'color' => '', /* empty for default color OR color profile OR custom #color */
            ),
            $atts
        )
    );

    $style_output = '';
    if ($color != '') {
        $style_output .= 'color:' . $color . '; ';
    }

    return '<blockquote class="td_quote td_quote_right"><p style="' . $style_output . '">' . $content . '</p></blockquote>' ;
}
add_shortcode('quote_right', 'td_quote_right');


function td_quote_left($atts, $content = null) {
    extract(shortcode_atts(
            array(
                'color' => '', /* empty for default color OR color profile OR custom #color */
            ),
            $atts
        )
    );

    $style_output = '';
    if ($color != '') {
        $style_output .= 'color:' . $color . '; ';
    }

    return '<blockquote class="td_quote td_quote_left"><p style="' . $style_output . '">' . $content . '</p></blockquote>' ;
}
add_shortcode('quote_left', 'td_quote_left');


function td_quote_box_center($atts, $content = null) {
    return '<blockquote class="td_quote_box td_box_center"><p>' . $content . '</p></blockquote>' ;
}
add_shortcode('quote_box_center', 'td_quote_box_center');


function td_quote_box_left($atts, $content = null) {
    return '<blockquote class="td_quote_box td_box_left"><p>' . $content . '</p></blockquote>' ;
}
add_shortcode('quote_box_left', 'td_quote_box_left');


function td_quote_box_right($atts, $content = null) {
    return '<blockquote class="td_quote_box td_box_right"><p>' . $content . '</p></blockquote>' ;
}
add_shortcode('quote_box_right', 'td_quote_box_right');


function td_pull_quote_center($atts, $content = null) {
    return '<blockquote class="td_pull_quote td_pull_center"><p>' . $content . '</p></blockquote>' ;
}
add_shortcode('pull_quote_center', 'td_pull_quote_center');


function td_pull_quote_left($atts, $content = null) {
    return '<blockquote class="td_pull_quote td_pull_left"><p>' . $content . '</p></blockquote>' ;
}
add_shortcode('pull_quote_left', 'td_pull_quote_left');


function td_pull_quote_right($atts, $content = null) {
    return '<blockquote class="td_pull_quote td_pull_right"><p>' . $content . '</p></blockquote>' ;
}
add_shortcode('pull_quote_right', 'td_pull_quote_right');


//dropcaps
function td_dropcap($atts, $content = null) {
    extract(shortcode_atts(
            array(
                'label' => '', /* the text */
                'bg_color' => '', /* empty for default color OR color profile OR custom #color */
                'text_color' => '', /* empty for default color OR color profile OR custom #color */
                'type' => '' /* empty = default type, 1 and 2 and 3 */
            ),
            $atts
        )
    );

    $style_output = '';

    //bg-color
    if ($bg_color != '') {
        $style_output .= 'background-color:' . $bg_color . '; ';
    }

    //text-color
    if ($text_color != '') {
        $style_output .= 'color:' . $text_color . '; ';
    }

    //parse the style
    if (!empty($style_output)) {
        $style_output = ' style="' . $style_output . '"';
    }

    //parse the label
    if (!empty($content)) {
        $label = $content;
    }


    $class_output = '';
    switch ($type) {
        case '1':
            $class_output .= 'dropcap1 ';
            break;

        case '2':
            $class_output .= 'dropcap2 ';
            break;
        case '3':
            $class_output .= 'dropcap3 ';
            break;

        case '4':
            $class_output .= 'dropcap4 ';
            break;
    }


    return '<span class="dropcap ' . $class_output . '"' . $style_output . '>' . $label . '</span>';
}
add_shortcode('dropcap', 'td_dropcap');



//dividers
function td_divider($atts, $content = null) {
    extract(shortcode_atts(
            array(
                'label' => '', /* the text */
                'bg_color' => '', /* empty for default color OR color profile OR custom #color */
                'type' => '', /* empty = default type, 1 and 2 and 3 */
                'height' => '' /* separator height, leave empty for auto (empty for the ones with graphics)  works only with type 0 - 3 */
            ),
            $atts
        )
    );

    $style_output = '';

    //bg-color
    if ($bg_color != '') {
        $style_output .= 'border-color:' . td_get_color_profile($bg_color) . '; ';
    }

    //bg-color
    if ($height != '') {
        $style_output .= 'border-width:' . $height . '; ';
    }

    //parse the style
    if (!empty($style_output)) {
        $style_output = ' style="' . $style_output . '"';
    }

    //parse the label
    if (!empty($content)) {
        $label = $content;
    }


    $class_output = '';

    if (!empty($type)) {
        $class_output .= 'divider' . $type . ' ';
    }


    return '<div class="divider ' . $class_output . '"' . $style_output . '></div>';
}
add_shortcode('divider', 'td_divider');

