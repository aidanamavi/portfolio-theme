<?php
/**
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2021, Aidan Amavi
* @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
*/

function customize_content_security( $wp_customize ) {
  $siteURL = site_url();
  $wp_customize->add_section(
      'content_security_section',
      array(
        'title' => 'Content Security Settings',
        'priority' => 35,
				'panel' => 'theme_panel',
        'description' => __( 'Improve your web site security with content policies.', 'portfoliotheme' ),
      )
  );
	$wp_customize->add_setting(
    'default_src_textbox',
    array(
      'default' => site_url(),
			'transport'   => 'postMessage',
    )
	);
	$wp_customize->add_control(
    'default_src_textbox',
    array(
      'label' => 'Default Source',
      'section' => 'content_security_section',
      'type' => 'text',
      'description' => __( 'The web site address that this web site uses.', 'portfoliotheme' ),
    )
	);
  $wp_customize->add_setting(
    'frame_src_textbox',
    array(
      'default' => '',
			'transport'   => 'postMessage',
    )
	);
	$wp_customize->add_control(
    'frame_src_textbox',
    array(
      'label' => 'Frame Source',
      'section' => 'content_security_section',
      'type' => 'text',
      'description' => __( 'Trusted web site addresses you use for iframe elements.', 'portfoliotheme' ),
    )
	);
  $wp_customize->add_setting(
    'media_src_textbox',
    array(
      'default' => '',
			'transport'   => 'postMessage',
    )
	);
	$wp_customize->add_control(
    'media_src_textbox',
    array(
      'label' => 'Media Source',
      'section' => 'content_security_section',
      'type' => 'text',
      'description' => __('Trusted web site addresses you use for audio, video, and track elements.', 'portfoliotheme' ),
    )
	);
  $wp_customize->add_setting(
    'object_src_textbox',
    array(
      'default' => '\'none\'',
			'transport'   => 'postMessage',
    )
	);
	$wp_customize->add_control(
    'object_src_textbox',
    array(
      'label' => 'Object Source',
      'section' => 'content_security_section',
      'type' => 'text',
      'description' => __('Trusted web site addresses you use for object, embed, and applet elements.', 'portfoliotheme' ),
    )
	);
  $wp_customize->add_setting(
    'unsafe_eval_select',
    array(
      'default' => '',
			'transport'   => 'postMessage',
    )
	);
	$wp_customize->add_control(
    'unsafe_eval_select',
    array(
      'label' => 'Unsafe Eval',
      'section' => 'content_security_section',
      'type' => 'checkbox',
      'description' => __('Allow use of JavaScript such as eval, setImmediate , and window.execScript.', 'portfoliotheme' ),
    )
	);
  $wp_customize->add_setting(
    'unsafe_inline_select',
    array(
      'default' => '',
			'transport'   => 'postMessage',
    )
	);
	$wp_customize->add_control(
    'unsafe_inline_select',
    array(
      'label' => 'Unsafe Inline',
      'section' => 'content_security_section',
      'type' => 'checkbox',
      'description' => __('Allow use of HTML inline sources.', 'portfoliotheme' ),
    )
	);
}
add_action( 'customize_register', 'customize_content_security' );

function content_security_header( ) {
  $default_src_textbox = get_theme_mod('default_src_textbox');
  $frame_src_textbox = get_theme_mod('frame_src_textbox');
  $media_src_textbox = get_theme_mod('media_src_textbox');
  $object_src_textbox = get_theme_mod('object_src_textbox');
  $unsafe_eval_select = get_theme_mod('unsafe_eval_select');
  $unsafe_inline_select = get_theme_mod('unsafe_inline_select');
  if ($frame_src_textbox) { $frame_src_textbox = "; frame-src ".$frame_src_textbox; } else {
    $frame_src_textbox = '';
  }
  if ($media_src_textbox) { $media_src_textbox = "; media-src ".$media_src_textbox; } else {
    $media_src_textbox = '';
  }
  if ($object_src_textbox) { $object_src_textbox = "; object-src ".$object_src_textbox; } else {
    $object_src_textbox = '';
  }
  if ($unsafe_eval_select) { $unsafe_eval_select = " 'unsafe-eval'"; } else {
    $unsafe_eval_select = '';
  }
  if ($unsafe_inline_select) { $unsafe_inline_select = " 'unsafe-inline'"; } else {
    $unsafe_inline_select = '';
  }
  ?>
  <meta http-equiv="Content-Security-Policy" content="default-src <?php echo $default_src_textbox; echo $unsafe_eval_select; echo $unsafe_inline_select; echo $frame_src_textbox; echo $media_src_textbox; echo $object_src_textbox; ?>">
  <?php
}
add_action( 'wp_head', 'content_security_header' );

 ?>
