<?php
//removing the comments sidewide
if(td_util::get_option('tds_disable_comments_sidewide') == '') {?>
                        <div class="comments" id="comments">
                            <?php if (post_password_required()) { ?>

                            <?php } else { ?>
                                <?php if (comments_open() ) { ?>
                                    <div class="comments-title-wrap">
                                        <?php
                                        $num_comments = get_comments_number(); // get_comments_number returns only a numeric value
                                        if ( $num_comments == 0 ) {
                                            $td_comments_no_text = __td('NO COMMENTS');
                                        } elseif ( $num_comments > 1 ) {
                                            $td_comments_no_text = $num_comments . ' ' . __td('COMMENTS');
                                        } else {
                                            $td_comments_no_text = __td('1 COMMENT');
                                        }
                                        ?>
                                        <h4 class="block-title"><span><?php echo $td_comments_no_text?></span></h4>
                                    </div>

                                    <?php if (have_comments()) { ?>
                                        <ol class="comment-list">
                                            <?php wp_list_comments( array( 'callback' => 'td_comment' ) ); ?>
                                        </ol>
                                        <div class="comment-pagination">
                                            <?php paginate_comments_links(); ?>
                                        </div>
                                    <?php } ?>
                            <?php } ?>
                            <?php

                            $commenter = wp_get_current_commenter();

                            if (empty($aria_req)) {
                                $aria_req = '';
                            }
    $fields =  array(
        'author' =>
        '<p class="comment-form-input-wrap">
            <span class="comment-req-wrap needsclick"><input class="" id="author" name="author" placeholder="' . __td('Name:', TD_THEME_NAME) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' . ( $req ? '</span>' : '' ) .
        '</p>',

        'email'  =>
        '<p class="comment-form-input-wrap">
            <span class="comment-req-wrap needsclick"><input class="" id="email" name="email" placeholder="' . __td('Email:', TD_THEME_NAME) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' . ( $req ? '</span>' : '' ) .
        '</p>',

        'url' =>
        '<p class="comment-form-input-wrap needsclick">
            <input class="" id="url" name="url" placeholder="' . __td('Website:', TD_THEME_NAME) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />' .
        '</p>',
    );

    $defaults = array(
     'fields' => apply_filters('comment_form_default_fields', $fields ),
    );

    $defaults['comment_field'] = '<div class="clearfix"></div><p class="comment-form-input-wrap"><textarea class="needsclick" placeholder="' . __td('Comment:', TD_THEME_NAME) . '" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';

    $defaults['comment_notes_before'] = '';
    $defaults['comment_notes_after'] = '';
    $defaults['title_reply'] = __td('Leave a Reply');
    $defaults['label_submit'] = __td('Post Comment');
    $defaults['cancel_reply_link'] = __td('Cancel reply');

    comment_form($defaults);
                                //comment_form();

                                ?>
                            <?php } ?>
                        </div> <!-- /.content -->


<?php
}//end removing the comments sidewide
        /**
         * Custom callback for outputting comments
         *
         * @return void
         * @author tagdiv
         */
        function td_comment( $comment, $args, $depth ) {
            $GLOBALS['comment'] = $comment;

                $td_isPingTrackbackClass = '';

                if($comment->comment_type == 'pingback') {
                    $td_isPingTrackbackClass = 'pingback';
                }

                if($comment->comment_type == 'trackback') {
                    $td_isPingTrackbackClass = 'trackback';
                }


                if (!empty($comment->comment_author_email)) {
                    $td_comment_auth_email = $comment->comment_author_email;
                } else {
                    $td_comment_auth_email = '';
                }


                $td_article_date_unix = @strtotime("{$comment->comment_date_gmt} GMT");
            //print_r($td_article_date_unix);
            ?>
            <?php if ( $comment->comment_approved == '1' ) { ?>
                <li class="comment <?php echo $td_isPingTrackbackClass ?>" id="li-comment-<?php comment_ID() ?>">
                    <article>
                        <footer>
                            <?php
                            //echo get_template_directory_uri() . "/images/avatar.jpg";
                            //echo get_avatar($td_comment_auth_email, 50, get_template_directory_uri() . "/images/avatar.jpg");
                            echo get_avatar($td_comment_auth_email, 50); ?>
                            <cite><?php comment_author_link() ?></cite>

                                <a class="comment-link" href="#li-comment-<?php comment_ID() ?>">
                                    <time pubdate="<?php echo $td_article_date_unix ?>"><?php comment_date() ?> at <?php comment_time() ?></time>
                                </a>

                        </footer>
                        <div class="comment-content">
                            <?php comment_text() ?>

                        </div>
                        <div class="comment-meta" id="comment-<?php comment_ID() ?>">
                            <?php comment_reply_link(array_merge( $args, array(
                                'depth' => $depth,
                                'max_depth' => $args['max_depth'],
                                'reply_text' => __td('Reply', TD_THEME_NAME),
                                'login_text' =>  __td('Log in to leave a comment', TD_THEME_NAME)
                            )))
                            ?>
                        </div>

                    </article>
                </li>
            <?php
            }
        }
?>