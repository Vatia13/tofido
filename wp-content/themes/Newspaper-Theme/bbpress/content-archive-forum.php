<?php

//Forum index

/**
 * Archive Forum Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */



//shows one forum
function td_show_forum($forum_object) {

    $last_active = bbp_get_forum_last_active_id($forum_object->ID);

    $time_since = '';
    $last_updated_by_avatar = '';

    if (!empty($last_active)) {
        $time_since      = bbp_get_forum_freshness_link( $forum_object->ID );
        $last_updated_by_avatar = bbp_get_author_link( array( 'post_id' => $last_active, 'size' => 40, 'type' => 'avatar' ) );
        //echo $time_since;
    }
    ?>
    <div class="clearfix"></div>
    <ul class="td-forum-list-table td-forum-content">
        <li class="td-forum-category-title<?php if (empty($forum_object->post_content)) {  echo ' td-forum-title-no-desc'; }?>">
            <div class="td-forum-index-padd">
                <a class="bbp-forum-title" href="<?php bbp_forum_permalink
                ($forum_object->ID); ?>"><?php
                    bbp_forum_title($forum_object->ID); ?></a>
                <?php if (!empty($forum_object->post_content)) { ?>
                    <div class="td-forum-description"><?php echo $forum_object->post_content?></div>
                <?php } ?>

                </li><li class="td-forum-replies">
                    <div><?php echo bbp_get_forum_topic_count($forum_object->ID);?> topics</div>
                    <div><?php echo bbp_get_forum_reply_count($forum_object->ID); ?> replies</div>
                </li><li class="td-forum-last-comment">

                <div>
                    <?php echo $last_updated_by_avatar; ?>
                </div>



                <div class="td-forum-last-comment-content">
                    <div class="td-forum-author-name">
                        by <a class="td-forum-last-author" href="<?php bbp_reply_author_url($last_active)
                        ?>"><?php echo
                            bbp_get_topic_author_display_name($last_active); ?></a>
                    </div>
                    <div class="td-forum-time-comment">
                        <?php bbp_forum_freshness_link( $forum_object->ID ) ?>
                    </div>
                </div>
        </li>
    </ul>
    <div class="clearfix"></div>
    <?php
}

?>
<div id="bbpress-forums">

    <?php if ( bbp_allow_search() ) : ?>

        <div class="bbp-search-form">

            <?php bbp_get_template_part( 'form', 'search' ); ?>

        </div>

    <?php endif; ?>

    <?php do_action( 'bbp_template_before_forums_index' ); ?>

    <?php if ( bbp_has_forums() ) : ?>


            <?php do_action( 'bbp_template_before_forums_loop' ); ?>
                    <?php while ( bbp_forums() ) : bbp_the_forum(); ?>
                        <!-- forum loop -->
                        <?php
                        /**
                         * Forums Loop - Single Forum
                         */
                        $cur_forum_obj = bbp_get_forum('');

                        if (bbp_is_forum_category()) {
                            //is a category - print the header and output the forums
                            ?>
                            <div class="clearfix"></div>
                            <ul class="td-forum-list-head td-forum-list-table">
                                <li class="td-forum-category-title">
                                    <span class="td-forum-category-name">
                                    <?php echo $cur_forum_obj->post_title?>
                                    </span>
                                </li><li class="td-forum-topics-replies">
                                    Topics/Replies
                                </li><li class="td-forum-last-comment">
                                    Last comment
                                </li>
                            </ul>
                            <?php
                            $sub_forums_obj = bbp_forum_get_subforums();
                            if (is_array($sub_forums_obj)){
                                foreach ($sub_forums_obj as $sub_forum_obj) {
                                    td_show_forum($sub_forum_obj);
                                }
                            }
                        } else {
                            //show the normal forum - no header
                            td_show_forum($cur_forum_obj);
                        }
                        ?>
                        <!-- end forum loop -->
                    <?php endwhile; ?>
            <?php do_action( 'bbp_template_after_forums_loop' ); ?>

    <?php else : ?>

        <?php bbp_get_template_part( 'feedback', 'no-forums' ); ?>

    <?php endif; ?>

    <?php do_action( 'bbp_template_after_forums_index' ); ?>

</div>
