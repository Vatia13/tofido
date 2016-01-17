<?php


class td_module_blog extends td_module {

    var $td_post_theme_settings;

    var $is_single; //true if we are on a single page



    function __construct($post = '') {
        // construct the class without the post object, used in the author template for the box
        if (empty($post)) {
            return;
        }

        parent::__construct($post);

        //read post settings
        $this->td_post_theme_settings = get_post_meta($post->ID, 'td_post_theme_settings', true);

        $this->is_single = is_single();
    }



    

    function get_social_sharing() {
        $social_sharing = 1;
        $closing_class_tags = 'td-tags-and-social-wrapper-box-bottom-line';

        if (!$this->is_single) {
            return;
        }

        $buffy = $this_post_tags = $wrapper_post_tags = '';

        if (td_util::get_option('tds_social_show') == 'hide') {
            $social_sharing = 0;
        } else {
            $closing_class_tags = '';
        }

        //if the post has tags
        $this_post_tags = $this->get_the_tags();
        if(!empty($this_post_tags)) {
            $wrapper_post_tags = '<div class="td-tags-and-social-wrapper-box ' . $closing_class_tags . '"> ' . $this_post_tags . '</div>';
        }


        $buffy .= '
            <div class="td-social-sharing">
                ' . $wrapper_post_tags;

        if($social_sharing == 1) {

            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $this->post->ID ), 'single-post-thumbnail' );

            $twetter_user = td_util::get_option('tds_tweeter_username');

            $buffy .= '
                <div class="td-tags-and-social-wrapper-box td-tags-and-social-wrapper-box-bottom-line">
                    <a class="td-social-sharing-buttons td-social-twitter" href="https://twitter.com/intent/tweet?text=' . urlencode($this->title) . '&url=' .  urlencode(get_permalink()) . '&via=' . urlencode($twetter_user ? $twetter_user : get_bloginfo('name')) .'" onclick="if(!document.getElementById(\'td_social_networks_buttons\')){window.open(this.href, \'mywin\',
\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;}" ><div class="td-sp td-sp-share-twitter"></div><div class="td-social-but-text">Twitter</div></a>
                    <a class="td-social-sharing-buttons td-social-facebook" href="http://www.facebook.com/sharer.php?u=' . urlencode(get_permalink()) . '" onclick="window.open(this.href, \'mywin\',
\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><div class="td-sp td-sp-share-facebook"></div><div class="td-social-but-text">Facebook</div></a>
                    <a class="td-social-sharing-buttons td-social-google" href="http://plus.google.com/share?url=' . get_permalink() . '" onclick="window.open(this.href, \'mywin\',
\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><div class="td-sp td-sp-share-google"></div><div class="td-social-but-text">Google +</div></a>
                    <a class="td-social-sharing-buttons td-social-pinterest" href="http://pinterest.com/pin/create/button/?url=' . get_permalink() . '&amp;media=' . (!empty($image[0]) ? $image[0] : '') . '" onclick="window.open(this.href, \'mywin\',
