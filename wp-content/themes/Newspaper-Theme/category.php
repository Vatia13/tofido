<?php
/*  ----------------------------------------------------------------------------
    the blog index template
 */

get_header();

global $loop_module_id, $loop_sidebar_position, $cur_cat_obj;

$cur_cat_id = get_query_var('cat');
$cur_cat_obj = get_category($cur_cat_id);


//read the per category setting
$tdc_layout = td_util::get_category_option($cur_cat_id, 'tdc_layout');//swich by RADU A, get_tax_meta($cur_cat_id, 'tdc_layout');
$tdc_sidebar_pos = td_util::get_category_option($cur_cat_id, 'tdc_sidebar_pos');////swich by RADU A,  get_tax_meta($cur_cat_id, 'tdc_sidebar_pos');

//set the template id, used to get the template specific settings
$template_id = 'category';

//prepare the loop variables

$loop_module_id = td_util::get_option('tds_' . $template_id . '_page_layout', 1); //module 1 is default
$loop_sidebar_position = td_util::get_option('tds_' . $template_id . '_sidebar_pos'); //sidebar right is default (empty)

//override the category global template with the category specific settings
if (!empty($tdc_layout)) {
    $loop_module_id = $tdc_layout;
}

if (!empty($tdc_sidebar_pos)) {
    $loop_sidebar_position = $tdc_sidebar_pos;
}


switch ($loop_sidebar_position) {
    case 'sidebar_left':
        echo td_page_generator::wrap_start();
        ?>
        <div class="span4 column_container">
            <?php get_sidebar(); ?>
        </div>
        <div class="span8 column_container">
            <?php
            //load the author box located in - parts/page-category-slider.php - can be overwritten by the child theme
            locate_template('parts/page-category-slider.php', true);
            ?>


            <?php locate_template('loop.php', true);?>

            <?php echo td_page_generator::get_pagination(); ?>
        </div>
        <?php
        echo td_page_generator::wrap_end();
        break;

    case 'no_sidebar':
        echo td_page_generator::wrap_start();
        ?>
        <div class="span12 column_container">
            <?php
            //load the author box located in - parts/page-category-slider.php - can be overwritten by the child theme
            locate_template('parts/page-category-slider.php', true);
            ?>


            <?php locate_template('loop.php', true);?>

            <?php echo td_page_generator::get_pagination(); ?>
        </div>
        <?php
        echo td_page_generator::wrap_end();
        break;



    default:
        echo td_page_generator::wrap_start();
        ?>
            <div class="span8 column_container">
                <?php
                //load the author box located in - parts/page-category-slider.php - can be overwritten by the child theme
                locate_template('parts/page-category-slider.php', true);
                ?>


                <?php locate_template('loop.php', true);?>

                <?php echo td_page_generator::get_pagination(); ?>
            </div>
            <div class="span4 column_container">
                <?php get_sidebar(); ?>
            </div>
        <?php
        echo td_page_generator::wrap_end();
        break;
}


get_footer();



?>