<?php

/**
 * Pagination for pages of topics (when viewing a forum)
 *
 * @package bbPress
 * @subpackage Theme
 */

if (!function_exists('td_bbp_forum_pagination_links_custom')) {
    function td_bbp_forum_pagination_links_custom($comments) {

        $comments = str_replace('&larr;', '<img width="5" class="td-retina left-arrow" src="' . get_template_directory_uri()  . '/images/icons/similar-left.png" alt=""/> ' . __td('Prev'), $comments);
        $comments = str_replace('&rarr;', __td('Next') . ' <img width="5" class="td-retina right-arrow" src="' . get_template_directory_uri()  . '/images/icons/similar-right.png" alt=""/>', $comments);
        return $comments;
    }
    add_filter( 'bbp_get_forum_pagination_links', 'td_bbp_forum_pagination_links_custom');

}


?>

<?php do_action( 'bbp_template_before_pagination_loop' ); ?>




	<div class="page-nav">

		<?php bbp_forum_pagination_links(); ?>

	</div>


<?php do_action( 'bbp_template_after_pagination_loop' ); ?>
