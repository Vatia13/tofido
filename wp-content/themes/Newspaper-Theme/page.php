<?php
/*  ----------------------------------------------------------------------------
    the page template
 */


get_header();


//set the template id, used to get the template specific settings
$template_id = 'page';


$loop_sidebar_position = td_util::get_option('tds_' . $template_id . '_sidebar_pos'); //sidebar right is default (empty)


//read the custom single post settings - this setting overids all of them
$td_page = get_post_meta($post->ID, 'td_page', true);
if (!empty($td_page['td_sidebar_position'])) {
    $loop_sidebar_position = $td_page['td_sidebar_position'];
}

switch ($loop_sidebar_position) {
    case 'sidebar_left':
        echo td_page_generator::wrap_start();
        ?>
        <div class="span4 column_container" role="complementary" itemscope="itemscope" itemtype="<?php echo td_global::$http_or_https?>://schema.org/WPSideBar">
            <?php get_sidebar(); ?>
        </div>
        <div class="span8 column_container td-no-pagination" role="main" itemscope="itemscope" itemprop="mainContentOfPage" itemtype="<?php echo td_global::$http_or_https?>://schema.org/CreativeWork">

            <?php

            if (have_posts()) {
                while ( have_posts() ) : the_post();
                    echo td_page_generator::get_page_breadcrumbs(get_the_title());
                    ?>
                    <h1 itemprop="name" class="entry-title td-page-title">
                        <?php /*<a itemprop="url" href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title_attribute() ?>"><?php the_title() ?></a>*/?>
                        <span><?php the_title() ?></span>
                    </h1>
                    <?php
                    the_content();
                    if (td_util::get_option('tds_disable_comments_pages') == 'show_comments') {
                        comments_template('', true);
                    }
                endwhile; //end loop
            }
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
            if (have_posts()) {
                while ( have_posts() ) : the_post();
                    echo td_page_generator::get_page_breadcrumbs(get_the_title());
                    ?>
                    <h1 itemprop="name" class="entry-title td-page-title">
                        <?php /*<a itemprop="url" href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title_attribute() ?>"><?php the_title() ?></a>*/?>
                        <span><?php the_title() ?></span>
                    </h1>
                    <?php
                    the_content();
                    if (td_util::get_option('tds_disable_comments_pages') == 'show_comments') {
                        comments_template('', true);
                    }
                endwhile; //end loop
            }
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
                    if (have_posts()) {
                        while ( have_posts() ) : the_post();
                            echo td_page_generator::get_page_breadcrumbs(get_the_title());
                            ?>
                            <h1 itemprop="name" class="entry-title td-page-title">
                                <?php /*<a itemprop="url" href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title_attribute() ?>"><?php the_title() ?></a>*/?>
                                <span><?php the_title() ?></span>
                            </h1>
                            <?php
                            the_content();
                            if (td_util::get_option('tds_disable_comments_pages') == 'show_comments') {
                                comments_template('', true);
                            }
                        endwhile;//end loop
                    }
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