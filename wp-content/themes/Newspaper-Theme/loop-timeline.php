<?php
/**
 * this loop is used for timeline template
 **/

//adding breadcrumbs
echo td_page_generator::get_page_breadcrumbs($post->post_title);?>

<div class="td-template-timeline-title"><?php echo __td('Timeline');?></div>

<?php
//main loop of the page (but for this sidebar position)
$td_timeline_post_date = $td_timeline_post_year = $explode_time_date = '';
$td_timeline_post_count = 0;
$date_format = get_option('date_format');
if (have_posts()) {
    while ( have_posts() ) : the_post();

        $explode_time_date = explode(' ', $post->post_date);
        $explode_post_date = explode('-', $explode_time_date[0]);

        //write year
        if($td_timeline_post_year != $explode_post_date[0]) {
            $td_timeline_post_year = $explode_post_date[0];


            //adding wrapper around year links
            if($td_timeline_post_count > 0) {
                echo '</div><div class="td-timeline-block-title td-timline-padding-top"><span>' . $td_timeline_post_year . '</span></div><div class="td-timeline-wrapper-links">';
            } else {
                echo '<div class="td-timeline-block-title"><span>' . $td_timeline_post_year . '</span></div><div class="td-timeline-wrapper-links">';
            }
        }

        $td_timeline_post_count++;

        ?>
        <h1 itemprop="name" class="td-timline-h1-link">
            <span class="td-timeline-item-dot"></span><div class="td-timeline-post-date"><?php echo  date_i18n($date_format, get_the_time('U', $post->ID));?></div><a itemprop="url" href="<?php the_permalink();?>" rel="bookmark" title="<?php the_title_attribute();?>"><?php the_title();?></a>
        </h1>
    <?php
    endwhile; //end loop
    echo '</div>';
}