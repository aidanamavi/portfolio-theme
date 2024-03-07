<?php
/**
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2024, Aidan Amavi
* @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
*/


## Reference: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/frame-src
## Reference: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy
## Reference: https://developer.mozilla.org/en-US/docs/Web/HTTP/CSP
$content_security_settings = array(
  array(
    'name' => 'default_src_textbox',
    'label' => 'Default Source',
    'key' => 'default-src',
    'description' => __( 'The web site address that this web site uses.', 'portfoliotheme' ),
  ),
  array(
    'name' => 'frame_src_textbox',
    'label' => 'Frame Source',
    'key' => 'frame-src',
    'description' => __( 'Trusted web site addresses you use for iframe elements.', 'portfoliotheme' ),
  ),
  array(
    'name' => 'font_src_textbox',
    'label' => 'Font Source',
    'key' => 'font-src',
    'description' => __('Trusted web site addresses you use for fonts loaded using @font-face.', 'portfoliotheme' ),
  ),
  array(
    'name' => 'img_src_textbox',
    'label' => 'Image Source',
    'key' => 'image-src',
    'description' => __('Trusted web site addresses you use for images and favicons.', 'portfoliotheme' ),
  ),
  array(
    'name' => 'media_src_textbox',
    'label' => 'Media Source',
    'key' => 'media-src',
    'description' => __('Trusted web site addresses you use for audio, video, and track elements.', 'portfoliotheme' ),
  ),
  array(
    'name' => 'object_src_textbox',
    'label' => 'Object Source',
    'key' => 'object-src',
    'description' => __('Trusted web site addresses you use for object, embed, and applet elements.', 'portfoliotheme' ),
  ),
  // array(
  //   'name' => 'unsafe_eval_select',
  //   'label' => 'Unsafe Eval',
  //   'type' => 'checkbox',
  //   'description' => __('Allow use of JavaScript such as eval, setImmediate, and window.execScript.', 'portfoliotheme' ),
  // ),
  // array(
  //   'name' => 'unsafe_inline_select',
  //   'label' => 'Unsafe Inline',
  //   'type' => 'checkbox',
  //   'description' => __('Allow use of HTML inline sources.', 'portfoliotheme' ),
  // ),
);
function customize_content_security( $wp_customize ) {
  global $content_security_settings;
  $settings = $content_security_settings;
  $section['name'] = 'content_security_section';
  $wp_customize->add_section(
      $section['name'],
      array(
        'title' => 'Content Security Settings',
        'priority' => 35,
        'panel' => 'theme_panel',
        'description' => __( 'Improve your web site security with content policies.', 'portfoliotheme' ),
      )
  );
  foreach ($settings as $setting) {
    $wp_customize->add_setting(
      $setting['name'],
      array(
        'default' => '',
        'transport' => 'postMessage',
      )
    );
    $wp_customize->add_control(
      $setting['name'],
      array(
        'label' => $setting['label'],
        'section' => $section['name'],
        'type' => isset($setting['type']) ? $setting['type'] : 'text',
        'description' => $setting['description'],
      )
    );
  }
}
add_action( 'customize_register', 'customize_content_security' );

function content_security_header( ) {
  global $content_security_settings;
  $settings = $content_security_settings;
  $header = '<meta http-equiv="Content-Security-Policy" content="';
  $header_content = '';
  foreach ($settings as $setting) {
    $setting['value'] = get_theme_mod($setting['name']);
    if ($setting['value']) {
      if (!empty($header_content)) $header_content .= ' ';
      $header_content .= $setting['key'] . ' ' . $setting['value'] . ';';
    }
  }
  $header .= $header_content . '">';
  echo $header.PHP_EOL;
}
add_action( 'wp_head', 'content_security_header' );

?>