"use strict";

/* ----------------------------------------------------------------------------
 blocks.js
 --------------------------------------------------------------------------- */



/*  ----------------------------------------------------------------------------
 On load
 */
jQuery().ready(function() {
    td_on_ready_ajax_blocks();
});





function td_on_ready_ajax_blocks() {


    /*  ----------------------------------------------------------------------------
     AJAX pagination next
     */
    jQuery(".td-ajax-next-page").click(function(event){
        event.preventDefault();

        var current_block_obj = td_getBlockObjById(jQuery(this).data('td_block_id'));

        if(jQuery(this).hasClass('ajax-page-disabled') || current_block_obj.is_ajax_running === true) {
            return;
        }

        current_block_obj.is_ajax_running = true; // ajax is running and we're wayting for a reply from server

        current_block_obj.td_current_page++;
        td_ajax_do_block_request(current_block_obj, 'next');
    });


    /*  ----------------------------------------------------------------------------
     AJAX pagination prev
     */
    jQuery(".td_ajax-prev-page").click(function(event){
        event.preventDefault();

        var current_block_obj = td_getBlockObjById(jQuery(this).data('td_block_id'));

        if(jQuery(this).hasClass('ajax-page-disabled') || current_block_obj.is_ajax_running === true) {
            return;
        }

        current_block_obj.is_ajax_running = true; // ajax is running and we're wayting for a reply from server

        current_block_obj.td_current_page--;
        td_ajax_do_block_request(current_block_obj, 'back');
    });


    /*  ----------------------------------------------------------------------------
     AJAX pagination load more
     */
    jQuery(".td_ajax_load_more").click(function(event){
        event.preventDefault();
        if(jQuery(this).hasClass('ajax-page-disabled')) {
            return;
        }

        var current_block_obj = td_getBlockObjById(jQuery(this).data('td_block_id'));

        current_block_obj.td_current_page++;
        td_ajax_do_block_request(current_block_obj, 'load_more');
    });


    /*  ----------------------------------------------------------------------------
     AJAX pagination infinite load
     */
    jQuery('.td_ajax_infinite').waypoint(function(direction) {
        if (direction === 'down') {
            //console.log('loading');
            var current_block_obj = td_getBlockObjById(jQuery(this).data('td_block_id'));

            current_block_obj.td_current_page++;
            td_ajax_do_block_request(current_block_obj, 'infinite_load');
        }

    }, { offset: '110%' });





    /*  ----------------------------------------------------------------------------
     AJAX sub cat filter
     */
    jQuery(".ajax-sub-cat").click(function(event){ //click on an ajax category filter
        event.preventDefault();


        //get the current block id
        var current_block_id = jQuery(this).data('td_block_id');


        //destroy any iossliders to avoid bugs
        jQuery('#' + current_block_id).find('.iosSlider').iosSlider('destroy');;

        //get current block
        var current_block_obj = td_getBlockObjById(current_block_id);

        //change cur cat
        current_block_obj.td_cur_cat = jQuery(this).data('cat_id');

        current_block_obj.td_current_page = 1;


        //console.log(current_block_obj);

        //do request
        td_ajax_do_block_request(current_block_obj, 'pull_down');
    });




    /*  ----------------------------------------------------------------------------
     AJAX MEGA MENU
     */



    var td_mega_menu_last_link = '';

    //it used to hook the mega menu categories
    function td_ajax_sub_cat_mega_run(event) {

        if (td_mega_menu_last_link != jQuery(this).attr('href')) {
            event.preventDefault();
            td_mega_menu_last_link = jQuery(this).attr('href');
        } else {
            td_mega_menu_last_link = '';
        }


        //get the current block id
        var current_block_id = jQuery(this).data('td_block_id');

        //get current block
        var current_block_obj = td_getBlockObjById(current_block_id);


        //change cur cat
        current_block_obj.td_cur_cat = jQuery(this).data('cat_id');

        current_block_obj.td_current_page = 1;

        //do request - no append, no animation
        td_ajax_do_block_request(current_block_obj, 'pull_down');
    }

    //on touch devices use click
    if (td_detect.is_touch_device) {
        jQuery(".ajax-sub-cat-mega").click(td_ajax_sub_cat_mega_run);
    } else {
        jQuery(".ajax-sub-cat-mega").hover(td_ajax_sub_cat_mega_run, function (event) {} );
    }


} // end td_on_ready_ajax_blocks()



