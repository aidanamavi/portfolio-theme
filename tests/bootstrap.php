<?php
/**
 * PHPUnit bootstrap file for Portfolio Theme
 */

// Set up WordPress testing environment
define('WP_USE_THEMES', false);

// Mock WordPress functions for testing
if (!function_exists('get_template_directory')) {
    function get_template_directory() {
        return __DIR__ . '/..';
    }
}

if (!function_exists('wp_create_nonce')) {
    function wp_create_nonce($action = -1) {
        return substr(md5($action . 'test'), 0, 10);
    }
}

if (!function_exists('get_bloginfo')) {
    function get_bloginfo($show = '') {
        $info = [
            'name' => 'Test Site',
            'template_url' => 'https://example.com/theme',
            'wpurl' => 'https://example.com'
        ];
        return $info[$show] ?? '';
    }
}

if (!function_exists('bloginfo')) {
    function bloginfo($show = '') {
        echo get_bloginfo($show);
    }
}

if (!function_exists('get_theme_mod')) {
    function get_theme_mod($name, $default = false) {
        return $default;
    }
}

if (!function_exists('add_filter')) {
    function add_filter($tag, $function_to_add, $priority = 10, $accepted_args = 1) {
        return true;
    }
}

if (!function_exists('apply_filters')) {
    function apply_filters($tag, $value) {
        return $value;
    }
}

if (!function_exists('get_option')) {
    function get_option($option, $default = false) {
        return $default;
    }
}

if (!function_exists('wp_head')) {
    function wp_head() {
        return '';
    }
}

if (!function_exists('get_stylesheet_directory_uri')) {
    function get_stylesheet_directory_uri() {
        return 'https://example.com/theme';
    }
}

if (!function_exists('add_shortcode')) {
    function add_shortcode($tag, $func) {
        return true;
    }
}

if (!function_exists('add_action')) {
    function add_action($tag, $function_to_add, $priority = 10, $accepted_args = 1) {
        return true;
    }
}

if (!function_exists('register_post_type')) {
    function register_post_type($post_type, $args = array()) {
        return true;
    }
}

if (!function_exists('add_theme_support')) {
    function add_theme_support($feature) {
        return true;
    }
}

if (!function_exists('get_current_user_id')) {
    function get_current_user_id() {
        return 1;
    }
}

if (!function_exists('wp_verify_nonce')) {
    function wp_verify_nonce($nonce, $action = -1) {
        return true;
    }
}

if (!function_exists('wp_die')) {
    function wp_die($message = '', $title = '', $args = array()) {
        exit($message);
    }
}

if (!function_exists('wp_get_current_user')) {
    function wp_get_current_user() {
        global $current_user;
        return $current_user;
    }
}

if (!function_exists('__')) {
    function __($text, $domain = 'default') {
        return $text;
    }
}

if (!function_exists('esc_html')) {
    function esc_html($text) {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('esc_attr')) {
    function esc_attr($text) {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }
}

// Mock $_SERVER for testing
$_SERVER['HTTP_USER_AGENT'] = 'Test Browser';

// Mock global variables
global $current_user;
$current_user = (object) ['ID' => 1];