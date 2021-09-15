<?php
/**
* @package WordPress Portfolio Theme
* @version 0.5
* @author Aidan Amavi <mail@aidanamavi.com>
* @link https://www.aidanamavi.com Author's Web Site
* @copyright 2012 - 2021, Aidan Amavi
* @license https://www.gnu.org/licenses/agpl.html GNU Affero General Public License
*/

add_action('init', 'add_post_type_work');
function add_post_type_work() {
	$labels = array(
		'name' => _x('Work', 'post type general name'),
		'singular_name' => _x('Work', 'post type singular name'),
		'all_items' => __('All Work'),
		'add_new' => _x('Add Work', 'Work'),
		'add_new_item' => __('Add New Work'),
		'edit_item' => __('Edit Work'),
		'new_item' => __('New Work'),
		'view_item' => __('View Work'),
		'search_items' => __('Search Work'),
		'not_found' =>  __('No Work found'),
		'not_found_in_trash' => __('No Work found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Work'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_rest' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => true,
		'menu_position' => 5,
		'map_meta_cap' => true,
		'supports' => array('author','title','thumbnail','excerpt','editor')
	);
	register_post_type('work',$args);
}

add_filter( 'enter_title_here', 'add_post_type_work_title' );
function add_post_type_work_title( $input ) {
	global $post_type;
	if ($post_type == 'work') {
		return __( 'Enter work title here', 'portfoliotheme' );
	}
	return $input;
}

$roleGroups = array(
	array(										# entertainment and sports
		'creativeProducer'			=> __('Creative Producer', 'portfoliotheme'),
		'creativeDirector'			=> __('Creative Director', 'portfoliotheme'),
		'assistantDirector'			=> __('Assistant Director', 'portfoliotheme'),
		'programDirector'				=> __('Program Director', 'portfoliotheme'),
	),
	array(										# arts and design
		'artDirector'						=> __('Art Director', 'portfoliotheme'),
		'graphicDesigner'				=> __('Graphic Designer', 'portfoliotheme'),
		'multimediaAnimator'		=> __('Multimedia Animator', 'portfoliotheme'),
	),
	array(										# computer and information technology: coding
		'computerProgramer'			=> __('Computer Programmer', 'portfoliotheme'),
		'softwareDeveloper'			=> __('Software Developer', 'portfoliotheme'),
		'webDeveloper'					=> __('Web Developer', 'portfoliotheme'),
	),
	array(										# computer and information technology: admin
		'databaseAdministrator'	=> __('Database Administrator', 'portfoliotheme'),
		'networkAdministrator'	=> __('Network Administrator', 'portfoliotheme'),
		'systemsAdministrator'	=> __('Systems Administrator', 'portfoliotheme'),
	),
	array(										# computer and information technology: analysts
		'systemsAnalyst'				=> __('Systems Analyst', 'portfoliotheme'),
		'securityAnalyst'				=> __('Security Analyst', 'portfoliotheme'),
	),
	array(										# computer and information technology: network
		'networkArchitect'			=> __('Network Architect', 'portfoliotheme'),
		'supportSpecialist'			=> __('Support Specialist', 'portfoliotheme'),
	),
	array(										# media and communication: photographers
		'assistantPhotographer'	=> __('Assistant Photographer', 'portfoliotheme'),
		'cameraOperator'				=> __('Camera Operator', 'portfoliotheme'),
		'cinematographer'				=> __('Cinematographer', 'portfoliotheme'),
		'photographer'					=> __('Photographer', 'portfoliotheme'),
		'videographer'					=> __('Videographer', 'portfoliotheme'),
	),
	array(										# media and communication: photo/video editors
		'colorist'							=> __('Colorist', 'portfoliotheme'),
		'editor'								=> __('Editor', 'portfoliotheme'),
		'retoucher'							=> __('Retoucher', 'portfoliotheme'),
	),
	array(										# media and communication: technichians
		'lightingDesigner'			=> __('Lighting Designer', 'portfoliotheme'),
		'gaffer'								=> __('Gaffer', 'portfoliotheme'),
		'keyGrip'								=> __('Key Grip', 'portfoliotheme'),
		'dollyGrip'							=> __('Dolly Grip', 'portfoliotheme'),
		'bestBoyGrip'						=> __('Best Boy Grip', 'portfoliotheme'),
		'bestBoyElectrician'		=> __('Best Boy Electrician', 'portfoliotheme'),
	),
	array(										# media and communication: announcers & writers
		'actor'									=> __('Actor', 'portfoliotheme'),
		'announcer'							=> __('Announcer', 'portfoliotheme'),
		'broadcastProgrammer'		=> __('Broadcast Programmer', 'portfoliotheme'),
		'copywriter'						=> __('Copywriter', 'portfoliotheme'),
		'journalist'						=> __('Journalist', 'portfoliotheme'),
	),
);
$disciplineGroups = array(
	array(								# media
		'broadcastMedia'		=> __('Broadcast Media', 'portfoliotheme'),
		'digitalMedia'			=> __('Digital Media', 'portfoliotheme'),
		'socialMedia'				=> __('Social Media', 'portfoliotheme'),
	),
	array(								# marketing & advertising
		'advertising'				=> __('Advertising', 'portfoliotheme'),
		'marketing'					=> __('Marketing', 'portfoliotheme'),
		'marketResearch'		=> __('Market Research', 'portfoliotheme'),
	),
	array(								# design
		'experienceDesign'	=> __('Experience Design', 'portfoliotheme'),
		'graphicDesign'			=> __('Graphic Design', 'portfoliotheme'),
		'interactiveDesign'	=> __('Interactive Design', 'portfoliotheme'),
		'lightingDesign'		=> __('Lighting Design', 'portfoliotheme'),
		'networkDesign'			=> __('Network Design', 'portfoliotheme'),
		'soundDesign'				=> __('Sound Design', 'portfoliotheme'),
		'webDesign'					=> __('Web Design', 'portfoliotheme'),
	),
	array(											# computers and systems
		'softwareArchitecture'		=> __('Software Architecture', 'portfoliotheme'),
		'systemsAdministration'		=> __('Systems Administration', 'portfoliotheme'),
		'webDevelopment'					=> __('Web Development', 'portfoliotheme'),
	),
	array(											# enterpirse architecture domain
		'businessArchitecture'		=> __('Business Architecture', 'portfoliotheme'),
		'dataArchitecture'				=> __('Data Architecture', 'portfoliotheme'),
		'applicationsArchitecture'=> __('Applications Architecture', 'portfoliotheme'),
		'technologyrchitecture'		=> __('Technology Architecture', 'portfoliotheme'),
	),
	array(								# audio video
		'audiography'				=> __('Audiography', 'portfoliotheme'),
		'photography'				=> __('Photography', 'portfoliotheme'),
		'videography'				=> __('Videography', 'portfoliotheme'),
	),
	array(
		'amFmBroadcasting'	=> __('AM/FM Broadcasting', 'portfoliotheme'),
	),
	array(
		'acting'						=> __('Acting', 'portfoliotheme'),
		'copywriting'				=> __('Copywriting', 'portfoliotheme'),
		'composition'				=> __('Composition', 'portfoliotheme'),
	),
	array(
		'talentAcquisition'	=> __('Talent Acquisition', 'portfoliotheme'),
	)
);
$toolGroups = array(
	array(								# project management
		'basecamp'					=> __('Basecamp', 'portfoliotheme'),
		'facetime'					=> __('Facetime', 'portfoliotheme'),
		'trello'						=> __('Trello', 'portfoliotheme'),
		'wrike'							=> __('Wrike', 'portfoliotheme'),
		'zoomconference'		=> __('Zoom', 'portfoliotheme'),
	),
	array(								# operating systems
		'android'						=> __('Android', 'portfoliotheme'),
		'centOs'						=> __('CentOS', 'portfoliotheme'),
		'ios'								=> __('iOS', 'portfoliotheme'),
		'ipados'						=> __('iPadOS', 'portfoliotheme'),
		'macos'							=> __('macOS', 'portfoliotheme'),
		'rhel'							=> __('RHEL', 'portfoliotheme'),
		'windows'						=> __('Windows', 'portfoliotheme'),
	),
	array(								# network browsers
		'chrome'						=> __('Chrome', 'portfoliotheme'),
		'edge'							=> __('Edge', 'portfoliotheme'),
		'firefox'						=> __('Firefox', 'portfoliotheme'),
		'internetExplorer'	=> __('Internet Explorer', 'portfoliotheme'),
		'opera'							=> __('Opera', 'portfoliotheme'),
		'safari'						=> __('Safari', 'portfoliotheme'),
	),
	array(								# network servers
		'apache'						=> __('Apache', 'portfoliotheme'),
		'bind'							=> __('BIND', 'portfoliotheme'),
		'dovecot'						=> __('Dovecot', 'portfoliotheme'),
		'icecast'						=> __('Icecast', 'portfoliotheme'),
		'nginx'							=> __('NGINX', 'portfoliotheme'),
		'postfix'						=> __('Postfix', 'portfoliotheme'),
		'shoutcast'					=> __('Shoutcast', 'portfoliotheme'),
	),
	array(								# file clients
		'cyberduck'					=> __('Cyberduck', 'portfoliotheme'),
		'winscp'						=> __('WinSCP', 'portfoliotheme'),
	),
	array(								# integrated development environments
		'androidStudio'			=> __('Android Studio', 'portfoliotheme'),
		'appCode'						=> __('AppCode', 'portfoliotheme'),
		'atom'							=> __('Atom', 'portfoliotheme'),
		'clion'							=> __('Clion', 'portfoliotheme'),
		'codeBlocks'				=> __('Code::Blocks', 'portfoliotheme'),
		'eclipse'						=> __('Eclipse', 'portfoliotheme'),
		'emacs'							=> __('Emacs', 'portfoliotheme'),
		'geany'							=> __('Geany', 'portfoliotheme'),
		'goLand'						=> __('GoLand', 'portfoliotheme'),
		'intellijIdea'			=> __('IntelliJ IDEA', 'portfoliotheme'),
		'komodo'						=> __('Komodo', 'portfoliotheme'),
		'netBeans'					=> __('NetBeans', 'portfoliotheme'),
		'notepad++'					=> __('Notepad++', 'portfoliotheme'),
		'phpStorm'					=> __('PHPStorm', 'portfoliotheme'),
		'pyCharm'						=> __('PyCharm', 'portfoliotheme'),
		'qtCreator'					=> __('Qt Creator', 'portfoliotheme'),
		'rStudio'						=> __('RStudio', 'portfoliotheme'),
		'rubyMine'					=> __('RubyMine', 'portfoliotheme'),
		'sublimeText'				=> __('Sublime Text', 'portfoliotheme'),
		'vim'								=> __('Vim', 'portfoliotheme'),
		'visualStudio'			=> __('Visual Studio', 'portfoliotheme'),
		'visualStudioCode'	=> __('Visual Studio Code', 'portfoliotheme'),
		'webStorm'					=> __('WebStorm', 'portfoliotheme'),
		'xCode'							=> __('XCode', 'portfoliotheme'),
	),
	array(								# code version control
		'git'								=> __('Git', 'portfoliotheme'),
		'mercurial'					=> __('Mercurial', 'portfoliotheme'),
		'svc'								=> __('SVC', 'portfoliotheme'),
	),
	array(								# code languages
		'assembly'					=> __('Assembly', 'portfoliotheme'),
		'bash'							=> __('Bash', 'portfoliotheme'),
		'c'									=> __('C', 'portfoliotheme'),
		'cSharp'						=> __('C#', 'portfoliotheme'),
		'cplusplus'					=> __('C++', 'portfoliotheme'),
		'coffeeScript'			=> __('Coffee Script', 'portfoliotheme'),
		'css'								=> __('CSS', 'portfoliotheme'),
		'go'								=> __('Go', 'portfoliotheme'),
		'groovy'						=> __('Groovy', 'portfoliotheme'),
		'html'							=> __('HTML', 'portfoliotheme'),
		'java'							=> __('Java', 'portfoliotheme'),
		'javascript'				=> __('JavaScript', 'portfoliotheme'),
		'kotlin'						=> __('Kotlin', 'portfoliotheme'),
		'matlab'						=> __('Matlab', 'portfoliotheme'),
		'objectivec'				=> __('Objective-C', 'portfoliotheme'),
		'perl'							=> __('Perl', 'portfoliotheme'),
		'php'								=> __('PHP', 'portfoliotheme'),
		'powershell'				=> __('PowerShell', 'portfoliotheme'),
		'python'						=> __('Python', 'portfoliotheme'),
		'r'									=> __('R', 'portfoliotheme'),
		'ruby'							=> __('Ruby', 'portfoliotheme'),
		'rust'							=> __('Rust', 'portfoliotheme'),
		'scala'							=> __('Scala', 'portfoliotheme'),
		'sql'								=> __('SQL', 'portfoliotheme'),
		'shell'							=> __('Shell', 'portfoliotheme'),
		'swift'							=> __('Swift', 'portfoliotheme'),
		'typeScript'				=> __('TypeScript', 'portfoliotheme'),
		'vbscript'					=> __('VBScript', 'portfoliotheme'),
		'visualbasic'				=> __('Visual Basic', 'portfoliotheme'),
	),
	array(								# apis, libraries and frameworks
		'animatecss'				=> __('Animate.css', 'portfoliotheme'),
		'authorizenet'			=> __('Authorize.net', 'portfoliotheme'),
		'jquery'						=> __('jQuery', 'portfoliotheme'),
		'matomo'						=> __('Matomo', 'portfoliotheme'),
		'metatrader'				=> __('MetaTrader', 'portfoliotheme'),
		'paypal'						=> __('PayPal', 'portfoliotheme'),
		'shopify'						=> __('Shopify', 'portfoliotheme'),
		'square'						=> __('Square', 'portfoliotheme'),
		'squareSpace'				=> __('SquareSpace', 'portfoliotheme'),
		'stripe'						=> __('Stripe', 'portfoliotheme'),
		'wix'								=> __('Wix', 'portfoliotheme'),
		'wordpress'					=> __('WordPress', 'portfoliotheme'),
	),
	array(								# infrastructure/cloud platforms
		'a2Hosting'					=> __('A2Hosting', 'portfoliotheme'),
		'alibabaCloud'			=> __('Alibaba Cloud', 'portfoliotheme'),
		'atlanticnet'				=> __('Atlantic.net', 'portfoliotheme'),
		'aws'								=> __('AWS', 'portfoliotheme'),
		'azure'							=> __('Azure', 'portfoliotheme'),
		'citrix'						=> __('Citrix', 'portfoliotheme'),
		'cloudFoundry'			=> __('Cloud Foundry', 'portfoliotheme'),
		'cloudWays'					=> __('CloudWays', 'portfoliotheme'),
		'cPanel'						=> __('cPanel', 'portfoliotheme'),
		'digitalocean'			=> __('DigitalOcean', 'portfoliotheme'),
		'dreamHost'					=> __('DreamHost', 'portfoliotheme'),
		'engineYard'				=> __('Engine Yard', 'portfoliotheme'),
		'goDaddy'						=> __('GoDaddy', 'portfoliotheme'),
		'googlecloud'				=> __('Google Cloud', 'portfoliotheme'),
		'heroku'						=> __('Heroku', 'portfoliotheme'),
		'ibmCloud'					=> __('IBM Cloud', 'portfoliotheme'),
		'jelastic'					=> __('Jelastic', 'portfoliotheme'),
		'kamatera'					=> __('Kamatera', 'portfoliotheme'),
		'linode'						=> __('Linode', 'portfoliotheme'),
		'mediaTemple'				=> __('MediaTemple', 'portfoliotheme'),
		'openShift'					=> __('OpenShift', 'portfoliotheme'),
		'openStack'					=> __('OpenStack', 'portfoliotheme'),
		'oracleCloud'				=> __('Oracle Cloud', 'portfoliotheme'),
		'plesk'							=> __('Plesk', 'portfoliotheme'),
		'rackSpace'					=> __('RackSpace', 'portfoliotheme'),
		'salesforce'				=> __('Salesforce', 'portfoliotheme'),
		'sapCloud'					=> __('SAP Cloud', 'portfoliotheme'),
		'scaleway'					=> __('Scaleway', 'portfoliotheme'),
		'softLayer'					=> __('SoftLayer', 'portfoliotheme'),
		'springCloud'				=> __('Spring Cloud', 'portfoliotheme'),
		'steadfast'					=> __('Steadfast', 'portfoliotheme'),
		'terreMark'					=> __('TerreMark', 'portfoliotheme'),
		'toggleBox'					=> __('ToggleBox', 'portfoliotheme'),
		'verizon'						=> __('Verizon Cloud', 'portfoliotheme'),
		'vmware'						=> __('VMWare', 'portfoliotheme'),
		'vultr'							=> __('Vultr', 'portfoliotheme'),
		'webmin'						=> __('Webmin', 'portfoliotheme'),
	),
	array(								# media recording
		'canon'							=> __('Canon', 'portfoliotheme'),
		'm-audio'						=> __('M-Audio', 'portfoliotheme'),
		'nikon'							=> __('Nikon', 'portfoliotheme'),
		'panasonic'					=> __('Panasonic', 'portfoliotheme'),
		'red'								=> __('RED', 'portfoliotheme'),
		'rode'							=> __('Rode', 'portfoliotheme'),
		'roland'						=> __('Roland', 'portfoliotheme'),
		'sennheiser'				=> __('Sennheiser', 'portfoliotheme'),
		'sony'							=> __('Sony', 'portfoliotheme'),
		'zoom'							=> __('Zoom', 'portfoliotheme'),
	),
	array(								# camera: lighting
		'arri'							=> __('Arri', 'portfoliotheme'),
		'bron'							=> __('Bron', 'portfoliotheme'),
		'chimera'						=> __('Chimera', 'portfoliotheme'),
		'kinoFlo'						=> __('Kino Flo', 'portfoliotheme'),
		'litepanels'				=> __('Litepanels', 'portfoliotheme'),
		'moleRichardson'		=> __('Mole Richardson', 'portfoliotheme'),
		'profoto'						=> __('Profoto', 'portfoliotheme'),
	),
	array(								# camera: lighting
		'beautyDish'				=> __('Beauty Dish', 'portfoliotheme'),
		'duvetyneMuslin'		=> __('Duvetyne/Muslin', 'portfoliotheme'),
		'flagKit'						=> __('Flag Kit', 'portfoliotheme'),
		'foils'							=> __('Foil', 'portfoliotheme'),
		'gelFilters'				=> __('Gel Filters', 'portfoliotheme'),
		'reflectors'				=> __('Reflectors', 'portfoliotheme'),
		'stingers'					=> __('Stingers', 'portfoliotheme'),
		'tapes'							=> __('Tapes', 'portfoliotheme'),
	),
	array(								# camera: gaffing
		'easyrigCinema3'		=> __('Easyrig Cinema 3', 'portfoliotheme'),
		'losmandyPortaJib'	=> __('Losmandy Porta-Jib', 'portfoliotheme'),
		'matthewsDolly'			=> __('Matthews Dolly', 'portfoliotheme'),
		'spiderDolly'				=> __('Spider Dolly', 'portfoliotheme'),
	),
	array(								# camera: grip
		'autopoles'					=> __('Autopoles', 'portfoliotheme'),
		'backdrops'					=> __('Backdrops', 'portfoliotheme'),
		'comboStands'				=> __('Combo Stands', 'portfoliotheme'),
		'cStands'						=> __('C-Stands', 'portfoliotheme'),
		'cardelliniClamps'	=> __('Cardellini Clamps', 'portfoliotheme'),
		'sandBags'					=> __('Sand Bags', 'portfoliotheme'),
	),
	array(								# media publishing
		'iWork'							=> __('iWork', 'portfoliotheme'),
		'office'						=> __('Office', 'portfoliotheme'),
		'openOffice'				=> __('Open Office', 'portfoliotheme'),
	),
	array(								# media editors
		'afterEffects'			=> __('After Effects', 'portfoliotheme'),
		'bridge'						=> __('Bridge', 'portfoliotheme'),
		'illustrator'				=> __('Illustrator', 'portfoliotheme'),
		'finalCutPro'				=> __('Final Cut Pro', 'portfoliotheme'),
		'lightroom'					=> __('Lightroom', 'portfoliotheme'),
		'live'							=> __('Live', 'portfoliotheme'),
		'photoshop'					=> __('Photoshop', 'portfoliotheme'),
		'premiere'					=> __('Premiere', 'portfoliotheme'),
	),
	array(								# 3d environment engines and rendering
		'chaosScope'				=> __('Chaos Scope', 'portfoliotheme'),
		'unityEngine'				=> __('Unity Engine', 'portfoliotheme'),
		'unrealEngine'			=> __('Unreal Engine', 'portfoliotheme'),
	),
);
$productGroups = array(
	array(							# words
		'brandName'				=> __('Brand Name', 'portfoliotheme'),
		'copy'						=> __('Copy', 'portfoliotheme'),
		'literature'			=> __('Literature', 'portfoliotheme'),
	),
	array(							# visuals
		'brandLogo'				=> __('Brand Logo', 'portfoliotheme'),
		'fineArt'					=> __('Fine Art', 'portfoliotheme'),
		'graphic'					=> __('Graphic', 'portfoliotheme'),
		'photography'			=> __('Photography', 'portfoliotheme'),
		'styleGuide'			=> __('Style Guide', 'portfoliotheme'),
	),
	array(							# motion
		'animation'				=> __('Animation', 'portfoliotheme'),
		'commercial'			=> __('Commercial', 'portfoliotheme'),
		'film'						=> __('Film', 'portfoliotheme'),
		'musicVideo'			=> __('Music Video', 'portfoliotheme'),
		'tvShow'					=> __('TV Show', 'portfoliotheme'),
		'trailer'					=> __('Trailer', 'portfoliotheme'),
	),
	array(							# sound
		'fieldRecording'	=> __('Field Recording', 'portfoliotheme'),
		'livePerformance'	=> __('Live Performance', 'portfoliotheme'),
		'music'						=> __('Music', 'portfoliotheme'),
		'radioShow'				=> __('Radio Show', 'portfoliotheme'),
	),
	array(							# code
		'webSite'					=> __('Web Site', 'portfoliotheme'),
		'webPage'					=> __('Web Page', 'portfoliotheme'),
		'webApp'					=> __('Web App', 'portfoliotheme'),
	),
);
$presentationGroups = array(
	array(
		'goods'						=> __('Goods', 'portfoliotheme'),
		'print'						=> __('Print', 'portfoliotheme'),
		'recording'				=> __('Recording', 'portfoliotheme'),
		'theater'					=> __('Theater', 'portfoliotheme'),
		'cinema'					=> __('Cinema', 'portfoliotheme'),
		'tv'							=> __('TV', 'portfoliotheme'),
		'radio'						=> __('Radio', 'portfoliotheme'),
		'internet'				=> __('Internet', 'portfoliotheme'),
	)
);
$shortcutGroups = array(
	array(
		'all'							=> __('All', 'portfoliotheme'),
		'web'							=> __('Web', 'portfoliotheme'),
		'video'						=> __('Video', 'portfoliotheme'),
		'photo'						=> __('Photo', 'portfoliotheme'),
		'graphic'					=> __('Graphic', 'portfoliotheme'),
		'sound'						=> __('Sound', 'portfoliotheme'),
	)
);

/**
 *
 * Check if each custom meta key is in a seperately displayed group.
 *
 */
function isSeparateGroup($metaGroup, $previousEntry, $nextEntry) {
	global $roleGroups;
	global $disciplineGroups;
	global $toolGroups;
	global $productGroups;
	global $presentationGroups;
	$allGroups = array();
	if ($metaGroup === 'roles') {
		$allGroups = $roleGroups;
	} elseif ($metaGroup === 'disciplines') {
		$allGroups = $disciplineGroups;
	} elseif ($metaGroup === 'tools') {
		$allGroups = $toolGroups;
	} elseif ($metaGroup === 'products') {
		$allGroups = $productGroups;
	} elseif ($metaGroup === 'presentations') {
		$allGroups = $productGroups;
	} else {
		error_log('Incorrect metaGroup: '.$metaGroup);
	}
	// Seperate the sub-groups
	foreach($allGroups as $group) {
		static $groupIndex = 0;
		foreach($group as $key => $value) {
			if ($key === $previousEntry) {
				$previousEntryGroup = $groupIndex;
			}
			if ($key === $nextEntry) {
				$nextEntryGroup = $groupIndex;
			}
		}
		++$groupIndex;
	}
	$groupIndex = 0;
	if ($previousEntryGroup === $nextEntryGroup) {
		return false;
	} else {
		return true;
	}
}

function displayMetaLabel($metaGroup, $metaKey) {
	global $roleGroups;
	global $disciplineGroups;
	global $toolGroups;
	global $productGroups;
	global $presentationGroups;
	global $shortcutGroups;
	if ($metaGroup === 'roles') {
		$allGroups = $roleGroups;
	} elseif ($metaGroup === 'disciplines') {
		$allGroups = $disciplineGroups;
	} elseif ($metaGroup === 'tools') {
		$allGroups = $toolGroups;
	} elseif ($metaGroup === 'products') {
		$allGroups = $productGroups;
	} elseif ($metaGroup === 'presentations') {
		$allGroups = $presentationGroups;
	} elseif ($metaGroup === 'shortcut') {
		$allGroups = $shortcutGroups;
	} else {
		error_log('Undefined metaGroup.');
	}
	foreach($allGroups as $group) {
		foreach($group as $key => $label) {
			if ($metaKey === $key) {
				return $label;
			}
		}
	}
}


/* Define the custom box */
add_action( 'add_meta_boxes_work', 'project_info_meta_boxes' );
/* Do something with the data entered */
//add_action( 'save_post', 'work_info_save_postdata' );
/* Adds a box to the main column on the Work post type edit screens */
function project_info_meta_boxes() {
	add_meta_box(
    'project_info_meta_boxes',
    __('Project Info', 'portfoliotheme'),
    'project_info_meta_boxes_html',
    'work',
    'normal',
    'high'
  );
}
/* Adds the upload functions for the images. */
add_action('admin_enqueue_scripts', 'image_upload_scripts');
function image_upload_scripts() {
	global $post_type;
	$post_type = $post_type ? $post_type : $_GET['post_type'];
	$action = $_GET['action'];
	if ($post_type === 'work') {
    wp_register_script('upload-slide-image', get_bloginfo('template_url').'/js/upload-slide-image.js', array('jquery'));
    wp_enqueue_script('upload-slide-image');
  }
}
/* Adds the upload functions for the images. */
add_action('admin_enqueue_scripts', 'form_copy_scripts');
function form_copy_scripts() {
	global $post_type;
	$post_type = $post_type ? $post_type : $_GET['post_type'];
	$action = $_GET['action'];
	if ($post_type === 'work') {
    wp_register_script('copy-slide-info', get_bloginfo('template_url').'/js/copy-slide-info.js', array('jquery'));
    wp_enqueue_script('copy-slide-info');
  }
}
/* Adds the styles for the forms. */
add_action('admin_enqueue_scripts', 'work_post_type_styles');
function work_post_type_styles() {
	global $post_type;
	$post_type = $post_type ? $post_type : $_GET['post_type'];
	$action = $_GET['action'];
	if ($post_type === 'work') {
    wp_register_style('work_post_type_styles', get_bloginfo('template_url').'/css/post-type-work.css');
    wp_enqueue_style('work_post_type_styles');
  }
}
/* Prints the box content */
function project_info_meta_boxes_html($post, $arguments) {
	printf(
		'<p><strong>%1$s</strong></p>',
		__('Shortcut Keywords', 'portfoliotheme')
	);
	$saved = get_post_meta( $post->ID, 'shortcut_keywords', true );
  global $shortcutGroups;
	echo '<div class="masonry_wrapper">';
	echo '<div class="masonry_column">';
	foreach ($shortcutGroups as $group) {
	  foreach($group as $key => $label) {
			if (!empty($saved)) {
				if (in_array($key, $saved)) {
					$checked = 'checked="checked"';
				} else {
					$checked = '';
				}
			}
	    printf(
	      '<input type="checkbox" name="shortcut_keywords[]" value="%1$s" id="shortcut_keywords[%1$s]" %3$s />'.
	      '<label for="shortcut_keywords[%1$s]"> %2$s ' .
	      '</label><br />',
	      esc_attr($key),
	      esc_html($label),
				$checked
	    );
			unset($checked);
	  }
	}
	echo '</div></div>';
}

$numberOfSlides = 4;
/* Define the custom box */
add_action( 'add_meta_boxes_work', 'slide_info_add_custom_box' );
/* Do something with the data entered */
add_action( 'save_post', 'slide_info_save_postdata' );
/* Adds a box to the main column on the Work post type edit screens */
function slide_info_add_custom_box() {
	global $numberOfSlides;
	$slideNumber = 0;
	while ($numberOfSlides > 0){
		++$slideNumber;
		--$numberOfSlides;
		add_meta_box(
	    'slide_info_sectionid'.$slideNumber,
	    __('Project Slide', 'portfoliotheme').' '.$slideNumber,
	    'slide_info_html_custom_box',
	    'work',
	    'normal',
	    'high',
			array('slideNumber'=>$slideNumber)
	  );
	}
}
/* Prints the box content */
function slide_info_html_custom_box($post, $arguments) {
  // Use nonce for verification.
  wp_nonce_field( 'work_info_field_nonce', 'work_info_noncename' );

	$slideNumber = $arguments['args']['slideNumber'];
	$slideId = 'slide_'.$slideNumber;
	$prevSlideNumber = $slideNumber-1;

	printf(
		'<p><strong><label for="'.$slideId.'_title">%1$s</label></strong></p>',
 		__('Featured Title', 'portfoliotheme')
  );
	$saved = get_post_meta( $post->ID, $slideId.'_title', true );
	$placeholder = __('Enter a title for this slide', 'portfoliotheme');
	$label = __('Title', 'portfoliotheme');
	if ($saved) {
		$imageUrl = $saved;
	} else {
		$imageUrl = '';
	}
  printf(
    '<input type="text" name="'.$slideId.'_title" value="%1$s" id="'.$slideId.'_title" placeholder="%2$s" style="width: 100&#37;; margin-bottom: 10px;" />'.
		'<br /><br />',
		esc_attr($imageUrl),
		esc_attr($placeholder)
  );

	printf(
		'<p><strong><label for="'.$slideId.'_url">%1$s</label></strong></p>',
		__('Featured Image', 'portfoliotheme')
	);
	$saved = get_post_meta( $post->ID, $slideId.'_url', true );
	$placeholder = __('Choose an image for this slide', 'portfoliotheme');
	$label = __('Web Address', 'portfoliotheme');
	$button = __('Browse Images', 'portfoliotheme');
	if ($saved) {
		$imageUrl = $saved;
	} else {
		$imageUrl = '';
	}
  printf(
		// '<label for="'.$slideId.'_url"> %4$s </label>'.
    '<input type="text" name="'.$slideId.'_url" value="%1$s" id="'.$slideId.'_url" placeholder="%2$s" style="width: 100&#37;; margin-bottom: 10px;" />'.
		'<input type="button" value="%3$s" class="button components-button upload_button" id="'.$slideId.'_button" />'.
		'<br /><br />',
		esc_attr($imageUrl),
		esc_attr($placeholder),
		esc_attr($button),
		esc_html($label)
  );

	printf(
		'<p><strong><label for="'.$slideId.'_demo_url">%1$s</label></strong></p>',
		__('Featured Demo', 'portfoliotheme')
	);
	$saved = get_post_meta( $post->ID, $slideId.'_demo_url', true );
	$label = __('For example, www.my-demo-website.com', 'portfoliotheme');
	if ($saved) {
		$imageUrl = $saved;
	} else {
		$imageUrl = '';
	}
  printf(
    '<input type="text" name="'.$slideId.'_demo_url" value="%1$s" id="'.$slideId.'_demo_url" placeholder="%2$s" style="width: 100&#37;; margin-bottom: 10px;" />'.
    // '<label for="'.$slideId.'_demo_url"> %2$s ' .
    '</label>',
    esc_attr($imageUrl),
		esc_html($label)
  );

	echo '<br /><br /><hr>';

	if ($prevSlideNumber>0) {
		echo '<br />';
		echo '<button type="button" id="'.$slideId.'_copy_button" class="button components-button copy_button">';
		echo 'Copy Slide '.$prevSlideNumber.' Info';
		echo '</button>';
		echo '<label for="'.$slideId.'_copy_button">';
		echo ' Copy slide info from the previous slide.';
		echo '</label>';

		echo '<br /><br /><hr>';
	}

	if ($prevSlideNumber>0) {
		echo '<br />';
		echo '<button type="button" id="'.$slideId.'_clear_button" class="button components-button clear_button">';
		echo 'Clear Slide '.$slideNumber.' Info';
		echo '</button>';
		echo '<label for="'.$slideId.'_clear_button">';
		echo ' Clear slide info for the current slide.';
		echo '</label>';

		echo '<br /><br /><hr>';
	}

	printf(
		'<p><strong>%1$s</strong></p>',
		__('Project Roles', 'portfoliotheme')
	);
  $saved = get_post_meta( $post->ID, $slideId.'_roles', true );
  global $roleGroups;
	echo '<div class="masonry_wrapper">';
	echo '<div class="masonry_column">';
	foreach($roleGroups as $group) {
	  foreach($group as $key => $label) {
			if (!empty($prevRole) && isSeparateGroup('roles', $prevRole, $key)) {
				echo '<br />';
				echo '</div>';
				echo '<div class="masonry_column">';
			}
			if (!empty($saved)) {
				if (in_array($key, $saved)) {
					$checked = 'checked="checked"';
				} else {
					$checked = '';
				}
			}
	    printf(
	      '<input type="checkbox" name="'.$slideId.'_roles[]" value="%1$s" id="'.$slideId.'_roles[%1$s]" %3$s />'.
	      '<label for="'.$slideId.'_roles[%1$s]"> %2$s ' .
	      '</label><br />',
	      esc_attr($key),
	      esc_html($label),
				$checked
	    );
			$prevRole = $key;
			unset($checked);
	  }
	}
	unset($prevRole);
	echo '</div></div><hr>';

	printf(
		'<p><strong>%1$s</strong></p>',
		__('Project Disciplines', 'portfoliotheme')
	);
  $saved = get_post_meta( $post->ID, $slideId.'_disciplines', true );
  global $disciplineGroups;
	echo '<div class="masonry_wrapper">';
	echo '<div class="masonry_column">';
	foreach($disciplineGroups as $group) {
	  foreach($group as $key => $label) {
			if (!empty($prevDiscipline) && isSeparateGroup('disciplines', $prevDiscipline, $key)) {
				echo '<br />';
				echo '</div>';
				echo '<div class="masonry_column">';
			}
			if (!empty($saved)) {
				if (in_array($key, $saved)) {
					$checked = 'checked="checked"';
				} else {
					$checked = '';
				}
			}
	    printf(
	      '<input type="checkbox" name="'.$slideId.'_disciplines[]" value="%1$s" id="'.$slideId.'_disciplines[%1$s]" %3$s />'.
	      '<label for="'.$slideId.'_disciplines[%1$s]"> %2$s ' .
	      '</label><br />',
	      esc_attr($key),
	      esc_html($label),
				$checked
	    );
			$prevDiscipline = $key;
			unset($checked);
	  }
	}
	unset($prevDiscipline);
	echo '</div></div><hr>';

	printf(
		'<p><strong>%1$s</strong></p>',
		__('Project Tools', 'portfoliotheme')
	);
  $saved = get_post_meta( $post->ID, $slideId.'_tools', true );
  global $toolGroups;
	echo '<div class="masonry_wrapper">';
	echo '<div class="masonry_column">';
	foreach ($toolGroups as $groups) {
	  foreach($groups as $key => $label) {
			if (!empty($prevTool) && isSeparateGroup('tools', $prevTool, $key)) {
				echo '<br />';
				echo '</div>';
				echo '<div class="masonry_column">';
			}
			if (!empty($saved)) {
				if (in_array($key, $saved)) {
					$checked = 'checked="checked"';
				} else {
					$checked = '';
				}
			}
	    printf(
	      '<input type="checkbox" name="'.$slideId.'_tools[]" value="%1$s" id="'.$slideId.'_tools[%1$s]" %3$s />'.
	      '<label for="'.$slideId.'_tools[%1$s]"> %2$s ' .
	      '</label><br />',
	      esc_attr($key),
	      esc_html($label),
				$checked
	    );
			$prevTool = $key;
			unset($checked);
	  }
	}
	unset($prevTool);
	echo '</div></div><hr>';

	printf(
		'<p><strong>%1$s</strong></p>',
		__('Project Products', 'portfoliotheme')
	);
  $saved = get_post_meta( $post->ID, $slideId.'_products', true );
  global $productGroups;
	echo '<div class="masonry_wrapper">';
	echo '<div class="masonry_column">';
	foreach ($productGroups as $group) {
	  foreach($group as $key => $label) {
			if (!empty($prevProduct) && isSeparateGroup('products', $prevProduct, $key)) {
				echo '<br />';
				echo '</div>';
				echo '<div class="masonry_column">';
			}
			if (!empty($saved)) {
				if (in_array($key, $saved)) {
					$checked = 'checked="checked"';
				} else {
					$checked = '';
				}
			}
	    printf(
	      '<input type="checkbox" name="'.$slideId.'_products[]" value="%1$s" id="'.$slideId.'_products[%1$s]" %3$s />'.
	      '<label for="'.$slideId.'_products[%1$s]"> %2$s ' .
	      '</label><br />',
	      esc_attr($key),
	      esc_html($label),
				$checked
	    );
			$prevProduct = $key;
			unset($checked);
	  }
	}
	unset($prevProduct);
	echo '</div></div><hr>';

	printf(
		'<p><strong>%1$s</strong></p>',
		__('Project Presentation', 'portfoliotheme')
	);
  $saved = get_post_meta( $post->ID, $slideId.'_presentations', true );
  global $presentationGroups;
	echo '<div class="masonry_wrapper">';
	echo '<div class="masonry_column">';
	foreach ($presentationGroups as $groups) {
	  foreach($groups as $key => $label) {
			if (!empty($prevPresentation) && isSeparateGroup('presentations', $prevPresentation, $key)) {
				echo '<br />';
				echo '</div>';
				echo '<div class="masonry_column">';
			}
			if (!empty($saved)) {
				if (in_array($key, $saved)) {
					$checked = 'checked="checked"';
				} else {
					$checked = '';
				}
			}
	    printf(
	      '<input type="checkbox" name="'.$slideId.'_presentations[]" value="%1$s" id="'.$slideId.'_presentations[%1$s]" %3$s />'.
	      '<label for="'.$slideId.'_presentations[%1$s]"> %2$s ' .
	      '</label><br />',
	      esc_attr($key),
	      esc_html($label),
				$checked
	    );
			$prevPresentation = $key;
			unset($checked);
	  }
	}
	unset($prevTool);
	echo '</div></div><hr>';

	printf(
		'<p><strong>%1$s</strong></p>',
		__('Description', 'portfoliotheme')
	);
	$saved = get_post_meta( $post->ID, $slideId.'_description', true );
	printf(
		'<textarea name="'.$slideId.'_description" id="'.$slideId.'_description" placeholder="Enter your description here...">%1$s</textarea>'.
		'<br />',
		esc_attr($saved)
	);
	echo '<br/>';
}
/**
	* When the post is saved, saves our custom data.
	* @param $post_id
	*/
function slide_info_save_postdata( $post_id )
{
  // If auto-save action, do nothing.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
	}
  // Validate cross-site request forgery security token.
  if (!wp_verify_nonce($_POST['work_info_noncename'], 'work_info_field_nonce')) {
    return;
	}

	// @todo reduce code, by creating a sanatize function for URLs.
	if ( isset($_POST['title_image_url']) && $_POST['title_image_url'] !== '' ){
		$titleImageUrl = esc_url_raw($_POST['title_image_url']);
		$sanatizedUrl = filter_var($titleImageUrl, FILTER_SANITIZE_URL);
		if (filter_var($sanatizedUrl, FILTER_VALIDATE_URL)) {
			update_post_meta( $post_id, 'title_image_url', $sanatizedUrl );
		} else {
			error_log('Invalid URL type detected for title image url.');
		}
	} else {
		delete_post_meta($post_id, 'title_image_url'  );
	}
	if ( isset($_POST['description']) && $_POST['description'] !== '' ){
		update_post_meta( $post_id, 'description', $_POST['description'] );
	} else {
		delete_post_meta($post_id, 'description'  );
	}
	if ( isset($_POST['shortcut_keywords']) && $_POST['shortcut_keywords'] !== '' ){
		update_post_meta( $post_id, 'shortcut_keywords', $_POST['shortcut_keywords'] );
	} else {
		delete_post_meta($post_id, 'shortcut_keywords'  );
	}

	global $numberOfSlides;
	$slideNumber = 0;
	while ($numberOfSlides > 0){
		++$slideNumber;
		--$numberOfSlides;
		$slideId = 'slide_'.$slideNumber;
		$slideDetected = false;
		// Add support for "Title
		if ( isset($_POST[$slideId.'_title']) && $_POST[$slideId.'_title'] !== '' ){
			$slideDescription = trim(esc_textarea($_POST[$slideId.'_title']));
			update_post_meta( $post_id, $slideId.'_title', $slideDescription );
	  } else {
	  	delete_post_meta($post_id, $slideId.'_title'  );
	  }
		// Add support for "URL"
		if ( isset($_POST[$slideId.'_url']) && $_POST[$slideId.'_url'] !== '' ){
			$slideImageUrl = esc_url_raw($_POST[$slideId.'_url']);
			$sanatizedUrl = filter_var($slideImageUrl, FILTER_SANITIZE_URL);
			if (filter_var($sanatizedUrl, FILTER_VALIDATE_URL)) {
				update_post_meta( $post_id, $slideId.'_url', $sanatizedUrl );
				$slideDetected = true;
			} else {
				error_log('Invalid URL type detected for image slide.');
			}
			$slideDetected = true;
	  } else {
	  	delete_post_meta($post_id, $slideId.'_url'  );
	  }
		// Add support for "demo URL"
		if ( isset($_POST[$slideId.'_demo_url']) && $_POST[$slideId.'_demo_url'] !== '' ){
			$slideDemoUrl = esc_url_raw($_POST[$slideId.'_demo_url']);
			$sanatizedUrl = filter_var($slideDemoUrl, FILTER_SANITIZE_URL);
			if (filter_var($sanatizedUrl, FILTER_VALIDATE_URL)) {
	    	update_post_meta( $post_id, $slideId.'_demo_url', $sanatizedUrl );
				$slideDetected = true;
			} else {
				error_log('Invalid URL type detected for Demo slide.');
			}
	  } else {
	  	delete_post_meta($post_id, $slideId.'_demo_url'  );
	  }
		if ($slideDetected) {
			++$slideTotal;
		}
	  if ( isset($_POST[$slideId.'_products']) && $_POST[$slideId.'_products'] !== '' ){
	    update_post_meta( $post_id, $slideId.'_products', $_POST[$slideId.'_products'] );
	  } else {
	  	delete_post_meta($post_id, $slideId.'_products'  );
	  }
		if ( isset($_POST[$slideId.'_roles']) && $_POST[$slideId.'_roles'] !== '' ){
	    update_post_meta( $post_id, $slideId.'_roles', $_POST[$slideId.'_roles'] );
	  } else {
	  	delete_post_meta($post_id, $slideId.'_roles'  );
	  }
		if ( isset($_POST[$slideId.'_disciplines']) && $_POST[$slideId.'_disciplines'] !== '' ){
	    update_post_meta( $post_id, $slideId.'_disciplines', $_POST[$slideId.'_disciplines'] );
	  } else {
	  	delete_post_meta($post_id, $slideId.'_disciplines'  );
	  }
		if ( isset($_POST[$slideId.'_tools']) && $_POST[$slideId.'_tools'] !== '' ){
	    update_post_meta( $post_id, $slideId.'_tools', $_POST[$slideId.'_tools'] );
	  } else {
	  	delete_post_meta($post_id, $slideId.'_tools'  );
	  }
		if ( isset($_POST[$slideId.'_presentations']) && $_POST[$slideId.'_presentations'] !== '' ){
	    update_post_meta( $post_id, $slideId.'_presentations', $_POST[$slideId.'_presentations'] );
	  } else {
	  	delete_post_meta($post_id, $slideId.'_presentations'  );
	  }
		if ( isset($_POST[$slideId.'_description']) && $_POST[$slideId.'_description'] !== '' ){
			$slideDescription = trim(esc_textarea($_POST[$slideId.'_description']));
			update_post_meta( $post_id, $slideId.'_description', $slideDescription );
	  } else {
	  	delete_post_meta($post_id, $slideId.'_description'  );
	  }
	}
	update_post_meta( $post_id, 'slideTotal', $slideTotal );
}
 ?>
