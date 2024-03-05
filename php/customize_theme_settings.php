<?php
/**
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2024, Aidan Amavi
* @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
*/

function customize_theme_settings( $wp_customize ) {
	$wp_customize->add_panel(
      'theme_panel',
      array(
        'title' => __( 'Theme Settings', 'portfoliotheme' ),
        'priority' => 10,
				'description' => __( 'Choose your theme settings.', 'portfoliotheme' ),
      )
  );
}
add_action( 'customize_register', 'customize_theme_settings' );

 ?>
