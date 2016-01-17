/*  ----------------------------------------------------------------------------
 tagDiv live css compiler ( 2013 )
 - this script is used on our demo site to customize the theme live
 - not used on production sites
 */


var td_style_buffer =
    '<style> /* @theme_color */ .category .entry-content, .tag .entry-content, .td_quote_box { -webkit-transition: border-color 1s ease-in-out; -moz-transition: border-color 1s ease-in-out; -o-transition: border-color 1s ease-in-out; transition: border-color 1s ease-in-out; border-color: @theme_color; } .block-title a, .block-title span, .td-tags a:hover, .td-scroll-up-visible, .td-scroll-up, .sf-menu ul .current-menu-item > a, .sf-menu ul a:hover, .sf-menu ul .sfHover > a, .td-rating-bar-wrap div, .iosSlider .slide-meta-cat, .sf-menu ul .current-menu-ancestor > a, .td-404-sub-sub-title a, .widget_tag_cloud .tagcloud a:hover, .td-mobile-close a, ul.td-category a, .td_social .td_social_type .td_social_button a, .dropcap { -webkit-transition: background-color 1s ease-in-out; -moz-transition: background-color 1s ease-in-out; -o-transition: background-color 1s ease-in-out; transition: background-color 1s ease-in-out; background-color: @theme_color; } .block-title, .sf-menu li a:hover, .sf-menu .sfHover a, .sf-menu .current-menu-ancestor a, .header-search-wrap .dropdown-menu, .sf-menu > .current-menu-item > a, .ui-tabs-nav { -webkit-transition: border-color 1s ease-in-out; -moz-transition: border-color 1s ease-in-out; -o-transition: border-color 1s ease-in-out; transition: border-color 1s ease-in-out; border-color: @theme_color; } .author-box-wrap .td-author-name a, blockquote p, .page-nav a:hover, .widget_pages .current_page_item a, .widget_calendar td a, .widget_categories .current-cat > a, .widget_pages .current_page_parent > a, .td_pull_quote p { -webkit-transition: color 1s ease-in-out; -moz-transition: color 1s ease-in-out; -o-transition: color 1s ease-in-out; transition: color 1s ease-in-out; color: @theme_color; } .page-nav .current { -webkit-transition: background-color 1s ease-in-out; -moz-transition: background-color 1s ease-in-out; -o-transition: background-color 1s ease-in-out; transition: background-color 1s ease-in-out; background-color: @theme_color; border-color: @theme_color; } .wpb_btn-inverse, .ui-tabs-nav .ui-tabs-active a, .post .wpb_btn-danger, .form-submit input, .wpcf7-submit { -webkit-transition: background-color 1s ease-in-out; -moz-transition: background-color 1s ease-in-out; -o-transition: background-color 1s ease-in-out; transition: background-color 1s ease-in-out; background-color: @theme_color !important; } .header-search-wrap .dropdown-menu:before { -webkit-transition: border-color 1s ease-in-out; -moz-transition: border-color 1s ease-in-out; -o-transition: border-color 1s ease-in-out; transition: border-color 1s ease-in-out; border-color: transparent transparent @theme_color; } .td-mobile-content .current-menu-item > a, .td-mobile-content a:hover { -webkit-transition: color 1s ease-in-out; -moz-transition: color 1s ease-in-out; -o-transition: color 1s ease-in-out; transition: color 1s ease-in-out; color: @theme_color !important; } /* @slider_text */ .td-sbig-title-wrap .td-sbig-title, .td-slide-item-sec .td-sbig-title-wrap { -webkit-transition: background-color 1s ease-in-out; -moz-transition: background-color 1s ease-in-out; -o-transition: background-color 1s ease-in-out; transition: background-color 1s ease-in-out; background-color: @slider_text; } /* @select_color */ ::-moz-selection { background: @select_color; color: #fff; } ::selection { background: @select_color; color: #fff; } /* @link_color */ a, .widget_recent_comments .recentcomments .url { -webkit-transition: color 1s ease-in-out; -moz-transition: color 1s ease-in-out; -o-transition: color 1s ease-in-out; transition: color 1s ease-in-out; color: @link_color; } .cur-sub-cat { -webkit-transition: color 1s ease-in-out; -moz-transition: color 1s ease-in-out; -o-transition: color 1s ease-in-out; transition: color 1s ease-in-out; color:@link_color !important; } /* @link_hover_color */ a:hover, .widget_recent_comments .recentcomments .url:hover { -webkit-transition: color 1s ease-in-out; -moz-transition: color 1s ease-in-out; -o-transition: color 1s ease-in-out; transition: color 1s ease-in-out; color: @link_hover_color; } </style>';