/**
 * makes a ajax block request
 * @param current_block_obj
 * @param td_append - append the return content?
 * @returns {string}
 */
function td_ajax_do_block_request(current_block_obj, td_user_action) {

    //console.log(current_block_obj);

    //search the cache
    var current_block_obj_signature = JSON.stringify(current_block_obj);
    if (td_local_cache.exist(current_block_obj_signature)) {
        //do the animation with cache hit = true
        td_block_ajax_loading_start(current_block_obj, true);
        td_ajax_block_process_response(td_local_cache.get(current_block_obj_signature), td_user_action);
        return 'cache_hit'; //cache HIT
    }


    //cache miss - we make a full request! - cache hit - false
    td_block_ajax_loading_start(current_block_obj, false);


    jQuery.ajax({
        type: 'POST',
        url: td_ajax_url,
        cache:true,

        data: {
            action: 'td_ajax_block',
            td_atts: current_block_obj.atts,
            td_cur_cat:current_block_obj.td_cur_cat,
            td_block_id:current_block_obj.id,
            td_column_number:current_block_obj.td_column_number,
            td_current_page:current_block_obj.td_current_page,
            block_type:current_block_obj.block_type,
            td_user_action:current_block_obj.td_user_action
        },
        success: function(data, textStatus, XMLHttpRequest){
            td_local_cache.set(current_block_obj_signature, data);
            td_ajax_block_process_response(data, td_user_action);
        },
        error: function(MLHttpRequest, textStatus, errorThrown){
            //console.log(errorThrown);
        }
    });
}


/**
 * process the response from the ajax query (it also processes the responses stored in the cache)
 * @param data
 * @param td_user_action
 */
function td_ajax_block_process_response(data, td_user_action) {

    //read the server response
    var td_reply_obj = jQuery.parseJSON(data); //get the data object


    //console.log(td_reply_obj);
    /*
     td_data_object.td_block_id
     td_data_object.td_data
     td_data_object.td_cur_cat
     */

    jQuery('.sub-cat-' + td_reply_obj.td_block_id).removeClass('cur-sub-cat');
    jQuery('#sub-cat-' + td_reply_obj.td_block_id + '-' + td_reply_obj.td_cur_cat).addClass('cur-sub-cat');


    //load the content (in place or append)
    if (td_user_action == 'load_more' || td_user_action == 'infinite_load') {
        jQuery('#' + td_reply_obj.td_block_id).append(td_reply_obj.td_data); //append
    } else {
        jQuery('#' + td_reply_obj.td_block_id).html(td_reply_obj.td_data); //in place
    }


    //hide or show prev
    if (td_reply_obj.td_hide_prev === true) {
        jQuery('#prev-page-' + td_reply_obj.td_block_id).addClass('ajax-page-disabled');
    } else {
        jQuery('#prev-page-' + td_reply_obj.td_block_id).removeClass('ajax-page-disabled');
    }

    //hide or show next
    if (td_reply_obj.td_hide_next === true) {
        jQuery('#next-page-' + td_reply_obj.td_block_id).addClass('ajax-page-disabled');
    } else {
        jQuery('#next-page-' + td_reply_obj.td_block_id).removeClass('ajax-page-disabled');
    }


    var  current_block_obj = td_getBlockObjById(td_reply_obj.td_block_id);
    if (current_block_obj.block_type === 'slide') {
        //make the first slide active (to have caption)
        jQuery('#' + td_reply_obj.td_block_id + ' .slide-wrap-active-first').addClass('slide-wrap-active');
    }

    current_block_obj.is_ajax_running = false; // finish the loading for this block


    //loading effects
    td_block_ajax_loading_end(current_block_obj, td_user_action);
}


