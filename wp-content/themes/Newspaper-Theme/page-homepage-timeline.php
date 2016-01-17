<?php
/*
Template Name: Timeline
*/


get_header();


//set the template id, used to get the template specific settings
$template_id = 'timeline';
td_global::$current_template = $template_id;


global $paged, $post; //$more is a hack to fix the read more loop

$td_page = (get_query_var('page')) ? get_query_var('page') : 1; //rewrite the global var
$td_paged = (get_query_var('paged')) ? get_query_var('paged') : 1; //rewrite the global var


//paged works on single pages, page - works on homepage
if ($td_paged > $td_page) {
    $paged = $td_paged;
} else {
    $paged = $td_page;
}


//fet the sidebar position for this template; sidebar right is default
$loop_sidebar_position = td_util::get_option('tds_' . $template_id . '_sidebar_pos');


//modifing main query of the page
query_posts(array('orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => 50, 'paged' =>$td_paged));


switch ($loop_sidebar_position) {
    case 'sidebar_left':
        echo td_page_generator::wrap_start();
        ?>
        <div class="span4 column_container" role="complementary" itemscope="itemscope" itemtype="<?php echo td_global::$http_or_https?>://schema.org/WPSideBar">
            <?php get_sidebar(); ?>
        </div>
        <div class="span8 column_container td-no-pagination" role="main" itemscope="itemscope" itemprop="mainContentOfPage" itemtype="<?php echo td_global::$http_or_https?>://schema.org/CreativeWork">

            <?php
            locate_template('loop-timeline.php', true);

            //adding paginations
            echo td_page_generator::get_pagination();

            //reseting main query
            wp_reset_query();
            ?>

        </div>
        <?php
        echo td_page_generator::wrap_end();
        break;

    case 'no_sidebar':
        echo td_page_generator::wrap_start();
        ?>
        <div class="span12 column_container td-no-pagination" role="main" itemscope="itemscope" itemprop="mainContentOfPage" itemtype="<?php echo td_global::$http_or_https?>://schema.org/CreativeWork">

            <?php
            locate_template('loop-timeline.php', true);

            //adding paginations
            echo td_page_generator::get_pagination();

            //reseting main query
            wp_reset_query();
            ?>

        </div>
        <?php
        echo td_page_generator::wrap_end();
        break;



    default:
        echo td_page_generator::wrap_start();
        ?>
            <div class="span8 column_container td-no-pagination" role="main" itemscope="itemscope" itemprop="mainContentOfPage" itemtype="<?php echo td_global::$http_or_https?>://schema.org/CreativeWork">
                <?php
                locate_template('loop-timeline.php', true);

                //adding paginations
                echo td_page_generator::get_pagination();

                //reseting main query
                wp_reset_query();
                ?>
            </div>
            <div class="span4 column_container" role="complementary" itemscope="itemscope" itemtype="<?php echo td_global::$http_or_https?>://schema.org/WPSideBar">
                <?php get_sidebar(); ?>
            </div>
        <?php
        echo td_page_generator::wrap_end();
        break;
}


get_footer();