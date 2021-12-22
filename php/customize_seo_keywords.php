<?php
/**
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2021, Aidan Amavi
* @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
*/

function customize_seo_keywords( $wp_customize ) {
  $wp_customize->add_section(
      'seo_section',
      array(
        'title' => __('SEO Keywords', 'portfoliotheme' ),
        'priority' => 35,
				'panel' => 'theme_panel',
      )
  );
	$wp_customize->add_setting(
    'seo_keywords_textbox',
    array(
      'default' => 'portfolio, resume, blog',
			'transport'   => 'postMessage',
    )
	);
	$wp_customize->add_control(
    'seo_keywords_textbox',
    array(
      'label' => __('Keywords', 'portfoliotheme' ),
      'section' => 'seo_section',
      'type' => 'text',
    )
	);
}
add_action( 'customize_register', 'customize_seo_keywords' );

?>
