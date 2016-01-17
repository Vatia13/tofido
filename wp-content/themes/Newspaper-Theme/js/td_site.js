/*
    tagDiv - 2014 - Newspaper WordPress theme v4.0
    Our portfolio:  http://themeforest.net/user/tagDiv/portfolio

    Thanks for using our theme! :)
*/





var td_is_slide_moving = false; //disable touch when the touch sliders are moving




/*  ----------------------------------------------------------------------------
 Menu script
 */

jQuery('#td-top-menu .sf-menu').supersubs({
    minWidth:    10, // minimum width of sub-menus in em units
    maxWidth:    40, // maximum width of sub-menus in em units
    extraWidth:  1 // extra width can ensure lines don't sometimes turn over
});

if (td_detect.is_touch_device) {
    //touch
    jQuery('#td-top-menu .sf-menu').superfish({
        delay:300,
        speed:'fast',
        useClick:true
    });
} else {
    //not touch
    jQuery('#td-top-menu .sf-menu').superfish({
        delay:500,
        speed:200,
        useClick:false
    });
}

/*  ----------------------------------------------------------------------------
    On load
 */
jQuery().ready(function jQuery_ready() {



    //resize all the videos if we have them
    td_resize_videos();









    //put focus on search box in blog header
    jQuery('#search-button').click(function(){
        jQuery(this).delay(200).queue(function(){
            document.getElementById("td-header-search").focus();
            jQuery(this).dequeue();
        });
    });


    //retina images
    td_retina();

    //colorbox
    jQuery('.td-featured-img').colorbox({
        maxWidth:"95%",
        maxHeight:"95%",
        fixed:true
    });





    td_ajax_search();


    //srun the mobile menu on phones and on desktop (no ipad or big tablets with touch)
    if (td_detect.is_phone_screen || td_detect.is_touch_device === false) {
        //alert('mobile menu');
        td_mobile_menu2();
    }







    td_fake_clicks();







    //fake placeholder for ie
    jQuery('input, textarea').placeholder();



    //more stories box
    td_more_articles_box.init();



    if (td_detect.is_chrome === true || td_detect.is_ie10 || td_detect.is_ie11) {
        td_smooth_scroll();
    }


    setTimeout(function(){
        td_resize_page_sliders()
    }, 1500);

}); //end on load


/**
 * windlow.load
 */
jQuery(window).load(function() {
    td_resize_page_sliders();
});



/*  ----------------------------------------------------------------------------
 Scroll to top + animation stop
 */

var td_is_scrolling_animation = false;
var td_mouse_wheel_or_touch_moved = false; //we want to know if the user stopped the animation via touch or mouse move

//stop the animation on mouse wheel
jQuery(document).bind('mousewheel DOMMouseScroll MozMousePixelScroll', function(e){
    if (td_is_scrolling_animation === false) {
        return;
    } else {
        td_is_scrolling_animation = false;
        td_mouse_wheel_or_touch_moved = true;

        jQuery("html, body").stop();
    }
});

//stop the animation on touch
if (document.addEventListener){
    document.addEventListener('touchmove', function(e) {
        if (td_is_scrolling_animation === false) {
            return;
        } else {
            td_is_scrolling_animation = false;
            td_mouse_wheel_or_touch_moved = true;
            jQuery("html, body").stop();
        }
    }, false);
}

/**
 * called by td_events.js on scroll - back to top
 */
var td_scroll_to_top_is_visible = false;
function td_events_scroll_scroll_to_top(scrollTop) {
    if(td_is_scrolling_animation) {  //do not fire the event on animations
        return;
    }
    if (scrollTop > 400) {
        if (td_scroll_to_top_is_visible === false) { //only add class if needed
            td_scroll_to_top_is_visible = true;
            jQuery('.td-scroll-up').addClass('td-scroll-up-visible');
        }
    } else {
        if (td_scroll_to_top_is_visible === true) { //only add class if needed
            td_scroll_to_top_is_visible = false;
            jQuery('.td-scroll-up').removeClass('td-scroll-up-visible');
        }
    }
}


