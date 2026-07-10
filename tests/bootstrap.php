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

// Load Brain Monkey for WordPress function mocking FIRST
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

// Mock essential WordPress functions that might be called during file inclusion
\Brain\Monkey\Functions\when('add_action')->justReturn(true);
\Brain\Monkey\Functions\when('wp_die')->justReturn(true);
\Brain\Monkey\Functions\when('check_ajax_referer')->justReturn(true);
\Brain\Monkey\Functions\when('get_template_part')->justReturn(true);
\Brain\Monkey\Functions\when('esc_url')->returnArg();
\Brain\Monkey\Functions\when('esc_attr')->returnArg();
\Brain\Monkey\Functions\when('get_category_link')->alias(function($id) {
    return "http://example.com/category/{$id}";
});
\Brain\Monkey\Functions\when('get_post_type')->justReturn('post');
\Brain\Monkey\Functions\when('get_the_category')->justReturn([]);

// Don't auto-load theme files in bootstrap - let individual tests load what they need