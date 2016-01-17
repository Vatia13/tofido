<?php

/*  ----------------------------------------------------------------------------
    The slider that shows featured posts on category templates is here
 */


global  $cur_cat_obj, $loop_sidebar_position, $loop_module_id;

//bread crumbs
echo td_page_generator::get_category_breadcrumbs($cur_cat_obj);




if ($loop_module_id != 1 and $loop_module_id != 7) {
    //the category title
    ?>
    <header>
        <h1 itemprop="name" class="entry-title td-page-title">
            <?php /*<a itemprop="url" href="<?php echo get_category_link($cur_cat_obj->cat_ID)?>" rel="bookmark" title="<?php echo __td('Posts in ') . $cur_cat_obj->name ?>"><?php echo $cur_cat_obj->name ?></a> */?>
            <span><?php echo $cur_cat_obj->name ?></span>
        </h1>
    </header>
    <?php



    //the subcategories
    if (!empty($cur_cat_obj->cat_ID)) {
        $td_sub_cats = get_categories(array(
            'parent' => $cur_cat_obj->cat_ID
        ));

        if (!empty($td_sub_cats)) {
            echo '<ul class="td-category td-category-page-subcats">';
            echo '<li><span class="td-category-page-sub-ind"></span></li>';

            foreach ($td_sub_cats as $td_sub_cat) {
                if (!empty($td_sub_cat->name)) {
                    $tax_meta_subcat_color = td_util::get_category_option($td_sub_cat->cat_ID, 'tdc_color'); //swich by RADU A, get_tax_meta($td_sub_cat->cat_ID, 'tdc_color');
                    if (!empty($tax_meta_subcat_color)) {
                        $td_cat_color = ' style="background-color:' . $tax_meta_subcat_color . ';"';
                    } else {
                        $td_cat_color = '';
                    }
                    ?>
                    <li class="entry-category"><a <?php echo $td_cat_color?> href="<?php echo get_category_link($td_sub_cat->cat_ID)?>"><?php echo $td_sub_cat->name?></a></li>

                    <?php
                }
            }
            echo '</ul>';
            echo '<div class="clearfix"></div>';
        }
    }
}





//the category description
if (!empty($cur_cat_obj->description)) {
    echo '<div class="entry-content">';
    echo $cur_cat_obj->description;
    echo '</div>';
}






//slider
if ($loop_sidebar_position != 'no_sidebar') {
    $td_force_columns = '2';
} else {
    $td_force_columns = '3';
}

//read the category slider settings
$tdc_slider = td_util::get_category_option($cur_cat_obj->cat_ID, 'tdc_slider');//swich by RADU A,get_tax_meta($cur_cat_obj->cat_ID, 'tdc_slider');

//show only on page 1
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


if ($tdc_slider != 'hide_slider' and $paged == '1') {





        if ($tdc_slider == '') {
            //show small slider
            echo td_global_blocks::get_instance('td_slide')->render(array(
                'category_id' => $cur_cat_obj->cat_ID,
                'sort' => 'featured',
                'force_columns' => $td_force_columns,
                'hide_title' => 'hide_title'
            ));
        } else {

        }





}
?>