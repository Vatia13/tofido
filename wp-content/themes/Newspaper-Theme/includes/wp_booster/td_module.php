<?php
class td_module {
    var $post;

    var $title_attribute;
    var $title;
    var $href;


    var $td_review; //review meta




    //constructor
    function __construct($post) {

        //this filter is used by td_unique_posts.php - to add unique posts to the array for the datasource
        apply_filters("td_wp_boost_new_module", $post);

        $this->post = $post;

        $this->title = get_the_title($post->ID);
        $this->title_attribute = esc_attr(strip_tags($this->title));
        $this->href = get_permalink($post->ID);

        if (has_post_thumbnail($this->post->ID)) {
            $this->post_has_thumb = true;
        } else {
            $this->post_has_thumb = false;
        }

        //get the review metadata
        $this->td_review = get_post_meta($this->post->ID, 'td_review', true);
    }



    //used only on modules / excluding the blog one - the blog uses the one from the child
    function get_item_scope() { //@todo - refactor this not used anymore
        //all the links are articles - google doesn't like multiple reviews on one page
        return 'itemscope itemtype="' . td_global::$http_or_https . '://schema.org/Article"';
    }

    //used only on single post, we have it empty for future improvements
    function get_item_scope_meta() {
        $buffy = ''; //the vampire slayer

        $author_id = $this->post->post_author;

        $buffy .= '<meta itemprop="author" content = "' . get_the_author_meta('display_name', $author_id) . '">';
        return $buffy;
    }

    function get_no_thumb_class() {
        $featured_image_placeholder = td_util::get_option('tds_featured_image_placeholder');
        if ($featured_image_placeholder == 'show_placeholder') {
            //if we have placeholders, do not add the no thumb class
            return;
        } else {
            //no placeholders - check to see if we have a thumb and if we don't have one - fix the layout
            return td_util::if_not_show($this->post_has_thumb, 'td_mod_no_thumb');
        }

    }


    function get_author($show_stars_on_review = true) {
        $buffy = '';
        if (td_review::has_review($this->td_review) and $show_stars_on_review === true) {
            //if review do nothing
//            $buffy .= '<div class="entry-review-stars">';
//            $buffy .=  td_review::render_stars($this->td_review);
//            $buffy .= '</div>';
        } else {
            $td_article_date_unix = get_the_time('U', $this->post->ID);



            $buffy .= '<span class="td-block-author">';
                $buffy .= __td('by', TD_THEME_NAME);
                $buffy .= ' ';
                $buffy .= '<a itemprop="author" href="' . get_author_posts_url($this->post->post_author) . '">' . get_the_author_meta('display_name', $this->post->post_author) . '</a>' ;
                $buffy .= ' - ';
            $buffy .= '</span>';


            $buffy .= '<meta itemprop="interactionCount" content="UserComments:' . get_comments_number($this->post->ID) . '"/>';
            //$buffy .= '<meta itemprop="dateCreated" content="' . get_the_time(get_option('date_format'), $this->post->ID) . '"/>';
        }
        return $buffy;
    }


    function get_date($show_stars_on_review = true) {
        $visibility_class = '';
        if (td_util::get_option('tds_p_show_date') == 'hide') {
            $visibility_class = ' td-visibility-hidden';
        }

        $buffy = '';
        if (td_review::has_review($this->td_review) and $show_stars_on_review === true) {
            //if review show stars
            $buffy .= '<div class="entry-review-stars">';
            $buffy .=  td_review::render_stars($this->td_review);
            $buffy .= '</div>';

        } else {
            $td_article_date_unix = get_the_time('U', $this->post->ID);
            $buffy .= '<time  itemprop="dateCreated" class="entry-date updated' . $visibility_class . '" datetime="' . date(DATE_W3C, $td_article_date_unix) . '" >' . get_the_time(get_option('date_format'), $this->post->ID) . '</time>';
            $buffy .= '<meta itemprop="interactionCount" content="UserComments:' . get_comments_number($this->post->ID) . '"/>';

        }

        return $buffy;
    }

    function get_commentsAndViews() {

        $buffy = '';

        $buffy .= '<div class="entry-comments-views">';
        if (td_util::get_option('tds_p_show_comments') != 'hide') {
            //$buffy .= '<a href="' . get_comments_link($this->post->ID) . '">';
            $buffy .= '<span class="td-sp td-sp-ico-comments td-fake-click" data-fake-click="' . get_comments_link($this->post->ID) . '"></span>';
            $buffy .= get_comments_number($this->post->ID);
            //$buffy .= '</a>';
        }

        if (td_util::get_option('tds_p_show_views') != 'hide') {
            $buffy .= ' ';
            $buffy .= '<span class="td-sp td-sp-ico-view"></span>';
            // WP-Post Views Counter
            if (function_exists('the_views')) {
                $post_views = the_views(false);
                $buffy .= $post_views;
            }
            // Default Theme Views Counter
            else {
                $buffy .= '<span class="td-nr-views-' . $this->post->ID . '">' . td_page_views::get_page_views($this->post->ID) .'</span>';
            }
        }
        $buffy .= '</div>';

        return $buffy;
    }


