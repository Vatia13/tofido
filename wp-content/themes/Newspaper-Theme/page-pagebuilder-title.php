<?php
/* Template Name: Page builder - with title */


get_header();

if (have_posts()) { ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <div class="container td-page-wrap">
            <div class="row">
                <div class="span12">
                    <div class="td-grid-wrap">
                        <div class="container-fluid">
                            <h1 itemprop="name" class="entry-title td-page-title">
                                <?php /*<a itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>*/?>
                                <span><?php the_title(); ?></span>
                            </h1>
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php } else {
    echo td_page_generator::no_posts();
}

get_footer();