jQuery('.td-scroll-up').click(function(){
    if(td_is_scrolling_animation) { //double check - because when we remove the class, the button is still visible for a while
        return;
    }

    //hide the button
    td_scroll_to_top_is_visible = false;
    jQuery('.td-scroll-up').removeClass('td-scroll-up-visible');

    //hide more articles box
    td_more_articles_box.is_box_visible = false;
    jQuery('.td-more-articles-box').removeClass('td-front-end-display-block');

    //scroll to top
    td_util.scroll_to_position(0, 1200);

    return false;
});


/**
 * More stories box
 */
var td_more_articles_box = {
    is_box_visible:false,
    cookie:'',
    distance_from_top:400,

    init: function init() {


        //read the cookie
        td_more_articles_box.cookie = td_read_site_cookie('td-cookie-more-articles');


        //setting distance from the top
        if(!isNaN(parseInt(tds_more_articles_on_post_pages_distance_from_top)) && isFinite(tds_more_articles_on_post_pages_distance_from_top) && parseInt(tds_more_articles_on_post_pages_distance_from_top) > 0){
            td_more_articles_box.distance_from_top = parseInt(tds_more_articles_on_post_pages_distance_from_top);
        } else {
            td_more_articles_box.distance_from_top = 400;
        }

        //adding event to hide the box
        jQuery('.td-close-more-articles-box').click(function(){

            //hiding the box
            jQuery('.td-more-articles-box').removeClass('td-front-end-display-block');
            jQuery('.td-more-articles-box').hide();

            //cookie life
            if(!isNaN(parseInt(tds_more_articles_on_post_time_to_wait)) && isFinite(tds_more_articles_on_post_time_to_wait)){
                //setting cookie
                td_create_cookie('td-cookie-more-articles', 'hide-more-articles-box', parseInt(tds_more_articles_on_post_time_to_wait));
            }
        });
    },

    /**
     * called by td_events.js on scroll
     */
    td_events_scroll: function td_events_scroll(scrollTop) {

        if(td_is_scrolling_animation) { //do not fire the event on animations
            return;
        }

        //check to see if it's enable form panel and also from cookie
        if(td_util.get_backend_var('tds_more_articles_on_post_enable') == "show" && td_more_articles_box.cookie != 'hide-more-articles-box') {

            if (scrollTop > td_more_articles_box.distance_from_top ) {
                if (td_more_articles_box.is_box_visible === false) {
                    jQuery('.td-more-articles-box').addClass('td-front-end-display-block');
                    td_more_articles_box.is_box_visible = true;
                }
            } else {
                if (td_more_articles_box.is_box_visible === true) {
                    jQuery('.td-more-articles-box').removeClass('td-front-end-display-block');
                    td_more_articles_box.is_box_visible = false;
                }
            }
        }
    }
};



//click on a div -> go to a url
function td_fake_clicks() {
    jQuery('.td-fake-click').click(function(){
        window.location = jQuery(this).data("fake-click");
    });
}




var td_resize_timer_id;
jQuery(window).resize(function() {
    clearTimeout(td_resize_timer_id);
    td_resize_timer_id = setTimeout(td_done_resizing, 500);

});

function td_done_resizing(){
    td_resize_videos();
}



/*  ----------------------------------------------------------------------------
    Resize the videos
 */
function td_resize_videos() {
    //youtube in content
    jQuery(document).find('iframe[src*="youtube.com"]').each(function() {
        var td_video = jQuery(this);
        td_video.attr('width', '100%');
        var td_video_width = td_video.width();
        td_video.css('height', td_video_width * 0.6, 'important');
    });


    //vimeo in content
    jQuery(document).find('iframe[src*="vimeo.com"]').each(function() {
        var td_video = jQuery(this);
        td_video.attr('width', '100%');
        var td_video_width = td_video.width();
        td_video.css('height', td_video_width * 0.6, 'important');
    })


    //daily motion in content
    jQuery(document).find('iframe[src*="dailymotion.com"]').each(function() {
        var td_video = jQuery(this);
        td_video.attr('width', '100%');
        var td_video_width = td_video.width();
        td_video.css('height', td_video_width * 0.6, 'important');
    })
}




