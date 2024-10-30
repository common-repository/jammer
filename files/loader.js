function getParam(id, name) {
	return jQuery('#' + id + '-' + name).text();
}

function parseTracksStr(id) {
	var mediaTypes = [ 'mp3', 'm4a', 'm4v', 'webma', 'webmv', 'oga', 'ogv', 'wav', 'fla', 'flv', 'rtmpa', 'rtmpv' ];
	var supplied = [];
	var tracks = getParam(id, 'tracks').split(',');
	var out = [];
	
	for (var i = 0; i < tracks.length; ++i) {
		var obj = {};
		var objDirty = false;
		
		var fields = tracks[i].split('|');
		for (var j = 0; j < fields.length; ++j) {
			var index = fields[j].indexOf('=');
			if (index == -1)
				continue;
			
			var left = fields[j].substring(0, index);
			var right = fields[j].substring(index + 1);
			obj[left] = right;
			objDirty = true;
			
			if (mediaTypes.indexOf(left) != -1) {
				// add it to 'supplied'
				if (supplied.indexOf(left) == -1) // only if it's not already in there
					supplied.push(left);
			}
		}
		if (objDirty)
			out.push(obj);
	}
	return { tracks: out, supplied: supplied.join(', ') };
}

jQuery(document).ready(function() {
	jQuery('div[class="jamp-player"]').each(function(i, el) {
		var id = jQuery(el).attr('id');
		var tracksObj = parseTracksStr(id);
		var pl = new jPlayerPlaylist(
			{
				jPlayer: '#jplayer_' + id,
				cssSelectorAncestor: '#jcontainer_' + id
			},
			tracksObj.tracks,
			{
				supplied: tracksObj.supplied,
				swfPath: getParam(id, 'swfPath'),
				playlistOptions: {
					enableRemoveControls: true,
					autoplay: true
				},
			}
		);
	});
});