var td_bg_boxed_imgs = [
    'http://demo.tagdiv.com/newspaper/bg_images/1.jpg',
    'http://demo.tagdiv.com/newspaper/bg_images/2.jpg',
    'http://demo.tagdiv.com/newspaper/bg_images/3.jpg'
];


var td_current_panel_stat = td_read_cookie('td_show_panel');
if (td_current_panel_stat == 'show' || td_current_panel_stat == null) {
    jQuery('.td-theme-settings-small').addClass('td-theme-settings-no-transition');
    jQuery('.td-theme-settings-small').removeClass('td-theme-settings-small');
}




/*  ----------------------------------------------------------------------------
 On load
 */
jQuery().ready(function() {

    //hide panel
    jQuery("#td-theme-set-hide").click(function(event){
        event.preventDefault();
        event.stopPropagation();
        //hide
        td_create_cookie('td_show_panel', 'hide', 1);
        jQuery('#td-theme-settings').removeClass('td-theme-settings-no-transition');
        jQuery('#td-theme-settings').addClass('td-theme-settings-small');


        jQuery('.td-set-theme-style-link').removeClass('fadeInLeft');


    });


    //show panel
    jQuery("#td-theme-settings").click(function(){
        if (jQuery(this).hasClass('td-theme-settings-small')) {

            jQuery('.td-set-theme-style-link').addClass('animated_xlong fadeInLeft');

            //show full
            td_create_cookie('td_show_panel', 'show', 1);
            jQuery('.td-theme-settings-small').removeClass('td-theme-settings-small');
        }
    });





}); //end on load






/*  ----------------------------------------------------------------------------
    Support functions
 */
//add trim for ie8
if (!String.prototype.trim) {
    String.prototype.trim=function(){return this.replace(/^\s+|\s+$/g, '');};
}


function td_create_cookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    } else var expires = "";
    document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
}

function td_read_cookie(name) {
    var nameEQ = escape(name) + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return unescape(c.substring(nameEQ.length, c.length));
    }
    return null;
}

function td_erase_cookie(name) {
    td_create_cookie(name, "", -1);
}





/*  ----------------------------------------------------------------------------
    live css compiler @tagDiv 2013
 */

//the settings object
function td_customizer_setting () {
    this.name = '';
    this.value = '';
}

//the sections object
function td_customizer_css_section() {
    this.name = '';
    this.raw_css = '';
    this.compiled_css = '';
}

//css parser class
function td_custom_css_parser(raw_css) {
    this.raw_css = raw_css;
    this.settings = [];
    this.css_sections = [];
    this.style_element_id = '';
    this.compiled_css = ''; //compiled css
}

//load the settings
td_custom_css_parser.prototype.load_setting_raw = function(name, value){
    if (this.get_css_section(name) === false) {
        var new_setting = new td_customizer_setting();
        new_setting.name = name;
        new_setting.value = value;
        this.settings.push(new_setting);
    } else {
        this.update_setting_value(name, value);
    }
};

//split the css in sections
td_custom_css_parser.prototype.split_into_sections = function(){
    //remove style wrapping
    this.raw_css = this.raw_css.replace(/<style>/gi,'');
    this.raw_css = this.raw_css.replace(/<\/style>/gi,'');

    this.raw_css = this.raw_css.trim();

    //explode the sections
    var css_splits = this.raw_css.split('/*');

    var containing_class = this;
    jQuery.each(css_splits, function(index, css_split) {
        var css_split_parts = css_split.split('*/');
        if (typeof css_split_parts[0] !== "undefined" && typeof css_split_parts[1] !== "undefined") {
            var new_css_section = new td_customizer_css_section();
            new_css_section.name = css_split_parts[0].trim();
            new_css_section.raw_css = css_split_parts[1].trim();
            containing_class.css_sections.push(new_css_section);
        }
    });
};


