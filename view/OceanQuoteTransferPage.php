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
	<?php TESTransportCommonHtmlHead("測試海運網",false);?>
</head>
<body>
<?php 
	echo TESTransportCommonHtmlBody();
	list($result,$html)=TESTransportHeader(false,true);
  	//echo $html;
  	if(!$result){exit;}
  	if (isset($_SESSION['username'])){
  		echo header("Location:./index.php");
  	}else{
  		echo $html;
		echo '<script type="text/javascript">$(document).ready(function(){$( "#popupwidowNotLoginQuoteMessage" ).click();});</script>';
  	}
	?>
<div>
	<?php echo TESTransportIndex();?>
</div>
<div class="footer">
	<?php echo TESTransportFooter();?>
</div>
</body>
</html>