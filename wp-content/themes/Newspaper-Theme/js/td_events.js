/**
 * td_events.js - handles the events that requiere throttling
 * Created by ra on 6/27/14.
 * v1.1
 */

var td_events = {

    //the events - we have timers that look at the variables and fire the event if the flag is true
    scroll_event_slow_run: false,
    resize_event_run: false, //when true, fire up the resize event



    scroll_window_scrollTop: 0, //used to store the scrollTop

    init: function init() {

        jQuery(window).scroll(function() {
            td_events.scroll_event_slow_run = true;


            //read the scroll top
            td_events.scroll_window_scrollTop = jQuery(window).scrollTop();

            /*  ----------------------------------------------------------------------------
                Run affix menu event
             */
            td_affix.td_events_scroll(td_events.scroll_window_scrollTop); //main menu
        });


        jQuery(window).resize(function() {
            td_events.resize_event_run = true;
        });



        //low resolution timer for rest?
        setInterval(function() {
            //scroll event
            if (td_events.scroll_event_slow_run) {
                td_events.scroll_event_slow_run = false;

                //back to top
                td_events_scroll_scroll_to_top(td_events.scroll_window_scrollTop);

                //more articles box
                td_more_articles_box.td_events_scroll(td_events.scroll_window_scrollTop);

            }

            //resize event
            if (td_events.resize_event_run) {
                td_events.resize_event_run = false;
                td_affix.compute_top();
                td_detect.run_is_phone_screen();
            }
        }, 500);

    }



}

td_events.init();