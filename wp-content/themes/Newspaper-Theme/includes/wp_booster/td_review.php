<?php

class td_review {
    static $td_review_key = 'td_review_key';

    //calculates the average stars rating
    static function render_stars($td_review) {
        $total_stars = self::calculate_total_stars($td_review);
        return self::number_to_stars($total_stars);
    }


    //converts 0 - 5 to stars
    static function number_to_stars($total_stars) {
        //echo $total_stars;

        // Show full stars flag
        $show_star = true;

        // full stars($star_parts[0]) and half stars($star_parts[1])
        $star_parts = explode('.', $total_stars);
        // echo $star_parts[0] . " - " . $star_parts[1] . "</br>";

        $buffy = '';
        for ($i = 0; $i <= 4; $i++) {

            if ($star_parts[0] == $i) {
                $show_star = false;
            }
            // full stars
            if ($show_star) {
                $buffy .= '<span class="td-sp td-sp-star-on td-review-star"></span>';
            } else {
                // first quarter stars (1/3)
                if (isset($star_parts[1]) and ($star_parts[1] > 0) and ($star_parts[1] < 4) and ($star_parts[0] == $i)){
                    $buffy .= '<span class="td-sp td-sp-star-fq td-review-star"></span>';
                }
                // half stars (1/2)
                else if (isset($star_parts[1]) and ($star_parts[1] > 3) and ($star_parts[1] < 7) and ($star_parts[0] == $i)){
                    $buffy .= '<span class="td-sp td-sp-star-half td-review-star"></span>';
                }
                // last quarter stars (2/3)
                else if (isset($star_parts[1]) and ($star_parts[1] > 6) and ($star_parts[1] < 10) and ($star_parts[0] == $i)){
                    $buffy .= '<span class="td-sp td-sp-star-lq td-review-star"></span>';
                }
                // empty stars
                else {
                    $buffy .= '<span class="td-sp td-sp-star-off td-review-star"></span>';
                }
            }
        }
        return $buffy;
    }


    //draws the bars
    static function number_to_bars($percent_rating) {
        $buffy = '';
        $buffy .= '<div class="td-rating-bar-wrap">';
            $buffy .= '<div style="width:' . $percent_rating . '%"></div>';
        $buffy .= '</div>';

        return $buffy;
    }

    //check to see if we have a rating
    //@legacy this is legacy code - introduced on Newspaper - nu puteam sa-l schimbam ca stricam compatibilitatea
    static function has_review($td_review) {
        if (!empty($td_review['has_review']) and (
                !empty($td_review['p_review_stars']) or
                !empty($td_review['p_review_percents']) or
                !empty($td_review['p_review_points']))
            ) {
            return true;
        } else {
            return false;
        }
    }

    // converts the rating to 0-5 to be used with stars
    static function calculate_total_stars($td_review) {
        if (!empty($td_review['has_review'])) {
            switch ($td_review['has_review']) {
                case 'rate_stars' :
                    return round(self::calculate_total($td_review), 1);
                    break;
                case 'rate_percent':
                    return round(self::calculate_total($td_review) / 10 / 2, 1);
                    break;
                case 'rate_point' :
                    return round(self::calculate_total($td_review) / 2, 1);
                    break;
            }
        }
    }


    // converts the rating to 0-5 to be used with stars
    static function calculate_total_key_value($td_review) {
        if (!empty($td_review['has_review'])) {
            switch ($td_review['has_review']) {
                case 'rate_stars' :
                    return round(self::calculate_total($td_review), 1);
                    break;
                case 'rate_percent':
                    return round(self::calculate_total($td_review) / 10 / 2, 1);
                    break;
                case 'rate_point' :
                    return round(self::calculate_total($td_review) / 2, 1);
                    break;
            }
        }
    }

    //calculates the average of the rating
    static function calculate_total($td_review, $show_percent = false) {
        //print_r($td_review);
        if (!empty($td_review['has_review'])) {

            $total = 0;
            $cnt = 0;

            switch ($td_review['has_review']) {
                case 'rate_stars' :
                    foreach ($td_review['p_review_stars'] as $section) {
                        if (!empty($section['desc']) and !empty($section['rate'])) {
                            $total = $total + $section['rate'];
                            $cnt++;
                        }
                    }
                    break;

                case 'rate_percent' :
                    foreach ($td_review['p_review_percents'] as $section) {
                        if (!empty($section['desc']) and !empty($section['rate'])) {
                            $total = $total + $section['rate'];
                            $cnt++;
                        }
                    }
                    break;

                case 'rate_point' :
                    foreach ($td_review['p_review_points'] as $section) {
                        if (!empty($section['desc']) and !empty($section['rate'])) {
                            $total = $total + $section['rate'];
                            $cnt++;
                        }
                    }
                    break;

            }

            if ($total == 0) {
                $result = 0;
            } else {
                $result = round($total / $cnt, 1);
            }


            if ($show_percent and $td_review['has_review'] == 'rate_percent') {
                return $result . ' %';
            } else {
                return $result;
            }
        }

    }


