<?php
/**
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2024, Aidan Amavi
* @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
*/

// Show blog post type content on our category and tag pages.
add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
  if (is_category() || is_tag()) {
    $post_type = get_query_var('post_type');
		if ($post_type) {
		  $post_type = $post_type;
		} else {
		  $post_type = array('blog');
		}
	  $query->set('post_type',$post_type);
		return $query;
	}
}

?>
