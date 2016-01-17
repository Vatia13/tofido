<?php
    //new template - we should only keep this one
    global $td_row_count, $td_column_count;
    $td_row_count ++;


    $output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = '';
    extract(shortcode_atts(array(
        'el_class'        => '',
        'bg_image'        => '',
        'bg_color'        => '',
        'bg_image_repeat' => '',
        'font_color'      => '',
        'padding'         => '',
        'margin_bottom'   => '',
        'css' => '',

        //tagdiv mod
        'custom_title' => '',
        'header_color' => '',
        'header_text_color' => ''
    ), $atts));

    wp_enqueue_style( 'js_composer_front' );
    wp_enqueue_script( 'wpb_composer_front_js' );
    wp_enqueue_style('js_composer_custom_css');

    $el_class = $this->getExtraClass($el_class);

    $css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row '.get_row_css_class().$el_class.vc_shortcode_custom_css_class($css, ' '), $this->settings['base']);

    //tagdiv mod the block title
    if ($custom_title != '') {
        $output .= '<div class="'.$css_class.'">';
        $output .= '<div class="span12 wpb_column column_container">';
        $td_tmp_block_class = new td_block(); //we use this class to generate the title
        $output .= $td_tmp_block_class->get_block_title_raw($atts);
        $output .= '</div>';
        $output .= '</div>'.$this->endBlockComment('row');
    }

    $style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);
    $output .= '<div class="'.$css_class.'"'.$style.'>';
    $output .= wpb_js_remove_wpautop($content);
    $output .= '</div>'.$this->endBlockComment('row');


    $td_row_count--;

    echo $output;


