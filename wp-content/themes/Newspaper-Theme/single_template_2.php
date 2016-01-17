<?php
/**
 * single blog post template 2
 */


global $loop_sidebar_position;
$td_mod_single = new td_module_1($post);
?>

<article id="post-<?php echo $td_mod_single->post->ID;?>" class="<?php echo join(' ', get_post_class());?>" <?php echo $td_mod_single->get_item_scope();?>>

    <?php echo td_page_generator::wrap_start(); ?>
        <div class="span12">

            <?php
            //show the breadcrumb
            if (get_post_type($post) == 'post') {
                echo td_page_generator::get_single_breadcrumbs($td_mod_single->title);
            } else {
                echo td_page_generator::get_page_breadcrumbs($td_mod_single->title);
            }
            ?>

            <header>
                <?php echo $td_mod_single->get_title();?>

                <div class="meta-info">
                    <?php echo $td_mod_single->get_category();?>
                    <?php //echo $td_mod_single->get_author();?>
                    <?php echo $td_mod_single->get_date(false);?>
                    <?php echo $td_mod_single->get_commentsAndViews();?>
                </div>
            </header>
        </div>
    </div> <!-- close the row from td_page_generator -->

    <div class="row-fluid "> <!-- open new row -->
    <?php

        // we check the sidebar position and for each one we have a different case
        switch ($loop_sidebar_position) {

            default: // sidebar right - the default sidebar position
                ?>
                    <div class="span8 column_container td-post-content" role="main" itemprop="mainContentOfPage">
                        <?php
                        locate_template('loop-single-2.php', true);
                        comments_template('', true);
                        ?>
                    </div>
                    <div class="span4 column_container td-post-sidebar" role="complementary" itemscope="itemscope" itemtype="<?php echo td_global::$http_or_https?>://schema.org/WPSideBar">
                        <?php get_sidebar(); ?>
                    </div>
                <?php
                break;


            case 'sidebar_left':
                ?>
                <div class="span4 column_container td-post-sidebar" role="complementary" itemscope="itemscope" itemtype="<?php echo td_global::$http_or_https?>://schema.org/WPSideBar">
                    <?php get_sidebar(); ?>
                </div>
                <div class="span8 column_container td-post-content" role="main" itemprop="mainContentOfPage">
                    <?php
                    locate_template('loop-single-2.php', true);
                    comments_template('', true);
                    ?>
                </div>
                <?php
                break;

            case 'no_sidebar':
                td_global::$load_featured_img_from_template = 'full';
                ?>
                <div class="span12 column_container td-post-content" role="main" itemprop="mainContentOfPage">
                    <?php
                    locate_template('loop-single-2.php', true);
                    comments_template('', true);
                    ?>
                </div>
                <?php
                break;
        }
    echo td_page_generator::wrap_end();
?>
</article> <!-- /.post -->