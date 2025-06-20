<?php
/**
 * PHPUnit bootstrap file for Portfolio Theme tests
 *
 * @package WordPress Portfolio Theme
 */

// Composer autoloader
if (file_exists(dirname(__DIR__) . '/vendor/autoload.php')) {
    require_once dirname(__DIR__) . '/vendor/autoload.php';
}

// Load Brain Monkey for WordPress function mocking
if (class_exists('Brain\Monkey\Setup')) {
    \Brain\Monkey\setUp();
}

// Define WordPress constants for testing
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__DIR__) . '/');
}

if (!defined('WP_DEBUG')) {
    define('WP_DEBUG', true);
}

// Mock WordPress functions that are commonly used
if (!function_exists('esc_url')) {
    function esc_url($url) {
        return $url;
    }
}

if (!function_exists('esc_attr')) {
    function esc_attr($text) {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('get_category_link')) {
    function get_category_link($category_id) {
        return 'http://example.com/category/' . $category_id;
    }
}

if (!function_exists('get_post_type')) {
    function get_post_type($post_id = null) {
        return 'post';
    }
}

if (!function_exists('get_the_category')) {
    function get_the_category($post_id = null) {
        return [
            (object) [
                'term_id' => 1,
                'name' => 'Test Category',
                'cat_name' => 'Test Category'
            ]
        ];
    }
}

if (!function_exists('__')) {
    function __($text, $domain = null) {
        return $text;
    }
}