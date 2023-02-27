<?php
session_start();
require_once('../model/CommonSql.php');
require_once('../controllers/CommonSqlController.php');
require_once('../controllers/CommonHtmlController.php');
?>
<html>
<?php 
echo getDryHtmlTitleHead();
?>
<body>
<?php
echo getDryHeaderHtml(true);
?>
<center>
<table border=0 cellspacing=5 cellpadding=5 width=90%>
<?php
echo getDryIndexContentHtml();

?>
</table>
</center>

<?php
echo getDryFooterHtml(true);
?>

</body>
</html>