/*  ----------------------------------------------------------------------------
    Ajax search
 */
var td_aj_search_cur_sel = 0;
var td_aj_search_results = 0;
var td_aj_first_down_up = true;
function td_ajax_search() {




    jQuery('#td-header-search').keydown(function(event) {

        //console.log(event.keyCode);


        if ((event.which && event.which == 39) || (event.keyCode && event.keyCode == 39) || (event.which && event.which == 37) || (event.keyCode && event.keyCode == 37)) {
            //do nothing on left and right arrows
            td_aj_search_input_focus();
            return;
        }

        if ((event.which && event.which == 13) || (event.keyCode && event.keyCode == 13)) {

            //redirectSearch('q');
            var td_aj_cur_element = jQuery('.td-aj-cur-element');
            if (td_aj_cur_element.length > 0) {
                //alert('ra');
                var td_go_to_url = td_aj_cur_element.find('.entry-title a').attr('href');
                window.location = td_go_to_url;
            } else {
                jQuery(this).parent().parent().submit();
            }

            return false; //redirect for search on enter
        } else {

            if ((event.which && event.which == 40) || (event.keyCode && event.keyCode == 40)) {
                // down
                td_aj_search_move_prompt_down();
                return false; //disable the envent

            } else if((event.which && event.which == 38) || (event.keyCode && event.keyCode == 38)) {
                //up
                td_aj_search_move_prompt_up();
                return false; //disable the envent
            } else {

                //for backspace we have to check if the search query is empty and if so, clear the list
                if ((event.which && event.which == 8) || (event.keyCode && event.keyCode == 8)) {
                    //if we have just one character left, that means it will be deleted now and we also have to clear the search results list
                    var search_query = jQuery(this).val();
                    if (search_query.length == 1) {
                        jQuery('#td-aj-search').empty();
                    }

                }

                //various keys
                td_aj_search_input_focus();
                setTimeout("td_ajax_search_do_request()",100);
            }
            return true;
        }

    });



}

//moves the select up
function td_aj_search_move_prompt_up() {


    if (td_aj_first_down_up === true) {
        td_aj_first_down_up = false;
        if (td_aj_search_cur_sel === 0) {
            td_aj_search_cur_sel = td_aj_search_results - 1;
        } else {
            td_aj_search_cur_sel--;
        }
    } else {
        if (td_aj_search_cur_sel === 0) {
            td_aj_search_cur_sel = td_aj_search_results;
        } else {
            td_aj_search_cur_sel--;
        }
    }


    jQuery('.td_mod_aj_search').removeClass('td-aj-cur-element');



    if (td_aj_search_cur_sel  > td_aj_search_results -1) {
        //the input is selected
        jQuery('.td-search-form').fadeTo(100, 1);
    } else {
        td_aj_search_input_remove_focus();
        jQuery('.td_mod_aj_search').eq(td_aj_search_cur_sel).addClass('td-aj-cur-element');
    }



}

//moves the select prompt down
function td_aj_search_move_prompt_down() {

    if (td_aj_first_down_up === true) {
        td_aj_first_down_up = false;
    } else {
        if (td_aj_search_cur_sel === td_aj_search_results) {
            td_aj_search_cur_sel = 0;
        } else {
            td_aj_search_cur_sel++;
        }
    }


    jQuery('.td_mod_aj_search').removeClass('td-aj-cur-element');

    if (td_aj_search_cur_sel > td_aj_search_results - 1 ) {
        //the input is selected
        jQuery('.td-search-form').fadeTo(100, 1);
    } else {
        td_aj_search_input_remove_focus();
        jQuery('.td_mod_aj_search').eq(td_aj_search_cur_sel).addClass('td-aj-cur-element');
    }


}


