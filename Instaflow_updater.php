<?php

/*
 * Instaflow_updater.php (May 9 2020)
 * https://github.com/codeeverywhereca/Instaflow
 * Copyright 2020, http://codeeverywhere.ca
 * Licensed under the MIT license.
 */
 
// Limit Access By IP Address (uncomment below) ...
/*
if(!in_array($_SERVER['REMOTE_ADDR'], ['0.0.0.0'])):
	echo "<h1>NO ACCESS!</h1>";
	exit();
endif;
*/


function saveJSONToDisk() {
	if(!isset($_POST['pass']) or empty($_POST['pass']) or $_POST['pass'] != 'password') // <-- Set Your Password Here!
		return ['red', 'BAD PASSWORD!'];
	
	if(!isset($_POST['json']) or $_POST['json'] == '')
		return ['red', 'BAD DATA!'];
	
	json_decode($_POST['json']);
	if(json_last_error() != JSON_ERROR_NONE)
		return ['red', 'BAD JSON!'];
	
	file_put_contents('insta.json', $_POST['json']);
	return ['green', 'JSON SAVED!'];
}

if(isset($_POST['submit']))
	$action = saveJSONToDisk();
else
	$action = ['', ''];

$prevJSON = isset($_POST['json']) ? $_POST['json'] : 'paste JSON string here ...';
?>

<body>
	<h1 style="color:<?=$action[0]?>"><?=$action[1]?></h1>
	<p>Use the command below in the JS console of the Instagram profile page to copy the JSON string</p>
	<pre>copy(JSON.stringify(window._sharedData.entry_data.ProfilePage[0].graphql.user.edge_owner_to_timeline_media.edges, null, 2))</pre>
	<form action="" method="post">
		<style>
			pre { padding: 15px; background: rgb(224, 224, 224); display: inline-block; }
			input, textarea, h1, pre, p { margin: 15px; }
			input, textarea { border: 2px solid grey; font-size: 18px; }
			textarea { height: 250px; width: 950px; }
		</style>
		<div>
			<textarea name="json"><?=$prevJSON?></textarea>
		</div>
		<div>
			<input type="password" name="pass" />
		</div>
		<div>
			<input type="submit" name="submit" value="Save JSON"/></div>
	</form>
	Your IP: <?=$_SERVER['REMOTE_ADDR']?>
</body>
