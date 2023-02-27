<?php
require_once("../../model/CommonSql.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
session_start();
if(isset($_SESSION['member_id'])){$member_id=$_SESSION['member_id'];}else{$member_id=0;}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<?php echo QATransportCommonHtmlHead("洋宏海運網");?>
  <script language="javascript">
    function Record(ocean_export_id){
    $.ajax({
      type: 'POST',
      url: '../../Action/RecordAction.php',
      data: {
        action: 'record',
        ocean_export_id: ocean_export_id,
        dataType: "json" 
      },
      success:function(item){
        item=JSON.parse(item);
      },
      cache:false,
      ifModified :true,
      async:false,
      error:function(item){
        result=false;
      }
    })
    }

  </script>
    <style>
      #intro {
        background-image: url(../../images/b6.jpg);
        background-size: cover;
        height: 100vh;
      }
    </style>
</head>
<body>

	<?php 
  	list($result,$html)=QATransportHeader(true,true);
  	echo $html;
  	if(!$result){exit;}
  	$ocean_quote_buf=sqlSelectOceanExportOrderByQuoteRoute();
	?>
    <div id="intro" class="bg-image shadow-2-strong">
      <div class="mask d-flex align-items-center h-100">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-10 col-md-8">
              <form method="post" action="" class="bg-white  rounded-5 shadow-5-strong p-5">
                <h1 class="mb-3 fw-normal text-center">海運整櫃出口報價</h1>
                <div class='row'>
        			<div class='col col-auto d-flex align-items-center'>
          				<h2 class="mb-3 fw-normal">服務港口據點</h1>
        			</div>
        		</div>
        		<div class='row'>
        			<div class='col col-lg-3'>
          				<select class='form-select' id='DestinationCountry' name='destination_country_id'>
            				<option selected>請選擇</option>
            				<?php echo getDestinationCountryOptionDestinationCountryEnglishValueCountryId(false);?>
          				</select>
        			</div>
        			<div class='col col-lg-3'>
            			<select class='form-select' id='DestinationPort' name='destination_port_id'>
          				</select>
        			</div>
        		</div>
        		<div class='col'>
                    <h2 class="mb-3 fw-normal">點擊報價單下載</h1>
        		</div>
        		<?php
        		$table="";
                foreach ($ocean_quote_buf as $ocean_quote_array){
                    $table.="<div class='col'><h4>";
                    $table.="<a download href='../../upload/OceanExportQuote/".$ocean_quote_array['attachment']."' onclick='Record(".$ocean_quote_array['ocean_export_id'].")'>".$ocean_quote_array['quote_route']."</a>";
                    //現在暫時開放會員直接可下載報價，若不開放在將以下註解拿掉然後將上方連結註解
                    // if(isset($_SESSION['username'])){
                    //     if($pass==1){
                    //         $table.="<a download href='../../upload/OceanExportQuote/".$ocean_quote_array['attachment']."'>".$ocean_quote_array['quote_route']."</a>";
                    //     }elseif($pass==0 || $pass==2 || $pass==3){
                    //         $table.="<a href='javascript: PopupWidowClick(\"NotPassQuoteMessage\");'>".$ocean_quote_array['quote_route']."</a>";
                    //     }
                        
                    // }else{
                    //     $table.="<a href='javascript: PopupWidowClick(\"NotLoginQuoteMessage\");'>".$ocean_quote_array['quote_route']."</a>";
                    // }
                    $table.="</h4></div>";
                }
        		
                echo $table;
      			?>
        		</div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
<div class="footer">
	<?php echo QATransportFooter();?>
</div>
</body>
</html>