// puts the focus on the input box
function td_aj_search_input_focus() {
    td_aj_search_cur_sel = 0;
    td_aj_first_down_up = true;
    jQuery('.td-search-form').fadeTo(100, 1);
    jQuery('.td_mod_aj_search').removeClass('td-aj-cur-element');
}

//removes the focus from the input box
function td_aj_search_input_remove_focus() {
    if (td_aj_search_results !== 0) {
        jQuery('.td-search-form').css('opacity', 0.5);
    }
}

//makes an ajax request
function td_ajax_search_do_request() {

    if (jQuery('#td-header-search').val() == '') {
        td_aj_search_input_focus();
        return;
    }


    var search_query = jQuery('#td-header-search').val();


    //do we have a cache hit
    if (td_local_cache.exist(search_query)) {
        td_ajax_search_process_request(td_local_cache.get(search_query));
        return; //cache HIT
    }


    //fk no cache hit - do the real request



    jQuery.ajax({
        type: 'POST',
        url: td_ajax_url,
        data: {
            action: 'td_ajax_search',
            td_string: search_query
        },
        success: function(data, textStatus, XMLHttpRequest){
            td_local_cache.set(search_query, data);
            td_ajax_search_process_request(data);
        },
        error: function(MLHttpRequest, textStatus, errorThrown){
            //console.log(errorThrown);
        }
    });
}

function td_ajax_search_process_request(data) {
    var current_query = jQuery('#td-header-search').val();

    //the search is empty - drop results
    if (current_query == '') {
        jQuery('#td-aj-search').empty();
        return;
    }

    var td_data_object = jQuery.parseJSON(data); //get the data object
    //drop the result - it's from a old query
    if (td_data_object.td_search_query !== current_query) {
        return;
    }

    //reset the current selection and total posts
    td_aj_search_cur_sel = 0;
    td_aj_search_results = td_data_object.td_total_in_list;
    td_aj_first_down_up = true;


    //update the query
    jQuery('#td-aj-search').html(td_data_object.td_data);

    /*
     td_data_object.td_data
     td_data_object.td_total_results
     td_data_object.td_total_in_list
     */
}






