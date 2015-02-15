<?php
	if (isset($_GET['icon'])) {
		if (preg_match("/^[0-9a-zA-Z_]+$/", $_GET['icon'])) {
			$icon_name = strtolower($_GET['icon']);
		} else { $icon_name = ''; }
	} else { $icon_name = ''; }
	
	$new_icon_size = 45;
	header ("Content-type: image/png");
	$img = imagecreatefrompng("../../style/images/armory/back/back.png");
	imagealphablending($img, true);
	imagesavealpha($img, true);
	if ($icon_name) {
		$dest = imagecreatetruecolor($new_icon_size, $new_icon_size);
		if (@file_exists("../../style/images/armory/icons/$icon_name.jpg")) {
			$icon = @imagecreatefromjpeg("../../style/images/armory/icons/$icon_name.jpg");
		} else {
			$icon = @imagecreatefromjpeg("http://static.wowhead.com/images/wow/icons/large/$icon_name.jpg");
			@imagejpeg($icon, "../../style/images/armory/icons/$icon_name.jpg", 100);
		}
		if ($icon_name) { 
			imagecopyresized($dest, $icon, 0, 0, 0, 0, $new_icon_size, $new_icon_size, 56, 56);
			imagecopy($img, $dest, 6, 6, 0, 0, $new_icon_size, $new_icon_size);
		}
	}
	
	imagepng($img);
	imagedestroy($img);
	imagedestroy($dest);
	imagedestroy($icon);
?>