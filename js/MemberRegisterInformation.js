function ajax_member_username(){
  if($("#inputUsername").val()){
    $.ajax({
      type: 'POST',
      url: '../../Action/MemberAction.php',
      data: {
        action: 'username',
        val: $("#inputUsername").val(),
        member_id: $("#member_id").val(),
        dataType: "json" 
      },
      success:function(item){
        item=JSON.parse(item);
        if(item=="Y"){
          $('#username_message').html("<p class='text-danger'>已有此帳號存在</p>");
          result=false;
        }else{
          result=true;
        }
      },
      cache:false,
      ifModified :true,
      async:false,
      error:function(item){
        result=false;
      }
    })
    return result;
  }
}
function ajax_username_verification_code(){
  if($("#inputUsername").val()){
    $.ajax({
      type: 'POST',
      url: '../../Action/MemberAction.php',
      data: {
        action: 'username_verification_code',
        val: $("#inputUsername").val(),
        member_id: $("#member_id").val(),
        dataType: "json" 
      },
      success:function(item){
        item=JSON.parse(item);
        if(item=="Y"){
          $('#username_verification_code_message').html("<p class='text-success'>驗證碼已寄送"+$("#inputUsername").val()+"，效期為10分鐘</p>");
          result=true;
        }else{
          $('#username_verification_code_message').html("<p class='text-danger'>驗證碼寄送失敗</p>");
          result=false;
        }
      },
      cache:false,
      ifModified :true,
      async:false,
      error:function(item){
        result=false;
      }
    })
    return result;
  }
}
function ajax_member_contact_email(){
  if($("#inputContactEmail").val()){
    $.ajax({
      type: 'POST',
      url: '../../Action/MemberAction.php',
      data: {
        action: 'email',
        val: $("#inputContactEmail").val(),
        member_id: $("#member_id").val(),
        dataType: "json" 
      },
      success:function(item){
        item=JSON.parse(item);
        if(item=="Y"){
          $('#contact_email_message').html("<p class='text-danger'>已有此Email存在</p>");
          result= false;
        }else{
          result= true;
        }
      },cache:false,
      ifModified :true,
      async:false,error:function(item){
      result= false;
      }
    })
  return result;
  }
}

function address_readonly_attr(){
  if ($('#city_id').val()==0){
    $("#area_id").empty();
    $("#inputCompanyAddress").attr("readonly", "readonly");
  }else if ($('#area_id').val()==0){
    $("#inputCompanyAddress").attr("readonly", "readonly");
  }else{
    $("#inputCompanyAddress").removeAttr("readonly");
  }
}

function username_verification_code_onclick(){
  PopupWidowClick("verification_code");
  return ajax_username_verification_code();
}

function username_verification_code_disbled_attr(){
  if(username_format() && ajax_member_username()){
    $("#buttonUsernameVerificationCode").removeAttr("disabled");
    return true;
  }
  $("#buttonUsernameVerificationCode").attr("disabled", "disabled");
  $('#inputUsernameVerificationCode').val("");
  return false;
}