function td_mobile_menu2() {
    //return;
    //alert('mobile menu');
    //******************************************************************
    //MOBILE MENU new

    // helper functions

    var trim = function(str)
    {
        return str.trim ? str.trim() : str.replace(/^\s+|\s+$/g,'');
    };

    var hasClass = function(el, cn)
    {
        return (' ' + el.className + ' ').indexOf(' ' + cn + ' ') !== -1;
    };

    var addClass = function(el, cn)
    {
        if (!hasClass(el, cn)) {
            el.className = (el.className === '') ? cn : el.className + ' ' + cn;
        }
    };

    var removeClass = function(el, cn)
    {
        el.className = trim((' ' + el.className + ' ').replace(' ' + cn + ' ', ' '));
    };

    var hasParent = function(el, id)
    {
        if (el) {
            do {
                if (el.id === id) {
                    return true;
                }
                if (el.nodeType === 9) {
                    break;
                }
            }
            while((el = el.parentNode));
        }
        return false;
    };

    // normalize vendor prefixes

    var doc = document.documentElement;

    var transform_prop = window.Modernizr.prefixed('transform'),
        transition_prop = window.Modernizr.prefixed('transition'),
        transition_end = (function() {
            var props = {
                'WebkitTransition' : 'webkitTransitionEnd',
                'MozTransition'    : 'transitionend',
                'OTransition'      : 'oTransitionEnd otransitionend',
                'msTransition'     : 'MSTransitionEnd',
                'transition'       : 'transitionend'
            };
            return props.hasOwnProperty(transition_prop) ? props[transition_prop] : false;
        })();

    window.App = (function()
    {

        var _init = false;
        var app = { };

        var inner_nav_td = document.getElementById('inner-wrap');
        var nav_open = false;
        var nav_class = 'js-nav';

        //console.log(inner_nav_td);
        app.init = function()
        {
            if (_init) {
                return;
            }
            _init = true;

            var closeNavEnd = function(e)
            {
                if (e && e.target === inner_nav_td) {
                    document.removeEventListener(transition_end, closeNavEnd, false);
                }
                nav_open = false;
            };

            app.closeNav =function()
            {
                if (nav_open) {
                    // close navigation after transition or immediately
                    //console.log(inner_nav_td);

                    jQuery('#inner-wrap').css('minHeight', 'auto');
                    var duration = (transition_end && transition_prop) ? parseFloat(window.getComputedStyle(inner_nav_td, '')[transition_prop + 'Duration']) : 0;
                    if (duration > 0) {
                        document.addEventListener(transition_end, closeNavEnd, false);
                    } else {
                        closeNavEnd(null);
                    }
                }
                removeClass(doc, nav_class);
            };

            app.openNav = function()
            {
                if (nav_open) {
                    return;
                }


                //var td_cur_innerwrap_height = jQuery('#inner-wrap').height();

//                if (td_cur_innerwrap_height != td_cur_mobile_nav_height) {
//
//                }
//                alert(td_cur_mobile_nav_height);
                var td_cur_mobile_nav_height = jQuery('.td-menu-animate').height();
                jQuery('#inner-wrap').css('minHeight', td_cur_mobile_nav_height);
                addClass(doc, nav_class);


                /*
                jQuery(this).delay(1000).queue(function(){
                    if (td_detect.is_phone_screen) {
                        jQuery("html, body").animate({ scrollTop: 0 }, {
                                duration: 1000,
                                easing:'easeInOutQuart',
                                complete: function(){
                                    td_is_scrolling_animation = false;
                                }
                            }
                        );
                    }

                    jQuery(this).dequeue();
                });
*/


                nav_open = true;
            };

            app.toggleNav = function(e)
            {

                if (nav_open && hasClass(doc, nav_class)) {
                    app.closeNav();
                } else {
                    app.openNav();
                }
                if (e) {
                    e.preventDefault();
                }
            };

            // open nav with main "nav" button
            //document.getElementById('nav-open-btn').addEventListener('click', app.toggleNav, false);

            jQuery('#td-top-mobile-toggle a, .td-mobile-close a').click(function(){
                app.toggleNav();
            });




            // close nav with main "close" button
            //document.getElementById('nav-close-btn').addEventListener('click', app.toggleNav, false);



            addClass(doc, 'js-ready');

        };

        return app;

    })();

    if (window.addEventListener) {
        window.addEventListener('DOMContentLoaded', window.App.init, false);
    }







}




/*  ----------------------------------------------------------------------------
    Slider callbacks
 */
function slideStartedMoving(args) {
    td_is_slide_moving = true; //used on touch screens + mobile menu 2
}

function slideContentComplete(args) {
    td_is_slide_moving = false;
    if(!args.slideChanged) return false;
    jQuery(args.currentSlideObject).parent().find('.slide-info-wrap').removeClass('slide-wrap-active');
    jQuery(args.currentSlideObject).children('.slide-info-wrap').addClass('slide-wrap-active');
}

function slideContentLoaded(args) {
    if(!args.slideChanged) return false;
   // console.log('loaded');
    jQuery(args.currentSlideObject).parent().find('.slide-info-wrap').removeClass('slide-wrap-active');
    jQuery(args.currentSlideObject).children('.slide-info-wrap').addClass('slide-wrap-active');
}




/*  ----------------------------------------------------------------------------
    Add retina support
 */

function td_retina() {
    if (window.devicePixelRatio > 1) {
        jQuery('.td-retina').each(function(i) {
            var lowres = jQuery(this).attr('src');
            var highres = lowres.replace(".png", "@2x.png");
            highres = highres.replace(".jpg", "@2x.jpg");
            jQuery(this).attr('src', highres);

        });


        //custom logo support
        jQuery('.td-retina-data').each(function(i) {
            jQuery(this).attr('src', jQuery(this).data('retina'));
            //fix logo aligment on retina devices
            jQuery(this).addClass('td-retina-version');
        });

    }
}

