<?php
/*  ----------------------------------------------------------------------------
    the archive(s) template
 */

get_header();


//set the template id, used to get the template specific settings
$template_id = 'archive';

//prepare the loop variables
global $loop_module_id, $loop_sidebar_position, $part_cur_auth_obj;
$loop_module_id = td_util::get_option('tds_' . $template_id . '_page_layout', 1); //module 1 is default
$loop_sidebar_position = td_util::get_option('tds_' . $template_id . '_sidebar_pos'); //sidebar right is default (empty)


//read the current author object - used by here in title and by /parts/author-header.php
$part_cur_auth_obj = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));


//prepare the archives page title
if (is_day()) {
    $td_archive_title = __td('Daily Archives: ') . get_the_date();
} elseif (is_month()) {
    $td_archive_title = __td('Monthly Archives: ') . get_the_date('F Y');
} elseif (is_year()) {
    $td_archive_title = __td('Yearly Archives: ') . get_the_date('Y');
} else {
    $td_archive_title = __td('Archives');
}




switch ($loop_sidebar_position) {
    case 'sidebar_left':
        echo td_page_generator::wrap_start();
        ?>
        <div class="span4 column_container">
            <?php get_sidebar(); ?>
        </div>
        <div class="span8 column_container">

            <?php echo td_page_generator::get_archive_breadcrumbs(); // get the breadcrumbs - /includes/wp_booster/td_page_generator.php ?>

            <h1 itemprop="name" class="entry-title td-page-title">
                <span><?php echo $td_archive_title; ?></span>
            </h1>

            <?php locate_template('loop.php', true);?>

            <?php echo td_page_generator::get_pagination(); // get the pagination - /includes/wp_booster/td_page_generator.php ?>

        </div>
        <?php
        echo td_page_generator::wrap_end();
        break;

    case 'no_sidebar':
        echo td_page_generator::wrap_start();
        ?>
        <div class="span12 column_container">

            <?php echo td_page_generator::get_archive_breadcrumbs(); // get the breadcrumbs - /includes/wp_booster/td_page_generator.php ?>

            <h1 itemprop="name" class="entry-title td-page-title">
                <span><?php echo $td_archive_title; ?></span>
            </h1>

            <?php locate_template('loop.php', true);?>

            <?php echo td_page_generator::get_pagination(); // get the pagination - /includes/wp_booster/td_page_generator.php ?>

        </div>
        <?php
        echo td_page_generator::wrap_end();
        break;



    default:
        echo td_page_generator::wrap_start();
        ?>
            <div class="span8 column_container">
                <?php echo td_page_generator::get_archive_breadcrumbs(); // get the breadcrumbs - /includes/wp_booster/td_page_generator.php ?>

                <h1 itemprop="name" class="entry-title td-page-title">
                    <span><?php echo $td_archive_title; ?></span>
                </h1>

                <?php locate_template('loop.php', true);?>

                <?php echo td_page_generator::get_pagination(); // get the pagination - /includes/wp_booster/td_page_generator.php ?>

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