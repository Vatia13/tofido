<?php


class td_mega_menu extends td_block {


    function __construct() {
        $this->block_id = 'td_mega_menu';
        add_shortcode('td_mega_menu', array($this, 'render'));
    }


    function render($atts){
        $this->block_uid = td_global::td_generate_unique_id(); //update unique id on each render
        extract(shortcode_atts(
            array(
                'limit' => 5,
                'sort' => '',
                'category_id' => '',
                'category_ids' => '',
                'custom_title' => '',
                'custom_url' => '',
                'hide_title' => '',
                'show_child_cat' => '',
                'tag_slug' => '',
                'header_color' => ''
            ),$atts));

        $buffy = ''; //output buffer
        $td_unique_id = td_global::td_generate_unique_id();


        //custom categories

        //get subcategories, it returns false if there are no categories
        $get_block_sub_cats = $this->get_block_sub_cats($atts, $td_unique_id);
        $buffy_categories = '';
        $td_no_subcats_class = '';
        //we have subcategories
        if ($get_block_sub_cats !== false) {
            $buffy_categories .= '<div class="td_mega_menu_sub_cats">';
            //get the sub category filter for this block
            $buffy_categories .= $get_block_sub_cats;
            $buffy_categories .= '</div>';
            $atts['limit'] = 4; //alter the loop because we don't have space now with the categories
        } else {
            $td_no_subcats_class = ' td-no-subcats';
        }

        //end custom categories



        $td_query = &td_data_source::get_wp_query($atts); //by ref  do the query

        //get the js for this block
        $buffy .= $this->get_block_js($atts, $td_query);

        $buffy .= '<div class="td_block_wrap td_block_mega_menu' . $td_no_subcats_class . '">';

            //get the block title
            //$buffy .= $this->get_block_title($atts);

            //add the categories IF we have some
            $buffy .= $buffy_categories;




            $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner animated fadeInDown">';
            //inner content of the block
                $buffy .= $this->inner($td_query->posts);
            $buffy .= '</div>';

            $buffy .= $this->get_block_pagination($atts, $td_unique_id);
            //get the ajax pagination for this block

            $buffy .= '<div class="clearfix"></div>';

        $buffy .= '</div> <!-- ./block1 -->';
        return $buffy;
    }

    function inner($posts, $td_column_number = '') {

        $buffy = '';


        if (!empty($posts)) {
            foreach ($posts as $post) {
                $td_module_mega_menu = new td_module_mega_menu($post);
                $buffy .= $td_module_mega_menu->render();
            }
        }

        return $buffy;
    }





    function get_block_sub_cats($atts) {
        extract(shortcode_atts(
            array(
                'limit' => 5,
                'sort' => '',
                'category_id' => '',
                'category_ids' => '',
                'custom_title' => '',
                'custom_url' => '',
                'hide_title' => '',
                'show_child_cat' => '',  //the child category number
                'sub_cat_ajax' => '' //empty we use ajax
            ),$atts));





        $buffy = '';


        if (!empty($show_child_cat) and !empty($category_id)) {

            $td_subcategories = get_categories(array('child_of' => $category_id));
            if (!empty($td_subcategories)) {
                if ($show_child_cat != 'all') {
                    $td_subcategories = array_slice($td_subcategories, 0, $show_child_cat);
                }


                $buffy .= '<div class="block-mega-child-cats">';


                //show all categories only on ajax
                if (empty($sub_cat_ajax)) {
                    $buffy .= '<div><a class="cur-sub-cat ajax-sub-cat-mega sub-cat-' . $this->block_uid . '" id="sub-cat-'
                        . $this->block_uid . '-' . $category_id . '" data-cat_id="' . $category_id . '"
                        data-td_block_id="' . $this->block_uid . '" href="' . get_category_link($category_id) . '">' . __td('All') . '</a></div>';
                }

                foreach ($td_subcategories as $td_category) {
                    if (empty($sub_cat_ajax)) {
                        $buffy .= '<div><a class="ajax-sub-cat-mega sub-cat-' . $this->block_uid . '" id="sub-cat-' . $this->block_uid . '-' . $td_category->cat_ID . '" data-cat_id="' . $td_category->cat_ID . '" data-td_block_id="' . $this->block_uid . '" href="' . get_category_link($td_category->cat_ID) . '">' . $td_category->name . '</a></div>';
                    } else {
                        $buffy .= '<div><a href="' . get_category_link($td_category->cat_ID) . '">' . $td_category->name . '</a></div>';
                    }
                }


                $buffy .= '</div>';
            } else {
                //there are no subcategories, return false - this is used by the mega menu block to alter it's structure
                return false;
            }

        }

        return $buffy;
    }



}



td_global_blocks::add_instance('td_mega_menu', new td_mega_menu());