/*
jQuery('body').click(function(e){
    if(! jQuery(e.target).hasClass('custom-background')){
        alert('clicked on something that has not the class theDIV');
    }

});*/

//click only on BACKGROUND, for devices that don't have touch (ex: phone, tablets)
if(!td_detect.is_touch_device && td_ad_background_click_link != '') {

    //var ev = ev || window.event;
    //var target = ev.target || ev.srcElement;
    jQuery('body').click(function(event) {

        //getting the target element that the user clicks - for W3C and MSIE
        var target = (event.target) ? event.target : event.srcElement;

        //only if the background has background image
        if(jQuery('body').hasClass('td-boxed-layout')) {
            if(target.id == 'inner-wrap' || target.className == 'td-header-menu-wrap' || target.className == 'td-header-bg' || target.className == 'td-menu-background affix-top') {

                //open the link ad page
                if(td_ad_background_click_target == '_blank') {
                    //open in a new window
                    window.open(td_ad_background_click_link)
                } else {
                    //open in the same window
                    location.href = td_ad_background_click_link;
                }
            }
        }

        //e.stopPropagation();
        //stopBubble(event);
    });
}


function stopBubble(e){
    if(e && e.stopPropagation) {
        e.stopPropagation();
    } else {
        window.event.cancelBubble=true;
    }
}



/**
 * reading cookies
 * @param name
 * @returns {*}
 */
function td_read_site_cookie(name) {
    var nameEQ = escape(name) + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return unescape(c.substring(nameEQ.length, c.length));
    }
    return null;
}


/**
 *
 * @param td_time_cookie_array
 *
 * @param[0]: name of the cookie
 * @param[1]: value of the cookie
 * @param[2]: expiration time
 */
function td_set_cookies_life(td_time_cookie_array) {
    var expiry = new Date();
    expiry.setTime(expiry.getTime() + td_time_cookie_array[2]);

    // Date()'s toGMTSting() method will format the date correctly for a cookie
    document.cookie = td_time_cookie_array[0] + "=" + td_time_cookie_array[1] + "; expires=" + expiry.toGMTString() + "; path=/";
}



//get page width
function td_get_page_width() {
    var x = 0;

    if (self.innerHeight)     {
        x = self.innerWidth;

    } else if (document.documentElement && document.documentElement.clientHeight) {
        x = document.documentElement.clientWidth;

    } else if (document.body) {
        x = document.body.clientWidth;
    }

    return x;
}



//function to resize the height of the slide
function td_resize_slide(args) {
    if(td_get_page_width() < 768) {
        var slide_displayd = args.currentSlideNumber;


        //console.log(args.sliderObject[0]);
        //console.log(args.data.obj[0]);

        var current_slider = jQuery(args.data.obj[0]).attr("id");

        if(td_detect.is_ie8 === false) {
            jQuery("#" + current_slider).css("overflow", "none");
            jQuery("#" + current_slider + " .item").css("overflow", "visible");
        }



        var setHeight = 0;
        setHeight = jQuery("#" + current_slider + "_item_" + slide_displayd).outerHeight(true);


        jQuery("#" + current_slider + ", #" + current_slider + " .slider").css({
            height: setHeight
        });
    }
}


//function to resize the height of the slide with jQuery.each() function
function td_resize_page_sliders() {
    jQuery(document).find('.iosSlider.td_block_big_grid').each(function() {
        var current_slider = jQuery(this).attr("id");

        if(!td_detect.is_ie8) {
            jQuery("#" + current_slider).css("overflow", "none");
            jQuery("#" + current_slider + " .item").css("overflow", "visible");
        }

        var setHeight = 0;
        setHeight = jQuery("#" + current_slider + "_item_1").outerHeight(true);

        jQuery("#" + current_slider + ", #" + current_slider + " .slider").css({
            height: setHeight
        });
    });
}