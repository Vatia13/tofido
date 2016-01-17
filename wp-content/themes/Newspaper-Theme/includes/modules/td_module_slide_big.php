<?php

class td_module_slide_big {//extends td_module {

    //holds the current post we are working with
    private $current_post;

    function __construct() {}

    function get_title_main() {
        $cut_parms = array(
            'char_per_line' => 26,
            'excerpt' => 13, //words
            'line_wrap_start' => '<span class="td-sbig-title">',
            'line_wrap_end' => '</span><span class="td-sbig-sep"></span>'
        );


        //get the excerpt from panel
        $tds_big_slide_big_image_title_excerpt = td_util::get_option('tds_big_slide_big_image_title_excerpt');

        //if set, in the theme panel, get the excerpt length from there
        if(intval($tds_big_slide_big_image_title_excerpt) > 0) {
            $cut_parms['excerpt'] = intval($tds_big_slide_big_image_title_excerpt);
        }

        $buffy = '';

        $buffy .= '<div class="td-sbig-title-wrap">';
        $buffy .='<a class="noSwipe" itemprop="url" href="' . $this->current_post->href . '" rel="bookmark" title="' . $this->current_post->title_attribute . '">';
        $buffy .= td_util::cut_title($cut_parms, $this->current_post->title);
        $buffy .='</a>';
        $buffy .= '</div>';

        return $buffy;

    }

    function get_title_sec_item() {

        //get the excerpt from panel
        $tds_big_slide_small_image_title_excerpt = td_util::get_option('tds_big_slide_small_image_title_excerpt');

        $buffy = '';
        $buffy .= '<div class="td-sbig-title-wrap">';
        $buffy .='<a class="noSwipe" itemprop="url" href="' . $this->current_post->href . '" rel="bookmark" title="' . $this->current_post->title_attribute . '">';

        //make the title
        if(intval($tds_big_slide_small_image_title_excerpt) > 0) {
            $buffy .= td_util::excerpt($this->current_post->title, $tds_big_slide_small_image_title_excerpt);
        } else {
            $buffy .= $this->current_post->title;
        }

        $buffy .='</a>';
        $buffy .= '</div>';

        return $buffy;
    }

    //$posts, $td_create_slider
    function render($array_param) {
        $posts = $array_param[0];
        $id_slider = $array_param[2];

        //check to see if we have an open item wrapper
        $item_tag = 0;

        ob_start();?>

        <?php //<div class="td-big-grid-wrapper">;?>

        <?php
        $i_cont = 0;
        $item_counter = 1;
        foreach ($posts as $post) {
            //run the td_module constructor for each post
            $this->current_post = new td_module($post);

            $class_name_small_posts = '';

            if($i_cont == 0 /*and $td_create_slider == 1*/) {
                echo '<div class="item" id="' . $id_slider . '_item_' . $item_counter . '">';
                $class_name_small_posts = '';
                $item_tag = 1;//open the item div wrapper
            } else {
                $class_name_small_posts = 'td-big-grid-post-sec';
            }?>


            <div class="td-big-grid-post-<?php echo $i_cont;?> td-big-grid-post <?php echo $class_name_small_posts;?>" <?php echo $this->current_post->get_item_scope();?>>
                <?php
                //get different image sizes
                if($i_cont == 0) {
                    echo $this->current_post->get_image('art-slidebig-main');//745 x 483
                } else {
                    echo $this->current_post->get_image('art-wide');//326 x 159
                }?>
                <div class="td-big-grid-meta">
                    <?php
                    if($i_cont == 0) {
                        echo $this->get_title_main();
                    } else {
                        ?><div class="td-big-grid-title"><?php
                        echo $this->get_title_sec_item();
                        ?></div><?php
                    }
                    ?>
                </div>
                <?php echo $this->current_post->get_item_scope_meta();?>
            </div>

            <?php
            $i_cont++;

            if($i_cont == 4 /*and $td_create_slider == 1*/) {
                echo'</div>';
                $i_cont = 0;
                $item_counter++;
                $item_tag = 0;//close the item div wrapper
            }
        }

        //check to see if we still have an open item div wrapper open
        //this is the case when we have more then 1 slide and on the last slide there are less then 4 posts
        if($item_tag == 1) {
            echo'</div>';
            $item_tag = 0;//not mandatory here, just to be sure
        }
        ?>

        <?php //</div>?>

        <?php return ob_get_clean();
    }
}