//get setting value
td_custom_css_parser.prototype.get_setting_value = function(name){
    var tmpReturn = false;
    jQuery.each(this.settings, function(index, setting) {
        if (setting.name === name) {
            tmpReturn = setting.value;
            return false; //brake jquery each
        }
    });
    return tmpReturn;
};

//get setting value
td_custom_css_parser.prototype.update_setting_value = function(name, value){
    jQuery.each(this.settings, function(index, setting) {
        if (setting.name === name) {
            setting.value = value;
            return false; //brake jquery each
        }
    });
};


//get css section
td_custom_css_parser.prototype.get_css_section = function(name){
    var tmpReturn = false;
    jQuery.each(this.settings, function(index, setting) {
        if (setting.name === name) {
            tmpReturn = setting.value;
            return false; //brake jquery each
        }
    });
    return tmpReturn;
};

//compile each section
td_custom_css_parser.prototype.compile_sections = function(){
    if (typeof this.css_sections !== "undefined" && typeof this.settings !== "undefined") {
        var containing_class = this;
        //console.log('start');

        jQuery.each(this.css_sections, function(index, section) {
            jQuery.each(containing_class.settings, function(index, setting) {
                section.raw_css = str_replace("@" + setting.name, setting.value, section.raw_css);
            });
        });
    }
};

//compile the css
td_custom_css_parser.prototype.compile_css = function(){

    this.split_into_sections();
    this.compile_sections();

    var buffy = '';
    var containing_class = this;

    jQuery.each(this.css_sections, function(index, section) {
        if (section.raw_css !== '' && containing_class.get_setting_value(str_replace("@", '', section.name)) !== false) {
            buffy = buffy + section.raw_css;
        }
    });

    this.compiled_css = buffy;
    //alert(buffy);
};


//inject css
td_custom_css_parser.prototype.inject_css = function(){


    var td_style = document.createElement('style');
    td_style.type = 'text/css';
    td_style.innerHTML = this.compiled_css;
    td_style.setAttribute("id", "td_style_inject");
    if (this.style_element_id === '') {
        //new element


        jQuery('body').append(td_style);
        this.style_element_id = 'td_style_inject';
    } else {
        //update old
        jQuery('#td_style_inject').replaceWith(td_style);
    }
};







/*
var td_custom_css_parser = new td_custom_css_parser(td_style_buffer);
td_custom_css_parser.load_setting_raw('header_color', 'red');
td_custom_css_parser.load_setting_raw('header_line_color', 'blue');


td_custom_css_parser.load_setting_raw('link_color', 'pink');

//td_custom_css_parser.compile_css();
//td_custom_css_parser.inject_css();


td_custom_css_parser.load_setting_raw('header_color', 'white');
td_custom_css_parser.load_setting_raw('header_line_color', 'gray');
*/
//td_custom_css_parser.compile_css();
//td_custom_css_parser.inject_css();



//alert(td_custom_css_parser.get_setting_value('link_color'));


//console.log(td_custom_css_parser.settings);
//console.log(td_custom_css_parser.css_sections);


//td_custom_css_parser.load_setting_raw('test');



var pad = function(num, totalChars) {
    var pad = '0';
    num = num + '';
    while (num.length < totalChars) {
        num = pad + num;
    }
    return num;
};