    /**
     * get_image v010
     * @param $thumbType
     * @return string
     */
    function get_image($thumbType) {
        $buffy = ''; //the output buffer




        $featured_image_placeholder = td_util::get_option('tds_featured_image_placeholder');



        /*
         *  - if we have a post thumb - show that
         *  - if we don't have a post thumb, check the image placeholder option and if we're also not a single page show the image placeholder.
         */


        if ($this->post_has_thumb or ($featured_image_placeholder == 'show_placeholder')) {
            if ($this->post_has_thumb) {

                //if we have a thumb

                $attachment_id = get_post_thumbnail_id($this->post->ID);
                $td_temp_image_url = wp_get_attachment_image_src($attachment_id, $thumbType);


                $attachment_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true );
                $attachment_alt = 'alt="' . esc_attr(strip_tags($attachment_alt)) . '"';



                $attachment_title = ' title="' . $this->title . '"';



                if (empty($td_temp_image_url[0])) {
                    $td_temp_image_url[0] = '';
                }

                if (empty($td_temp_image_url[1])) {
                    $td_temp_image_url[1] = '';
                }

                if (empty($td_temp_image_url[2])) {
                    $td_temp_image_url[2] = '';
                }


            } else {

                //we have no thumb but the placeholder one is activated

                global $_wp_additional_image_sizes;

                //print_r($_wp_additional_image_sizes[$thumbType]);

                $td_temp_image_url[1] = $_wp_additional_image_sizes[$thumbType]['width'];
                $td_temp_image_url[2] = $_wp_additional_image_sizes[$thumbType]['height'];

                switch ($thumbType) {
                    case 'featured-image':
                        $td_temp_image_url[0] = get_template_directory_uri() . '/images/no-thumb/art-slide-med.png';
                        break;
                    case 'art-thumb':
                        $td_temp_image_url[0] = get_template_directory_uri() . '/images/no-thumb/art-thumb.png';
                        break;
                    case 'art-wide':
                        $td_temp_image_url[0] = get_template_directory_uri() . '/images/no-thumb/art-wide.png';
                        break;
                    case 'art-big-1col':
                        $td_temp_image_url[0] = get_template_directory_uri() . '/images/no-thumb/art-big-1col.png';
                        break;
                    case 'art-slide-small':
                        $td_temp_image_url[0] = get_template_directory_uri() . '/images/no-thumb/art-slide-small.png';
                        break;
                    case 'art-slide-med':
                        $td_temp_image_url[0] = get_template_directory_uri() . '/images/no-thumb/art-slide-med.png';
                        break;
                    case 'art-slide-big':
                        $td_temp_image_url[0] = get_template_directory_uri() . '/images/no-thumb/art-slide-big.png';
                        break;
                    case 'art-slidebig-main':
                        $td_temp_image_url[0] = get_template_directory_uri() . '/images/no-thumb/art-slidebig-main.png';
                        break;
                    case 'art-gal':
                        $td_temp_image_url[0] = get_template_directory_uri() . '/images/no-thumb/art-gal.png';
                        break;
                }


                $attachment_alt = '';
                $attachment_title = '';
            } //end    if ($this->post_has_thumb) {



            $buffy .= '<div class="thumb-wrap">';
                if (current_user_can('edit_posts')) {
                    $buffy .= '<a class="td-admin-edit" href="' . get_edit_post_link($this->post->ID) . '">edit</a>';
                }

                $buffy .='<a href="' . $this->href . '" rel="bookmark" title="' . $this->title_attribute . '">';

                    $buffy .= '<img width="' . $td_temp_image_url[1] . '" height="' . $td_temp_image_url[2] . '" itemprop="image" class="entry-thumb" src="' . $td_temp_image_url[0] . '" ' . $attachment_alt . $attachment_title . '/>';
                    if (get_post_format($this->post->ID) == 'video') {
                        if ($thumbType == 'art-thumb' or $thumbType == 'thumbnail') {
                            $buffy .= '<img width="20" class="video-play-icon td-retina" src="' . get_template_directory_uri() . '/images/icons/video-small.png' . '" alt="video"/>';
                        } else {
                            $buffy .= '<img width="40" class="video-play-icon-big td-retina" src="' . get_template_directory_uri() . '/images/icons/ico-video-large.png' . '" alt="video"/>';
                        }
                    }
                $buffy .= '</a>';
            $buffy .= '</div>'; //end wrapper

            return $buffy;
        }
    }


    function get_title($excerpt_lenght = '') {
        $buffy = '';
        $buffy .= '<h3 itemprop="name" class="entry-title">';
        $buffy .='<a itemprop="url" href="' . $this->href . '" rel="bookmark" title="' . $this->title_attribute . '">';
        if (!empty($excerpt_lenght)) {
            $buffy .= td_util::excerpt($this->title, $excerpt_lenght, 'show_shortcodes');
        } else {
            $buffy .= $this->title;
        }
        $buffy .='</a>';
        $buffy .= '</h3>';
        return $buffy;
    }


    function get_excerpt($lenght = 25, $show_shortcodes = '') {

        if ($this->post->post_excerpt != '') {
            return $this->post->post_excerpt;
        }

        if (empty($lenght)) {
            $lenght = 25;
        }

        $buffy = '';
        //print_r($this->post);

        //remove [caption .... [/caption] from $this->post->post_content
        $post_content = preg_replace("/\[caption(.*)\[\/caption\]/i", '', $this->post->post_content);

        $buffy .= td_util::excerpt($post_content, $lenght, $show_shortcodes);
        return $buffy;
    }
}

