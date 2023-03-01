<?php
session_start();
require_once('../model/CommonSql.php');
require_once('../controllers/CommonSqlController.php');
require_once('../controllers/CommonHtmlController.php');
$version	= " Ver 1.3.2a";
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>
<head>
	<title>測試股份有限公司貨櫃管理系統 <?php echo $version;?></title>
	<style type="text/css">
	#switch
	{
		position:absolute;
		float:left;
		border: 2px solid; 
		color: #FFFFFF;
		background-color: #FFFF7F;
		z-index: 0;
		top:15%;
		left:20px;;
		right:10%;
	}

	#footer
	{
		position:absolute;
		bottom:5px;
		left:20px;;
		right:10px;
	}
	</style>
</head>
<body BGCOLOR=#FFFFFF LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>
<div id=switch>
<table width=100% cellpadding=5 cellspacing=5 border=0>
	<tr><td colspan=2 align=center><span style=font-size:40px;>測試股份有限公司貨櫃管理系統<br /><br /></span></td></tr>
	<tr align=center>
		<td><button onclick="location.href='../view/IsoTankIndex.php'" style=font-size:20px;>ISOTANK管理</button><br /><br /></td>
		<td width=50%><button onclick="location.href='../view/DryIndex.php'" style=font-size:20px;>乾櫃管理</button><br /><?php echo $version;?><br /></td>
	</tr>
	<tr><td colspan=2 align=center><button onclick="location.href='../view/IsoTankLogout.php'" style=font-size:20px;> 登 出 </button><br /><br /></span></td></tr>
</table>
</div>
<p>
<br />
<div id=footer>
	<hr>
	<table cellpadding=3 cellspacing=3 border=0 width=90%><tr>
		<td>Programed by Larry Lai &copy; Copyright 2018, All Rights Reserved.</td>
	</tr></table>
</div>
</body>
</html>