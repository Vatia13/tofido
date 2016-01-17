<?php
/**
 * single blog post template 1
 */


global $loop_sidebar_position;

// we check the sidebar position and for each one we have a different case
switch ($loop_sidebar_position) {


    default: // sidebar right - the default sidebar position
        echo td_page_generator::wrap_start();
        ?>
            <div class="span8 column_container td-post-content" role="main" itemprop="mainContentOfPage">
                <?php
                locate_template('loop-single-1.php', true);
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
            locate_template('loop-single-1.php', true);
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
            locate_template('loop-single-1.php', true);
            comments_template('', true);
            ?>
        </div>
        <?php
        echo td_page_generator::wrap_end();
        break;

}