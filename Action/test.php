<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title>測試物流網登入</title>
   <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/"> 
    <!-- Bootstrap core CSS -->
</head>
  <body class="text-center">
<!-- Modal -->
  <form method="post" action="MemberAction.php" id="loginForm"  class="form-inline" >
    <input type="text" id="state" name="state" value="add" hidden>
    <input type="text" id="id" name="id" value="" hidden>
    <input type="text" id="action" name="action" value="email" hidden>
   <div class="row justify-content-md-center">
        <div class="col-md-12">
          <h1 class="h3 mb-3 fw-normal">會員註冊</h1>
        </div>
      </div>
    </div>
        <div class="col col-lg-3">
          <input type="email" class="form-control" id="inputContactEmail" name="val" required="required" value=""  placeholder="請輸入正確的EMail">
          <input type="text" class="form-control" id="inputContactEmail" name="member_id" value=0>
          <input type="text" class="form-control" id="inputContactEmail" name="action" value="username">
        </div>
        <div class="col col-lg-2" style="text-align:left">
          <span id="contact_email_message">
          </span>  
        </div>
      </div>
      
    <button type="submit" name="emp_edit_send" class="btn btn-success">註冊</button>
  </form>
  </body>
</html>


