<?php
/* Template Name: Homepage - blank */

get_header();

if (have_posts()) { ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <div class="container td-page-wrap">
            <div class="row">
                <div class="span12">
                    <div class="td-grid-wrap">
                        <div class="container-fluid">
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