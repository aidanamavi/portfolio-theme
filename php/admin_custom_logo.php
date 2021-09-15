<?php
/**
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2021, Aidan Amavi
* @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
*/

// Add custom logo.
function custom_logo() { ?>
	<style type="text/css">
		h1 a { background-image: url(
			<?php get_bloginfo('template_directory'); ?>/img/logo-login.gif
		) !important) }
		</style>
<?php }
add_action('login_head', 'custom_logo');

?>
