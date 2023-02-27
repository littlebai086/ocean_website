<?php
session_start();
require_once('../model/CommonSql.php');
require_once('../controllers/CommonSqlController.php');
require_once('../controllers/CommonHtmlController.php');
session_destroy();
echo "<script type='text/javascript' language='javascript'>alert('登出成功......');</script>";
echo '<meta http-equiv=REFRESH CONTENT=1;url=./Staff/StaffLogin.php>';
?>