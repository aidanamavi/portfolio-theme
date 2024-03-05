<?php
/**
* The template for displaying blog category content.
*
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2024, Aidan Amavi
* @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
*/
?>
				<div id="page_category_<?php echo $cat; ?>" data-page-title="<?php strip_tags(esc_attr(single_cat_title())); ?>" data-view-type="category" data-post-type="blog" data-category-id="<?php echo $cat; ?>">
					<div class="title_wrapper">
						<div class="title">
							<h2>
								category
							</h2>
						</div>
					</div>
<?php 		if (have_posts()): while (have_posts()): the_post(); ?>
					<article class="blog_list">
						<h1 class="blog_title"><a href="<?php the_permalink(); ?>" data-link-type="postNavigation" data-view-type="single" data-post-type="blog" data-post-id="<?php the_ID(); ?>"><?php the_title(); ?></a></h1>
						<h4 class="blog_date_categories_tags"><?php the_time('F j, Y'); ?> • <?php custom_the_category(', ',''); ?><?php the_tags(' • '); ?></h4>
					</article>
<?php 		endwhile; endif; ?>
				</div>
