<?php
/*
 * Instaflow.php (Dec 30 2017)
 * https://github.com/codeeverywhereca/Instaflow
 * Copyright 2017, http://codeeverywhere.ca
 * Licensed under the MIT license.
 */

if( isset($_GET['user']) && !empty($_GET['user']) ) {
	
	if( !file_exists('insta.cache') || (time() - filemtime('insta.cache') > 60 * 60 * 3) ) {
		
		$html = file_get_contents('https://www.instagram.com/' . $_GET['user']);
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
	
} else {
	echo '{ "status" : false, "message" : "no username provided" }';
}

?>
