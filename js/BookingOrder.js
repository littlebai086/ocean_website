
function hs_code_format(){
  if(/^[0-9]{4,10}$/.test($('#inputHsCode').val())){
    $('#hs_code_message').html(format_true_img());
    return true;
  }else{
    $('#hs_code_message').html("<p class='text-danger'>HS CODE為至少4位數字</p>");
    return false;
  }
}

function cargo_weight_format(){
  if(/^[0-9]{0,5}$/.test($('#inputCargoWeight').val())){
    if(!$('#inputCargoWeight').val()){
      $('#cargo_weight_message').html("<p class='text-danger'>不得為空</p>");
      return false;
    }else if(parseInt($('#inputCargoWeight').val())!=0){
      $('#cargo_weight_message').html(format_true_img());
      return true;
    }else{
      $('#cargo_weight_message').html("<p class='text-danger'>不得為0</p>");
      return false;
    }
  }else{
    $('#cargo_weight_message').html("<p class='text-danger'>貨重最多為5位數字</p>");
    return false;
  }
}

function volume_format(){
  if(/^[0-9]{0,5}$/.test($('#inputVolume').val())){
    if(!$('#inputVolume').val()){
      $('#volume_message').html("<p class='text-danger'>不得為空</p>");
      return false;
    }else if(parseInt($('#inputVolume').val())!=0){
      $('#volume_message').html(format_true_img());
      return true;
    }else if(parseInt($('#inputVolume').val())==0){
      $('#volume_message').html("<p class='text-danger'>不得為0</p>");
      return false;
    }
  }
}

function quantity_format(){
  if(!$('#inputQuantity').val()){
      $('#quantity_message').html("<p class='text-danger'>不得為空</p>");
      return false;
  }else if(parseInt($('#inputQuantity').val())!=0){
    $('#quantity_message').html(format_true_img());
    return true;
  }else if(parseInt($('#inputQuantity').val())==0){
    $('#quantity_message').html("<p class='text-danger'>不得為0</p>");
    return false;
  }
}

function un_no_format(){
  if($('#inputDangerousGoods').val()=="危險品"){
    if(/^[0-9]{4}$/.test($('#inputUnNo').val())){
      $('#un_no_message').html(format_true_img());
      return true;
    }else{
      $('#un_no_message').html("請輸入4位數字");
      return false;
    }
  }else if($('#inputDangerousGoods').val()=="非危險品"){
    return true;
  }
}

function cabinet_volumet_format(){
  var sum=0
  var num=0
  $("input[name='cabinet_volume[]']").each(function(key){
    $($("input[name='cabinet_volume[]']")[key]).val($($("input[name='cabinet_volume[]']")[key]).val().replace(/[^\d]/g, ""));
    if ($($("input[name='cabinet_volume[]']")[key]).val().length>1){
      $($("input[name='cabinet_volume[]']")[key]).val($($("input[name='cabinet_volume[]']")[key]).val().replace(/^[0]+/g, ""));
    }
      if ($(this).val()==""){
         num=0;
      }else{
        num=parseFloat($($("input[name='cabinet_volume[]']")[key]).val());
      }
      sum+=num;
    }
  ) 
  if (sum>0){
    $('#cabient_volume_message').html(format_true_img());
    return true;
  }else{
    $('#cabient_volume_message').html("<p class='text-danger'>總櫃量不得為0</p>");
    return false;
  }
}

function terms_of_trade_format(){
  //console.log($("input[name='terms_of_trade']:checked").val());
  if($("input[name='terms_of_trade']:checked").val()=="EX-WORK"){
    $("#terms_of_trade_word").html("提貨地址");
    $("#terms_of_trade_remark").html("<input type='text' class='form-control' name='terms_of_trade_remark'>");
  }else if($("input[name='terms_of_trade']:checked").val()=="DDU" || 
         $("input[name='terms_of_trade']:checked").val()=="DDP"){
    $("#terms_of_trade_word").html("送貨地址");
    $("#terms_of_trade_remark").html("<input type='text' class='form-control' name='terms_of_trade_remark'>");
  }else{
    $("#terms_of_trade_word").html("");
    $("#terms_of_trade_remark").html("");
  }
}

