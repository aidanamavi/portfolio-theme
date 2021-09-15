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
				<div id="page_custom" data-page-title="<?php the_title_attribute(); ?>" data-view-type="archive" data-post-type="page">
					<div class="title_wrapper">
						<div class="title">
							<h2>
								<?php the_title_attribute(); ?>
							</h2>
						</div>
					</div>
					<?php
					if ( have_posts() ) :
				    while ( have_posts() ) : the_post();
				        the_content();
				    endwhile;
					else :
					    _e( 'Sorry, no pages matched your criteria.', 'portfolio-theme' );
					endif;
  				?>
				</div>
