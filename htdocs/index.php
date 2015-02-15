<?php
 // не трогать!
	session_start();
	
	include_once './include/config.php';
	include_once './include/functions.php';
	include_once './include/string.php';
	
	if (isset($_GET['lang'])) {
		if (preg_match("/^[0-9]+$/", $_GET['lang'])) {
			@$lang = $_GET['lang'];
			$_SESSION['lang'] = $lang;
			if ($lang < '1' || $lang > $lang_count) { $lang = '1'; $_SESSION['lang'] = '1';} 
		} else { $lang = '1'; $_SESSION['lang'] = '1';}
	}
	
	if (isset($_SESSION['lang'])) {
		if (preg_match("/^[0-9]+$/", $_SESSION['lang'])) {
			@$lang = $_SESSION['lang'];
			if ($lang < '1' || $lang > $lang_count) { $lang = '1'; $_SESSION['lang'] = '1';} 
		} else { $lang = '1'; $_SESSION['lang'] = '1';}
	} else { $lang = '1'; $_SESSION['lang'] = '1';}
	
	if (isset($_GET['page'])) {
		if (preg_match("/^[a-zA-Z0-9_]+$/", $_GET['page'])) {
			@$page = strtolower($_GET['page']);
		} else { $page = 'main'; }
	} else { $page = 'main'; }
	
	if (isset($_GET['do'])) {
		if (preg_match("/^[a-zA-Z0-9_]+$/", $_GET['do'])) {
			@$do = strtolower($_GET['do']);
		} else { $do = ''; }
	} else { $do = ''; }
	
	if (isset($_GET['realm'])) {
		if (preg_match("/^[0-9]+$/", $_GET['realm'])) {
			@$realm_num = $_GET['realm'];
			if ($realm_num < '1' || $realm_num > $realm_count) { $realm_num = '1';} 
		} else { $realm_num = '1'; }
	} else { $realm_num = '1'; }
	
	if (isset($_GET['guid'])) {
		if (preg_match("/^[0-9]+$/", $_GET['guid'])) {
			@$guid = $_GET['guid'];
		} else { $guid = '1'; }
	} else { $guid = '1'; }
	
	if (isset($_GET['vote'])) {
		if (preg_match("/^[0-9]+$/", $_GET['vote'])) {
			@$vote = $_GET['vote'];
			if ($vote < '1' || $vote > $vote_count) { $vote = '';} 
		} else { $vote = ''; }
	} else { $vote = ''; }
	
	if (isset($_SESSION['logined'][$realm_num])) { 
		@$user_logined[$realm_num] = $_SESSION['logined'][$realm_num];
		@$user_guid[$realm_num] = $_SESSION['acc_id'][$realm_num];
	} else { $user_logined[$realm_num] = '0'; }
	
	if ($page == "main"){
		$page_mtitle = @$str[$lang]['0'];
		$page_path = "./modules/main/main_page_$lang.php";
	} elseif($page == "rules"){
		$page_mtitle = @$str[$lang]['1'];
		$page_path = "./modules/rules/rules_page_$lang.php";
	} elseif($page == "about"){
		$page_mtitle = @$str[$lang]['2'];
		$page_path = "./modules/about/about_page_$lang.php";
	} elseif($page == "transfer"){
		$page_mtitle = @$str[$lang]['3'];
		$page_path = "./modules/transfer/transfer_page_$lang.php";
	} elseif($page == "license"){
		$page_mtitle = @$str[$lang]['4'];
		$page_path = "./modules/reg_page.php";
	} elseif($page == "online"){
		$page_mtitle = @$str[$lang]['5'];
		$page_path = "./modules/online_page.php";
	} elseif($page == "connect"){
		$page_mtitle = @$str[$lang]['6'];
		$page_path = "./modules/connect/connect_page_$lang.php";
	} elseif($page=="ban"){
		$page_mtitle = @$str[$lang]['7'];
		$page_path = "./modules/ban_page.php";
	} elseif($page=="reg"){
		$page_mtitle = @$str[$lang]['8'];
		$page_path = "./modules/reg_page.php";
	} elseif($page=="statistics"){
		$page_mtitle = @$str[$lang]['9'];
		$page_path = "./modules/statistics_page.php";
	} elseif($page=="tkills"){
		$page_mtitle = @$str[$lang]['10'];
		$page_path = "./modules/tkills_page.php";
	} elseif($page=="tgold"){
		$page_mtitle = @$str[$lang]['11'];
		$page_path = "./modules/tgold_page.php";
	} elseif($page=="tonline"){
		$page_mtitle = @$str[$lang]['12'];
		$page_path = "./modules/tonline_page.php";
	} elseif($page=="armory" && $do == "viewchar"){
		$page_mtitle = @$str[$lang]['13'];
		$page_path = "./modules/armory/view_character.php";
	} elseif($page=="armory" && $do == "search"){
		$page_mtitle = @$str[$lang]['13'];
		$page_path = "./modules/armory/search_character.php";
	} elseif($page=="armory"){
		$page_mtitle = @$str[$lang]['13'];
		$page_path = "./modules/armory/search_character.php";
	} elseif($page=="lk" && $do=="main"){
		$page_mtitle = @$str[$lang]['14'];
		$page_path = "./modules/lk/main_page.php";
	} elseif($page=="lk" && $do=="setpassword"){
		$page_mtitle = @$str[$lang]['14'];
		$page_path = "./modules/lk/set_password.php";
	} elseif($page=="lk" && $do=="setmail"){
		$page_mtitle = @$str[$lang]['14'];
		$page_path = "./modules/lk/set_mail.php";
	} elseif($page=="lk" && $do=="vote"){
		$page_mtitle = @$str[$lang]['14'];
		$page_path = "./modules/lk/vote_page.php";
	} elseif($page=="lk" && $do=="buy"){
		$page_mtitle = @$str[$lang]['14'];
		$page_path = "./modules/lk/buy_page.php";
	} elseif($page=="lk" && $do=="getbonuses"){
		$page_mtitle = @$str[$lang]['14'];
		$page_path = "./modules/lk/donate_page.php";
	} elseif($page=="lk" && $do=="buyitem"){
		$page_mtitle = @$str[$lang]['14'];
		$page_path = "./modules/lk/buy_item_page.php";
	}  elseif($page=="lk" && $do=="buylvl"){
		$page_mtitle = @$str[$lang]['14'];
		$page_path = "./modules/lk/buy_lvl_page.php";
	} elseif($page=="lk" && $do=="buygold"){
		$page_mtitle = @$str[$lang]['14'];
		$page_path = "./modules/lk/buy_gold_page.php";
	} elseif($page=="lk"){
		$page_mtitle = @$str[$lang]['14'];
		$page_path = "./modules/lk/main.php";
	} else {
		$page_mtitle = @$str[$lang]['0'];
		$page_path = "./modules/main/main_page_$lang.php";
	}
	for ($i = 1; $i <= $realm_count; $i++) {
		$ConnectDB[$i] = @mysql_connect($mysql_path[$i], $mysql_login[$i], $mysql_password[$i]);
		$fp[$i] = @fsockopen ($server_path[$i], $server_port[$i], $errno, $errstr, 0.5);
		@mysql_query("SET NAMES '$mysql_cod'", $ConnectDB[$i]);
	}
	$ConnectDB['cms'] = @mysql_connect($mysql_path['cms'], $mysql_login['cms'], $mysql_password['cms']);
	@mysql_query("SET NAMES '$mysql_cod'", $ConnectDB['cms']);
	 // не трогать!
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=cp1251" />
<title><?php echo $site_title;?></title>
<link type="text/css" href="./style/main.css" rel="stylesheet" />
<link href="img/template.css" rel="stylesheet" type="text/css" />

