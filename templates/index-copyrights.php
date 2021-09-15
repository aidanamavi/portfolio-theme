<?php
/**
* The template for displaying about page content.
*
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2021, Aidan Amavi
* @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
*/
?>
				<div id="page_info_copyright" data-page-title="copyrights">
					<div class="highlight_slides">
						<div class="slide" data-slide="1">
							<img src="https://aidanamavi.com/wp-content/uploads/2020/05/highlight_about_1.jpg" class="highlight" alt="">
							<div class="highlight_text">
								<div class="title_wrapper">
									<div class="title">
										<h2>
											Third Party Copyrights & Trademarks
										</h2>
									</div>
								</div>
								<p>
									All the following trademarks are the properties of their respective owners as listed below. Should any trademark attribution be missing, mistaken or erroneous, please contact us as soon as possible for rectification.
								</p>
								<?php global $post; setup_postdata($post); the_content(); wp_reset_postdata(); ?>
							</div>
						</div>
					</div>
				</div>
