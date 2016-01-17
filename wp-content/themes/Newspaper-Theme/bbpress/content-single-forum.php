<?php

//forum single



/**
 * Single Forum Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="bbpress-forums">

	<?php //bbp_breadcrumb(); ?>

    <?php if ( bbp_allow_search() ) : ?>

        <div class="bbp-search-form">

            <?php bbp_get_template_part( 'form', 'search' ); ?>

        </div>

    <?php endif; ?>

	<?php do_action( 'bbp_template_before_single_forum' ); ?>

	<?php if ( post_password_required() ) : ?>
		<?php bbp_get_template_part( 'form', 'protected' ); ?>
	<?php else : ?>

		<?php //bbp_single_forum_description(); ?>

		<?php if ( bbp_has_forums() ) : ?>

			<?php //bbp_get_template_part( 'loop', 'forums' ); ?>

		<?php endif; ?>

		<?php if ( !bbp_is_forum_category() && bbp_has_topics() ) : ?>



            <?php do_action( 'bbp_template_before_topics_loop' ); ?>

            <div class="clearfix"></div>
                <div class="td-topics-wrap">
                    <?php while ( bbp_topics() ) : bbp_the_topic(); ?>
                        <?php
                        $topic = bbp_get_topic('');



                        ?>
                    <ul class="td-topic-list-table">
                        <li class="td-forum-topics-avatar">
                            <span class="td-topic-started-by">
                                <?php bbp_author_link( array( 'post_id' => $topic->ID, 'size' => 60, 'type' => 'avatar' ) ); //started by ?>
                            </span>

                            <span class="td-topic-last-reply">
                                <?php
                                $last_active_topic_id = get_post_meta( $topic->ID, '_bbp_last_active_id', true );
                                bbp_author_link( array( 'post_id' => $last_active_topic_id, 'size' => 25, 'type' => 'avatar' ) );
                                ?>
                            </span>

                        </li><li class="td-forum-topics-title">
                            <div class="td-topics-title">
                                <a href="<?php bbp_topic_permalink(); ?>"><?php bbp_topic_title();?></a>
                            </div>
                            <div class="td-topics-title-details">
                                started by <a href="<?php bbp_user_profile_url($topic->post_author) ?>"><?php bbp_topic_author_display_name()?></a>
                            </div>
                            <div class="td-topics-title-details">
                                <?php
                                //bbp_get_reply_author_link(array('post_id' => ));


                                ?>
                                Last reply by <a href="<?php bbp_reply_author_url(bbp_get_topic_last_active_id()) ?>"><?php echo bbp_get_topic_author_display_name(bbp_get_topic_last_active_id()); ?></a>

                                <?php bbp_topic_last_active_time(); ?>
                            </div>

                        </li><li class="td-forum-topics-replies">
                            <?php bbp_topic_reply_count() ?>
                        </li>
                    </ul>
                        <?php


                //print_r($topic);
                //echo '<br><br>';

                        ?>



                    <?php endwhile; ?>
                </div>
            <div class="clearfix"></div>


            <?php do_action( 'bbp_template_after_topics_loop' ); ?>




            <?php bbp_get_template_part( 'pagination', 'topics'    ); ?>

			<?php bbp_get_template_part( 'form',       'topic'     ); ?>

		<?php elseif ( !bbp_is_forum_category() ) : ?>

			<?php bbp_get_template_part( 'feedback',   'no-topics' ); ?>

			<?php bbp_get_template_part( 'form',       'topic'     ); ?>

		<?php endif; ?>

	<?php endif; ?>

	<?php do_action( 'bbp_template_after_single_forum' ); ?>

</div>
