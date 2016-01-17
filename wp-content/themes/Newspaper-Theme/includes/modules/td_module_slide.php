<?php

class td_module_slide extends td_module {


    function __construct($post) {
        //run the parrent constructor
        parent::__construct($post);
    }

    function get_title_main() {
        $cut_parms = array(
            'char_per_line' => 26,
            'excerpt' => 13, //words
            'line_wrap_start' => '<span class="td-sbig-title">',
            'line_wrap_end' => '</span><span class="td-sbig-sep"></span>'
        );

        $buffy = '';

        $buffy .= '<div class="td-sbig-title-wrap">';
        $buffy .='<a class="noSwipe" itemprop="url" href="' . $this->href . '" rel="bookmark" title="' . $this->title_attribute . '">';
        $buffy .= td_util::cut_title($cut_parms, $this->title);
        $buffy .='</a>';
        $buffy .= '</div>';

        return $buffy;

    }

    function render($td_column_number, $td_post_count) {
        $buffy = '';

        $buffy .= '<div class = "item" ' . $this->get_item_scope()  . '>';
        switch ($td_column_number) {
            case '1': //one column layout
                $buffy .= $this->get_image('art-slide-small');
                break;
            case '2': //two column layout
                $buffy .= $this->get_image('art-slide-med');
                break;
            case '3': //three column layout
                $buffy .= $this->get_image('art-slide-big');
                break;
        }

            $buffy .= '<div class="slide-meta">';
                $buffy .= '<span class="slide-meta-cat">';
                $buffy .= $this->get_category();
                $buffy .= '</span>';
                $buffy .= '<span class="slide-meta-author">';
                //$buffy .= $this->get_author();
                $buffy .= $this->get_date();
                $buffy .= '</span>';
            $buffy .= '</div>';
            $buffy .= $this->get_title_main();

            $buffy .= $this->get_item_scope_meta();
        $buffy .= '</div>';

        return $buffy;
    }

    function get_category() {
        $buffy = '';

        //read the post meta to get the custom primary category
        $td_post_theme_settings = get_post_meta($this->post->ID, 'td_post_theme_settings', true);
        if (!empty($td_post_theme_settings['td_primary_cat'])) {
            //we have a custom category selected
            $selected_category_obj = get_category($td_post_theme_settings['td_primary_cat']);
        } else {
            //get one auto
            $categories = get_the_category($this->post->ID);
            if (!empty($categories[0])) {
                if ($categories[0]->name === TD_FEATURED_CAT and !empty($categories[1])) {
                    $selected_category_obj = $categories[1];
                } else {
                    $selected_category_obj = $categories[0];
                }
            }
        }


        if (!empty($selected_category_obj)) { //@todo catch error here
            $buffy .= '<a href="' . get_category_link($selected_category_obj->cat_ID) . '">'  . $selected_category_obj->name . '</a>' ;
        }

        //return print_r($post, true);
        return $buffy;
    }
}

