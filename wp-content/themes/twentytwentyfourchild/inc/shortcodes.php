<?php
require_once get_stylesheet_directory().DS.'inc'.DS.'getters.php';
$a = getAnyPosts(
	[
		'count' => 0,
		'type' => 'arts'
	], [
		'photo' => 'Cinema',
		],
	'Stark Sansa'
);
foreach ($a as $item){
	echo $item['title'].'<br>';
}
