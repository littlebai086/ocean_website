<?php
require_once("../model/CommonSql.php");
require_once("../controllers/CommonSqlController.php");
require_once("../controllers/CommonController.php");
require_once("../controllers/CommonHtmlController.php");
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>測試海運網</title>
	<?php echo TESTransportCommonHtmlHead("【測試海運網】線上訂艙詢價|國際海運出口貨運承攬|近20年國際海運承攬經驗",false,true);?>
	<script>
	$(document).ready(function() {
		
		$(".sub1,#sub1").hover(function(){
			$("#sub1").show();
		},function(){
			$("#sub1").hide();
		});
		
		$(".sub2,#sub2").hover(function(){
			$("#sub2").show();
		},function(){
			$("#sub2").hide();
		});
		
	}); 
	
	</script>
</head>
<body>
	<?php 
	echo TESTransportCommonHtmlBody();
	list($result,$html)=TESTransportHeader(false,true);
  	echo $html;
  	if(!$result){exit;}
	?>
<div>
	<?php echo TESTransportIndex();?>
</div>
<div class="footer">
	<?php echo TESTransportFooter();?>
</div>
</body>
</html>