    /*  ----------------------------------------------------------------------------
        render table
     */

    static function render_table($td_review) {
        $buffy = '';
        $buffy .= self::render_table_head();
        $buffy .= self::render_table_rows($td_review);
        $buffy .= self::render_table_footer($td_review);




        return $buffy;
    }


    /*  ----------------------------------------------------------------------------
        render table head
     */

    static function render_table_head() {
        $buffy = '';
        $buffy .= '<table class="td-review">';
        $buffy .= '<tr class="td-review-header">';
            $buffy .= '<td colspan="2">';
                $buffy .= '<span>' . __td('Review overview', TD_THEME_NAME) . '</span>';
            $buffy .= '</td>';
        $buffy .= '</tr>';
        return $buffy;
    }

    static function render_table_rows($td_review) {
        $buffy = '';


        if (!empty($td_review['has_review'])) {
            switch ($td_review['has_review']) {
                case 'rate_stars' :
                    foreach ($td_review['p_review_stars'] as $section) {
                        if (!empty($section['desc']) and !empty($section['rate'])) {
                            $buffy .= '<tr class="td-review-row-stars">';
                                $buffy .= '<td class="td-review-desc">';
                                    $buffy .= $section['desc'];
                                $buffy .= '</td>';
                                $buffy .= '<td class="td-review-stars">';
                                $buffy .= self::number_to_stars($section['rate']);
                                  //$buffy .= $section['rate'];
                                $buffy .= '</td>';
                            $buffy .= '</tr>';
                        }
                    }
                    break;

                case 'rate_percent' :

                    foreach ($td_review['p_review_percents'] as $section) {
                        if (!empty($section['desc']) and !empty($section['rate'])) {
                            $buffy .= '<tr class="td-review-row-bars">';
                                $buffy .= '<td colspan="2">';
                                    $buffy .= '<div class="td-review-desc">' . $section['desc'] . ' - ' . $section['rate'] . ' %</div>';
                                    $buffy .= self::number_to_bars($section['rate']);
                                $buffy .= '</td>';
                            $buffy .= '</tr>';
                        }
                    }
                    break;

                case 'rate_point' :
                    foreach ($td_review['p_review_points'] as $section) {
                        if (!empty($section['desc']) and !empty($section['rate'])) {
                            $buffy .= '<tr class="td-review-row-bars">';
                                $buffy .= '<td colspan="2">';
                                    $buffy .= '<div class="td-review-desc">' . $section['desc'] . ' - ' . $section['rate'] .  '</div>';;
                                    $buffy .= self::number_to_bars($section['rate'] * 10);
                                $buffy .= '</td>';
                            $buffy .= '</tr>';
                        }
                    }
                    break;

            }



        }
        return $buffy;
    }



    /*  ----------------------------------------------------------------------------
        render table footer
     */
    static function render_table_footer($td_review) {
        if (!empty($td_review['has_review'])) {

            $buffy = '';


            if ($td_review['has_review'] == 'rate_percent' or $td_review['has_review'] == 'rate_point') {
                $buffy .= '<tr class="td_review_with_bars"><td></td><td></td></tr>';
            }

            $buffy .= '<tr class="td-review-footer">';
                $buffy .= '<td class="td-review-summary">';
                    $buffy .= '<h5>' . __td('Summary', TD_THEME_NAME) . '</h5>';
                    if (!empty($td_review['review'])) {
                        $buffy .= '<div>' . $td_review['review'] . '</div>';
                    }

                $buffy .= '</td>';
                $buffy .= '<td class="td-review-score">';
                switch ($td_review['has_review']) {
                    case 'rate_stars' :
                        $buffy .= '<div class="td-review-final-score">' . self::calculate_total($td_review) . '</div>';
                        $buffy .= '<div>' . self::render_stars($td_review) . '</div>';
                        break;

                    case 'rate_percent' :
                        $buffy .= '<div class="td-review-final-score">' . self::calculate_total($td_review) . '<span class="td-review-percent-sign">%</span></div>';
                        break;

                    case 'rate_point' :
                        $buffy .= '<div class="td-review-final-score">' . self::calculate_total($td_review) . '</div>';
                        break;

                }


                $buffy .= '</td>';

            $buffy .= '</tr>';
            $buffy .= '</table>';
            return $buffy;
        }
    }




    static function hook_up() {
        add_filter('save_post', array( __CLASS__, 'save_post_hook'));
    }


    static function save_post_hook($post_id) {
        $td_review = get_post_meta($post_id, 'td_review', true);
        if (self::has_review($td_review)) {
            update_post_meta($post_id, self::$td_review_key, self::calculate_total_key_value($td_review));
            /*
            $myFile = "d:/testFile.txt";
            $fh = fopen($myFile, 'w') or die("can't open file");
            $stringData = print_r($td_review, true);
            $stringData .= self::calculate_total($td_review);

            fwrite($fh, $stringData);
            fclose($fh);
             */
        }
    }
}

td_review::hook_up();
