<?php	
if( isset($_GET['user']) && !empty($_GET['user']) ) {
	
	if( !file_exists('insta.cache') || (time() - filemtime('insta.cache') > 60 * 60) ) {
		echo $json = file_get_contents('https://www.instagram.com/' . $_GET['user'] . '/media/');
		file_put_contents('insta.cache', $json);
	} else {
		echo file_get_contents('insta.cache');
	}

} else {
	echo '{ "status" : false, "message" : "no username provided" }';
}
?>
