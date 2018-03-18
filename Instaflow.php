<?php

/*
 * Instaflow.php (Mar 18 2017)
 * https://github.com/codeeverywhereca/Instaflow
 * Copyright 2017, http://codeeverywhere.ca
 * Licensed under the MIT license.
 */

$username = "instagram";

function Instaflow($username) {
	
	// Cache stale?
	if( !file_exists('insta.cache') || (time() - filemtime('insta.cache') > 60 * 60 * 6 ) ) {
		
		// Make HTTP Request ...
		$opts = array(
			'http' => array('header' => "User-Agent:Mozilla/5.0 (compatible; Bot/2.1)\r\n")
		);
		$context = stream_context_create($opts);
		$html = file_get_contents("https://www.instagram.com/$username/", false, $context);
		
		// If Fails, use Cache
		if( !$html ) {
			echo file_get_contents('insta.cache');
			return -1;
		}
		
		// Parse Resp ...
		$regex = '/<script type="text\/javascript">window\._sharedData = {(.+)};<\/script>/i';
		
		// If Fails, use Cache
		if( !preg_match($regex, $html, $matches) ) {
			echo file_get_contents('insta.cache');
			return -1;
		}
		
		// Decode Resp ...
		$json = json_decode( '{' . $matches[1] . '}' );
		$json = json_encode( $json->entry_data->ProfilePage[0]->graphql->user->edge_owner_to_timeline_media->edges );
				
		// If Fails, use Cache
		if( !$json ) {
			echo file_get_contents('insta.cache');
			return -1;
		}
		
		echo $json;
		file_put_contents('insta.cache', $json);
		return 1;
	
	} else {
		
		echo file_get_contents('insta.cache');
		return 2;
	
	}
}

Instaflow($username);
?>
