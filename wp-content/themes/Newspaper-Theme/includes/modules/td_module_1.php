<?php

/**
 * This is the full blog post module
 */
class td_module_1 extends td_module_blog {
    var $show_excerpt = false; //this is changed by module 7 (module 7 inherits this module)


    function __construct($post) {
        //run the parrent constructor
        parent::__construct($post);
    }

    function render() {
        ob_start();
        $buffy = '';
        ?>

        <article id="post-<?php echo $this->post->ID;?>" class="<?php echo join(' ', get_post_class());?>" <?php echo $this->get_item_scope();?>>

            <header>

                <?php echo $this->get_title();?>

                <div class="meta-info">
                    <?php echo $this->get_category();?>
                    <?php //echo $this->get_author();?>
                    <?php echo $this->get_date(false);?>
                    <?php echo $this->get_commentsAndViews();?>
                </div>
            </header>


            <?php if (!empty($this->td_post_theme_settings['td_subtitle'])) { ?>
                <p class="td-sub-title"><?php echo $this->td_post_theme_settings['td_subtitle'];?></p>
            <?php } ?>


            <?php
            // override the default featured image by the templates (single.php and home.php/index.php - blog loop)
            if (!empty(td_global::$load_featured_img_from_template)) {
                echo $this->get_image(td_global::$load_featured_img_from_template);
            } else {
                 echo $this->get_image('featured-image');
            }
            ?>


            <?php if ($this->show_excerpt === true) { //module 7 uses this?>

                <p><?php echo $this->get_excerpt(td_util::get_option('tds_' . 'mod7_content_excerpt'));?></p>
                <div class="more-link-wrap wpb_button td_read_more clearfix">
                    <a href="<?php echo $this->href;?>"><?php echo __td('Continue', TD_THEME_NAME);?></a>
                </div>

            <?php } else { ?>

                <div class="td-post-text-content">
                    <?php echo $this->get_content();?>
                </div>

            <?php } ?>

            <div class="clearfix"></div>

            <footer>
                <?php echo $this->get_post_pagination();?>
                <?php echo $this->get_review();?>
                <?php echo $this->get_the_tags();?>
                <?php echo $this->get_source_and_via();?>
                <?php echo $this->get_social_sharing();?>
                <?php echo $this->get_next_prev_posts();?>
                <?php echo $this->get_author_box();?>
            </footer>

        </article> <!-- /.post -->

        <?php echo $this->related_posts();?>
        <?php
        //return $buffy;
        return ob_get_clean();
    }
}