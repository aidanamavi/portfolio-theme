<?php
/**
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2021, Aidan Amavi
* @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
*/

add_action('init', 'add_post_type_blog');
function add_post_type_blog() {
	$labels = array(
		'name' => _x('Blog', 'post type general name'),
		'singular_name' => _x('Blog', 'post type singular name'),
		'all_items' => __('All Blog Posts'),
		'add_new' => _x('Add Blog Post', 'Work'),
		'add_new_item' => __('Add New Blog Post'),
		'edit_item' => __('Edit Blog Post'),
		'new_item' => __('New Blog Post'),
		'view_item' => __('View Blog Post'),
		'search_items' => __('Search Blog Posts'),
		'not_found' =>  __('No Blog Posts found'),
		'not_found_in_trash' => __('No Blog Posts found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Blog'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_rest' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => true,
		'menu_position' => 5,
		'map_meta_cap' => true,
		'supports' => array('author','title','thumbnail','editor','page-attributes','excerpt','revisions'),
		'taxonomies' => array('category')
	);
	register_post_type('blog',$args);
}

add_filter( 'enter_title_here', 'add_post_type_blog_title' );
function add_post_type_blog_title( $input ) {
global $post_type;
if ($post_type == 'blog') {
	return __( 'Enter blog post title here', 'portfoliotheme' );
}
return $input;
}

 ?>