function QuoteExportPriceShowDecide(){
  if(cabinet_volumet_format() && $("#DestinationPort").val()!=null){
    cabinet_volumes=$("input[name='cabinet_volume[]']").map(function(){return $(this).val();}).get();
    cut_off_place_id=$("#inputCutOffPlaceId").val();
    destination_port_id=$("#DestinationPort").val();
    AjaxQuoteExportPriceSearch(cabinet_volumes,cut_off_place_id,destination_port_id);
  }else{
    $("#OceanExportPriceShow").empty();
    $("#inputOceanExportPriceData").val("");
  }
}

$(document).ready(function(){
  if ($("#inputDangerousGoods").val()=="危險品" && $("#file_num").val()==0){
    $("#inputAttachments").attr("required", "required");
  }
  if($('#error').val()=="1"){
    hs_code_format();
    cargo_weight_format();
    un_no_format();
    cabinet_volumet_format();
  }

  $('#inputUnNo').keyup(function(){
    $('#inputUnNo').val($('#inputUnNo').val().replace(/[^\d]/g, ""));
      if ($('#inputUnNo').val().length>4){
        $('#inputUnNo').val($('#inputUnNo').val().substring(0,4));
      }
    return un_no_format();
  })
  $('#inputDangerousGoods').change(function(){
    if ($("#inputDangerousGoods").val()=="危險品"){
      $("#class_div").html('<label for="inputClass" class="control-label"><font color="red">*</font>CLASS</label>');
      $("#class_select_div").html('<select id="selectClass" class="form-select" name="class"><option>1</option><option>2</option><option selected>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option></select>');
      $("#un_no_div").html('<label for="inputUnNo" class="control-label"><font color="red">*</font>UN.NO.</label>');
      $("#un_no_input_div").html('<input type="text" class="w-50 form-control" id="inputUnNo" name="un_no" required="required"><small class="text-muted">* 請輸入數字4碼 </small>');
      $("#attachments_label_div").html('<label for="inputAttachments" class="control-label"><font color="red">*</font>附檔</label>');
      $("#inputAttachments").attr("required", "required");
      $('#inputUnNo').keyup(function(){
        $('#inputUnNo').val($('#inputUnNo').val().replace(/[^\d]/g, ""));
        if ($('#inputUnNo').val().length>4){
          $('#inputUnNo').val($('#inputUnNo').val().substring(0,4));
        }
        return un_no_format();
      })
    }else if($("#inputDangerousGoods").val()=="非危險品"){
      $("#class_div").empty();
      $("#class_select_div").empty();
      $("#un_no_div").empty();
      $("#un_no_input_div").empty();
      $("#un_no_message").empty();
      $("#attachments_label_div").html('<label for="inputAttachments" class="control-label">附檔</label>');
      $("#inputAttachments").removeAttr("required");
    }
  })

  $('#inputHsCode').keyup(function(){
    $('#inputHsCode').val($('#inputHsCode').val().replace(/[^\d]/g, ""));
    if ($('#inputHsCode').val().length>10){
      $('#inputHsCode').val($('#inputHsCode').val().substring(0,10));
    }
    return hs_code_format();
  })
  $('#inputCargoWeight').keyup(function(){
    $('#inputCargoWeight').val($('#inputCargoWeight').val().replace(/[^\d]/g, ""));
    if ($('#inputCargoWeight').val().length>5){
      $('#inputCargoWeight').val($('#inputCargoWeight').val().substring(0,5));
    }
    return cargo_weight_format();
  })
  $('#inputVolume').keyup(function(){
    $('#inputVolume').val($('#inputVolume').val().replace(/[^\d]/g, ""));
    if ($('#inputVolume').val().length>5){
      $('#inputVolume').val($('#inputVolume').val().substring(0,5));
    }
    return volume_format();
  })

  $('#inputQuantity').keyup(function(){
    return quantity_format();
  })

  $("input[name='cabinet_volume[]']").keyup(function(){
    QuoteExportPriceShowDecide();
    return cabinet_volumet_format();
  })

  $("input[name='cabinet_volume[]']").mouseover(function(){
    $("input[name='cabinet_volume[]']").each(function(key){
      if ($(this).val()==""){
         $($("input[name='cabinet_volume[]']")[key]).val(0);
      }
    }) 
  })

  $("input[name='cabinet_volume[]'").bind('keyup mouseup', function () {
    QuoteExportPriceShowDecide();           
  });

  $("input[name='terms_of_trade']").click(function(){
    return terms_of_trade_format();
  })
  $('#DestinationCountry').change(function(){
    QuoteExportPriceShowDecide();
  })
  $('#inputCutOffPlaceId').change(function(){
    QuoteExportPriceShowDecide();
  })
  $('#inputAttachments').change(function () {
    $("#FileList").empty();
    if(InputFileFileListShowFile()){
      $('#inputOldAttachments')[0].files=$('#inputAttachments')[0].files;
    }else{
      $('#inputAttachments')[0].files=$('#inputOldAttachments')[0].files;
      fragment=getFileArrayShowFileListText(Array.from($('#inputAttachments')[0].files));
      $("#FileList").append(fragment);
    }
  });
  $("#BookingOrderForm").submit(function(e){
    if($("#ShipmentType").val()=="CY" && hs_code_format() && cargo_weight_format() && un_no_format() &&cabinet_volumet_format()){
      sessionStorage.setItem("myhtml", $("#BookingOrderForm").html());
      return true;
    }else if($("#ShipmentType").val()=="CFS" && hs_code_format() && cargo_weight_format() &&　volume_format() && quantity_format()){
      sessionStorage.setItem("myhtml", $("#BookingOrderForm").html());
      return true;
    }
    alert("填入資料不符合格式或者是空白");
    return false;
    //sessionStorage.setItem("myhtml", $("#BookingOrderForm").html());
  });

});
function FileUploadDivShow(key,filename){
  fragment ="<div class='row'><div class='col col-lg-1 d-flex align-items-center'></div>";
  fragment +="<div class='col col d-flex align-items-start'>";
  fragment +="<button type='button' id='delfile"+key+"' class='btn btn-secondary' onclick=\"del_attachment("+key+")\">"+filename+" "+getDelUploadFileIcon();
  fragment +="</div></div>";
  return fragment;
}

