<?php
/*  ----------------------------------------------------------------------------
    the author template
 */

get_header();




//set the template id, used to get the template specific settings
$template_id = 'tag';

//prepare the loop variables
global $loop_module_id, $loop_sidebar_position;
$loop_module_id = td_util::get_option('tds_' . $template_id . '_page_layout', 1); //module 1 is default
$loop_sidebar_position = td_util::get_option('tds_' . $template_id . '_sidebar_pos'); //sidebar right is default (empty)



$current_tag_name = single_tag_title( '', false );

switch ($loop_sidebar_position) {
    case 'sidebar_left':
        echo td_page_generator::wrap_start();
        ?>
        <div class="span4 column_container">
            <?php get_sidebar(); ?>
        </div>
        <div class="span8 column_container">

            <?php echo td_page_generator::get_tag_breadcrumbs($current_tag_name);?>

            <h1 itemprop="name" class="entry-title td-page-title">
                <?php /*<a itemprop="url" href="<?php echo get_tag_link(get_query_var('tag_id'));?>" rel="bookmark" title="<?php echo __td('Posts in ') . $current_tag_name?>">Tag: <?php echo $current_tag_name ?></a>*/?>
                <span><?php echo __td('Tag');?>: <?php echo $current_tag_name ?></span>
            </h1>

            <?php
            $td_tag_description = tag_description();
            if (!empty($td_tag_description)) {
                echo '<div class="entry-content">';
                echo $td_tag_description;
                echo '</div>';
            }
            locate_template('loop.php', true);

            echo td_page_generator::get_pagination();
            ?>

        </div>
        <?php
        echo td_page_generator::wrap_end();
        break;

    case 'no_sidebar':
        echo td_page_generator::wrap_start();
        ?>
        <div class="span12 column_container">

            <?php echo td_page_generator::get_tag_breadcrumbs($current_tag_name);?>

            <h1 itemprop="name" class="entry-title td-page-title">
                <?php /*<a itemprop="url" href="<?php echo get_tag_link(get_query_var('tag_id'));?>" rel="bookmark" title="<?php echo __td('Posts in ') . $current_tag_name?>"><?php echo $current_tag_name ?></a>*/?>
                <span><?php echo $current_tag_name ?></span>
            </h1>

            <?php
            $td_tag_description = tag_description();
            if (!empty($td_tag_description)) {
                echo '<div class="entry-content">';
                echo $td_tag_description;
                echo '</div>';
            }
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

                <?php echo td_page_generator::get_tag_breadcrumbs($current_tag_name);?>

                <h1 itemprop="name" class="entry-title td-page-title">
                    <?php /*<a itemprop="url" href="<?php echo get_tag_link(get_query_var('tag_id'));?>" rel="bookmark" title="<?php echo __td('Posts in ') . $current_tag_name?>"><?php echo $current_tag_name ?></a>*/?>
                    <span><?php echo $current_tag_name ?></span>
                </h1>

                <?php
                $td_tag_description = tag_description();
                if (!empty($td_tag_description)) {
                    echo '<div class="entry-content">';
                    echo $td_tag_description;
                    echo '</div>';
                }
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
?>