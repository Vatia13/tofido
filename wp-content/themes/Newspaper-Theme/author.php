<?php
/*  ----------------------------------------------------------------------------
    the author template
 */

get_header();

//set the template id, used to get the template specific settings
$template_id = 'author';

//prepare the loop variables
global $loop_module_id, $loop_sidebar_position, $part_cur_auth_obj;
$loop_module_id = td_util::get_option('tds_' . $template_id . '_page_layout', 1); //module 1 is default
$loop_sidebar_position = td_util::get_option('tds_' . $template_id . '_sidebar_pos'); //sidebar right is default (empty)


//read the current author object - used by here in title and by /parts/author-header.php
$part_cur_auth_obj = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));


//set the global current author object, used by widgets (author widget)
td_global::$current_author_obj = $part_cur_auth_obj;




switch ($loop_sidebar_position) {

    /*  ----------------------------------------------------------------------------
        This is the default option
        If you set the author template with the right sidebar the theme will use this part
    */
    default:
        echo td_page_generator::wrap_start();
        ?>
            <div class="span8 column_container">

                <?php echo td_page_generator::get_author_breadcrumbs($part_cur_auth_obj); // generate the breadcrumbs ?>

                <h1 itemprop="name" class="entry-title td-page-title">
                    <span><?php echo $part_cur_auth_obj->display_name; ?></span>
                </h1>

                <?php
                //load the author box located in - parts/page-author-box.php - can be overwritten by the child theme
                locate_template('parts/page-author-box.php', true);
                ?>

                <?php locate_template('loop.php', true);?>

                <?php echo td_page_generator::get_pagination(); // the pagination?>

            </div>
            <div class="span4 column_container">
                <?php get_sidebar(); ?>
            </div>
        <?php
        echo td_page_generator::wrap_end();
        break;



    /*  ----------------------------------------------------------------------------
        If you set the author template with sidebar left the theme will render this part
    */
    case 'sidebar_left':
        echo td_page_generator::wrap_start();
        ?>
            <div class="span4 column_container">
                <?php get_sidebar(); ?>
            </div>
            <div class="span8 column_container">

                <?php echo td_page_generator::get_author_breadcrumbs($part_cur_auth_obj); // generate the breadcrumbs ?>

                <h1 itemprop="name" class="entry-title td-page-title">
                    <span><?php echo $part_cur_auth_obj->display_name; ?></span>
                </h1>

                <?php
                //load the author box located in - parts/page-author-box.php - can be overwritten by the child theme
                locate_template('parts/page-author-box.php', true);
                ?>

                <?php locate_template('loop.php', true);?>

                <?php echo td_page_generator::get_pagination(); // the pagination?>

            </div>
        <?php
        echo td_page_generator::wrap_end();
        break;



    /*  ----------------------------------------------------------------------------
        If you set the author template with no sidebar the theme will use this part
    */
    case 'no_sidebar':
        echo td_page_generator::wrap_start();
        ?>
            <div class="span12 column_container">

                <?php echo td_page_generator::get_author_breadcrumbs($part_cur_auth_obj); // generate the breadcrumbs ?>

                <h1 itemprop="name" class="entry-title td-page-title">
                    <span><?php echo $part_cur_auth_obj->display_name; ?></span>
                </h1>

                <?php
                //load the author box located in - parts/page-author-box.php - can be overwritten by the child theme
                locate_template('parts/page-author-box.php', true);
                ?>

                <?php locate_template('loop.php', true);?>

                <?php echo td_page_generator::get_pagination(); // the pagination?>

            </div>
        <?php
        echo td_page_generator::wrap_end();
        break;




}


get_footer();
?>