<?php

// the menu

class td_menu {
    var $is_header_menu_mobile = true;


    function __construct() {
        add_action( 'init', array($this, 'hook_init'));

        if (is_admin()) {
            add_action('wp_update_nav_menu_item', array( $this, 'hook_wp_update_nav_menu_item'), 10, 3);
            add_filter('wp_edit_nav_menu_walker', array($this, 'hook_wp_edit_nav_menu_walker'));
        }

        add_filter('wp_nav_menu_objects', array($this, 'hook_wp_nav_menu_objects'),  10, 2);
    }



    function hook_wp_edit_nav_menu_walker () {
        include_once('td_menu_back.php');
        return 'td_nav_menu_edit_walker';
    }

    function hook_wp_update_nav_menu_item ($menu_id, $menu_item_db_id, $args) {

        //echo $menu_item_db_id;
        if (isset($_POST['td_mega_menu_cat'][$menu_item_db_id])) {
            //print_r($_POST);
            update_post_meta($menu_item_db_id, 'td_mega_menu_cat', $_POST['td_mega_menu_cat'][$menu_item_db_id]);
        }



    }




    function hook_wp_nav_menu_objects($items, $args = '') {
        $items_buffy = array();

        $td_is_firstMenu = true;




        //print_r($items);

        foreach ($items as &$item) {
            $item->is_mega_menu = false;

            // first menu fix
            if ($td_is_firstMenu) {
                $item->classes[] = 'menu-item-first';
                $td_is_firstMenu = false;
            }

            // fix the down arros + shortcodes
            if (strpos($item->title,'[') === false) {

            } else {
                //on shortcodes [home] etc.. do not show down arrow
                $item->classes[] = 'td-no-down-arrow';
            }

            //run shortcodes
            $item->title = do_shortcode($item->title);




            //is mega menu?
            $td_mega_menu_cat = get_post_meta($item->ID, 'td_mega_menu_cat', true);
            if ($td_mega_menu_cat != '' and $this->is_header_menu_mobile === false) {


                $item->classes[] = 'td-not-mega';
                $item->classes[] = 'td-mega-menu';

                //add the parent menu (ex current menu to the buffer)
                $items_buffy[] = $item;

                //create a new mega menu item:
                $post = new stdClass;
                $post->ID = 0;
                $post->post_author = '';
                $post->post_date = '';
                $post->post_date_gmt = '';
                $post->post_password = '';
                $post->post_type = 'menu_tds';
                $post->post_status = 'draft';
                $post->to_ping = '';
                $post->pinged = '';
                $post->comment_status = get_option( 'default_comment_status' );
                $post->ping_status = get_option( 'default_ping_status' );
                $post->post_pingback = get_option( 'default_pingback_flag' );
                $post->post_category = get_option( 'default_category' );
                $post->page_template = 'default';
                $post->post_parent = 0;
                $post->menu_order = 0;
                $new_item = new WP_Post($post);




                //$new_item->


                /*
                 * it's a mega menu,
                 * - set the is_mega_menu flag
                 * - alter the last item classes  $last_item
                 * - change the title and url of the current item
                 */
                $new_item->is_mega_menu = true; //this is sent to the menu walkers

                $new_item->menu_item_parent = $item->ID;

                $new_item->url = '';
                $new_item->title = '<div class="td-mega-grid">';
                $new_item->title .= td_global_blocks::get_instance('td_mega_menu')->render(
                    array(
                        'limit' => '5',
                        'td_column_number' => 3,
                        'ajax_pagination' => 'next_prev',
                        'category_id' => $td_mega_menu_cat,
                        'show_child_cat' => '5'
                    ));
                $new_item->title .= '</div>';




                $items_buffy[] = $new_item;

            } else {
                $item->classes[] = 'td-not-mega';
                $items_buffy[] = $item;
            }







        } //end foreach


        // we have two header-menu locations and the fist one is the mobile menu
        // the second one is the header menu
        if ($args->theme_location == 'header-menu') {
            $this->is_header_menu_mobile = false;
        }



        //print_r($items_buffy);
        //die;
        return $items_buffy;
    }


    function hook_init() {
        register_nav_menus(
            array(
                'top-menu' => __( 'Top Header Menu', TD_THEME_NAME),
                'header-menu' => __( 'Header Menu (main)', TD_THEME_NAME),
                'footer-menu' => __( 'Footer Menu', TD_THEME_NAME)
            )
        );
    }



}

new td_menu();





//this walker is used to remove a wrapping <a> around the megamenu
class td_tagdiv_walker_nav_menu extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        /**
         * Filter the CSS class(es) applied to a menu item's <li>.
         *
         * @since 3.0.0
         *
         * @param array  $classes The CSS classes that are applied to the menu item's <li>.
         * @param object $item    The current menu item.
         * @param array  $args    An array of arguments. @see wp_nav_menu()
         */
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        /**
         * Filter the ID applied to a menu item's <li>.
         *
         * @since 3.0.1
         *
         * @param string The ID that is applied to the menu item's <li>.
         * @param object $item The current menu item.
         * @param array $args An array of arguments. @see wp_nav_menu()
         */
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>';

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

        /**
         * Filter the HTML attributes applied to a menu item's <a>.
         *
         * @since 3.6.0
         *
         * @param array $atts {
         *     The HTML attributes applied to the menu item's <a>, empty strings are ignored.
         *
         *     @type string $title  The title attribute.
         *     @type string $target The target attribute.
         *     @type string $rel    The rel attribute.
         *     @type string $href   The href attribute.
         * }
         * @param object $item The current menu item.
         * @param array  $args An array of arguments. @see wp_nav_menu()
         */
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;

        //tagdiv - megamenu disable link from from includes/wp_booster/td_menu.php  hook_wp_nav_menu_objects
        if ($item->is_mega_menu == false) {
            $item_output .= '<a'. $attributes .'>';
        }

        /** This filter is documented in wp-includes/post-template.php */
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

        //tagdiv - megamenu disable link from includes/wp_booster/td_menu.php   hook_wp_nav_menu_objects
        if ($item->is_mega_menu == false) {
            $item_output .= '</a>';
        }
        $item_output .= $args->after;

        /**
         * Filter a menu item's starting output.
         *
         * The menu item's starting output only includes $args->before, the opening <a>,
         * the menu item's title, the closing </a>, and $args->after. Currently, there is
         * no filter for modifying the opening and closing <li> for a menu item.
         *
         * @since 3.0.0
         *
         * @param string $item_output The menu item's starting HTML output.
         * @param object $item        Menu item data object.
         * @param int    $depth       Depth of menu item. Used for padding.
         * @param array  $args        An array of arguments. @see wp_nav_menu()
         */
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}






