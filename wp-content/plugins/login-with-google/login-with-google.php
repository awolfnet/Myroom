<?php

/**
 * @package Login with google
 * @version 1.0.0
 */
/*
Plugin Name: Login with google
Plugin URI: http://www.awolf.net/
Description: Login with google
Author: Haiyang Wolf
Version: 1.0.0
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!class_exists("LoginWithGoogle")) {
    define("LOGINWITHGOOGLE_PLUGIN_NAME", "login-with-google"); //Plugin name
    class LoginWithGoogle
    {
        private static $instance = null;

        public static function Instance()
        {
            if (is_null(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function __construct()
        {
            add_shortcode('login-with-google', array($this, 'ShowLoginButton'));
            add_action('wp_head', array($this, 'AddGoogleSiginClientID'));
            add_action('wp_body_open', array($this, 'AddGoogleSiginScript'));
            add_action('wp_enqueue_scripts', array($this, 'EnqueueScripts'));

            /**
             * Ajax
             */
            add_action('wp_ajax_nopriv_loginwithgoogle', array($this, 'Login'));
            add_action('wp_ajax_signoutgoogle', array($this, 'Logout'));
        }

        public static function init()
        {
            return new LoginWithGoogle();
        }

        public function Login()
        {
            check_ajax_referer(LOGINWITHGOOGLE_PLUGIN_NAME);
            $userProfile = $_REQUEST['profile'];

            try {
                if (!isset($userProfile['email'])) {
                    throw new Exception('Email scope is not present');
                }
                $useremail = $userProfile['email'];
                if (!email_exists($useremail)) {
                    //Create user
                    $username = $this->getUserUUID();
                    $password = $userProfile['id'] . $userProfile['expires_at'];
                    $name = $userProfile['name'];
                    $userID = wp_create_user($username, $password, $useremail);
                    if (!is_wp_error($userID)) {
                        $userdata = array(
                            'ID'           => $userID,
                            'role'         => 'subscriber',
                            'nickname'     => $name,
                            'display_name' => $name,
                            'show_admin_bar_front' => 'false',
                        );
                        wp_update_user($userdata);
                    } else {
                        throw new Exception($userID->get_error_message());
                    }
                } else {
                    //Login user
                    $user = get_user_by('email', $useremail);
                    $userID = $user->ID;
                }

                wp_clear_auth_cookie();
                wp_set_current_user($userID);
                wp_set_auth_cookie($userID);

                wp_send_json_success(array('redirect' => get_site_url()));
            } catch (Exception $ex) {
                wp_send_json_error(array('error' => __($ex->getMessage())));
            }
        }

        public function Logout()
        {
            wp_logout();
            wp_send_json_success('success');
        }
        public function ShowLoginButton()
        {
            return '<div class="g-signin2" data-longtitle="true" data-theme="light" data-onsuccess="onSignIn">Login with google</div>';
        }

        public function AddGoogleSiginClientID()
        {
            echo '<meta name="google-signin-client_id" content="189957353808-mi89141ejtjc6rj3ib2idfsgpvgjl3gh.apps.googleusercontent.com">';
            echo '<script src="https://apis.google.com/js/platform.js" async defer></script>';
            echo '<style type="text/css">.g-signin2{width: 100%;}.g-signin2>div{margin: 0 auto;}</style>';
        }

        public function AddGoogleSiginScript()
        {
?>
            <script type="text/javascript">
                function onSignIn(googleUser) {
                    var googleuserProfile = googleUser.getBasicProfile();
                    var authResponse = googleUser.getAuthResponse();

                    var user = {
                        id: googleuserProfile.getId(),
                        name: googleuserProfile.getName(),
                        avatar: googleuserProfile.getImageUrl(),
                        email: googleuserProfile.getEmail(),
                        token: authResponse.id_token,
                        expires_at: authResponse.expires_at,
                        expires_in: authResponse.expires_in,
                        first_issued_at: authResponse.first_issued_at,
                        id_token: authResponse.id_token,
                        idpId: authResponse.idpId,
                        login_hint: authResponse.login_hint,
                        token_type: authResponse.token_type
                    };

                    login(user);

                    console.log('ID: ' + googleuserProfile.getId()); // Do not send to your backend! Use an ID token instead.
                    console.log('Name: ' + googleuserProfile.getName());
                    console.log('Image URL: ' + googleuserProfile.getImageUrl());
                    console.log('Email: ' + googleuserProfile.getEmail()); // This is null if the 'email' scope is not present.
                    console.log('Token: ' + authResponse.id_token);
                }

                function signOut() {
                    var auth2 = gapi.auth2.getAuthInstance();
                    auth2.signOut().then(function() {
                        logout();
                        console.log('User signed out.');
                    });
                }

                function login(userProfile) {
                    jQuery.ajax({
                        type: "post",
                        cache: false,
                        dataType: "json",
                        url: loginwithgoogle.login,
                        data: {
                            action: "loginwithgoogle",
                            _ajax_nonce: loginwithgoogle.ajax_nonce,
                            profile: userProfile
                        },
                        success: function(response) {
                            console.log(response)
                            window.location.replace(response.data.redirect);
                        },
                        error: function(errorThrown) {
                            console.log(errorThrown)
                        }
                    }).always(function() {

                    });
                }

                function logout() {
                    jQuery.ajax({
                        type: "post",
                        cache: false,
                        dataType: "json",
                        url: loginwithgoogle.login,
                        data: {
                            action: "signoutgoogle",
                            _ajax_nonce: loginwithgoogle.ajax_nonce,
                        },
                        success: function(response) {
                            console.log(response)
                        },
                        error: function(errorThrown) {
                            console.log(errorThrown)
                        }
                    }).always(function() {

                    });
                }
            </script>
<?php
        }

        public function EnqueueScripts()
        {
            wp_register_script(LOGINWITHGOOGLE_PLUGIN_NAME, false, array('jquery'));
            wp_localize_script(LOGINWITHGOOGLE_PLUGIN_NAME, 'loginwithgoogle', array(
                'login' => admin_url('admin-ajax.php'),
                'ajax_nonce' => wp_create_nonce(LOGINWITHGOOGLE_PLUGIN_NAME)
            ));
            wp_enqueue_script(LOGINWITHGOOGLE_PLUGIN_NAME);
        }

        private function getUserUUID()
        {
            return str_replace('-', '', wp_generate_uuid4());
        }
    }

    add_action('plugins_loaded', array('LoginWithGoogle', 'Instance'), 15);
}
