<?php
/**
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2021, Aidan Amavi
* @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
*/

// Add custom page title.
function custom_page_title() {
	$siteDescription = get_bloginfo('description');
	$siteTitle = get_bloginfo('name');
	$pageTitle = get_the_title();
	$viewType;
	$postType = get_post_type();
	$pageSeperator = ' &rsaquo; ';
	$newSiteTitle;

	if ( is_front_page() && is_home() ) {
		$viewType = 'front_page';
	} elseif (is_singular()){
		// ‘is_page || is_attachment || is_single’
		$viewType = 'singular';
	} elseif (is_archive()){
		if (is_category()){
			global $cat;
			$viewType = 'category';
			$pageTitle = get_cat_name($cat);
		} else {
			$viewType = 'archive';
		}
	}

	if($viewType === 'category'){
		$postType = ucwords($postType);
		$viewType = ucwords($viewType);
		$newSiteTitle = $siteTitle.$pageSeperator.$postType.$pageSeperator.$viewType.$pageSeperator.$pageTitle;
	} elseif ($viewType === 'archive') {
		$postType = ucwords($postType);
		$viewType = ucwords($viewType);
		$newSiteTitle = $siteTitle.$pageSeperator.$postType.$pageSeperator.$viewType;
	} elseif ($viewType === 'singular'){
		$postType = ucwords($postType);
		$newSiteTitle = $siteTitle.$pageSeperator.$postType.$pageSeperator.$pageTitle;
		// TODO:  Remove hack when about postType is complete; make resume post with about postType
		if(is_page('about') || is_page('146')){
			$newSiteTitle = $siteTitle.$pageSeperator.'About'.$pageSeperator.$pageTitle;
		}
	} elseif ($viewType === 'front_page'){
		$newSiteTitle = $siteTitle;
	}
	echo $newSiteTitle;
}
// Aidan Amavi >  About > Resume
?>
