<?php
	$ip = $_SERVER['REMOTE_ADDR'];  
	if(isset($_POST['submit'])) {
		$accname = mysql_real_escape_string($_POST['accname']);
		$pword = mysql_real_escape_string($_POST['pword']);
		$pwordtwo = mysql_real_escape_string($_POST['pwordtwo']);
		$accmail = mysql_real_escape_string($_POST['accmail']);
		
		$cond = 0;
		if (preg_match("/^[a-zA-Z0-9_]+$/", $accname) && strlen($accname) >= 3) {
			if (preg_match("/^[a-zA-Z0-9]+$/", $pword) && strlen($pword) >= 3 ) {
				if (preg_match("/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-zA-Z0-9]{2,4}\$/", $accmail)) {
					if (strtoupper($pwordtwo) == strtoupper($pword)) {
						$cond = 0;
						for ($i = 1; $i <= $realm_count; $i++) {if(@mysql_num_rows(mysql_query("SELECT * FROM `".$mysql_db_realmd[$i]."`.`account` WHERE username = '$accname'", $ConnectDB[$i])) != 0) { $cond = '1'; }}
						if ($cond == 0) {
							$cond = 0;
							for ($i = 1; $i <= $realm_count; $i++) {if(@mysql_num_rows(mysql_query("SELECT * FROM `".$mysql_db_realmd[$i]."`.`account` WHERE email = '$accmail'", $ConnectDB[$i])) != 0) { $cond = '1'; } }
							if ($cond == 0) {
								$cond = 0;
								for ($i = 1; $i <= $realm_count; $i++) {if(!($ConnectDB[$i])) { $cond = '1'; } }
								if ($cond == 0) {
									$sha_ass_hash = getPasswordHash($accname, $pword);
									for ($i = 1; $i <= $realm_count; $i++) {
										$query = @mysql_query("INSERT INTO `".$mysql_db_realmd[$i]."`.`account` SET username = '$accname',  sha_pass_hash = '$sha_ass_hash', email = '$accmail', expansion = '2', last_ip = '$ip'", $ConnectDB[$i]);
									}
									$reg_page = 
										"<br>
										<center>".@$str[$lang]['74']." ".@$str[$lang]['75']."
										<br>";
								} else { $reg_page = 
										"<br>
										<center>".@$str[$lang]['73']." ".@$str[$lang]['65']."
										<br>";}
							} else { $reg_page = 
									"<br>
									<center>".@$str[$lang]['72']." ".@$str[$lang]['65']."
									<br>";}
						} else { $reg_page = 
							"<br>
							<center>".@$str[$lang]['71']." ".@$str[$lang]['65']."
							<br>";}
					} else { $reg_page = 
							"<br>
							<center>".@$str[$lang]['70']." ".@$str[$lang]['65']."
							<br>";}
				} else { $reg_page = 
						"<br>
						<center>".@$str[$lang]['69']." ".@$str[$lang]['65']."
						<br>";}
			} else { $reg_page = 
					"<br>
					<center>".@$str[$lang]['68']." ".@$str[$lang]['65']."
					<br>";}
		} else { $reg_page = 
				"<br>
				<center>".@$str[$lang]['67']." ".@$str[$lang]['65']."
				<br>";}
	} else {
		$reg_page =
			"<br>
			<center>
				<form method=\"post\" style=\"line-height:11px;\">
					".@$str[$lang]['60'].":<br><br>
					<input type=\"text\" class=\"input_textbox\" name=\"accname\"><br><br>
					".@$str[$lang]['61'].":<br><br>
					<input type=\"password\" class=\"input_textbox\" name=\"pword\"><br><br>
					".@$str[$lang]['62'].":<br><br>
					<input type=\"password\" class=\"input_textbox\" name=\"pwordtwo\"><br><br>
					".@$str[$lang]['63'].":<br><br>
					<input type=\"text\" class=\"input_textbox\"  name=\"accmail\"> <br><br>
					<a href=\"?page=rules\" target=\"_blank\">".@$str[$lang]['1']."</a><br><br>
					<input type=\"submit\" class=\"input_button\" value=\"".@$str[$lang]['64']."\" name=\"submit\">
				</form>
			</center>
			";
	}
 ?> 
<div class="mb_top"><?php echo @$str[$lang]['8'];?></div>
<div class="mb_main">
	<?php echo $reg_page;?>
</div>
<div class="mb_down"></div>