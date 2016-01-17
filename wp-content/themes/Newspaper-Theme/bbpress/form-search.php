<?php

/**
 * Search
 *
 * @package bbPress
 * @subpackage Theme
 */

?>


<div class="bbp-search-wrap">

    <form id="bbp-search-form" role="search" method="get" class="td-search-form-widget" action="<?php bbp_search_url(); ?>">
        <div>
            <input class="td-widget-search-input" type="text" placeholder="<?php echo __td('Search the forum') ?>" name="bbp_search"><input class="wpb_button wpb_btn-inverse btn" type="submit" id="bbp_search_submit" value="<?php echo __td('Search') ?>">
        </div>
    </form>
</div>



