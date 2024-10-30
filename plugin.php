<?php
/*
Plugin Name: Jammer
Description: WP plugin for JPlayer playlists
Version: 0.2
License: GPLv2 or later
*/

function jammer_scripts() {
	wp_enqueue_script('jquery');

	wp_enqueue_script(
		'jplayer',
		plugin_dir_url(__FILE__) .'files/jquery.jplayer.min.js'
	);

	wp_enqueue_script(
		'jplayerplaylist',
		plugin_dir_url(__FILE__) .'files/jplayer.playlist.min.js'
	);

	wp_enqueue_script(
		'jammerloader',
		plugin_dir_url(__FILE__) .'files/loader.js'
	);
}

function jammer_get_available_skins() {
	$avail_skins = array();
	$skin_dir = dirname(__FILE__) .'/files/skins';
	
	$skin_dirs = scandir($skin_dir);
	foreach ($skin_dirs as $dir) {
		// look for css file in dir
		if ($dir == '.' || $dir == '..')
			continue;
		
		$files = scandir($skin_dir .'/'. $dir);
		foreach ($files as $file) {
			$pi = pathinfo($skin_dir .'/'. $dir .'/'. $file);
			if (isset($pi['extension']) && $pi['extension'] == 'css') {
				// found a css file!
				$avail_skins[$dir] = 'files/skins/'. $dir .'/'. $file;
			}
		}
	}
	
	return $avail_skins;
}

function jammer_get_selected_skin($bias = "") {
	$avail_skins = jammer_get_available_skins();
	if (isset($avail_skins[$bias]))
		return $avail_skins[$bias];
	else if (isset($avail_skins[0]))
		return $avail_skins[0];
	else
		return 'files/skins/blue.monday/jplayer.blue.monday.css'; // just in case something goes terribly wrong...
}

function jammer_shortcode($atts) {
	extract(shortcode_atts(array(
		'tracks' => '',
		'style' => '',
		'skin' => 'blue.monday'
	), $atts));

	$skin = jammer_get_selected_skin($skin);
	
	$id = uniqid();
	return '
	<link rel="stylesheet" href="'. plugin_dir_url(__FILE__) . $skin .'" />
	<div id="'. $id .'" class="jamp-player">
		<div style="display:none;" id="'. $id . '-swfPath">'. (plugin_dir_url(__FILE__) .'files/Jplayer.swf') .'</div>
		<div style="display:none;" id="'. $id . '-tracks">'. $tracks .'</div>
		<div id="jplayer_'. $id .'"></div>
		<div id="jcontainer_'. $id .'" class="jp-audio" style="'. $style .'">
			<div class="jp-type-single">
				<div class="jp-gui jp-interface">
					<ul class="jp-controls">
						<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
						<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
						<li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
						<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
						<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
						<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
					</ul>
				<div class="jp-progress">
					<div class="jp-seek-bar">
						<div class="jp-play-bar"></div>
					</div>
				</div>
				<div class="jp-volume-bar">
					<div class="jp-volume-bar-value"></div>
				</div>
				<div class="jp-time-holder">
					<div class="jp-current-time"></div>
					<div class="jp-duration"></div>
					<ul class="jp-toggles">
						<li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
						<li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
					</ul>
				</div>
			</div>
			<div class="jp-title">
				<ul>
					<li>Bubble</li>
				</ul>
			</div>
				<div class="jp-no-solution">
					<span>Update Required</span>
					To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
				</div>
			</div>
			<div id="jplaylist_'. $id .'" class="jp-playlist">
				<ul><li></li></ul>
			</div>
		</div>
	</div>
	';
}

add_action('wp_enqueue_scripts', jammer_scripts);
add_shortcode('jammer', jammer_shortcode);
?>
