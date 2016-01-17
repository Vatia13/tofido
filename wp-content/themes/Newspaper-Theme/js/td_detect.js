"use strict";

/*  ----------------------------------------------------------------------------
    td_detect - browser detection object (instance)
    v1.1
 */

var td_detect = new function () {

    //constructor
    this.is_ie8 = false;
    this.is_ie9 = false;
    this.is_ie10 = false;
    this.is_ie11 = false;
    this.is_ie = false;
    this.is_safary = false;
    this.is_chrome = false;
    this.is_ipad = false;

    this.is_touch_device = false;

    this.has_history = false;

    this.is_phone_screen = false;

    this.is_ios = false;

    // is touch device ?
    this.is_touch_device = !!('ontouchstart' in window);

    this.is_mobile_device = false;

    // detect ie8
    if (jQuery('html').is('.ie8')) {
        this.is_ie8 = true;
        this.is_ie = true;
    }



    // detect ie9
    if (jQuery('html').is('.ie9')) {
        this.is_ie9 = true;
        this.is_ie = true;
    }

    // detect ie10 - also adds the ie10 class //it also detects windows mobile IE as IE10
    if(navigator.userAgent.indexOf("MSIE 10.0") > -1){
        jQuery("html").addClass("ie10");
        this.is_ie10 = true;
        this.is_ie = true;
        //alert('10');
    }

    //ie 11 check - also adds the ie11 class - it may detect ie on windows mobile
    if(!!navigator.userAgent.match(/Trident.*rv\:11\./)){
        jQuery("html").addClass("ie11");
        this.is_ie11 = true;
        //this.is_ie = true; //do not flag ie11 as is_ie
        //alert('11');
    }


    //do we have html5 history support?
    if (window.history && window.history.pushState) {
        this.has_history = true;
    }

    //check for safary
    if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
        this.is_safary = true;
    }

    //chrome and chrome-ium check
    this.is_chrome = /chrom(e|ium)/.test(navigator.userAgent.toLowerCase());

    this.is_ipad = navigator.userAgent.match(/iPad/i) != null;



    this.is_ios = /(iPad|iPhone|iPod)/g.test( navigator.userAgent );


    //detect if we run on a mobile device - ipad included - used by the modal / scroll to @see scroll_into_view
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        this.is_mobile_device = true;
    }

    /**
     * function to check the phone screen
     * @see td_events
     * The jQuery windows width is not reliable cross browser!
     */
    this.run_is_phone_screen = function () {
        if ((jQuery(window).width() < 768 || jQuery(window).height() < 768) && this.is_ipad === false) {
            this.is_phone_screen = true;

        } else {
            this.is_phone_screen = false;
        }

        //console.log(this.is_phone_screen + ' ' + jQuery(window).width() + ' ' + jQuery(window).height());
    }



    this.run_is_phone_screen();



};


