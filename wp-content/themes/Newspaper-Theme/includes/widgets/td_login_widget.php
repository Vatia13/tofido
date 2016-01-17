<?php
class td_login_widget extends WP_Widget {

    var $td_widget_builder;

    function __construct() {

        $this->td_widget_builder = new td_widget_builder($this);
        $this->td_widget_builder->td_map(
            array(
                "name" => __("Login Form", TD_THEME_NAME),
                "base" => "login_form",
                "class" => "",
                "controls" => "full",
                "category" => __('Content', TD_THEME_NAME),
                "params" => array()
            )
        );

    }

    function form($instance) {
        $this->td_widget_builder->form($instance);
    }

    function update($new_instance, $old_instance) {
        return $this->td_widget_builder->update($new_instance, $old_instance);
    }

    function widget($args, $instance) {
        $td_data_log_in = '';

        //test if user is logd in or not
        if ( is_user_logged_in() ) {
            //get current logd in user data
            global $current_user;

            echo '<ul class="top-header-menu td_ul_logout">
                    <li class="menu-item">
                        <a href="#" class="td_user_logd_in">' . $current_user->display_name . '</a>
                    </li>

                    <li class="menu-item">
                        <span class="td-sp td-sp-ico-logout"></span>
                        <a href="' . wp_logout_url(home_url()) . '">' . __td("Logout") . '</a>' .
                        get_avatar($current_user->ID, 20) .
                    '</li>
                  </ul>';
        } else {
            //check if admin allow registration
            $users_can_register = get_option('users_can_register');

            //if admin permits registration
            $users_can_register_tab = $users_can_register_form = '';
            if($users_can_register == 1){
                $users_can_register_tab = '<li><a id="register-link">' . __td("REGISTER") . '</a></li>';

                $users_can_register_form = '
                    <div id="td-register-div" class="td-dispaly-none">
                        <div class="td-login-panel-title">' . __td("Register for an account") .'</div>
                        <input class="td-login-input" type="text" name="register_email" id="register_email" placeholder="' . __td("your email") .'" value="" required>
                        <input class="td-login-input" type="text" name="register_user" id="register_user" placeholder="' . __td("your username") .'" value="" required>
                        <input type="button" name="register_button" id="register_button" class="wpb_button btn td-login-button" value="' . __td("Register") . '">
                         <div class="td-login-info-text">' . __td("A password will be e-mailed to you.") . '</div>
                    </div>';
            }

            echo '
            <ul class="top-header-menu td_ul_login"><li class="menu-item"><a class="td-login-modal-js menu-item" href="#login-form" data-effect="mpf-td-login-effect">' . __td("Log In") . '</a><span class="td-sp td-sp-ico-login td_sp_login_ico_style"></span></li></ul>
            <div  id="login-form" class="white-popup-block mfp-hide mfp-with-anim">
                <ul class="td-login-tabs">
                    <li><a id="login-link" class="td_login_tab_focus">' . __td("LOG IN") . '</a></li>' . $users_can_register_tab . '
                </ul>



                <div class="td-login-wrap">
                    <div class="td_display_err"></div>

                    <div id="td-login-div" class="">
                        <div class="td-login-panel-title">' . __td("Welcome! Login in to your account") .'</div>
                        <input class="td-login-input" type="text" name="login_email" id="login_email" placeholder="' . __td("your username") .'" value="" required>
                        <input class="td-login-input" type="password" name="login_pass" id="login_pass" value="" placeholder="' . __td("your password") .'" required>
                        <input type="button" name="login_button" id="login_button" class="wpb_button btn td-login-button" value="' . __td("Log In") . '">


                        <div class="td-login-info-text"><a href="#" id="forgot-pass-link">' . __td("Forgot your password?") . '</a></div>


                    </div>

                    ' . $users_can_register_form . '

                     <div id="td-forgot-pass-div" class="td-dispaly-none">
                        <div class="td-login-panel-title">' . __td("Recover your password") .'</div>
                        <input class="td-login-input" type="text" name="forgot_email" id="forgot_email" placeholder="' . __td("your email") .'" value="" required>
                        <input type="button" name="forgot_button" id="forgot_button" class="wpb_button btn td-login-button" value="' . __td("Send My Pass") . '">
                    </div>




                </div>
            </div>
            ';
        }
    }
}

add_action('widgets_init', create_function('', 'return register_widget("td_login_widget");'));
