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
    'label' => 'Default Source (default-src)',
    'key' => 'default-src',
    'description' => __( 'Default source for all content types not covered by other policies. Use \'self\' for your own domain, or add trusted domains like \'https://example.com\'. Separate multiple sources with spaces.', 'portfoliotheme' ),
  ),
  array(
    'name' => 'frame_src_textbox',
    'label' => 'Frame Source (frame-src)',
    'key' => 'frame-src',
    'description' => __( 'Controls where iframe content can be loaded from. Use \'self\' for your own domain, or add trusted sites like \'https://youtube.com https://vimeo.com\' for embedded videos. Use \'none\' to block all iframes.', 'portfoliotheme' ),
  ),
  array(
    'name' => 'font_src_textbox',
    'label' => 'Font Source (font-src)',
    'key' => 'font-src',
    'description' => __('Controls where web fonts can be loaded from. Use \'self\' for local fonts, or add services like \'https://fonts.googleapis.com https://fonts.gstatic.com\' for Google Fonts. Include \'data:\' if using data URI fonts.', 'portfoliotheme' ),
  ),
  array(
    'name' => 'img_src_textbox',
    'label' => 'Image Source (img-src)',
    'key' => 'img-src',
    'description' => __('Controls where images and favicons can be loaded from. Use \'self\' for your own images, add \'data:\' for inline images, or include CDNs like \'https://cdn.example.com\'. Separate multiple sources with spaces.', 'portfoliotheme' ),
  ),
  array(
    'name' => 'media_src_textbox',
    'label' => 'Media Source (media-src)',
    'key' => 'media-src',
    'description' => __('Controls where audio and video content can be loaded from. Use \'self\' for your own media files, or add trusted sources like \'https://media.example.com\'. Include \'data:\' if using data URI media.', 'portfoliotheme' ),
  ),
  array(
    'name' => 'object_src_textbox',
    'label' => 'Object Source (object-src)',
    'key' => 'object-src',
    'description' => __('Controls where object, embed, and applet elements can be loaded from. Use \'none\' to block all plugins (recommended for security), or add trusted sources if you need Flash or other plugins.', 'portfoliotheme' ),
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
        'title' => 'Security & Content Policy',
        'priority' => 35,
        'panel' => 'theme_panel',
        'description' => __( 'Content Security Policy helps protect your website from malicious attacks by controlling which external resources can be loaded. Only enter trusted domains that your site actually uses. Leave fields empty if you don\'t use that type of resource.', 'portfoliotheme' ),
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