<link type="text/css" href="img/1/jquery-u.css" rel="stylesheet" />	
		<link type="text/css" href="img/1/main0000.css" rel="stylesheet" />	
		<script type="text/javascript" src="img/1/jquery-1.js"></script>
		<script type="text/javascript" src="img/1/jquery-u.js"></script>
		<script type="text/javascript">
			$(function(){

				// Accordion
				$("#accordion").accordion({ header: "h3" });
	
				// Tabs
				$('#tabs').tabs();
	

				// Dialog			
				$('#wow').dialog({
					autoOpen: false,
					width: 600,
					buttons: {
						"Ok": function() { 
							$(this).dialog("close"); 
						}, 
						"Cancel": function() { 
							$(this).dialog("close"); 
						} 
					}
				});
				
				// About Link
				$('#wow_link').click(function(){
					$('#wow').dialog('open');
					return false;
				});

				// About	
				$('#about').dialog({
					autoOpen: false,
					width: 600,
					buttons: {
						"Ok": function() { 
							$(this).dialog("close"); 
						}, 
						"Cancel": function() { 
							$(this).dialog("close"); 
						} 
					}
				});
				
				// Dialog Link
				$('#about_link').click(function(){
					$('#about').dialog('open');
					return false;
				});

				// About	
				$('#la2').dialog({
					autoOpen: false,
					width: 600,
					buttons: {
						"Ok": function() { 
							$(this).dialog("close"); 
						}, 
						"Cancel": function() { 
							$(this).dialog("close"); 
						} 
					}
				});
				
				// Dialog Link
				$('#la2_link').click(function(){
					$('#la2').dialog('open');
					return false;
				});

				// About	
				$('#comm').dialog({
					autoOpen: false,
					width: 600,
					buttons: {
						"Ok": function() { 
							$(this).dialog("close"); 
						}, 
						"Cancel": function() { 
							$(this).dialog("close"); 
						} 
					}
				});
				
				// Dialog Link
				$('#comm_link').click(function(){
					$('#comm').dialog('open');
					return false;
				});

				// About	
				$('#news').dialog({
					autoOpen: false,
					width: 600,
					buttons: {
						"Ok": function() { 
							$(this).dialog("close"); 
						}, 
						"Cancel": function() { 
							$(this).dialog("close"); 
						} 
					}
				});
				
				// Dialog Link
				$('#news_link').click(function(){
					$('#news').dialog('open');
					return false;
				});

				

				// Datepicker
				$('#datepicker').datepicker({
					inline: true
				});
				
				// Slider
				$('#slider').slider({
					range: true,
					values: [17, 67]
				});
				
				// Progressbar
				$("#progressbar").progressbar({
					value: 20 
				});
				
				//hover states on the static widgets
				$('#dialog_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); }, 
					function() { $(this).removeClass('ui-state-hover'); }
				);
				//hover states on the static widgets
				$('#about_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); }, 
					function() { $(this).removeClass('ui-state-hover'); }
				);
				//hover states on the static widgets
				$('#la2_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); }, 
					function() { $(this).removeClass('ui-state-hover'); }
				);
				//hover states on the static widgets
				$('#wow_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); }, 
					function() { $(this).removeClass('ui-state-hover'); }
				);
				//hover states on the static widgets
				$('#comm_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); }, 
					function() { $(this).removeClass('ui-state-hover'); }
				);

				//hover states on the static widgets
				$('#news_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); }, 
					function() { $(this).removeClass('ui-state-hover'); }
				);
				
			});
		</script>
			
		
		
	</head>
