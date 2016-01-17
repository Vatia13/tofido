<?php
class td_authors extends td_block {
    function __construct() {
        $this->block_id = 'td_authors';
        add_shortcode('td_authors', array($this, 'render'));
    }



    function render( $atts ) {
        global $wpdb;

        $title = '';
        $sort = '';

        extract(shortcode_atts(
            array(
                'title' => '',
                'sort' => '',
                'header_color' => '',
                'exclude' => '',
                'include' => ''
            ),$atts));

        if (trim($title) == '') {
            $title = __td('OUR AUTHORS');
        }

        //print_r($atts);
        //die;

        $get_users_array = array();

        if (!empty($exclude)) {
            $exclude_array = explode(',', $exclude);
            $get_users_array['exclude'] = $exclude_array;
        }

        if (!empty($include)) {
            $include_array = explode(',', $include);
            $get_users_array['include'] = $include_array;
        }


        if (empty($sort)) {
            $get_users_array['orderby'] = 'display_name';
            //$td_authors = get_users(array('orderby' => 'display_name'));
        } else {
            $get_users_array['orderby'] = 'post_count';
            $get_users_array['order'] = 'DESC';
            //$td_authors = get_users(array('orderby' => 'post_count', 'order' => 'DESC'));
        }


        $td_authors = get_users($get_users_array);
        //print_r($td_authors);


        $buffy = '';
        $buffy .= '<div class="td_block_wrap td_top_authors">';
            $buffy .= '<h4 class="block-title"><span>' . $title . '</span></h4>';

                if (!empty($td_authors)) {
                    foreach ($td_authors as $td_author) {
                        //echo td_global::$current_author_obj->ID;
                        //echo $td_author->ID;
                        //print_r($td_author);

                        $current_author_class = '';
                        if (!empty(td_global::$current_author_obj->ID) and td_global::$current_author_obj->ID == $td_author->ID) {
                            $current_author_class = ' td-active';
                        }
                        $buffy .= '<div class="td-fake-click td_mod_wrap' . $current_author_class . '" data-fake-click="' . get_author_posts_url($td_author->ID) . '">';
                            $buffy .= '<a href="' . get_author_posts_url($td_author->ID) . '">' . get_avatar($td_author->user_email, '70') . '</a>';
                            $buffy .= '<div class="item-details">';

                                $buffy .= '<div class="td-authors-name">';
                                    $buffy .= '<a href="' . get_author_posts_url($td_author->ID) . '">' . $td_author->display_name . '</a>';
                                $buffy .= '</div>';


                                $buffy .= '<span class="td-author-post-count">';
                                    $buffy .= count_user_posts($td_author->ID). ' '  . __td('POSTS');
                                $buffy .= '</span>';

                                $buffy .= '<span class="td-author-comments-count">';
                                    $comment_count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) AS total FROM $wpdb->comments WHERE comment_approved = 1 AND user_id = %s", $td_author->ID));
                                    $buffy .= $comment_count . ' '  . __td('COMMENTS');
                                $buffy .= '</span>';
								
                                $buffy .= '<div class="td-authors-url">';
                                    $buffy .= '<a href="' . $td_author->user_url . '">' . $td_author->user_url .'</a>';
                                $buffy .= '</div>';								

                            $buffy .= '</div>';

                        $buffy .= '</div>';
                    }
                }



        $buffy .= '</div>';


        return $buffy;

    }



    function get_map() {

        return  array(
            "name" => __("Authors box", TD_THEME_NAME),
            "base" => "td_authors",
            "class" => "",
            "controls" => "full",
            "category" => __('Content', TD_THEME_NAME),
            'icon' => 'icon-pagebuilder-td_authors',
            "params" => array(
                array(
                    "param_name" => "title",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => "Block title",
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "sort",
                    "type" => "dropdown",
                    "value" => array('- Sort by name -' => '', 'Sort by post count' => 'post_count'),
                    "heading" => __("Sort authors by:", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "exclude",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => "Exclude authors id (, separated)",
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "include",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => "Include authors id (, separated) - do not use with exclude",
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "type" => "colorpicker",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Header color", TD_THEME_NAME),
                    "param_name" => "header_color",
                    "value" => '', //Default Red color
                    "description" => __("Choose a custom header color for this block", TD_THEME_NAME)
                ),
            )
        );
    }
}

td_global_blocks::add_instance('Authors box', new td_authors());


