<?php
/**
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2024, Aidan Amavi
* @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
*/

// Block direct file requests.
if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly.');

// Remove admin bar.
add_filter('show_admin_bar', '__return_false');

// Remove the_generator meta tag.
// add_filter( 'the_generator', create_function('$a', "return null;") );
add_filter('the_generator', '__return_false');

// Add shortcodes.
require_once(get_template_directory().'/php/custom_shortcodes.php');

// Add custom logo.
require_once(get_template_directory().'/php/admin_custom_logo.php');

// Enables the ability to get the category ID from a link for AJAX requests.
require_once(get_template_directory().'/php/custom_the_category.php');

// Add custom meta decription.
require_once(get_template_directory().'/php/custom_meta_description.php');

// Add custom page title.
require_once(get_template_directory().'/php/custom_page_title.php');

// Add custom remove URL protocol.
require_once(get_template_directory().'/php/custom_remove_url_protocol.php');

// Add custom remove protected filter.
require_once(get_template_directory().'/php/custom_remove_protected_filter.php');

// Add custom remove shortlink filter.
require_once(get_template_directory().'/php/custom_remove_shortlink.php');

// Add thumbnail support for Work post type.
require_once(get_template_directory().'/php/custom_thumbnail_support.php');

// Add the work post type.
require_once(get_template_directory().'/php/post-type-work.php');

// Add the blog post type.
require_once(get_template_directory().'/php/post-type-blog.php');

// Show blog post type content on our category and tag pages.
require_once(get_template_directory().'/php/category_query_post_type.php');

// Remove admin menus.
require_once(get_template_directory().'/php/admin_remove_menus.php');

// Add the individual sections, settings, and controls to the theme customizer.
require_once(get_template_directory().'/php/customize_theme_settings.php');
require_once(get_template_directory().'/php/customize_seo_keywords.php');
require_once(get_template_directory().'/php/customize_matomo_tracking.php');
require_once(get_template_directory().'/php/customize_showcase_settings.php');
require_once(get_template_directory().'/php/customize_content_security.php');

// Add AJAX support.
require_once(get_template_directory().'/php/ajax.php');
