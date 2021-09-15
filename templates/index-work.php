<?php
/**
* The template for displaying all portfolio content.
*
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2021, Aidan Amavi
* @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
*/
?>
				<div id="page_archive_work" data-page-title="Work" data-view-type="archive" data-post-type="work">
					<nav>
						<a href="#" class="underline" data-project-type="all" data-link-type="workNavigation">All</a>
						<a href="#" class="underline" data-project-type="web" data-link-type="workNavigation">Web</a>
						<a href="#" class="underline" data-project-type="video" data-link-type="workNavigation">Video</a>
						<a href="#" class="underline" data-project-type="photo" data-link-type="workNavigation">Photo</a>
						<a href="#" class="underline" data-project-type="graphic" data-link-type="workNavigation">Graphic</a>
						<a href="#" class="underline" data-project-type="sound" data-link-type="workNavigation">Sound</a>
					</nav>
					<div class="row">
<?php
					$args = array(
						'posts_per_page'   => 35,
						'offset'           => 0,
						'category'         => '',
						'orderby'          => 'post_date',
						'order'            => 'DESC',
						'include'          => '',
						'exclude'          => '',
						'meta_key'         => '',
						'meta_value'       => '',
						'post_type'        => 'work',
						'post_mime_type'   => '',
						'post_parent'      => '',
						'post_status'      => 'publish',
						'suppress_filters' => true );
					$myposts = get_posts( $args );
					foreach($myposts as $post) : setup_postdata($post);
						$keywords = get_post_meta( get_the_ID(), 'shortcut_keywords', true );
						if ($keywords) :
							foreach ($keywords as $keyword) :
								if (!empty($keywordList)) : $keywordList.= ' '; endif;
								$keywordList .= $keyword;
							endforeach;
						endif;
					?>
						<div class="column" data-project-type="<?php echo $keywordList; ?>">
							<a href="<?php the_permalink(); ?>" data-link-type="postNavigation" data-view-type="single" data-post-type="work" data-post-id="<?php the_ID(); ?>">
								<?php the_post_thumbnail(); echo PHP_EOL; ?>
							</a>
						</div>
<?php
					unset($keywordList);
					endforeach; wp_reset_postdata(); ?>
					</div>
				</div>