$(document).ready(function(){
  if($('#error').val()=="1" && $('#state').val()=="add"){
    ajax_member_contact_email();
    tax_id_number_format();
    company_chinese_format();
    company_english_format();
    contact_name_format();
    contact_company_phone_format();
    contact_company_fax_format();
    contact_email_format();
    username_verification_code_disbled_attr();
  }else if($('#state').val()=="update"){
    ajax_member_contact_email();
    tax_id_number_format();
    company_chinese_format();
    company_english_format()
    contact_name_format();
    contact_company_phone_format();
    contact_company_fax_format();
    contact_email_format();
  }

  $('#city_id').change(function(){
    if($("#city_id").val()!=0){
      $.ajax({
        type: 'GET',
        url: '../../Action/CommonAction.php',
        data: {
          action: 'city_select',
          val: $("#city_id").val(),
          dataType: "json" 
        },
        success:function(item){
          $("#area_id").empty();
          //$('#area_id').append("<option value=0>請選擇</option>");
          arrays=JSON.parse(item);
          $.each(arrays, function (key,array) {
            $.each(array, function (key2,value) {
              $('#area_id').append("<option value="+key2+">"+value+"</option>");
            });
          });
        }
      })
    }
    address_readonly_attr();
  })

  $('#area_id').change(function(){
    address_readonly_attr();
  })
            
  $('#inputUsername').keyup(function(){
    if($('#state').val()=="add"){
      $('#inputContactEmail').val($('#inputUsername').val());
      contact_email_format();
      ajax_member_contact_email();
      return username_verification_code_disbled_attr();
    }
  })

  $('#inputPassword').keyup(function(){
    return password_format();
  })
  $('#inputConfirmPassword').keyup(function(){
    return password_format();
  })
  $('#inputTaxIdNumber').keyup(function(){
    $('#inputTaxIdNumber').val($('#inputTaxIdNumber').val().replace(/[^\d]/g, ""));
    if ($('#inputTaxIdNumber').val().length>8){
      $('#inputTaxIdNumber').val($('#inputTaxIdNumber').val().substring(0,8));
    }
    return tax_id_number_format();
  })
  $('#inputCompanyChinese').keyup(function(){
    return company_chinese_format();
  })
  $('#inputCompanyEnglish').keyup(function(){
    return company_english_format();
  })
  $('#inputContactName').keyup(function(){
    return contact_name_format();
  })
  $('#inputContactCellphone').keyup(function(){
    $('#inputContactCellphone').val($('#inputContactCellphone').val().replace(/[^\d]/g, ""));
    return contact_cellphone_format();
  })
  $('#inputContactCompanyPhone').keyup(function(){
    $('#inputContactCompanyPhone').val($('#inputContactCompanyPhone').val().replace(/\({2,}/g, "(").replace(/\){2,}/g, ")").replace(/\-{2,}/g, "-").replace(/[^\d()-]/g, ""));
    $('#inputContactCompanyPhone').val($('#inputContactCompanyPhone').val().replace(" ", ""));
    return contact_company_phone_format();
  })

  $('#inputContactCompanyExtension').keyup(function(){
    $('#inputContactCompanyExtension').val($('#inputContactCompanyExtension').val().replace(/[^\d]/g, ""));
    $('#inputContactCompanyExtension').val($('#inputContactCompanyExtension').val().replace(" ", ""));
  })
  $('#inputContactCompanyFax').keyup(function(){
    $('#inputContactCompanyFax').val($('#inputContactCompanyFax').val().replace(/\({2,}/g, "(").replace(/\){2,}/g, ")").replace(/\-{2,}/g, "-").replace(/[^\d()-]/g, ""));
    $('#inputContactCompanyFax').val($('#inputContactCompanyFax').val().replace(" ", ""));
    return contact_company_fax_format();
  })
  $('#inputContactCompanyFaxExtension').keyup(function(){
    $('#inputContactCompanyFaxExtension').val($('#inputContactCompanyFaxExtension').val().replace(/[^\d]/g, ""));
    $('#inputContactCompanyFaxExtension').val($('#inputContactCompanyFaxExtension').val().replace(" ", ""));
  })
  $('#inputContactEmail').keyup(function(){
    contact_email_format();
    ajax_member_contact_email();
  })
  $("form").submit(function(e){
    if ($('#state').val()=="add"){
      if(ajax_member_username() && ajax_member_contact_email() && username_format() && password_format() && confirm_password_format() &&
        tax_id_number_format() && company_chinese_format() && company_english_format() && contact_name_format() && contact_cellphone_format() && contact_company_phone_format() && contact_company_fax_format() && contact_email_format()){
        return true;
      }
    }else if($('#state').val()=="update"){
      if(ajax_member_contact_email() && username_format() &&  contact_cellphone_format() &&
        tax_id_number_format() && company_chinese_format() && company_english_format() && contact_name_format() && contact_company_phone_format() && contact_company_fax_format() && contact_email_format()){
        return true;
      }
    }else{
      return true;
    }
    alert("填入資料不符合格式或者是必填欄位空白");
    return false;
  });
});