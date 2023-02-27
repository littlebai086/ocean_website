<?php
require_once("../../model/CommonSql.php");
require_once("../../model/OceanExport.php");
require_once("../../model/OceanExportPrice.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/OceanExportController.php");
session_start();
$form="";
$submit="上傳";
if (isset($_GET['state'])){$state=$_GET['state'];}else{$state=false;}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

</head>
<body>

<main class="container-fluid" >
  <form method="post" action="" id="loginForm" enctype="multipart/form-data">
    <div class='row'>
        <div class='col col-lg-4'>
        </div>  
        <div class='col col-lg-1 d-flex align-items-center'>
          <label for='inputChineseName' class='control-label'>海運報價航線</label>
        </div>
        <div class='col col-lg-2 d-flex align-items-center'>
        <input type='text' class='form-control' id='inputOceanQuoteRoute' name='quote_route' value='test' required='required' readonly='readonly'  >
        </div>
    </div>
    <div class='row'>
        <div class='col col-lg-4'>
        </div>  
        <div class='col col-lg-1 d-flex align-items-center'>
          <label for='inputELastName' class='control-label'>附檔</label>
        </div>
        <div class='col col-lg-2'>
          <input type='file'  class='form-control'name='attachment' id='inputAttachment' required='required'>
        </div>
    </div>
    
    <div class="row">
        <div class="col col-lg-5">
        </div>	
        <div class="col col-lg-1 d-flex align-items-center">
          <input type="submit" name="emp_edit_send" class="btn btn-success" value="<?php echo $submit;?>">
         </div>
        <div class="col col-lg-1 d-flex align-items-center">
            <input type="button" value="回海運報價航線列表" onclick="location.href='./OceanExportQuoteList.php'" class="btn btn-secondary">
        </div>
     </div>
  </form>
</main>
</body>
</html>
<?php
if(isset($_POST['emp_edit_send'])){
  $postname="attachment";
  $path="../../upload/OceanExportQuotePriceExcel/123.xlsx";
  // list($result,$filename)=getUploadFile($path,$postname,false);

  // if(!$result){
  //   echo "上傳出現錯誤，請聯絡公司相關IT人員";
  //   exit;
  // }
  $state_array=array("upload_country","quote_price");
  $worksheetpage=1;
  require_once('../../PHPExcel/PHPExcel.php');
  require_once('../../PHPExcel/PHPExcel/Writer/Excel2007.php');
  require_once('../../PHPExcel/PHPExcel/IOFactory.php');
  $reader = PHPExcel_IOFactory::createReader('Excel2007');
  $reader ->setReadDataOnly(true);
  print_r($state_array);
  $PHPExcel = $reader->load($path); // 檔案名稱 需已經上傳到主機上現在的路徑
  $sheet = $PHPExcel->getSheet($worksheetpage); // 獲取最大的列號 
  $sheetData = $PHPExcel->getSheet($worksheetpage)->toArray(null,true,true,false);
  print_r($sheetData);
}

?>
