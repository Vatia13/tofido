<?php

/*
 *
 * This class makes the layout for modules
 * used by:
 *  - blocks
 *  - includes/td_page_generator/td_template_layout.php (author page, tag page)
 */

class td_block_layout {
    var $row_is_open = false;
    var $span6_is_open = false;
    var $span4_is_open = false;



    function open_row() {
        if ($this->row_is_open) {
            //open row only onece
            return;
        }

        $this->row_is_open = true;
        return "\n\n\t" . '<div class="wpb_row row-fluid">';
    }

    function close_row() {
        $this->row_is_open = false;
        return '</div><!--./row-fluid-->';
    }

    function is_row_open() {
        return $this->row_is_open;
    }


    //span 4
    function open4() {
        if ($this->span4_is_open) {
            //open row only onece
            return;
        }
        $this->span4_is_open = true;
        return "\n\n\t" . '<div class="span4">' . "\n";
    }

    function close4() {
        $this->span4_is_open = false;
        return "\n\t" . '</div> <!-- ./span4 -->';
    }


    //span 6
    function open6() {
        if ($this->span6_is_open) {
            //open row only onece
            return;
        }
        $this->span6_is_open = true;
        return "\n\n\t" . '<div class="span6">' . "\n";
    }

    function close6() {
        $this->span6_is_open = false;
        return "\n\t" . '</div> <!-- ./span6 -->';
    }



    function close_all_tags() {


        $buffy = '';
        if ($this->span6_is_open) {
            $buffy .= $this->close6();
        }

        if ($this->span4_is_open) {
            $buffy .= $this->close4();
        }

        if ($this->row_is_open) {
            $buffy .= $this->close_row();
        }

        return $buffy;
    }



    function get_column_number() {
        global $td_row_count, $td_column_count;


        if ($td_row_count == 1) {
            //first row
            switch ($td_column_count) {
                case '1/1':
                    return 3;
                    break;

                case '2/3' :
                    return 2;
                    break;

                case '1/3' :
                    return 1;
                    break;

                case '1/2': //half a row + sidebar
                    return 2;
                    break;
            }
        } else {
            //row in row
            if ($td_column_count == '1/2') {
                return 1;
            }

            if ($td_column_count == '1/3') {
                // works if parent is empty (1/1)
                return 1;
            }
        }

        //default
        return 1;

        //echo "<br>ra:" . $td_row_count . ' ' . $td_column_count;
    }
}
