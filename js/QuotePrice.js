function Record(){
    $.ajax({
      type: 'POST',
      url: '../../Action/RecordAction.php',
      data: {
        action: 'record',
        shipment_type: $("#ShipmentType").val(),
        ocean_export_id: $("#QuoteRoute").val(),
        destination_port_id: $("#DestinationPort").val(),
        dataType: "json" 
      },
      success:function(item){
        //item=JSON.parse(item);
      },
      cache:false,
      ifModified :true,
      async:false,
      error:function(item){
        result=false;
      }
    })
    }
function PriceInformationData(){
  $("#PriceInformation").empty();
  $("#LocalChargeInformation").empty();
  if($("#QuoteRoute").val()!=undefined && $("#DestinationPort").val()!=null){
    AjaxQuoteRoutePriceDestinationPortCutOffPlaceId();
    AjaxOceanQuoteLocalCharge();
    Record();
  }
}

$(document).ready(function(){
  $('#QuoteRoute').change(function(){
    PriceInformationData();
  })
  $('#DestinationCountry').change(function(){
    PriceInformationData();
  })
  $('#DestinationPort').change(function(){
    PriceInformationData();
  })
  $('#CutOffPlaceId').change(function(){
    PriceInformationData();
  })
});