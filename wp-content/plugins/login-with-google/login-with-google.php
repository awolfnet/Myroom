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

class LoginWithGoogle
{
    function Login()
    {
        return "google-button";
    }
}

add_shortcode('login-with-google', array('LoginWithGoogle', 'Login'));
