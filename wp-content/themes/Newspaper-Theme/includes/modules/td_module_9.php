<?php


class td_module_9 extends td_module {

    function __construct($post) {
        //run the parrent constructor
        parent::__construct($post);
    }

    function render() {
        ob_start();
        ?>

        <div class="td_mod_wrap td_mod9 <?php echo $this->get_no_thumb_class();?>" <?php echo $this->get_item_scope();?>>
            <?php echo $this->get_image('art-big-1col');?>

            <div class="item-details">
                <?php echo $this->get_title(td_util::get_option('tds_mod9_title_excerpt'));?>
                <div class="meta-info">
                    <?php //echo $this->get_author();?>
                    <?php echo $this->get_date();?>
                    <?php echo $this->get_commentsAndViews();?>
                </div>


                <p><div class="td-post-text-excerpt"><?php echo $this->get_excerpt(td_util::get_option('tds_mod9_content_excerpt'));?></div></p>

                <div class="more-link-wrap wpb_button td_read_more clearfix">
                    <a href="<?php echo $this->href;?>"><?php echo __td('Continue', TD_THEME_NAME);?></a>
                </div>

            </div>

            <?php echo $this->get_item_scope_meta();?>
        </div>

        <?php return ob_get_clean();
    }
}