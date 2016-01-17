/**
 * Created by ra on 7/8/14.
 */

jQuery().ready(function() {




    jQuery(window).on("backstretch.after", function (e, instance, index) {
        td_template_single_1();
    });
});


/**
 * make td-post-template-6 title move down and blurry
 */
function td_template_single_1() {
    //run only on a post with template 6 on it
    if(jQuery("#td-full-screen-header-image").length > 0) {


        //define all the variables - for better performance ?
        //var td_parallax_el = document.getElementById('td_parallax_header_6');

        var td_parallax_bg_el = jQuery(".td-backstretch")[0];


        //console.log(td_parallax_bg_el);
        var scroll_from_top = '';
        var distance_from_bottom;

        //attach the animation tick on scroll
        jQuery(window).scroll(function(){
            // with each scroll event request an animation frame (we have a polyfill for animation frame)
            // the requestAnimationFrame is called only once and after that we wait
            td_request_tick();
        });
    }


    var td_animation_running = false; //if the tick is running, we set this to true

    function td_request_tick() {
        if (td_animation_running === false) {
            window.requestAnimationFrame(td_do_animation);
        }
        td_animation_running = true;
    }

    /**
     * the animation loop
     */
    function td_do_animation() {
        scroll_from_top = jQuery(document).scrollTop();
        if (scroll_from_top <= 950) { //stop the animation after scroll from top

            var blur_value = 1 - (scroll_from_top / 800); // @todo trebuie verificata formula??
            if (td_detect.is_ie8 === true) {
                blur_value = 1;
            }


            blur_value = Math.round(blur_value * 100) / 100;

            //opacity
            //td_parallax_el.style.opacity = blur_value;

            //move the bg
            var parallax_move = -Math.round(scroll_from_top / 4);
            td_move_Y(td_parallax_bg_el,-parallax_move);


            //move the title + cat
            distance_from_bottom = -Math.round(scroll_from_top / 8);
            //td_move_Y(td_parallax_el,-distance_from_bottom);
            //td_parallax_el.style.bottom = distance_from_bottom + "px";  //un accelerated version


        }

        td_animation_running = false;
    }


    function td_move_Y (elm, value) {
        var translate = 'translate3d(0px,' + value + 'px, 0px)';
        elm.style['-webkit-transform'] = translate;
        elm.style['-moz-transform'] = translate;
        elm.style['-ms-transform'] = translate;
        elm.style['-o-transform'] = translate;
        elm.style.transform = translate;
    }

}