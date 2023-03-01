<?php
require_once("../../model/CommonSql.php");
require_once("../../model/CFSOceanPrice.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/OceanExportController.php");
require_once("../../controllers/CFSOceanPriceController.php");
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<?php echo TESTransportCommonHtmlHead("測試海運網");?>
  <script src='../../js/QuotePrice.js'></script>
  <script language="javascript">


  </script>
    <style>
      #intro {
        background-image: url(../../images/login_bg.jpg);
        background-size: cover;
        min-height: 100vh;
      }
    </style>
</head>
<body>

	<?php
    echo TESTransportCommonHtmlBody();
  	list($result,$html)=TESTransportHeader(true,false);
  	echo $html;
  	if(!$result){exit;}
  	$ocean_quote_buf=sqlSelectOceanExportOrderByQuoteRoute();
	?>
  <div>
    <div id="intro" class="bg-image shadow-2-strong">
      <div class="mask d-flex align-items-center h-100">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-10 col-md-8">
              <form method="post" action="" class="bg-white  rounded-5 shadow-5-strong p-5">
                <input type="text" name="shipment_type" id="ShipmentType" value="CFS" hidden>
                <h1 class="mb-3 fw-normal text-center">海運併櫃報價</h1>
                <div class='row'>
        			<div class='col col-3 d-flex align-items-center'>
          				<h2 class="mb-3 fw-normal">結關地點</h2>
        			</div>
              <div class='col col d-flex align-items-center'>
                  <h2 class="mb-3 fw-normal">目的港</h2>
              </div>
        		</div>
        		<div class='row'>
              <div class='col col-lg-3'>
                  <select class='form-select' id='CutOffPlaceId' name='cut_off_place_id'>
                    <?php echo getCutOffPlaceOptionCityChineseValueCityId(false);?>
                  </select>
              </div>
              <div class='col col-lg-2'>
                  <select class='form-select' id='QuoteRoute' name='ocean_export_id'>
                    <option selected>請選擇</option>
                    <?php echo getCFSOceanPriceOceanOptionQuoteRouteValueExportOptionId(false);?>
                  </select>
              </div>
        			<div class='col col-lg-3'>
          				<select class='form-select' id='DestinationCountry' name='destination_country_id'>
          				</select>
        			</div>

        			<div class='col col-lg-3'>
            			<select class='form-select' id='DestinationPort' name='destination_port_id'>
          				</select>
        			</div>
        		</div>
            <div class='col' id='PriceInformation'>
              <?php //echo getStaffOceanExportPriceListCutOffPlaceTable(197,1);?>
            </div>
            <div class='col' id='LocalChargeInformation'>
              <?php //echo getOceanExportPriceLocalChargeTable(81,"CY");?>
            </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<div class="footer">
	<?php echo TESTransportFooter();?>
</div>
</body>
</html>