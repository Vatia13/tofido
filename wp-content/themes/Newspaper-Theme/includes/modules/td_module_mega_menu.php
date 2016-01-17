<?php

class td_module_mega_menu extends td_module {

    function __construct($post) {
        //run the parrent constructor
        parent::__construct($post);
    }

    function render() {
        ob_start();
        ?>

        <div class="td_mod_mega_menu">
            <?php echo $this->get_image('td_198x143');?>
            <div class="item-details">
                <?php echo $this->get_title(td_util::get_option('tds_mod3_title_excerpt'));?>
            </div>
        </div>
        <?php return ob_get_clean();
    }





    function get_title($excerpt_lenght = '') {
        $buffy = '';
        $buffy .= '<h4 itemprop="name" class="entry-title">';
        $buffy .='<a itemprop="url" href="' . $this->href . '" rel="bookmark" title="' . $this->title_attribute . '">';
        if (!empty($excerpt_lenght)) {
            $buffy .= td_util::excerpt($this->title, $excerpt_lenght, 'show_shortcodes');
        } else {
            $buffy .= $this->title;
        }
        $buffy .='</a>';
        $buffy .= '</h4>';
        return $buffy;
    }







}