// Ratio is between 0 and 1
var changeColor = function(color, ratio, darker) {
    // Trim trailing/leading whitespace
    color = color.replace(/^\s*|\s*$/, '');

    // Expand three-digit hex
    color = color.replace(
        /^#?([a-f0-9])([a-f0-9])([a-f0-9])$/i,
        '#$1$1$2$2$3$3'
    );

    // Calculate ratio
    var difference = Math.round(ratio * 256) * (darker ? -1 : 1),
    // Determine if input is RGB(A)
        rgb = color.match(new RegExp('^rgba?\\(\\s*' +
            '(\\d|[1-9]\\d|1\\d{2}|2[0-4][0-9]|25[0-5])' +
            '\\s*,\\s*' +
            '(\\d|[1-9]\\d|1\\d{2}|2[0-4][0-9]|25[0-5])' +
            '\\s*,\\s*' +
            '(\\d|[1-9]\\d|1\\d{2}|2[0-4][0-9]|25[0-5])' +
            '(?:\\s*,\\s*' +
            '(0|1|0?\\.\\d+))?' +
            '\\s*\\)$'
            , 'i')),
        alpha = !!rgb && rgb[4] != null ? rgb[4] : null,

    // Convert hex to decimal
        decimal = !!rgb? [rgb[1], rgb[2], rgb[3]] : color.replace(
            /^#?([a-f0-9][a-f0-9])([a-f0-9][a-f0-9])([a-f0-9][a-f0-9])/i,
            function() {
                return parseInt(arguments[1], 16) + ',' +
                    parseInt(arguments[2], 16) + ',' +
                    parseInt(arguments[3], 16);
            }
        ).split(/,/),
        returnValue;

    // Return RGB(A)
    return !!rgb ?
        'rgb' + (alpha !== null ? 'a' : '') + '(' +
            Math[darker ? 'max' : 'min'](
                parseInt(decimal[0], 10) + difference, darker ? 0 : 255
            ) + ', ' +
            Math[darker ? 'max' : 'min'](
                parseInt(decimal[1], 10) + difference, darker ? 0 : 255
            ) + ', ' +
            Math[darker ? 'max' : 'min'](
                parseInt(decimal[2], 10) + difference, darker ? 0 : 255
            ) +
            (alpha !== null ? ', ' + alpha : '') +
            ')' :
        // Return hex
        [
            '#',
            pad(Math[darker ? 'max' : 'min'](
                parseInt(decimal[0], 10) + difference, darker ? 0 : 255
            ).toString(16), 2),
            pad(Math[darker ? 'max' : 'min'](
                parseInt(decimal[1], 10) + difference, darker ? 0 : 255
            ).toString(16), 2),
            pad(Math[darker ? 'max' : 'min'](
                parseInt(decimal[2], 10) + difference, darker ? 0 : 255
            ).toString(16), 2)
        ].join('');
};
var lighterColor = function(color, ratio) {
    return changeColor(color, ratio, false);
};
var darkerColor = function(color, ratio) {
    return changeColor(color, ratio, true);
};









function td_convert_hex(hex,opacity){
    var hex = hex.replace('#','');
    var r = parseInt(hex.substring(0,2), 16);
    var g = parseInt(hex.substring(2,4), 16);
    var b = parseInt(hex.substring(4,6), 16);

    var result = 'rgba('+r+','+g+','+b+','+opacity/100+')';
    return result;
}

function str_replace (search, replace, subject, count) {
    // http://kevin.vanzonneveld.net
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Gabriel Paderni
    // +   improved by: Philip Peterson
    // +   improved by: Simon Willison (http://simonwillison.net)
    // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +   bugfixed by: Anton Ongson
    // +      input by: Onno Marsman
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +    tweaked by: Onno Marsman
    // +      input by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   input by: Oleg Eremeev
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Oleg Eremeev
    // %          note 1: The count parameter must be passed as a string in order
    // %          note 1:  to find a global variable in which the result will be given
    // *     example 1: str_replace(' ', '.', 'Kevin van Zonneveld');
    // *     returns 1: 'Kevin.van.Zonneveld'
    // *     example 2: str_replace(['{name}', 'l'], ['hello', 'm'], '{name}, lars');
    // *     returns 2: 'hemmo, mars'
    var i = 0,
        j = 0,
        temp = '',
        repl = '',
        sl = 0,
        fl = 0,
        f = [].concat(search),
        r = [].concat(replace),
        s = subject,
        ra = Object.prototype.toString.call(r) === '[object Array]',
        sa = Object.prototype.toString.call(s) === '[object Array]';
    s = [].concat(s);
    if (count) {
        this.window[count] = 0;
    }

    for (i = 0, sl = s.length; i < sl; i++) {
        if (s[i] === '') {
            continue;
        }
        for (j = 0, fl = f.length; j < fl; j++) {
            temp = s[i] + '';
            repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
            s[i] = (temp).split(f[j]).join(repl);
            if (count && s[i] !== temp) {
                this.window[count] += (temp.length - s[i].length) / f[j].length;
            }
        }
    }
    return sa ? s : s[0];
}