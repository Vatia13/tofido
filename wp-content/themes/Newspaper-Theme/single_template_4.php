<?php

/**
 * single blog post template 4
 */


global $loop_sidebar_position;
$td_mod_single = new td_module_1($post);



$td_post_featured_image = td_util::get_featured_image_src($post->ID, 'full');

?>

<?php
//if we have a featured image, show it
if (!empty($td_post_featured_image)) { ?>

    <div  class="td-big-slide-background"><div id="td-full-screen-header-image" class="td-image-gradient"></div></div>

    <!-- preload the image -->
    <img src="<?php echo $td_post_featured_image?>" alt="" style="display:none;"/>
    <?php

    td_js_buffer::add_to_footer(
        'jQuery().ready(function() {' . "\r\n" .
        'jQuery("#td-full-screen-header-image").backstretch("' . $td_post_featured_image . '", {fade:1200, centeredY:false});' . "\r\n" .
        '});'
    );
} ?>

<article id="post-<?php echo $td_mod_single->post->ID;?>" class="<?php echo join(' ', get_post_class());?>" <?php echo $td_mod_single->get_item_scope();?>>


    <div class="td-template4-header ">
        <div class="td-header-wrap">
            <div class="td-header-grid">
                <?php
                //show the breadcrumb
                if (get_post_type($post) == 'post') {
                    echo td_page_generator::get_single_breadcrumbs($td_mod_single->title);
                } else {
                    echo td_page_generator::get_page_breadcrumbs($td_mod_single->title);
                } ?>

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
        </div>
    </div>


    <?php
    // we check the sidebar position and for each one we have a different case
    switch ($loop_sidebar_position) {


        default: // sidebar right - the default sidebar position
            echo td_page_generator::wrap_start();
            ?>
                <div class="span8 column_container td-post-content" role="main" itemprop="mainContentOfPage">
                    <?php
                    locate_template('loop-single-4.php', true);
                    comments_template('', true);
                    ?>
                </div>
                <div class="span4 column_container td-post-sidebar" role="complementary" itemscope="itemscope" itemtype="<?php echo td_global::$http_or_https?>://schema.org/WPSideBar">
                    <?php get_sidebar(); ?>
                </div>
            <?php
            echo td_page_generator::wrap_end();
            break;


        case 'sidebar_left':
            echo td_page_generator::wrap_start();
            ?>
            <div class="span4 column_container td-post-sidebar" role="complementary" itemscope="itemscope" itemtype="<?php echo td_global::$http_or_https?>://schema.org/WPSideBar">
                <?php get_sidebar(); ?>
            </div>
            <div class="span8 column_container td-post-content" role="main" itemprop="mainContentOfPage">
                <?php
                locate_template('loop-single-4.php', true);
                comments_template('', true);
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
            <div class="span12 column_container td-post-content" role="main" itemprop="mainContentOfPage">
                <?php
                locate_template('loop-single-4.php', true);
                comments_template('', true);
                ?>
            </div>
            <?php
            echo td_page_generator::wrap_end();
            break;
    }?>
</article> <!-- /.post -->