<?php

/**
 * @package SSLForwarded
 * @version 1.7.2
 */
/*
Plugin Name: SSLForwarded
Plugin URI: http://www.awolf.net/
Description: Getting Wordpress to work with SSL behind a reverse proxy
Author: Haiyang Wolf
Version: 1.0.0
*/


if (!function_exists('SSLForwarded')) {
    function SSLForwarded()
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && 'https' === $_SERVER['HTTP_X_FORWARDED_PROTO']) {
            $_SERVER['HTTPS'] = 'on';
        }
    }
}
