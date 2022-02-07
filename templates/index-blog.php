<?php
/**
* The template for displaying all blog post content.
*
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2021, Aidan Amavi
* @license https://creativecommons.org/licenses/by-sa/4.0/ Attribution-ShareAlike 4.0 International
*/
?>
				<div id="page_archive_blog" data-page-title="Blog" data-view-type="archive" data-post-type="blog">
					<div class="title_wrapper">
						<div class="title">
							<h2>
								categories
							</h2>
						</div>
					</div>
					<ul>
    		<?php
				wp_list_categories( array(
	        'orderby'    => 'name',
	        'show_count' => true,
	        // 'exclude'    => array( 10 ),
					'title_li' => ''
    		));
				?>
					</ul>
					<div class="title_wrapper">
						<div class="title">
							<h2>
								archive
							</h2>
						</div>
					</div>
<?php
					$args = array(
						'posts_per_page'   => 15,
						'offset'           => 0,
						'category'         => '',
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
						'suppress_filters' => true );
					$myposts = get_posts( $args );
					foreach($myposts as $post) : setup_postdata($post);
					?>
					<article class="blog_list">
						<h1 class="blog_title"><a href="<?php the_permalink(); ?>" data-link-type="postNavigation" data-view-type="single" data-post-type="blog" data-post-id="<?php the_ID(); ?>"><?php the_title(); ?></a></h1>
						<h4 class="blog_date_categories_tags"><?php echo get_the_date(); ?> • <?php custom_the_category(', '); ?><?php the_tags(' • '); ?></h4>
					</article>
<?php
					endforeach; wp_reset_postdata(); ?>
				</div>
