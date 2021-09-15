/**
 * @package WordPress Portfolio Theme

 * @version 0.5
 *
 * @author Aidan Amavi <mail@aidanamavi.com>
 * @link https://www.aidanamavi.com Author's Web Site
 * @copyright 2012 - 2021, Aidan Amavi
 * @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
 */

jQuery(document).ready( function() {
	jQuery(document).on('click', '.copy_button', function(event) {
    event.preventDefault();
		let buttonId = jQuery(this).attr('id');
		let outputSlideId = buttonId.charAt(6)
		let inputSlideId = outputSlideId - 1;
		let inputs = jQuery('input[name^="slide_'+inputSlideId+'"]')
    inputs.each(function() {
			let input = this;
			let output = new Array();
			isCheckbox = input.name.includes("[]");
			if (isCheckbox) {
				output.name = this.name.replace(inputSlideId, outputSlideId);
				jQuery('input[name="' + output.name + '"][value="' + this.value  + '"]').prop("checked", this.checked);
			}
    });
  });
	jQuery(document).on('click', '.clear_button', function(event) {
    event.preventDefault();
		let buttonId = jQuery(this).attr('id');
		let slideId = buttonId.charAt(6)
		let inputs = jQuery('input[name^="slide_'+slideId+'"]')
    inputs.each(function() {
			let input = this;
			isCheckbox = input.name.includes("[]");
			if (isCheckbox) {
				jQuery(input).prop("checked", false);
			}
    });
  });
});
