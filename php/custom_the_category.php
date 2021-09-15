<?php
/**
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2021, Aidan Amavi
* @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
*/

// Enables the ability to get the category ID from a link for AJAX requests.
function custom_the_category($separator = '', $parents='', $postId = false) {
	$categories = get_the_category($postId); $i = 0;
	if (!empty($categories)) {
		foreach($categories as $cat) {
			if ( $i > 0 ) {
				$thelist .= $separator;
			}
			$thelist .= '<a href="' . esc_url(get_category_link($cat->term_id)) . '" data-link-type="postNavigation" data-view-type="category" data-post-type="'.get_post_type($postId).'" data-category-id="' . $cat->term_id . '" title="View all posts in '. esc_attr($cat->name) . '">' . $cat->cat_name . '</a>';
			$i++;
		}
		echo $thelist;
	}
}

?>
