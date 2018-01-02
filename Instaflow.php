<?php

/*
 * Instaflow.php (Jan 2 2017)
 * https://github.com/codeeverywhereca/Instaflow
 * Copyright 2017, http://codeeverywhere.ca
 * Licensed under the MIT license.
 */
	
$username = "instagram";

if( !file_exists('insta.cache') || (time() - filemtime('insta.cache') > 60 * 60 * 6) ) {
	
	$html = file_get_contents('https://www.instagram.com/' . $username);
	$regex = '/<script type="text\/javascript">window\._sharedData = {(.+)};<\/script>/i';
	
	if( !preg_match($regex, $html, $matches) ) {
		
		echo '{ "status" : false, "message" : "no matches" }';
		
	} else {
		
		$json = json_decode( '{' . $matches[1] . '}' );
		echo $json = json_encode( $json->entry_data->ProfilePage[0]->user );
		
		file_put_contents('insta.cache', $json);
	}

} else {
	
	echo file_get_contents('insta.cache');

}
?>