<body>

	<div id="container">
    	<div id="wrapper">
             <div id="inner">
             <div class="clr"></div>
		
<center>		

</center>
      <div id="menu_itc">
 <div>

  </div>
		  </div>

			 <!-- slideshow-->
            <div id="column1">
			<div id="box1-top"></div>
			<div id="box1-bot">              
            				<div class="module">
							
							
			<div>
				<div>
					<div>		
					




<? include ("stat.php") ?>
<? include ("realm.php") ?>
	</div>
				</div>
			</div>
		</div>
	           
             </div>
			 </div>                        
             <!--start right content-->
                          <div id="column2">
				<div id="box2-top"></div>
				<div id="box2-bot">           
            				<div class="moduletable">
			

	
<center><table border="1";">
<tr>
В личном кабинете вы можете приобрести вещи, уровень, золото за голосование 1 голос = 25 бонусов

</table> </center>




</div>
	           
             	</div>
              </div>                          
<div class="clr"></div>
<!-- user1 and left modules -->
<div style="width:260px;" id="leftcontent">                                       
<div class="module">    			
			<div>
				<div>
					<div>			
<h3><center>Меню</center></h3>
				<center>
				<tr><br><?php include './include/sitemenu_page.php';?>
				<h3><center>Начисление АП</center></h3>

				</center>					
<center>
<span class="article_separator">&nbsp;</span>
</center>
</p>	
					</div>
				</div>
			</div>
		</div>

     <div class="module">
            			
			<div>
				<div>

				</div>
			</div>
		</div>
			


			</div>
               

       

      <!-- user1 and left modules end -->

 	<div id="rightcontent">
			 <div id="maincontent-top"></div>
     		 <div id="maincontent">
             	
             	<table class="blog" cellpadding="0" cellspacing="0">



<tr>
	<td valign="top">
		<table width="100%"  cellpadding="0" cellspacing="0">
		<tr>
									
				

<table class="contentpaneopen">


<center>

<span class="article_separator">&nbsp;</span>
<?php include $page_path;?>
<span class="article_separator">&nbsp;</span>


<center>Всем спасибо за внимание !</center>
<span class="article_separator">&nbsp;</span>
</table>

<center>Скрипты RazArt<br>
Дизайн BurNeR
                        </center>
<span class="article_separator">&nbsp;</span>
</table>


								
		</tr>
		</table>
	</td>
</tr>


</table>


             </div> 
    
	 </div>
 

             </div>
             <!--inner end-->
				<br>
                </div>
            </div>
			
</body>
</html>