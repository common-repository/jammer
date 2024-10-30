=== Plugin Name ===
Contributors: jrop
Tags: jplayer, playlist, audio, player, mp3, wav, ogg, jammer
Requires at least: 3.5
Tested up to: 3.5
Stable Tag: 0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Jammer is a plugin that provies a shortcode users can use to embed an audio player (powered by jPlayer) in posts/pages.

== Description ==

Jammer is a plugin that provies a shortcode users can use to embed an audio player (powered by jPlayer) in posts/pages. Use like this:

\[jammer tracks="(track-string)" style="(css)" skin="(skin-directory)"\]

Where

* (track-string) is in the format "title=Some Title Here|mp3=url-to-mp3|oga=url-to-ogg,title=Another Title|mp3=...|oga=...".
* (skin-directory) is the name of a directory located in (plugin-dir)/jammer/files/skins with a jPlayer skin css file in it.  Out-of-the-box, valid values are "blue.monday" and "pink.flag".  You may also upload your own skins to this directory.  (Only one skin may be specified per page, otherwise behavior is not gauranteed)

As is evident, track titles as well as URLs should not contain the characters **|=",** (that is, pipe, equals, double quote, or comma), or else the plugin may get confused and break. Perhaps if I get enough requests, I'll add functionality to escape these characters some way.

When providing track urls, technically only one format is needed (such as only 'mp3', etc), see [this](http://jplayer.org/latest/developer-guide/#jPlayer-media-encoding) page for more details.

One should be consistent about what types of media is provided across different tracks, i.e., if mp3, and ogg are provided for the first track, only providing wav for the second track is not wise and might cause the plugin to break. 

If you like the plugin, please leave feedback in the form of a rating!  If the plugin doesn't work for you, please seek support via the support tab before leaving a bad rating!

== Installation ==

Extract the zip in your wordpress plugins directory and then activate the plugins menu in wordpress.

See the general description for how to use this plugin.

== Changelog ==

= 0.2 =
* Added support for different skins

= 0.1 =
* First release

