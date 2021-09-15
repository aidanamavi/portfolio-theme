<?php
/**
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2021, Aidan Amavi
* @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
*/

function customize_matomo_tracking( $wp_customize ) {
  $wp_customize->add_section(
      'matomo_section',
      array(
        'title' => 'Matomo Settings',
        'priority' => 35,
				'panel' => 'theme_panel',
      )
  );
	$wp_customize->add_setting(
    'matomo_site_id_textbox',
    array(
      'default' => '',
			'transport'   => 'postMessage',
    )
	);
	$wp_customize->add_control(
    'matomo_site_id_textbox',
    array(
      'label' => 'Site ID',
      'section' => 'matomo_section',
      'type' => 'text',
    )
	);
	$wp_customize->add_setting(
    'matomo_tracker_url_textbox',
    array(
      'default' => '',
			'transport'   => 'postMessage',
    )
	);
	$wp_customize->add_control(
    'matomo_tracker_url_textbox',
    array(
      'label' => 'Tracker URL',
      'section' => 'matomo_section',
      'type' => 'text',
    )
	);
}
add_action( 'customize_register', 'customize_matomo_tracking' );

 ?>
