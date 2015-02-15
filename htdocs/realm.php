	
										<script type="text/javascript">
	function showHint(id,s)
	{
		var sdiv=document.getElementById(id);
		if(s)
			sdiv.style.display='block';
		else
			sdiv.style.display='none';
	}
</script>
											<style>
	#ja-contentsl1 .table {				
		border:2px #111111 solid;
		background:#333333;
		font-size:1.3em;
	}
	
	#ja-contentsl1 .header {
		background:#333333 url( 'img/1/header-b.gif' ) repeat-x;
		color:#cccccc;			
		text-align:center;
	}
	
	#ja-contentsl1 .row1 {
		background:url( 'img/1/00000000.htm' ) repeat bottom #1D1D1D !important;
		color:#fff;				
	}
	
	#ja-contentsl1 .row2 {
		color:#fff;	
		background:#111111 !important;	
	}
	
	#ja-contentsl1 .short {
		border-bottom:1px #333333 solid;		
		padding:2px;
		height:35px;		
		text-align:center;
		vertical-align:middle;
	}

	#ja-contentsl1 .admin-list {
		position:absolute;		
		margin:5px;
		padding:5px;
		border:1px #000 solid;
		background-color:#333333 !important;
		color:#fff;
		text-align:left;		
		z-index:1000;
	}
	
	#ja-contentsl1 .server-on {
		background:white;
	}
	
	#ja-contentsl1 .realm-name {		
		margin:2px 0px;
		text-align:center;
		color:#000;
		font-size:1em;			
		background:transparent url( "img/1/yellow_b.png" ) no-repeat top left;
		display: -moz-inline-box;
		display:inline-block;
		zoom:1;
		*display:inline			
	}
	 
	#ja-contentsl1 .realm-name div {
		margin:0px 0px 0px 5px;
		padding:0px 5px 0px 0px;
		min-width:50px;
		line-height:26px;
		background:transparent url( "img/1/yellow_c.png" ) no-repeat top right;				
	} 
	
	#ja-contentsl1 .realm-name a.wlink:link, a.wlink:visited {	
		color:#000;
		text-decoration:none;		
	}
	
	
	
                                            </style>
<? include ("stat.php") ?>

											
<table width="100%" border="0" cellpadding="0" cellspacing="0" class='table servers'>
<tr class='header'>
        <td>Тип</td>
        <td>Сервер</td>
         <td>Версия</td>     
         <td>Рейты</td>
         <td>А/О</td>
         <td>Игроков</td>
         <td>Max</td>
<td>UpTime</td>
<td>Состояние</td>
        
</tr>
<tr class="row1 servers server-on" id="server-1">
            <td class="short"><b><? echo "$tip1" ?></b>
            <td class="short">
                <div class="realm-name">
				<div><b><a class="wlink" href="" target="_blank"><font size="1" face="Georgia, Arial" color="#00FFFF"><? echo "$realmname1" ?></font></a></b>
				</div>
				</div></td>
            <td class="short"><b><font size="2" face="Georgia, Arial" color="#00FFFF"><? echo "$version1 " ?></font></b> </td>           
            <td class="short">
                <div class="realm-name rates"><div><b><font size="2" face="Georgia, Arial" color="#00FFFF"><? echo "$rate1 " ?></font></b></div></div>            </td>
            <td class="short"><b><?
mysql_connect ("$dbip:$dbport","$dblogin","$dbpass");
mysql_selectdb ("$cdb");
$online = mysql_query ("select count(*) from characters where online = 1");
$online = mysql_result ($online,0);
$allianceonline = mysql_query ("select count(*) from characters where online = 1 and race in (1,3,4,7,11)");
$allianceonline = mysql_result ($allianceonline,0);
$hordeonline = mysql_query ("select count(*) from characters where online = 1 and race in (2,5,6,8,10)");
$hordeonline = mysql_result ($hordeonline,0);
mysql_selectdb ("$rdb");
$max = mysql_query ("select max(`maxplayers`) from uptime");         
$max = mysql_result ($max,0);
echo "<font color=lightblue>$allianceonline</font>/";
echo "<font color=red>$hordeonline</font>";

?></b></td>
            <td class="short"><b><?
mysql_selectdb ("$cdb");
$online = mysql_query ("select count(*) from characters where online = 1");
$online = mysql_result ($online,0);
$allianceonline = mysql_query ("select count(*) from characters where online = 1 and race in (1,3,4,7,11,22)");
$allianceonline = mysql_result ($allianceonline,0);
$hordeonline = mysql_query ("select count(*) from characters where online = 1 and race in (2,5,6,8,9,10)");
$hordeonline = mysql_result ($hordeonline,0);
mysql_selectdb ("$rdb");
$max = mysql_query ("select max(`maxplayers`) from uptime");         
$max = mysql_result ($max,0);
echo "<font color=lightgreen>$online</font><br>";

?></b></td>
            <td class="short"><b><?
mysql_connect ("$dbip:$dbport","$dblogin","$dbpass");
mysql_selectdb ("$cdb");
$online = mysql_query ("select count(*) from characters where online = 1");
$online = mysql_result ($online,0);
$allianceonline = mysql_query ("select count(*) from characters where online = 1 and race in (1,3,4,7,11)");
$allianceonline = mysql_result ($allianceonline,0);
$hordeonline = mysql_query ("select count(*) from characters where online = 1 and race in (2,5,6,8,10)");
$hordeonline = mysql_result ($hordeonline,0);
mysql_selectdb ("$rdb");
$max = mysql_query ("select max(`maxplayers`) from uptime");         
$max = mysql_result ($max,0);
echo "$max";


?></b></td>
			<td>	<?    
mysql_connect ("$dbip:$dbport","$dblogin","$dbpass");    
mysql_select_db ("$rdb");        
$uptime = mysql_query ("select max(`starttime`) from `uptime`");        
$uptime = time()-mysql_result ($uptime,0);        
$sec = $uptime%60;        
$uptime = intval ($uptime/60);        
$min = $uptime%60;        
$uptime = intval ($uptime/60);        
$hours = $uptime%24;        
$uptime = intval($uptime/24);             
$days = $uptime;        
echo "$days д $hours ч $min м ";   
     
?></td>
<td><img src='http://worldline-wow.ru/style/images/on.png'></td>

</table>