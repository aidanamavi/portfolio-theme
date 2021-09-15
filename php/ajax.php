<?php
/**
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2021, Aidan Amavi
* @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
*/

/**
 * Must use global $post to use setup_postdata().
 * Must echo the response, and use wp_die function to complete the callback.
 * This is necessary for wp_ajax to complete the return.
 *
 * https://codex.wordpress.org/AJAX_in_Plugins
 */
add_action( 'wp_ajax_getAjaxData', 'getAjaxData' );
add_action( 'wp_ajax_nopriv_getAjaxData', 'getAjaxData' );
// Uses AJAX data object {action: fetch-data $_POST[ 'key' ]: value}
function getAjaxData( ) {


	function validateIntegerInput($input) {
		$input = abs(intval($input));
		filter_var($input, FILTER_SANITIZE_NUMBER_INT);
		if (!is_int($input) && !filter_var($input, FILTER_VALIDATE_INT)) {
			echo 'Invalid page input.';
			exit(0);
			wp_die();
		}
	}


	// TODO: change to update key
	// Validate cross-site request forgery security token.
	if (!check_ajax_referer( 'ajax_fetch_nonce', 'token', false )) {
		header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
		get_template_part( 'templates/index', '403' );
		exit(0);
		wp_die();
	}


	/*
	*
	*	Begin methods
	*
	* Views: category, archive, single
	*/

	// input
	$viewType = 		$_POST[ 'viewType' ];
	$postType = $_POST[ 'postType' ];
	$postId = 	$_POST[ 'postId' ]; // post or category id

	$category=''; $offset='10';

	// Used for infinite scroll
	$offset = $_POST[ 'offsetPosts' ];
	$category = $_POST[ 'category' ];

	if(!empty($viewType) && !empty($postType)){
		$pageContent = "missing view or post type.";
	}

	if($viewType === 'archive'){
		get_template_part( 'templates/index', $postType );

	} elseif ($viewType === 'category') {
		$categoryId = $postId;
		validateIntegerInput($categoryId);
		$args = array(
			'posts_per_page'   => 10,
			'offset'           => '',
			'category'         => $categoryId,
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'include'          => '',
			'exclude'          => '',
			'meta_key'         => '',
			'meta_value'       => '',
			'post_type'        => 'blog',
			'post_mime_type'   => '',
			'post_parent'      => '',
			'post_status'      => 'publish',
			'suppress_filters' => true
		);
		$posts = get_posts( $args );
		?>
		<div id="page_category_<?php echo $categoryId; ?>"  data-page-title="<?php echo strip_tags(esc_attr(get_the_category_by_id($categoryId))); ?>" data-view-type="category" data-post-type="blog">
			<div class="title_wrapper">
				<div class="title">
					<h2>
						category
					</h2>
				</div>
			</div>
			<?php
			global $post;
			foreach($posts as $post) {
				setup_postdata($post); ?>
				<article class="blog_list">
					<h1 class="blog_title"><a href="<?php the_permalink(); ?>" data-link-type="postNavigation" data-view-type="single" data-post-type="blog" data-post-id="<?php the_ID(); ?>"><?php the_title(); ?></a></h1>
					<h4 class="blog_date_categories_tags"><?php the_time('F j, Y'); ?> • <?php custom_the_category(', ',''); ?><?php the_tags(' • '); ?></h4>
				</article><?php
				wp_reset_postdata();
			} ?>
		</div>
		<?php


	} elseif ($viewType === 'single') {
		if(empty($postId)){
			echo "viewType is single, and postId is missing.";
		} else {
			validateIntegerInput($postId);

			if ($postType === 'work') {
				$templateName = 'work_post';
			} elseif ($postType === 'blog') {
				$templateName = 'blog_post';
			} elseif ($postType === 'about') {
				$templateName = 'blog_post';
			}

			global $post;
			$post = get_post($postId);
			setup_postdata($post);
			get_template_part( 'templates/index', $templateName );
			wp_reset_postdata();
		}
	}

	/*
	*
	*						Infinite scroll
	*
	*/
	elseif (isset($offset) && isset($category)) {
		global $post;
		validateIntegerInput($offset);
		validateIntegerInput($category);
		$args = array(
			'posts_per_page'   => 10,
			'offset'           => $offset,
			'category'         => $category,
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'include'          => '',
			'exclude'          => '',
			'meta_key'         => '',
			'meta_value'       => '',
			'post_type'        => $postType,
			'post_mime_type'   => '',
			'post_parent'      => '',
			'post_status'      => 'publish',
			'suppress_filters' => true
		);
		$fetchedPosts = get_posts( $args );
		foreach($fetchedPosts as $post) {
			setup_postdata( $post );
			?>
			<article class="blog_list">
				<h1 class="blog_title"><a href="<?php the_permalink(); ?>" data-link-type="postNavigation" data-view-type="single" data-post-type="<?php echo $postType; ?>" data-post-id="<?php the_ID(); ?>"><?php the_title(); ?></a></h1>
				<h4 class="blog_date_categories_tags"><?php the_time('F j, Y'); ?> • <?php custom_the_category(', ',''); ?><?php the_tags(' • '); ?></h4>
			</article>
			<?php
			wp_reset_postdata();
		}
	}


	/*
	*
	*						404, if not found
	*
	*/
	else {
		get_template_part( 'templates/index', '404' );
	}

	wp_die();

}

?>
