<?php


/**
 * If you are looking for the loop that's handling the single post page (single.php), check out loop-single.php
 **/


global $loop_module_id, $loop_sidebar_position;

$td_template_layout = new td_template_layout($loop_sidebar_position);



if ($loop_module_id == 1 or $loop_module_id == 7 or $loop_module_id == 8 or $loop_module_id == 9 or $loop_module_id == 'search') {
    //disable the grid for mod 1 and 7 and search
    $td_template_layout->disable_output();
}

if (have_posts()) {
    while ( have_posts() ) : the_post();
        echo $td_template_layout->layout_open_element();


        switch ($loop_module_id) {
            case '1':
                $td_mod = new td_module_1($post);
                break;
            case '2':
                $td_mod = new td_module_2($post);
                break;
            case '3':
                $td_mod = new td_module_3($post);
                break;
            case '4':
                $td_mod = new td_module_4($post);
                break;
            case '5':
                $td_mod = new td_module_5($post);
                break;
            case '6':
                $td_mod = new td_module_6($post);
                break;
            case '7':
                $td_mod = new td_module_7($post);
                break;
            case '8':
                $td_mod = new td_module_8($post);
                break;
            case '9':
                $td_mod = new td_module_9($post);
                break;
            case 'search':
                $td_mod = new td_module_search($post);
                break;
            default:
                $td_mod = new td_module_2($post);
                break;
        }
        echo $td_mod->render();


        echo $td_template_layout->layout_close_element();
        $td_template_layout->layout_next();
    endwhile; //end loop
    echo $td_template_layout->close_all_tags();


} else {
    //no posts
    echo td_page_generator::no_posts();
}


