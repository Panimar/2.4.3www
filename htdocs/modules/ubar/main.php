<?php
	include_once '../../include/config.php';
	include_once '../../include/functions.php';
	include_once '../../include/string.php';
	
	session_start();
	
	if (isset($_SESSION['lang'])) {
		if (preg_match("/^[0-9]+$/", $_SESSION['lang'])) {
			@$lang = $_SESSION['lang'];
			if ($lang < '1' || $lang > $lang_count) { $lang = '1'; $_SESSION['lang'] = '1';} 
		} else { $lang = '1'; $_SESSION['lang'] = '1';}
	} else { $lang = '1'; $_SESSION['lang'] = '1';}
	
	if (isset($_GET['guid'])) {
		if (preg_match("/^[0-9]+$/", $_GET['guid'])) {
			$guid = $_GET['guid'];
		} else { $guid = ''; }
	} else { $guid = ''; }
	
	if (isset($_GET['realm'])) {
		if (preg_match("/^[0-9]+$/", $_GET['realm'])) {
			$realm_num = $_GET['realm'];
			if ($realm_num < '1' || $realm_num > $realm_count) { $realm_num = '1';} 
		} else { $realm_num = '1'; }
	} else { $realm_num = '1'; }
	
	for ($i = 1; $i <= $realm_count; $i++) {
		$ConnectDB[$i] = mysql_connect($mysql_path[$i], $mysql_login[$i], $mysql_password[$i]);
		@mysql_query("SET NAMES 'cp1251'", $ConnectDB[$i]);
	}
	
	function getTextSize($f_size, $font, $text){
		$level_temp = imagettfbbox($f_size, 0, $font, $text);
		return array($level_temp[2] - $level_temp[0], $level_temp[1] - $level_temp[7]);
	}
	
	if ($guid > 0 && getCharExist($guid, $realm_num)) {
		$character_db = @mysql_fetch_array(mysql_query("SELECT * FROM `".$mysql_db_characters[$realm_num]."`.`characters` WHERE guid = '$guid'", $ConnectDB[$realm_num]));
		$guidlid = @mysql_query("SELECT guildid FROM `".$mysql_db_characters[$realm_num]."`.`guild_member` WHERE guid = '$guid'", $ConnectDB[$realm_num]);
		if (@mysql_num_rows($guidlid)) {
			$guidlid = @mysql_fetch_array($guidlid);
			$guidlname = @mysql_fetch_array(mysql_query("SELECT name FROM `".$mysql_db_characters[$realm_num]."`.`guild` WHERE guildid = '".$guidlid['guildid']."'", $ConnectDB[$realm_num]));
			$guidlname = $guidlname['name'];
		} else { $guidlname = @$str[$lang]['173'];}
		$achiv_count = mysql_query("SELECT * FROM `".$mysql_db_characters[$realm_num]."`.`character_achievement` WHERE guid = '$guid'", $ConnectDB[$realm_num]);
		if (@mysql_num_rows($achiv_count)) { $achiv_count = mysql_num_rows($achiv_count); } else { $achiv_count = 0; }
		$race = $character_db['race'];
		$class = $character_db['class'];
		$gender = $character_db['gender'];
		$level = $character_db['level'];
		$name = $character_db['name'];
		$totalKills = $character_db['totalKills'];
		$arenaPoints = $character_db['arenaPoints'];
		$totalHonorPoints = $character_db['totalHonorPoints'];
		if ($character_db['online'] == 1) {$online_s = @$str[$lang]['174'];} else {$online_s = @$str[$lang]['173'];}
		$online_time = $character_db['totaltime'];
		$online_time = floor($online_time / 86400);
		$armory_db = @mysql_query("SELECT * FROM `".$mysql_db_characters[$realm_num]."`.`character_inventory` WHERE guid = $guid AND bag=0", $ConnectDB[$realm_num]);
		$i_count = 0;
		$i_alllvl = 0;
		if ($server_type[$realm_num] == 0) {
			while($result = @mysql_fetch_array($armory_db)){
				if ($result['slot']==0) {$i_alllvl += getItemLvl($result['item_template'], $realm_num); $i_count++;}
				if ($result['slot']==1) {$i_alllvl += getItemLvl($result['item_template'], $realm_num); $i_count++;}
				if ($result['slot']==2) {$i_alllvl += getItemLvl($result['item_template'], $realm_num); $i_count++;}
				if ($result['slot']==14) {$i_alllvl += getItemLvl($result['item_template'], $realm_num); $i_count++;}
				if ($result['slot']==4) {$i_alllvl += getItemLvl($result['item_template'], $realm_num); $i_count++;}
				if ($result['slot']==8) {$i_alllvl += getItemLvl($result['item_template'], $realm_num); $i_count++;}
				if ($result['slot']==9) {$i_alllvl += getItemLvl($result['item_template'], $realm_num); $i_count++;}
				if ($result['slot']==5) {$i_alllvl += getItemLvl($result['item_template'], $realm_num); $i_count++;}
				if ($result['slot']==6) {$i_alllvl += getItemLvl($result['item_template'], $realm_num); $i_count++;}
				if ($result['slot']==7) {$i_alllvl += getItemLvl($result['item_template'], $realm_num); $i_count++;}
				if ($result['slot']==10) {$i_alllvl += getItemLvl($result['item_template'], $realm_num); $i_count++;}
				if ($result['slot']==11) {$i_alllvl += getItemLvl($result['item_template'], $realm_num); $i_count++;}
				if ($result['slot']==12) {$i_alllvl += getItemLvl($result['item_template'], $realm_num); $i_count++;}
				if ($result['slot']==13) {$i_alllvl += getItemLvl($result['item_template'], $realm_num); $i_count++;}
				if ($result['slot']==15) {$i_alllvl += getItemLvl($result['item_template'], $realm_num); $i_count++;}
				if ($result['slot']==16) {$i_alllvl += getItemLvl($result['item_template'], $realm_num); $i_count++;}
				if ($result['slot']==17) {$i_alllvl += getItemLvl($result['item_template'], $realm_num); $i_count++;}
			}
		}
		if ($server_type[$realm_num] == 1) {
			while($result = @mysql_fetch_array($armory_db)){
				if ($result['slot']==0) {$i_alllvl += getItemLvl(getIEMyth($result['item'], $realm_num), $realm_num); $i_count++;}
				if ($result['slot']==1) {$i_alllvl += getItemLvl(getIEMyth($result['item'], $realm_num), $realm_num); $i_count++;}
				if ($result['slot']==2) {$i_alllvl += getItemLvl(getIEMyth($result['item'], $realm_num), $realm_num); $i_count++;}
				if ($result['slot']==14) {$i_alllvl += getItemLvl(getIEMyth($result['item'], $realm_num), $realm_num); $i_count++;}
				if ($result['slot']==4) {$i_alllvl += getItemLvl(getIEMyth($result['item'], $realm_num), $realm_num); $i_count++;}
				if ($result['slot']==8) {$i_alllvl += getItemLvl(getIEMyth($result['item'], $realm_num), $realm_num); $i_count++;}
				if ($result['slot']==9) {$i_alllvl += getItemLvl(getIEMyth($result['item'], $realm_num), $realm_num); $i_count++;}
				if ($result['slot']==5) {$i_alllvl += getItemLvl(getIEMyth($result['item'], $realm_num), $realm_num); $i_count++;}
				if ($result['slot']==6) {$i_alllvl += getItemLvl(getIEMyth($result['item'], $realm_num), $realm_num); $i_count++;}
				if ($result['slot']==7) {$i_alllvl += getItemLvl(getIEMyth($result['item'], $realm_num), $realm_num); $i_count++;}
				if ($result['slot']==10) {$i_alllvl += getItemLvl(getIEMyth($result['item'], $realm_num), $realm_num); $i_count++;}
				if ($result['slot']==11) {$i_alllvl += getItemLvl(getIEMyth($result['item'], $realm_num), $realm_num); $i_count++;}
				if ($result['slot']==12) {$i_alllvl += getItemLvl(getIEMyth($result['item'], $realm_num), $realm_num); $i_count++;}
				if ($result['slot']==13) {$i_alllvl += getItemLvl(getIEMyth($result['item'], $realm_num), $realm_num); $i_count++;}
				if ($result['slot']==15) {$i_alllvl += getItemLvl(getIEMyth($result['item'], $realm_num), $realm_num); $i_count++;}
				if ($result['slot']==16) {$i_alllvl += getItemLvl(getIEMyth($result['item'], $realm_num), $realm_num); $i_count++;}
				if ($result['slot']==17) {$i_alllvl += getItemLvl(getIEMyth($result['item'], $realm_num), $realm_num); $i_count++;}
			}
		}
		$i_lvl = @ceil($i_alllvl/$i_count);
		
		$img = imagecreatefrompng("./img/back.png");
		imagealphablending($img, true);
		imagesavealpha($img, true);
		$img_level = imagecreatefrompng("./img/level.png");
		imagealphablending($img_level, true);
		imagesavealpha($img_level, true);
		
		$img_race = imagecreatefrompng("./img/$race-$gender.png");
		imagealphablending($img_race, true);
		imagesavealpha($img_race, true);
		$img_class = imagecreatefrompng("./img/$class.png");
		imagealphablending($img_class, true);
		imagesavealpha($img_class, true);
		$img_level = imagecreatefrompng("./img/level.png");
		imagealphablending($img_level, true);
		imagesavealpha($img_level, true);
		
		$color_name = ImageColorAllocate($img, 228, 209, 162);
		$color_name_s = ImageColorAllocate($img, 152, 113, 20);
		
		imagecopy($img, $img_race, 18, 19, 0, 0, 64, 64);
		imagecopy($img, $img_class, 89, 15, 0, 0, 36, 36);
		imagecopy($img, $img_level, 89, 51, 0, 0, 36, 36);
		
		$level_size = getTextSize(13, "./FRIZQT.TTF", "$level");
		imagettftext($img, 13, 0, 107 - $level_size[0] / 2, 76, $color_name, "./FRIZQT.TTF", "$level");
		
		$name_size = getTextSize(13, "./FRIZQT.TTF", "$name");
		imagettftext($img, 13, 0, 140, 30, $color_name, "./FRIZQT.TTF", "$name");
		
		$realm_size = getTextSize(7, "./FRIZQT.TTF", $realm_title[$realm_num]);
		imagettftext($img, 7, 0, 144 + $name_size[0], 26, $color_name, "./FRIZQT.TTF", $realm_title[$realm_num]);
		
		$server_size = getTextSize(9, "./FRIZQT.TTF", $site_path);
		imagettftext($img, 9, 0, 407 - $server_size[0], 22, $color_name, "./FRIZQT.TTF", $site_path);
		
		$guild_size = getTextSize(8, "./FRIZQT.TTF", "$guidlname");
		
		imagettftext($img, 8, 0, 135, 48, $color_name, "./FRIZQT.TTF", @$str[$lang]['165'].": $totalKills");
		imagettftext($img, 8, 0, 135, 60, $color_name, "./FRIZQT.TTF", @$str[$lang]['166'].": $arenaPoints");
		imagettftext($img, 8, 0, 135, 72, $color_name, "./FRIZQT.TTF", @$str[$lang]['167'].": $totalHonorPoints");
		imagettftext($img, 8, 0, 135, 84, $color_name, "./FRIZQT.TTF", @$str[$lang]['168'].": $achiv_count");
		imagettftext($img, 8, 0, 255, 48, $color_name, "./FRIZQT.TTF", @$str[$lang]['169'].": $guidlname");
		imagettftext($img, 8, 0, 255, 60, $color_name, "./FRIZQT.TTF", @$str[$lang]['170'].": $online_time");
		imagettftext($img, 8, 0, 255, 72, $color_name, "./FRIZQT.TTF", @$str[$lang]['171'].": $online_s");
		imagettftext($img, 8, 0, 255, 84, $color_name, "./FRIZQT.TTF", @$str[$lang]['172'].": $i_lvl");
		
		header ("Content-type: image/png");
		imagepng($img);
		
		imagedestroy($img);
		imagedestroy($img_race);
		imagedestroy($img_race_b);
		imagedestroy($img_class);
		imagedestroy($img_class_b);
		imagedestroy($img_level);
	} else {
		header ("Content-type: image/png");
		$img = imagecreate(1, 1);
		ImageColorAllocate($img, 255, 255, 255);
		imagepng($img);
		imagedestroy($img);
	}
?>