\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><div class="td-sp td-sp-share-pinterest"></div><div class="td-social-but-text">Pinterest</div></a>
                </div>';
        }

        return $buffy . '</div>';
    }




    function get_social_like_tweet() {
        if (!$this->is_single) {
            return;
        }

        if (td_util::get_option('tds_like_tweet_show') != 'show') {
            return;
        }

        $buffy = '';
        $buffy .= '<div id="td_social_networks_buttons" class="td-social-like-tweet">';
        $buffy .= '<ul>';
        $buffy .= '<li class="td-like-tweet-twitter">';
        $buffy .= '<a href="https://twitter.com/share" class="twitter-share-button" data-url="' . $this->href . '" data-text="' . $this->title . '" data-via="' . td_util::get_option('tds_' . 'social_twitter') . '" data-lang="en">tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
        $buffy .= '</li>';

        $buffy .= '<li class="td-like-tweet-facebook">';
        $buffy .= '<iframe src="http://www.facebook.com/plugins/like.php?href=' . $this->href . '&amp;layout=button_count&amp;show_faces=false&amp;width=105&amp;action=like&amp;colorscheme=light&amp;height=21" style="border:none; overflow:hidden; width:105px; height:21px; background-color:transparent;"></iframe>';
        $buffy .= '</li>';

        $buffy .= '<li  class="td-like-tweet-google">';
        $buffy .= '
                    <div class="g-plusone" data-size="medium" data-href="' . $this->href . '"></div>
                    <script type="text/javascript">
                        (function() {
                            var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
                            po.src = "https://apis.google.com/js/plusone.js";
                            var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
                        })();
                    </script>
                    ';
        $buffy .= '</li>';
        $buffy .= '</ul>';
        $buffy .= '</div>';
        return $buffy;
    }





    function get_post_pagination() {
        if (!$this->is_single) {
            return;
        }

        return wp_link_pages(array(
            'before' => '<div class="page-nav page-nav-post"><center>',
            'after' => '</center></div><div style="clear:both;"></div>',
            'link_before' => '',
            'link_after' => '',
            'echo' => false,
            'nextpagelink'     => ' ' . __td('NEXT') . ' <img width="6" class="td-retina right-arrow" src="' . get_template_directory_uri()  . '/images/icons/similar-right.png" alt=""/>',
            'previouspagelink' => '<img width="6" class="td-retina left-arrow" src="' . get_template_directory_uri()  . '/images/icons/similar-left.png" alt=""/> ' . __td('PREV')
        ));
    }

    function get_title($excerpt_lenght = '') {
        //just use h1 instead of h3
        $var_single = 0;
        if (is_single()) {
            $var_single = 1;
        }

        $buffy = '';
        $buffy .= '<h1 itemprop="name" class="entry-title">';

        if ($var_single == 0) {
            $buffy .='<a itemprop="url" href="' . $this->href . '" rel="bookmark" title="' . $this->title_attribute . '">';
        }

        $buffy .= $this->title;

        if ($var_single == 0) {
            $buffy .='</a>';
        }

        $buffy .= '</h1>';
        return $buffy;
    }

    //$show_stars_on_review - not used
    function get_author($show_stars_on_review = '') {
        $buffy = '';
        $buffy .='<div class="td-clear-author"></div>';
        $buffy .= parent::get_author(false);
        return $buffy;
    }





    /**
     * get_image v010 - modified on wp_010 - returns the featured image of a single post
     * @param $thumbType
     * @return string
     */
    function get_image($thumbType) {
        global $page;

        //show only on the first page when we have posts with pages
        if (!empty($page) and $page > 1) {
            return;
        }

        //do not show the featured image if the global setting is set to hide - show the video preview regardless of the setting
        if (td_util::get_option('tds_show_featured_image') == 'hide' and get_post_format($this->post->ID) != 'video') {
            return;
        }

        //do not show the featured image on gallery post format
        if (get_post_format($this->post->ID) == 'gallery') {
            return;
        }

        //handle video post format
        if (get_post_format($this->post->ID) == 'video') {
            //if it's a video post...
            $td_post_video = get_post_meta($this->post->ID, 'td_post_video', true);
            $td_video_support = new td_video_support();

            //render the video if the post has a video in the featured video section of the post
            if (!empty($td_post_video['td_video'])) {
                return $td_video_support->renderVideo($td_post_video['td_video']);
            }
        } else {
            //if it's a normal post, show the default thumb

            if ($this->post_has_thumb) {
                //get the featured image id + full info about the 640px wide one
                $featured_image_id = get_post_thumbnail_id($this->post->ID);
                $featured_image_info = td_util::attachment_get_full_info($featured_image_id, $thumbType);

                //get the full size for the popup
                $featured_image_full_size_src = td_util::attachment_get_src($featured_image_id, 'full');

                $buffy = '';

                $show_td_modal_image = td_util::get_option('tds_featured_image_view_setting') ;

                if (is_single()) {
                    if ($show_td_modal_image != 'no_modal') {
                        //wrap the image_html with a link + add td-modal-image class
                        $image_html = '<a href="' . $featured_image_full_size_src['src'] . '" data-caption="' . htmlentities($featured_image_info['caption'], ENT_QUOTES) . '">';
                        $image_html .= '<img width="' . $featured_image_info['width'] . '" height="' . $featured_image_info['height'] . '" itemprop="image" class="entry-thumb td-modal-image" src="' . $featured_image_info['src'] . '" alt="' . $featured_image_info['alt']  . '" title="' . $featured_image_info['title'] . '"/>';
                        $image_html .= '</a>';
                    } else { //no_modal
                        $image_html = '<img width="' . $featured_image_info['width'] . '" height="' . $featured_image_info['height'] . '" itemprop="image" class="entry-thumb" src="' . $featured_image_info['src'] . '" alt="' . $featured_image_info['alt']  . '" title="' . $featured_image_info['title'] . '"/>';
                    }
                } else {
                    //on blog index page
                    $image_html = '<a href="' . $this->href . '"><img width="' . $featured_image_info['width'] . '" height="' . $featured_image_info['height'] . '" itemprop="image" class="entry-thumb" src="' . $featured_image_info['src'] . '" alt="' . $featured_image_info['alt']  . '" title="' . $featured_image_info['title'] . '"/></a>';
                }


                $buffy .= '<div class="td-post-featured-image">';

                // caption - put html5 wrapper on when we have a caption
                if (!empty($featured_image_info['caption'])) {
                    $buffy .= '<figure>';
                    $buffy .= $image_html;

                    $buffy .= '<figcaption class="wp-caption-text">' . $featured_image_info['caption'] . '</figcaption>';
                    $buffy .= '</figure>';
                } else {
                    $buffy .= $image_html;
                }

                $buffy .= '</div>';


                return $buffy;
            } else {
                return ''; //the post has no thumb
            }
        }
    }


    function get_category() {

        $buffy = '';

        $buffy .= '<ul class="td-category">';
        $categories = get_the_category($this->post->ID);
        $cat_array = array();

        if($categories){
            foreach($categories as $category) {
                if ($category->name != TD_FEATURED_CAT) { //ignore the featured category name
                    //get the parent of this cat
                    $td_parent_cat_obj = get_category($category->category_parent);

                    //if we have a parent, shot it first
                    if (!empty($td_parent_cat_obj->name)) {
                        $tax_meta__color_parent = td_util::get_category_option($td_parent_cat_obj->cat_ID,'tdc_color');//swich by RADU A, get_tax_meta($td_parent_cat_obj->cat_ID,'tdc_color');
                        $tax_meta__hide_on_post_parent = td_util::get_category_option($td_parent_cat_obj->cat_ID,'tdc_hide_on_post');//swich by RADU A, get_tax_meta($td_parent_cat_obj->cat_ID,'tdc_hide_on_post');
                        $cat_array[$td_parent_cat_obj->name] = array(
                            'color' => $tax_meta__color_parent,
                            'link' => get_category_link($td_parent_cat_obj->cat_ID),
                            'hide_on_post' => $tax_meta__hide_on_post_parent
                        );
                    }

                    //show the category, only if we didn't already showed the parent
                    $tax_meta_color = td_util::get_category_option($category->cat_ID,'tdc_color');//swich by RADU A, get_tax_meta($category->cat_ID,'tdc_color');
                    $tax_meta__hide_on_post_parent = td_util::get_category_option($category->cat_ID,'tdc_hide_on_post');//swich by RADU A, get_tax_meta($category->cat_ID,'tdc_hide_on_post');
                    $cat_array[$category->name] = array(
                        'color' => $tax_meta_color,
                        'link' => get_category_link($category->cat_ID),
                        'hide_on_post' => $tax_meta__hide_on_post_parent
                    );
                }
            }
        }

        foreach ($cat_array as $td_cat_name => $td_cat_parms) {
            if ($td_cat_parms['hide_on_post'] == 'hide') {
                continue;
            }

            if (!empty($td_cat_parms['color'])) {
                $td_cat_color = ' style="background-color:' . $td_cat_parms['color'] . ';"';
            } else {
                $td_cat_color = '';
            }


            $buffy .= '<li class="entry-category"><a ' . $td_cat_color . ' href="' . $td_cat_parms['link'] . '">' . $td_cat_name . '</a></li>';
        }
        $buffy .=  '</ul>';

        return $buffy;
    }




    function get_item_scope() {
        //show the review meta only on single posts that are reviews, the rest have to be article (in article lists)
        if (td_review::has_review($this->td_review) and is_single()) {
            return 'itemscope itemtype="http://schema.org/Review"';
        } else {
            return 'itemscope itemtype="http://schema.org/Article"';
        }
    }


    function get_item_scope_meta() {
        $buffy = ''; //the vampire slayer


        $author_id = $this->post->post_author;

        $buffy .= '<meta itemprop="author" content = "' . get_the_author_meta('display_name', $author_id) . '">';

        $authorMetaGoogle = get_the_author_meta('googleplus', $author_id);
        if (!empty($authorMetaGoogle)) {
            echo '<a href="' . $authorMetaGoogle . '?rel=author"></a>';
        }


        if (td_review::has_review($this->td_review) and is_single()) { //show the review meta only on single posts that are reviews, the rest have to be article (in article lists)
            $td_article_date_unix = get_the_time('U', $this->post->ID);

            if (!empty($this->td_review['review'])) {
                $buffy .= '<meta itemprop="about" content = "' . $this->td_review['review'] . '">';
            } else {
                //we have no review :|
                $buffy .= '<meta itemprop="about" content = "' . $this->get_excerpt(25) . '">';
            }

            $buffy .= '<meta itemprop="itemreviewed" content = "' . $this->title . '">';
            $buffy .= '<meta itemprop="datePublished" content="' . date(DATE_W3C, $td_article_date_unix) . '">';





            //$buffy .= '<meta itemprop="url" rel="author" content = "' . get_author_posts_url($author_id) . '">';

            $buffy .= '<span class="td-page-meta" itemprop="reviewRating" itemscope itemtype="' . td_global::$http_or_https . '://schema.org/Rating">';
                $buffy .= '<meta itemprop="worstRating" content = "1">';
                $buffy .= '<meta itemprop="bestRating" content = "5">';
                $buffy .= '<meta itemprop="ratingValue" content = "' . td_review::calculate_total_stars($this->td_review) . '">';
            $buffy .= ' </span>';
        }
        return $buffy;
    }




    function get_content() {



        /*  ----------------------------------------------------------------------------
            Prepare the content
        */
        $content = get_the_content(__td('Continue', TD_THEME_NAME));
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);



        /*  ----------------------------------------------------------------------------
            Smart list support @todo reorganizare partea asta
         */
        $td_smart_list = get_post_meta($this->post->ID, 'td_smart_list', true);
        if (!empty($td_smart_list['smart_list_template'])) {

            switch ($td_smart_list['smart_list_template']) {
                case 'td_smart_list_1':
                    $td_smart_list_obj = new td_smart_list_1();
                    break;

                case 'td_smart_list_2':
                    $td_smart_list_obj = new td_smart_list_2();
                    break;

                case 'td_smart_list_3':
                    $td_smart_list_obj = new td_smart_list_3();
                    break;

                case 'td_smart_list_4':
                    $td_smart_list_obj = new td_smart_list_4();
                    break;

            }



            if (isset($td_smart_list_obj)) {
                return $td_smart_list_obj->render_from_post_content($content);
            } else {
                //there was an error?
            }
        }
        /*  ----------------------------------------------------------------------------
            end smart list - if we have a list, the function returns above
         */





        /*  ----------------------------------------------------------------------------
            ad support on content
        */



        $tds_inline_ad_paragraph = td_util::get_option('tds_inline_ad_paragraph');
        $tds_inline_ad_align = td_util::get_option('tds_inline_ad_align');

        if (td_util::is_ad_spot_enabled('content_inline') and is_single() ) {

            if (empty($tds_inline_ad_paragraph)) {
                $tds_inline_ad_paragraph = 0;
            }


            $content_buffer = ''; // we replace the content with this buffer at the end

            $content_parts = preg_split('/(<p.*>)/U', $content, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

            //print_r($content_parts);
            //die;
            //$content_parts = explode('<p>', $content);
            foreach ($content_parts as $content_part_index => $content_part) {
                if (!empty($content_part)) {

                    if ($tds_inline_ad_paragraph == $content_part_index / 2) {  //we have 0 = > <p>   1 => content - that's why we have to divide by 2
                        //it's time to show the ad
                        switch ($tds_inline_ad_align) {
                            case 'left':
                                $content_buffer .= td_global_blocks::get_instance('td_ad_box')->render(array('spot_id' => 'content_inline', 'align' => 'left'));
                                break;

                            case 'right':
                                $content_buffer .= td_global_blocks::get_instance('td_ad_box')->render(array('spot_id' => 'content_inline', 'align' => 'right'));
                                break;

                            default:
                                $content_buffer .= td_global_blocks::get_instance('td_ad_box')->render(array('spot_id' => 'content_inline'));
                                break;
                        }

                    }
                    $content_buffer .=  $content_part;
                }
            } //end foreach
            $content = $content_buffer;
        }

        //add the top ad
        if (td_util::is_ad_spot_enabled('content_top') and is_single()) {
            $content = td_global_blocks::get_instance('td_ad_box')->render(array('spot_id' => 'content_top')) . $content;
        }


        //add bottom ad
        if (td_util::is_ad_spot_enabled('content_bottom') and is_single()) {
            $content = $content . td_global_blocks::get_instance('td_ad_box')->render(array('spot_id' => 'content_bottom'));
        }


        return $content;
    }


    /*  ----------------------------------------------------------------------------
        Single page
     */
    function get_review() {
        if (!$this->is_single) {
            return;
        }

        if (td_review::has_review($this->td_review)) {
            //print_r($this->td_review);
            $buffy = '';
            $buffy .= td_review::render_table($this->td_review);



            return $buffy;
        }
    }

    function get_source_and_via() {
        if (!$this->is_single) {
            return;
        }


        $buffy ='';

        //via and sourcet
        if (!empty($this->td_post_theme_settings['td_source']) or !empty($this->td_post_theme_settings['td_source_2']) or !empty($this->td_post_theme_settings['td_via']) or !empty($this->td_post_theme_settings['td_via_2'])) {
            $buffy .= '<div class="post-source-via">';

            if (!empty($this->td_post_theme_settings['td_via']) or !empty($this->td_post_theme_settings['td_via_2'])) {
                $buffy .= '<div class="post-via"><span>' . __td('VIA') . '</span>';
                if (!empty($this->td_post_theme_settings['td_via'])) {
                    $buffy .= ' <a rel="nofollow" href="' . $this->td_post_theme_settings['td_via_url'] . '">' . $this->td_post_theme_settings['td_via'] . '</a>';
                }
                if (!empty($this->td_post_theme_settings['td_via_2'])) {
                    $buffy .= ' <a rel="nofollow" href="' . $this->td_post_theme_settings['td_via_2_url'] . '">' . $this->td_post_theme_settings['td_via_2'] . '</a>';
                }

                $buffy .= '</div>';
                }

            if (!empty($this->td_post_theme_settings['td_source']) or !empty($this->td_post_theme_settings['td_source_2'])) {
                $buffy .= '<div class="post-via"><span>' . __td('SOURCE') . '</span>';
                if (!empty($this->td_post_theme_settings['td_source'])) {
                    $buffy .= ' <a rel="nofollow" href="' . $this->td_post_theme_settings['td_source_url'] . '">' . $this->td_post_theme_settings['td_source'] . '</a>';
                }
                if (!empty($this->td_post_theme_settings['td_source_2'])) {
                    $buffy .= ' <a rel="nofollow" href="' . $this->td_post_theme_settings['td_source_2_url'] . '">' . $this->td_post_theme_settings['td_source_2'] . '</a>';
                }

                $buffy .= '</div>';
            }

            $buffy .= '</div>';
        }


        return $buffy;
    }


    function get_the_tags() {
        if (!$this->is_single) {
            return;
        }

        if (td_util::get_option('tds_show_tags') == 'hide') {
            return;
        }


        $buffy = '';

        $td_post_tags = get_the_tags();
        if ($td_post_tags) {
            $buffy .= '<ul class="td-tags clearfix"><li><span class="td-tag-black">' . __td('TAGS') . '</span></li>';
            foreach ($td_post_tags as $tag) {
                $buffy .=  '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>';
            }
            $buffy .= '</ul>';
        }

        return $buffy;
    }

    function get_next_prev_posts() {
        if (!$this->is_single) {
            return;
        }

        if (td_util::get_option('tds_show_next_prev') == 'hide') {
            return;
        }

        $buffy = '';

        $next_post = get_next_post();
        $prev_post = get_previous_post();

        if (!empty($next_post) or !empty($prev_post)) {
            $buffy .= '<div class="wpb_row row-fluid next-prev">';
            if (!empty($prev_post)) {
                $buffy .= '<div class="span6 prev-post">';
                $buffy .= '<div><img width="6" class="td-retina" src="' . get_template_directory_uri()  .
                    '/images/icons/similar-left.png" alt=""/>' . __td('Previous article', TD_THEME_NAME) . '</div>';
                $buffy .= '<a href="' . get_permalink($prev_post->ID) . '">' . $prev_post->post_title . '</a>';
                $buffy .= '</div>';
            } else {
                $buffy .= '<div class="span6 prev-post">';
                $buffy .= '</div>';
            }

            if (!empty($next_post)) {
                $buffy .= '<div class="span6 next-post">';
                $buffy .= '<div>' . __td('Next article', TD_THEME_NAME) . '<img width="6" class="td-retina" src="' .
                    get_template_directory_uri()  . '/images/icons/similar-right.png" alt=""/></div>';
                $buffy .= '<a href="' . get_permalink($next_post->ID) . '">' . $next_post->post_title . '</a>';
                $buffy .= '</div>';
            }
            $buffy .= '</div>'; //end fluid row
        }

        return $buffy;
    }

    function get_author_box($author_id = '') {

        if (!$this->is_single) {
            return;
        }

        if (td_util::get_option('tds_show_author_box') == 'hide') {
            return;
        }

        if (empty($author_id)) {
            $author_id = $this->post->post_author;
        }


        $buffy = '';

        $authorDescription = get_the_author_meta('description');
        $hideAuthor = td_util::get_option('hide_author');

        if (empty($hideAuthor)) {

            $buffy .= '<div class="author-box-wrap">';
                $buffy .= '<a href="' . get_author_posts_url($author_id) . '">' ;
                $buffy .= get_avatar(get_the_author_meta('email', $author_id), '106');
                $buffy .= '</a>';


                $buffy .= '<div class="desc">';
                    $buffy .= '<div class="td-author-name">';
                    $buffy .= '<a href="' . get_author_posts_url($author_id) . '">' . get_the_author_meta('display_name', $author_id) . '</a>' ;
                    $buffy .= '</div>';



                    $buffy .= '<div class="vcard author"><span class="fn">';
                    $buffy .=  get_the_author_meta('description', $author_id);
                    $buffy .= '</span></div>';


                    $buffy .= '<div class="td-author-social">';
                    foreach (td_social_icons::$td_social_icons_array as $td_social_id => $td_social_name) {
                        //echo get_the_author_meta($td_social_id) . '<br>';
                        $authorMeta = get_the_author_meta($td_social_id);
                        if (!empty($authorMeta)) {

                            //the theme can use the twitter id instead of the full url. This avoids problems with yoast plugin
                            if ($td_social_id == 'twitter') {
                                if(filter_var($authorMeta, FILTER_VALIDATE_URL)){

                                } else {
                                    $authorMeta = str_replace('@', '', $authorMeta);
                                    $authorMeta = 'http://twitter.com/' . $authorMeta;
                                }
                            }
                            $buffy .= td_social_icons::get_icon($authorMeta, $td_social_id, 4, 16);
                        }
                    }
                    $buffy .= '</div>';



                    $buffy .= '<div class="clearfix"></div>';

                $buffy .= '</div>'; ////desc
            $buffy .= '</div>'; //author-box-wrap
        }


        return $buffy;
    }


    function related_posts() {

        global $post; //this is used by the loop down

        if (!$this->is_single) {
            return;
        }


        if (td_util::get_option('tds_similar_articles') == 'hide') {
            return;
        }

        if (td_util::get_option('tds_similar_articles_count') == '') {
            $tds_similar_articles_count = 2;
        } else {
            $tds_similar_articles_count = td_util::get_option('tds_similar_articles_count');
        }

        if (td_global::$cur_single_template_sidebar_pos == 'no_sidebar') {
            $tds_similar_articles_count = 3;
        }



        $buffy = '';
        $buffy .= '<div class="art-img-text-down similar-articles">';


        $args = array();

        switch (td_util::get_option('tds_similar_articles_type')) {

            //by tag
            case 'by_tag':
                $tags = wp_get_post_tags($this->post->ID);
                if ($tags) {
                    $taglist = array();
                    for ($i = 0; $i <= 4; $i++) {
                        if (!empty($tags[$i])) {
                            $taglist[] = $tags[$i]->term_id;
                        } else {
                            break;
                        }
                    }
                    $args = array(
                        'tag__in' => $taglist,
                        'post__not_in' => array($this->post->ID),
                        'showposts' => $tds_similar_articles_count,
                        'ignore_sticky_posts' => 1
                    );
                }
                break;


            //by title
            case 'by_auth':
                $args = array(
                    'author' => $this->post->post_author,
                    'post__not_in' => array($this->post->ID),
                    'showposts' => $tds_similar_articles_count,
                    'ignore_sticky_posts' => 1
                );
                break;


            //by category
            default:
                $args = array(
                    'category__in' => wp_get_post_categories($this->post->ID),
                    'post__not_in' => array($this->post->ID),
                    'showposts' => $tds_similar_articles_count,
                    'ignore_sticky_posts' => 1
                );
                break;
        }



        if (!empty($args)) {
            //do the query
            $my_query = new WP_Query($args);
            if ($my_query->have_posts()) {
                $buffy .= '<h4 class="block-title"><span>' . __td('SIMILAR ARTICLES') . '</span></h4>';

                $td_template_layout = new td_template_layout(''); //invalid sidebar position, it will default to 2 + 1

                if (td_global::$cur_single_template_sidebar_pos == 'no_sidebar') {
                    $td_template_layout->set_columns(3);
                } else {
                    $td_template_layout->set_columns(2);
                }


                while ($my_query->have_posts()) : $my_query->the_post();

                    $buffy .= $td_template_layout->layout_open_element();
                    $td_module_6 = new td_module_6($post);
                    $buffy .= $td_module_6->render();
                    $buffy .=  $td_template_layout->layout_close_element();

                    $td_template_layout->layout_next();
                endwhile;

                $buffy .= $td_template_layout->close_all_tags();
            }
        }




        $buffy .= '</div>';

        wp_reset_query();

        return $buffy;
    }




}
