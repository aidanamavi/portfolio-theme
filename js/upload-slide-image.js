/**
 * @package WordPress Portfolio Theme

 * @version 0.5
 *
 * @author Aidan Amavi <mail@aidanamavi.com>
 * @link https://www.aidanamavi.com Author's Web Site
 * @copyright 2012 - 2024, Aidan Amavi
 * @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
 */

jQuery(document).ready( function() {
	let custom_uploader;
	let input;
  jQuery(document).on('click', '.upload_button', function(event) {
    event.preventDefault();
		let button = jQuery(this);
		input = button.prev('input').attr('id');
		if (custom_uploader) {
      custom_uploader.open();
      return;
    }
    custom_uploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose Image',
      button: {
        text: 'Choose Image'
      },
      multiple: false
    });
    custom_uploader.on('select', function() {
      let attachment = custom_uploader.state().get('selection').first().toJSON
      jQuery('#'+input).val(attachment.url);
			let slideId = input.substr(0, 7);
			let elementId = slideId + '_title';
			jQuery('#' + elementId).val(attachment.title);
    });
    custom_uploader.open();
  });
});
