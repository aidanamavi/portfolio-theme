<?php
/**
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2021, Aidan Amavi
* @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
*/

function customize_showcase_settings( $wp_customize ) {
	$wp_customize->add_section(
      'showcase_section',
      array(
        'title' => __( 'Showcase Settings', 'portfoliotheme' ),
        'priority' => 10,
				'description' => __( 'Choose which animation styles you prefer for your Work transitions.', 'portfoliotheme' ),
				'panel' => 'theme_panel',
      )
  );
	$wp_customize->add_setting(
    'showcase_animation_in',
    array(
      'default' => 'animate__fadeIn',
			'transport'   => 'refresh',
    )
	);
	$wp_customize->add_control(
    'showcase_animation_in',
    array(
      'label' => __( 'Animation In', 'portfoliotheme' ),
      'section' => 'showcase_section',
			'description' => __( 'The animation of the incoming content.', 'portfoliotheme' ),
      'type' => 'select',
			'choices'  => array(
				'animate__fadeInLeftBig'  => __( 'Fade In Left Big' ),
				'animate__fadeInUp' => __( 'Fade In Up' ),
				'animate__fadeIn' => __( 'Fade In' ),
			),
    )
	);
	$wp_customize->add_setting(
    'showcase_animation_out',
    array(
      'default' => 'animate__fadeOut',
			'transport'   => 'refresh',
    )
	);
	$wp_customize->add_control(
    'showcase_animation_out',
    array(
			'label' => __( 'Animation Out', 'portfoliotheme' ),
      'section' => 'showcase_section',
			'description' => __( 'The animation of the outgoing content.', 'portfoliotheme' ),
      'type' => 'select',
			'choices'  => array(
				'animate__fadeOutRightBig'  => __( 'Fade Out Right Big' ),
				'animate__fadeOutDown' => __( 'Fade Out Down' ),
				'animate__fadeOut' => __( 'Fade Out' ),
			),
    )
	);
}
add_action( 'customize_register', 'customize_showcase_settings' );

 ?>