/**
 * loading start
 * @param current_block_obj
 * @param cache_hit
 */
function td_block_ajax_loading_start(current_block_obj, cache_hit) {

    //get the element
    var el_cur_td_block_inner = jQuery('#' + current_block_obj.id);

    //remove the loader
    jQuery('.td-loader-gif').remove(); //remove any remaining loaders

    //remove animation classes
    el_cur_td_block_inner.removeClass('fadeInRight fadeInLeft fadeInDown fadeInUp animated fadeIn');

    //add overflow + fixed height
    el_cur_td_block_inner.addClass('td_block_inner_overflow');
    var td_tmp_block_height = el_cur_td_block_inner.height();
    el_cur_td_block_inner.css('height', td_tmp_block_height);


    //show the loader only if it's needed
    if (cache_hit === true) {
        el_cur_td_block_inner.stop();
    } else {
        //el_cur_td_block_inner.parent().append('<img class="td-loader-gif td-loader-animation-start" src="' + td_get_template_directory_uri + '/images/AjaxLoader.gif" alt=""/>');
        el_cur_td_block_inner.parent().append('<div class="td-loader-gif td-loader-animation-start"></div>');

        //init the loading box
        td_loading_box.init(current_block_obj.header_color);

        setTimeout(function(){
            jQuery('.td-loader-gif').removeClass('td-loader-animation-start');
            jQuery('.td-loader-gif').addClass('td-loader-animation-mid');
        },50);

        el_cur_td_block_inner.stop();
        el_cur_td_block_inner.fadeTo('500',0.1, 'easeInOutCubic');
    }



    //auto height => fixed height
    var td_tmp_block_height = el_cur_td_block_inner.height();
    el_cur_td_block_inner.css('height', td_tmp_block_height);



}


/**
 * we have a reply from the ajax request
 * @param current_block_obj
 * @param td_user_action
 */
function td_block_ajax_loading_end(current_block_obj, td_user_action) {

    // remove the loader
    jQuery('.td-loader-gif').removeClass('td-loader-animation-mid');
    jQuery('.td-loader-gif').addClass('td-loader-animation-end');
    setTimeout(function(){
        jQuery('.td-loader-gif').remove();
        //stop the loading box
        td_loading_box.stop();
    },400);




    //get the current inner
    var el_cur_td_block_inner = jQuery('#' + current_block_obj.id);


    el_cur_td_block_inner.stop();



    switch(td_user_action) {
        case 'next':
            el_cur_td_block_inner.addClass('animated fadeInRight');
            break;
        case 'back':
            el_cur_td_block_inner.addClass('animated fadeInLeft');
            break;

        case 'pull_down':
            el_cur_td_block_inner.addClass('animated fadeInDown');
            break;

        case 'mega_menu':
            el_cur_td_block_inner.addClass('animated fadeInUp');
            break;


        case 'load_more':
            el_cur_td_block_inner.addClass('animated fadeIn');
            break;


        case 'infinite_load':
            el_cur_td_block_inner.addClass('animated fadeIn');
            break;
    }

    if (td_detect.is_ie9 || td_detect.is_ie8) {

        el_cur_td_block_inner.css('opacity', 1);
    }

    setTimeout(function(){
        jQuery('.td_block_inner_overflow').removeClass('td_block_inner_overflow');
        el_cur_td_block_inner.css('height', 'auto');

    },300);


    //refresh waypoints for infinit scroll
    jQuery.waypoints('refresh');
}


/**
 * search by block _id
 * @param myID - block id
 * @returns {number} the index
 */
function td_getBlockIndex(myID) {
    var cnt = 0;
    var tmpReturn = 0;
    jQuery.each(td_blocks, function(index, td_block) {
        if (td_block.id === myID) {
            tmpReturn = cnt;
            return false; //brake jquery each
        } else {
            cnt++;
        }
    });
    return tmpReturn;
}

/**
 * gets the block object using a block ID
 * @param myID
 * @returns {*} block object
 */
function td_getBlockObjById(myID) {
    return td_blocks[td_getBlockIndex(myID)];
}

