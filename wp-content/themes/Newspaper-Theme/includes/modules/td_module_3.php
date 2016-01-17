<?php


class td_module_3 extends td_module {

    function __construct($post) {
        //run the parrent constructor
        parent::__construct($post);
    }

    function render() {
        ob_start();
        ?>

        <div class="td_mod3 td_mod_wrap <?php echo $this->get_no_thumb_class();?>" <?php echo $this->get_item_scope();?>>
        <?php echo $this->get_image('art-thumb');?>
        <div class="item-details">
            <?php echo $this->get_title(td_util::get_option('tds_mod3_title_excerpt'));?>
            <div class="meta-info">
                <?php //echo $this->get_author();?>
                <?php echo $this->get_date();?>
                <?php //echo $this->get_commentsAndViews();?>
            </div>
        </div>
        <?php echo $this->get_item_scope_meta();?>
        </div>

        <?php return ob_get_clean();
    }
}