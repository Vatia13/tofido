<?php
/**
 * The single post loop for post template 1
 **/

if (have_posts()) {
    the_post();

    $td_mod_single = new td_module_1($post);



    //show the breadcrumb
    if (get_post_type($post) == 'post') {
        echo td_page_generator::get_single_breadcrumbs($td_mod_single->title);
    } else {
        echo td_page_generator::get_page_breadcrumbs($td_mod_single->title);
    }
    ?>

    <article id="post-<?php echo $td_mod_single->post->ID;?>" class="<?php echo join(' ', get_post_class());?>" <?php echo $td_mod_single->get_item_scope();?>>

        <header>

            <?php echo $td_mod_single->get_title();?>

            <div class="meta-info">
                <?php echo $td_mod_single->get_category();?>
                <?php //echo $td_mod_single->get_author();?>
                <?php echo $td_mod_single->get_date(false);?>
                <?php echo $td_mod_single->get_commentsAndViews();?>
            </div>
        </header>


        <?php if (!empty($td_mod_single->td_post_theme_settings['td_subtitle'])) { ?>
            <p class="td-sub-title"><?php echo $td_mod_single->td_post_theme_settings['td_subtitle'];?></p>
        <?php } ?>


        <?php
        // override the default featured image by the templates (single.php and home.php/index.php - blog loop)
        if (!empty(td_global::$load_featured_img_from_template)) {
            echo $td_mod_single->get_image(td_global::$load_featured_img_from_template);
        } else {
            echo $td_mod_single->get_image('art-big-1col');
        }
        ?>

        <div class="td-post-text-content">
            <?php echo $td_mod_single->get_content();?>
        </div>


        <div class="clearfix"></div>

        <footer>
            <?php echo $td_mod_single->get_post_pagination();?>
            <?php echo $td_mod_single->get_review();?>
            <?php echo $td_mod_single->get_source_and_via();?>
            <?php echo $td_mod_single->get_social_sharing();?>
            <?php echo $td_mod_single->get_social_like_tweet();?>
            <?php echo $td_mod_single->get_next_prev_posts();?>
            <?php echo $td_mod_single->get_author_box();?>


            <?php echo $td_mod_single->get_item_scope_meta();?>
        </footer>

    </article> <!-- /.post -->

    <?php echo $td_mod_single->related_posts();?>

<?php
} else {
    //no posts
    echo td_page_generator::no_posts();
}?>