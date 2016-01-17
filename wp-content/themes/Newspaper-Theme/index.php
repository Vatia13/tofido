<?php
/*  ----------------------------------------------------------------------------
    the blog index template
 */

get_header();

//set the template id, used to get the template specific settings - this was the old home.php template
$template_id = 'home';

//prepare the loop variables
global $loop_module_id, $loop_sidebar_position;
$loop_module_id = td_util::get_option('tds_' . $template_id . '_page_layout', 1); //module 1 is default
$loop_sidebar_position = td_util::get_option('tds_' . $template_id . '_sidebar_pos'); //sidebar right is default (empty)


switch ($loop_sidebar_position) {
    case 'sidebar_left':
        echo td_page_generator::wrap_start();
        ?>
        <div class="span4 column_container">
            <?php get_sidebar(); ?>
        </div>
        <div class="span8 column_container">

            <?php
            echo td_page_generator::get_home_breadcrumbs();
            locate_template('loop.php', true);

            echo td_page_generator::get_pagination();
            ?>

        </div>
        <?php
        echo td_page_generator::wrap_end();
        break;

    case 'no_sidebar':
        //td_global::$load_featured_img_from_template = 'art-slide-big';
        td_global::$load_featured_img_from_template = 'full';

        echo td_page_generator::wrap_start();
        ?>
        <div class="span12 column_container">

            <?php
            echo td_page_generator::get_home_breadcrumbs();
            locate_template('loop.php', true);

            echo td_page_generator::get_pagination();
            ?>

        </div>
        <?php
        echo td_page_generator::wrap_end();
        break;



    default:
        echo td_page_generator::wrap_start();
        ?>
            <div class="span8 column_container">

                <?php
                echo td_page_generator::get_home_breadcrumbs();
                locate_template('loop.php', true);

                echo td_page_generator::get_pagination();
                ?>

            </div>
            <div class="span4 column_container">
                <?php get_sidebar(); ?>
            </div>
        <?php
        echo td_page_generator::wrap_end();
        break;
}


get_footer();