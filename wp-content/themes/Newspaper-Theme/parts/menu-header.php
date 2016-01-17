<?php

/*  ----------------------------------------------------------------------------
    The main menu of the theme - the mobile menu is not here, it is in mobile-menu.php
 */

?>
<!-- header menu -->

<div class="td-menu-placeholder">

    <div class="td-menu-background">
        <div class="container td-menu-wrap">



            <div class="row-fluid td-menu-header">

                <div class="span11">
                    <?php
                    $tds_header_style = td_util::get_option('tds_header_style');
                    if ($tds_header_style != '3' && $tds_header_style != '6') { //do not show small logo on full width pages
                        ?>
                        <div class="mobile-logo-wrap">
                            <?php
                            //read the logo + retina logo
                            $td_customLogo = td_util::get_option('tds_logo_upload');
                            $td_customLogoR = td_util::get_option('tds_logo_upload_r');

                            $td_logo_text = td_util::get_option('tds_logo_text');
                            $td_tagline_text = td_util::get_option('tds_tagline_text');

                            $td_logo_alt = td_util::get_option('tds_logo_alt');
                            $td_logo_title = td_util::get_option('tds_logo_title');

                            if (!empty($td_logo_title)) {
                                $td_logo_title = ' title="' . $td_logo_title . '"';
                            }

                            if (td_util::get_option('tds_logo_menu_upload') == '') {
                                if (!empty($td_customLogoR)) {
                                    //if retina
                                    ?>
                                    <a itemprop="url" href="<?php echo home_url(); ?>">
                                        <img width="300" class="td-retina-data"  data-retina="<?php echo htmlentities($td_customLogoR) ?>" src="<?php echo $td_customLogo?>" alt="<?php echo $td_logo_alt ?>"<?php echo $td_logo_title ?>/>
                                    </a>
                                    <meta itemprop="name" content="<?php bloginfo('name')?>">
                                <?php
                                } else {
                                    //not retina
                                    if (!empty($td_customLogo)) {
                                        ?>
                                        <a itemprop="url" href="<?php echo home_url(); ?>"><img width="300"  src="<?php echo $td_customLogo?>" alt="<?php echo $td_logo_alt ?>"<?php echo $td_logo_title ?>/></a>
                                        <meta itemprop="name" content="<?php bloginfo('name')?>">
                                    <?php
                                    }
                                }
                            } else {
                                locate_template('parts/logo-mobile.php', true, false);
                            }
                            ?>
                        </div>
                    <?php } ?>


                    <div id="td-top-mobile-toggle">
                        <ul class="sf-menu">
                            <li>
                                <a href="#">
                                    <span class="menu_icon td-sp td-sp-ico-menu"></span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div id="td-top-menu" role="navigation" itemscope="itemscope" itemtype="<?php echo td_global::$http_or_https?>://schema.org/SiteNavigationElement">

                            <?php

                            wp_nav_menu(array(
                                'theme_location' => 'header-menu',
                                'menu_class'=> 'sf-menu',
                                'fallback_cb' => 'td_wp_page_menu',
                                'walker' => new td_tagdiv_walker_nav_menu()
                            ));

                            //if no menu
                            function td_wp_page_menu() {
                                //this is the default menu
                                echo '<ul class="sf-menu">';
                                echo '<li class="menu-item-first"><a href="' . home_url() . '/wp-admin/nav-menus.php?action=locations">Click here - to select or create a menu</a></li>';
                                echo '</ul>';
                            }




                            ?>
                    </div>



                </div>

                <div class="span1" id="td-top-search">
                    <!-- Search -->
                    <div class="header-search-wrap">
                        <div class="dropdown header-search">
                            <a id="search-button" href="#" role="button" class="dropdown-toggle " data-toggle="dropdown"><span class="td-sp td-sp-ico-search"></span></a>
                            <div class="dropdown-menu" aria-labelledby="search-button">
                                <form role="search" method="get" class="td-search-form" action="<?php echo home_url( '/' ); ?>">
                                    <div class="td-head-form-search-wrap">
                                        <input class="needsclick" id="td-header-search" type="text" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" /><input class="wpb_button wpb_btn-inverse btn" type="submit" id="td-header-search-top" value="<?php _etd('Search')?>" />
                                    </div>
                                </form>
                                <div id="td-aj-search"></div>
                            </div>
                        </div>
                    </div>
                </div>


            </div> <!-- /.row-fluid -->
        </div> <!-- /.td-menu-wrap -->
    </div> <!-- /.td-menu-background -->
</div> <!-- /.td-menu-placeholder -->