<?php
/**
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2024, Aidan Amavi
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

function matomo_footer( ) {
  $trackerUrl = get_theme_mod('matomo_tracker_url_textbox');
  $trackerId = get_theme_mod('matomo_site_id_textbox');
  if ($trackerUrl && $trackerId) :
  ?><!-- Matomo -->
            <script>
            var _paq = _paq || [];
            _paq.push(['trackPageView']);
            _paq.push(['enableLinkTracking']);
            (function() {
              var u="<?php echo $trackerUrl; ?>";
              _paq.push(['setTrackerUrl', u+'matomo.php']);
              _paq.push(['setSiteId', <?php echo $trackerId; ?>]);
              var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
              g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
            })();
            </script>
            <noscript>
              <p>
                <img src="<?php echo $trackerUrl; ?>matomo.php?idsite=<?php echo $trackerId; ?>&amp;rec=1" style="border:0;" alt="JavaScript required. Please enable." />
              </p>
            </noscript>
            <!-- End Matomo Code --><?php
  endif;
}
add_action( 'wp_footer', 'matomo_footer' );

 ?>
