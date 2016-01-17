<?php

class td_nav_menu_edit_walker extends Walker_Nav_Menu_Edit {
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

        $buffy = '';
        $control_buffy = '';

        //read the menu setting
        $td_mega_menu_cat = get_post_meta($item->ID, 'td_mega_menu_cat', true);
        //make the tree
        $td_category_tree = array_merge (array(' - Not mega menu - ' => ''), td_util::get_category2id_array(false));


        $control_buffy .= '<p class="description description-wide">';

            $control_buffy .= '<label>';
                $control_buffy .= 'Make this a category mega menu';
            $control_buffy .= '</label>';

            $control_buffy .= '<select name="td_mega_menu_cat[' . $item->ID . ']" id="" class="widefat code edit-menu-item-url">';
                foreach ($td_category_tree as $category => $category_id) {
                    $control_buffy .= '<option value="' . $category_id . '"' . selected($td_mega_menu_cat, $category_id, false) . '>' . $category . '</option>';
                }
            $control_buffy .= ' </select>';

        $control_buffy .= '</p>';



        parent::start_el($buffy, $item, $depth, $args, $id);




        $buffy = preg_replace('/(?=<div.*submitbox)/', $control_buffy, $buffy);

        $output .= $buffy;
    }
}