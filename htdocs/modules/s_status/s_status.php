<?php
	header("Content-Type: content=text/html; charset=cp1251");
	include_once '../../include/config.php';
	include_once '../../include/functions.php';
	include_once '../../include/string.php';
	$page_text = '';
	$online_count = 0;
	
	session_start();
	
	if (isset($_SESSION['lang'])) {
		if (preg_match("/^[0-9]+$/", $_SESSION['lang'])) {
			@$lang = $_SESSION['lang'];
			if ($lang < '1' || $lang > $lang_count) { $lang = '1'; $_SESSION['lang'] = '1';} 
		} else { $lang = '1'; $_SESSION['lang'] = '1';}
	} else { $lang = '1'; $_SESSION['lang'] = '1';}
	
	for ($i = 1; $i <= $realm_count; $i++) {
		$fp[$i] = @fsockopen ($server_path[$i], $server_port[$i], $errno, $errstr, 0.5);
		$ConnectDB[$i] = @mysql_connect($mysql_path[$i], $mysql_login[$i], $mysql_password[$i]);
		@mysql_query("SET NAMES '$mysql_cod'", $ConnectDB[$i]);
	}
	
	$page_text .= "<center>";
	for ($i = 1; $i <= $realm_count; $i++) {
		if($fp[$i] && $ConnectDB[$i]) {
			$page_text .= @$str[$lang]['21']." ".$realm_title[$i]." <font style=\"color: #f5c570; text-shadow: #c36a00 2px 2px 5px, #c36a00 -2px -2px 5px, #c36a00 2px -2px 5px, #c36a00 -2px 2px 5px;\">".@$str[$lang]['22']."</font><br/>";
			$online = getOnlineUserCount($i);
			$online_count += $online;
			$page_text .= @$str[$lang]['23'].": <font style=\"color: #f5c570; text-shadow: #c36a00 2px 2px 5px, #c36a00 -2px -2px 5px, #c36a00 2px -2px 5px, #c36a00 -2px 2px 5px;\">$online</font><br/>";
			$uptime = getUptime($i);
			$page_text .= @$str[$lang]['24'].": <font style=\"color: #f5c570; text-shadow: #c36a00 2px 2px 5px, #c36a00 -2px -2px 5px, #c36a00 2px -2px 5px, #c36a00 -2px 2px 5px;\">".$uptime[0]."</font> ".@$str[$lang]['25']." <font style=\"color: #f5c570; text-shadow: #c36a00 2px 2px 5px, #c36a00 -2px -2px 5px, #c36a00 2px -2px 5px, #c36a00 -2px 2px 5px;\">".$uptime[1]."</font> ".@$str[$lang]['26']." <font style=\"color: #f5c570; text-shadow: #c36a00 2px 2px 5px, #c36a00 -2px -2px 5px, #c36a00 2px -2px 5px, #c36a00 -2px 2px 5px;\">".$uptime[2]."</font> ".@$str[$lang]['27']."<br/>";
			$page_text .= "<br/>";
		} else { $page_text .= @$str[$lang]['21']." ".$realm_title[$i]." <font style=\"color: #b58539; text-shadow: #9c5500 2px 2px 5px, #9c5500 -2px -2px 5px, #9c5500 2px -2px 5px, #9c5500 -2px 2px 5px;\">".@$str[$lang]['29']."</font><br/><br/>"; }
	}
	if ($realm_count > 1) {
		$page_text .= @$str[$lang]['30'].": <font style=\"color: #f5c570; text-shadow: #c36a00 2px 2px 5px, #c36a00 -2px -2px 5px, #c36a00 2px -2px 5px, #c36a00 -2px 2px 5px;\">$online_count</font><br><br>";
	}
	$page_text .= "<b style=\"font-size: 10px; font-weight: none;\">".@$str[$lang]['31']." $refresh_status_time ".@$str[$lang]['28']."</b><br>";
	for ($i = 1; $i <= $realm_count; $i++) {
		@fclose($fp[$i]);
		@mysql_close($ConnectDB[$i]);
	}
	echo $page_text;
?>