function getFileListNameNotRepart(arr,arr1){
  new_arr=$.merge(arr,arr1);
  return removeDuplicates(new_arr, "name");
}

function InputFileFileListShowFile(){
    extension_allows = ["pdf", "docx", "doc", "jpg", "jpeg","png","gif"];
    var fp = $("#inputAttachments");
    var lg = fp[0].files.length; // get length
    var old_lg =$("#inputOldAttachments")[0].files.length; // get length
    var items = fp[0].files;
    var fragment = "";
    total=parseFloat($('#file_num').val())+parseFloat(lg)+parseFloat(old_lg);
    if (lg > 0 && total<=5) {
      for (var i = 0; i < lg; i++) {
        var fileName = items[i].name; // get file name
        var FileExtension1=getFileExtension1(fileName);
        if(jQuery.inArray( FileExtension1, extension_allows )!== -1){
          fragment +=FileUploadDivShow(i,fileName);
        }else{
          alert("格式限定：DOC、PDF、JPEG，請重新上傳檔案");
          return false;
        }
      }
    }else if(total>5){
      alert("上傳數量不可超過5個(包含原本檔案)");
      return false;
    }
    if(old_lg>0 && total<=5){
      var arr=Array.from($('#inputOldAttachments')[0].files);
      new_arr=getFileListNameNotRepart(arr,Array.from(items));
      fragment=getFileArrayShowFileListText(new_arr);
      $('#inputAttachments')[0].files=new FileListItems(new_arr);
    }
    $("#FileList").append(fragment);
    return true;
}

  function del_attachment(key){
    $("#FileList").empty();
    var attachments=$('#inputAttachments')[0].files;
    var arr=Array.from(attachments);
    arr.splice(key,1);
    $('#inputAttachments')[0].files=new FileListItems(arr);
    $('#inputOldAttachments')[0].files=new FileListItems(arr);
    fragment=getFileArrayShowFileListText(arr);
    $("#FileList").append(fragment);
  }

  function getFileArrayShowFileListText(arr){
    var fragment="";
    $.each(arr,function(key,value){
      var fileName = value["name"]; // get file name
      var FileExtension1=getFileExtension1(fileName);
      fragment +=FileUploadDivShow(key,fileName);
    });
    return fragment;
  }
