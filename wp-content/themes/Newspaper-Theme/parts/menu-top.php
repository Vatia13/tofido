<?php

/*  ----------------------------------------------------------------------------
    This is the black top menu
 */

?>
<div class="td-header-menu-wrap">
    <div class="container">
        <div class="row">
            <div class="span9">
                <?php
                    if (td_util::get_option('tds_data_top_menu') == 'show') {
                        $tds_data_time = td_util::get_option('tds_data_time_format');
                        if ($tds_data_time == '') {
                            $tds_data_time = 'l, F j, Y';
                        }
                        echo '<div class="td_data_time">';
                        echo date_i18n(stripslashes($tds_data_time));
                        echo '</div>';
                    }
                ?>
                <?php
                    wp_nav_menu(array(
                        'theme_location' => 'top-menu',
                        'menu_class'=> 'top-header-menu',
                        'fallback_cb' => 'td_wp_top_menu',
                        'container_class' => 'menu-top-container'
                    ));

                    function td_wp_top_menu() {
                        echo '<ul class="top-header-menu">';
                        echo '<li class="menu-item-first"><a href="' . home_url() . '/wp-admin/nav-menus.php?action=locations">Click here - to select or create a menu</a></li>';
                        echo '</ul>';
                    }

                ?>
            </div>

            <div class="span3">
                <?php dynamic_sidebar('Top right (social)'); ?>
            </div>

        </div>
    </div>
</div>


