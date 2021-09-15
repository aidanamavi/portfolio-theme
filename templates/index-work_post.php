<?php
/**
* The template for displaying individual portfolio content.
*
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2021, Aidan Amavi
* @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
*/
?>
				<div id="page_single_work_<?php the_ID(); ?>" data-page-title="<?php the_title_attribute(); ?>" data-view-type="single" data-post-type="work" data-post-id="<?php the_ID(); ?>">
<?php
					$slideTotal = (int) get_post_meta( get_the_ID(), 'slideTotal', true );
					$numberCount = 1; $slideCount = 1;

					if ($slideTotal > $numberCount) : ?>
					<div class="numbers_wrapper">
						<div class="numbers">
<?php 			while ($numberCount <= $slideTotal) : ?>
							<div data-slide="<?php echo $numberCount; ?>">
								<img src="<?php bloginfo('template_url'); ?>/img/highlight_number_<?php echo $numberCount; ?>@2x.png" class="off" alt="">
								<img src="<?php bloginfo('template_url'); ?>/img/highlight_number_<?php echo $numberCount; ?>_on@2x.png" class="on" alt="">
							</div>
<?php 				++$numberCount;
						endwhile; ?>
						</div>
					</div>
<?php 		endif; ?>
					<div class="highlight_slides">
<?php 		while ($slideCount <= $slideTotal) :
							$slideId = 'slide_'.$slideCount; ?>
						<div class="slide<?php if ($slideCount > 1) : echo ' hide toggleFade'; endif; ?>" data-slide="<?php echo $slideCount; ?>">
<?php					$slideImageUrl = remove_url_protocol(esc_url(get_post_meta( get_the_ID(), 'slide_'.$slideCount.'_url', true )));
							$slideImageTitle = esc_attr(get_post_meta( get_the_ID(), 'slide_'.$slideCount.'_title', true )); ?>
							<img src="<?php echo $slideImageUrl; ?>" class="highlight" alt="<?php echo $slideImageTitle; ?>">
							<div class="highlight_text">
								<div class="title_wrapper">
									<div class="title">
										<h2>
											<?php the_title_attribute(); ?>
										</h2>
									</div>
<?php 						$slideDemoUrl = esc_url(get_post_meta( get_the_ID(), 'slide_'.$slideCount.'_demo_url', true ));
									if ($slideDemoUrl) : ?>
									<div>
										<a href="<?php echo $slideDemoUrl; ?>" class="button">
											click for a demo
										</a>
									</div>
<?php 				endif; ?>
								</div>
<?php
							$description = apply_filters( 'the_content', get_the_content() );
							if ($description) : ?>
								<div class="skills">
									<div class="skills_title">
										<h2>
											description
										</h2>
									</div>
									<div>
<?php
echo '										'.do_shortcode($description).PHP_EOL;
										unset($description); ?>
									</div>
								</div>
<?php 				endif;

							$roles = get_post_meta( get_the_ID(), $slideId.'_roles', true );
							if ($roles) : ?>
								<div class="skills">
									<div class="skills_title">
										<h2>
											roles
										</h2>
									</div>
									<div class="masonry_wrapper">
										<div class="masonry_column">
<?php								foreach ($roles as $role) :
											if (!empty($prevRole) && isSeparateGroup('roles', $prevRole, $role)) : ?>
										</div>
										<div class="masonry_column">
<?php									endif;
echo '											'.displayMetaLabel('roles', $role).'<br />'.PHP_EOL;
											$prevRole = $role;
										endforeach; unset($prevRole); ?>
										</div>
									</div>
								</div>
<?php 				endif;

							$disciplines = get_post_meta( get_the_ID(), $slideId.'_disciplines', true );
							if ($disciplines) : ?>
								<div class="skills">
									<div class="skills_title">
										<h2>
											disciplines
										</h2>
									</div>
									<div class="masonry_wrapper">
										<div class="masonry_column">
<?php							foreach ($disciplines as $discipline) :
											if (!empty($prevDiscipline) && isSeparateGroup('disciplines', $prevDiscipline, $discipline)) : ?>
										</div>
										<div class="masonry_column">
<?php									endif;
echo '											'.displayMetaLabel('disciplines', $discipline).'<br />'.PHP_EOL;
											$prevDiscipline = $discipline;
										endforeach; unset($prevDiscipline); ?>
										</div>
									</div>
								</div>
<?php 				endif;

							$tools = get_post_meta( get_the_ID(), $slideId.'_tools', true );
							if ($tools) : ?>
								<div class="skills">
									<div class="skills_title">
										<h2>
											tools
										</h2>
									</div>
									<div class="masonry_wrapper">
										<div class="masonry_column">
<?php							foreach ($tools as $tool) :
											if (!empty($prevTool) && isSeparateGroup('tools', $prevTool, $tool)) : ?>
										</div>
										<div class="masonry_column">
<?php									endif;
echo '											'.displayMetaLabel('tools', $tool).'<br />'.PHP_EOL;
											$prevTool = $tool;
										endforeach; unset($prevTool); ?>
										</div>
									</div>
								</div>
<?php 			  endif;

							$products = get_post_meta( get_the_ID(), $slideId.'_products', true );
							if ($products) : ?>
								<div class="skills">
									<div class="skills_title">
										<h2>
											products
										</h2>
									</div>
									<div class="masonry_wrapper">
										<div class="masonry_column">
<?php							foreach ($products as $product) :
											if (!empty($prevProduct) && isSeparateGroup('products', $prevProduct, $product)) : ?>
										</div>
										<div class="masonry_column">
<?php									endif;
echo '											'.displayMetaLabel('products', $product).'<br />'.PHP_EOL;
											$prevProduct = $product;
										endforeach; unset($prevProduct); ?>
										</div>
									</div>
								</div>
<?php 				endif;

							$presentations = get_post_meta( get_the_ID(), $slideId.'_presentations', true );
							if ($presentations) : ?>
								<div class="skills">
									<div class="skills_title">
										<h2>
											presentations
										</h2>
									</div>
									<div class="masonry_wrapper">
										<div class="masonry_column">
<?php							foreach ($presentations as $presentation) :
											if (!empty($prevPresentation) && isSeparateGroup('presentations', $prevPresentation, $presentation)) : ?>
										</div>
										<div class="masonry_column">
<?php									endif;
echo '											'.displayMetaLabel('presentations', $presentation).'<br />'.PHP_EOL;
											$prevPresentation = $presentation;
										endforeach; unset($prevPresentation); ?>
										</div>
									</div>
								</div>
<?php 				endif; ?>
							</div>
						</div>
<?php 			++$slideCount;
					endwhile; ?>
					</div>
				</div>
