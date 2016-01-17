<?php
/*  ----------------------------------------------------------------------------
    the attachment template
 */


get_header();




//set the template id, used to get the template specific settings
$template_id = 'attachment';

//prepare the loop variables
global $loop_sidebar_position;
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
            if (!empty($post->post_parent) and !empty($post->post_title)) {
                echo td_page_generator::get_attachment_breadcrumbs($post->post_parent, $post->post_title);
            }


            if (is_single()) {?>
                <h1 itemprop="name" class="entry-title td-page-title">
                    <span><?php the_title(); ?></span>
                </h1><?php
            } else {?>
                <h1 itemprop="name" class="entry-title td-page-title">
                    <a itemprop="url" href="<?php ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                </h1><?php
            }

            get_template_part('loop', 'attachment');
            ?>

        </div>
        <?php
        echo td_page_generator::wrap_end();
        break;

    case 'no_sidebar':
        echo td_page_generator::wrap_start();
        ?>
        <div class="span12 column_container">

            <?php
            if (!empty($post->post_parent) and !empty($post->post_title)) {
                echo td_page_generator::get_attachment_breadcrumbs($post->post_parent, $post->post_title);
            }


            if (is_single()) {?>
                <h1 itemprop="name" class="entry-title td-page-title">
                    <span><?php the_title(); ?></span>
                </h1><?php
            } else {?>
                <h1 itemprop="name" class="entry-title td-page-title">
                    <a itemprop="url" href="<?php ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                </h1><?php
            }



            get_template_part('loop', 'attachment');
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
                if (!empty($post->post_parent) and !empty($post->post_title)) {
                    echo td_page_generator::get_attachment_breadcrumbs($post->post_parent, $post->post_title);
                }

                if (is_single()) {?>
                    <h1 itemprop="name" class="entry-title td-page-title">
                            <span><?php the_title(); ?></span>
                    </h1><?php
                } else {?>
                    <h1 itemprop="name" class="entry-title td-page-title">
                        <a itemprop="url" href="<?php ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    </h1><?php
                }

                    get_template_part('loop', 'attachment');
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