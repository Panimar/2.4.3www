<script>window.setInterval("refresh_s_status();", <?php echo $refresh_status_time;?>000);</script>

<div class="sb_top"><?php echo @$str[$lang]['20'];?></div>
<div class="sb_main" id="sb_main">
<script>window.setTimeout("refresh_s_status();", 1);</script>
<div style="text-align: center; width: 100%;"><img src="./style/images/ajax-loader.gif"></div>
</div>