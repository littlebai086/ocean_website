<?php
/**
 * 1.轉入隨便一個網址為錯誤網頁
 *
 * @author Peter Chang
 *
 * @return string
 */
function getErrorUrlPage(){
    $result="<script language='javascript'>document.location.href='https://test.com.tw/qat_logistics/error';</script>";
    return $result;
}
/**
 * 1.Bootstrap5 共用Jquery匯入這必須用在最尾
 *
 * @author Peter Chang
 *
 * @return string
 */
function getBoostrapBlundleJsImportEnd(){
    $result="
<script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js' integrity='sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p' crossorigin='anonymous'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js' integrity='sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ' crossorigin='anonymous'></script>
";
    return $result;
}
/**
 * 1.共用Jquery於SEO廣告代理商數據統計使用
 *
 * @author Peter Chang
 *
 * @return string
 */
function getGoogleTagManagerJsImportHeader(){
    $result="
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-K4ZQ8SC');</script>
<!-- End Google Tag Manager -->
";
    return $result;
}
/**
 * 1.共用Jquery於SEO廣告代理商數據統計使用
 *
 * @author Peter Chang
 *
 * @return string
 */
function getGoogleTagManagerJsImportBody(){
    $result="
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src='https://www.googletagmanager.com/ns.html?id=GTM-K4ZQ8SC'
height='0' width='0' style='display:none;visibility:hidden'></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
";
    return $result;
}
/**
 * 1.員工頁面共用的HtmlHead
 *
 * @author Peter Chang
 * 
 * @param string $title 網頁標題文字
 * 
 * @param boolean $parent_link 判斷資料夾是幾層
 *
 * @return string
 */
function QATransportStaffCommonHtmlHead($title,$parent_link=true,$navbar_top_fixed=true){
    $navbar_result="";
    if ($parent_link){
        $parent_href="../../";
    }else{
        $parent_href="../";
    }
    $result="
    <meta http-equiv='content-type' content='text/html;charset=utf-8' />
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <META NAME='Keywords' CONTENT='線上、海運、船期查詢、訂艙'>
    <META NAME='Description' CONTENT='提供網路線上海運船期查詢、訂艙。'>
    <META NAME='Author' CONTENT='測試股份有限公司'>
    <META NAME='Copyright' CONTENT='本網頁著作權屬測試股份有限公司所有'>
    <meta name='abstract' content='網路線上海運船期查詢、訂艙'>
    <meta content='網路線上海運船期查詢、訂艙'>
    <LINK rev='made' href='mailto:peter777200067@gmail.com'>
    <link rev='made' href='http://www.test.com.tw'>
    <title>".$title."</title>
    ".$navbar_result."
    <link href='".$parent_href."css/IconAHrefShow.css' rel='stylesheet' type='text/css'>
    <link href='".$parent_href."assets/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='".$parent_href."css/CommonCss.css' rel='stylesheet'>
    <link rel='canonical' href='https://getbootstrap.com/docs/5.0/examples/sign-in/'>
    <link rel='shortcut icon' href='".$parent_href."images/ico.png'>
    <link rel='icon' href='".$parent_href."images/ico.png' type='image/ico' />
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src='".$parent_href."js/CommonPage.js'></script>";
    return $result;
}
/**
 * 1.會員頁面共用的HtmlHead
 *
 * @author Peter Chang
 * 
 * @param string $title 網頁標題文字
 * 
 * @param boolean $parent_link 判斷資料夾是幾層
 *
 * @return string
 */
function QATransportCommonHtmlHead($title,$parent_link=true,$google_seo_search=false){
    $meta_html="";
    if ($parent_link){
        $parent_href="../../";
    }else{
        $parent_href="../";
    }
    //<meta name='description' content='海運費用查詢|貨櫃海運費|海運費用查詢|航運費用|歐洲海運費|海運服務|航運|海運費用|海運費|伊朗'>
    if($google_seo_search){
        $meta_html="
    <meta name='description' content='測試海運網提供專業的國外海運貨櫃運輸服務，歡迎與我們聯繫取得最佳物流方案及價格。測試海運網-國際海運服務，專案物流運籌管理，安排海運船期、洽訂艙位。'>
    <meta name='Author' CONTENT='測試股份有限公司'>
    <meta name='Copyright' CONTENT='本網頁著作權屬測試股份有限公司所有'>
    <meta name='abstract' content='網路線上海運船期查詢、訂艙'>
    <meta property='og:title' content='測試海運網'/>
    <meta property='og:description' content='海運費用查詢|貨櫃海運費|海運費用查詢|航運費用|歐洲海運費|海運服務|航運|海運費用|海運費|伊朗' />";
    }
    $result="
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content=''>
    <meta name='author' content='Mark Otto, Jacob Thornton, and Bootstrap contributors'>
    <meta name='generator' content='Hugo 0.83.1'>".$meta_html."
    <title>".$title."</title>
    <link href='".$parent_href."css/menu.css' rel='stylesheet' type='text/css'>
    <link href='".$parent_href."css/style.css' rel='stylesheet' type='text/css'>
    <link href='".$parent_href."css/reset.css' rel='stylesheet' type='text/css'>
    <link href='".$parent_href."css/IconAHrefShow.css' rel='stylesheet' type='text/css'>
    <link href='".$parent_href."assets/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='".$parent_href."css/CommonCss.css' rel='stylesheet'>
    <link rel='canonical' href='https://getbootstrap.com/docs/5.0/examples/sign-in/'>
    <link rel='shortcut icon' href='".$parent_href."images/ico.png'>
    <link rel='icon' href='".$parent_href."images/ico.png' type='image/ico' />
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src='".$parent_href."js/CommonPage.js'></script>
    ".getGoogleTagManagerJsImportHeader();
    return $result;
}
/**
 * 1.會員頁面共用的HtmlBody
 *
 * @author Peter Chang
 *
 * @return string
 */
function QATransportCommonHtmlBody(){
    $result=getGoogleTagManagerJsImportBody();
    return $result;
}
/**
 * 1.會員頁面共用的Header開頭
 * 2.這邊將會判斷有沒有登入或是審核通過等的彈跳視窗訊息回傳
 *
 * @author Peter Chang
 * 
 * @param string $title 網頁標題文字
 * 
 * @param boolean $parent_link 判斷資料夾是幾層
 * 
 * @param boolean $non_member_use 是否需要會員登入使用
 *
 * @return array(boolean,string)
 */

function QATransportHeader($parent_link,$non_member_use){
    $msg="";
    $ip=getRealIp();
    if(getIpBlackListIp($ip)){
        return array(false,getErrorUrlPage());
    }
    if(!$non_member_use){$msg=getBoostrapBlundleJsImportEnd();}
    $ocean_quote_buf=sqlSelectOceanExportOrderByQuoteRoute();
    if ($parent_link){
        $parent_href="../../";
    }else{
        $parent_href="../";
    }
    if (isset($_SESSION['username']) && isset($_SESSION['identity'])){
        $row=getMemberUsername($_SESSION['username']);
        if(!$row){
            session_destroy();
            $msg.=  PopupWidowScriptHiddenButton(false,"MemberLoginError").PopupStaticWidowHref("測試海運網","會員登入資訊有誤，請重新登入。",$parent_href."view/Member/MemberLogin.php",true,"MemberLoginError");
            if(!$non_member_use){return array(false,$msg);}
        }elseif($_SESSION['pass']!=$row['pass']){
            session_destroy();
            $msg.=  PopupWidowScriptHiddenButton(false,"MemberLoginError").PopupStaticWidowHref("測試海運網","資料有異動，請重新登入。",$parent_href."view/Member/MemberLogin.php",true,"MemberLoginError");
            if(!$non_member_use){return array(false,$msg);}
        }else{
            $member_id=$row['member_id'];
            $pass=$row['pass'];
            $msg.=PopupWidowScriptHiddenButton("NotPassQuoteMessage");
            $msg.=PopupWidowScriptHiddenButton("NotPassFunction","NotPassFunction");
            if($pass==0){
                $quote_message="待會員證審查通過，即可下載航線報價單。";
                $function_message="待會員證審查通過，才可使用此功能。";
            }elseif($pass==2){
                $quote_message="會員註冊失敗。<br>煩請貴司聯繫我司相關人員協助 (02)1234-5678。";
                $function_message="會員註冊失敗。<br>煩請貴司聯繫我司相關人員協助 (02)1234-5678。";
            }elseif($pass==3){
                $quote_message="貴司已經被測試海運網列入黑名單，無法再使用測試海運網的服務。";
                $function_message="貴司已經被測試海運網列入黑名單，無法再使用測試海運網的服務。";
            }
            if(isset($quote_message) && isset($function_message)){
                $msg.=PopupWidowHref("測試海運網",$quote_message,"",false,"NotPassQuoteMessage");
                $msg.=PopupWidowHref("測試海運網",$function_message,"",false,"NotPassFunction");
            }
        }
    }else{
        $member_id=NULL;
        $msg.=PopupWidowScriptHiddenButton("NotLoginQuoteMessage","NotLoginQuoteMessage");
        $msg.=PopupWidowScriptHiddenButton("NotLoginMessageFunction","NotLoginMessageFunction");
        $msg.=PopupWidowHref("測試海運網","請先登入會員，才能下載航線報價單。",$parent_href."view/Member/MemberLogin.php",false,"NotLoginQuoteMessage");
        if(!$non_member_use){
            $msg.=PopupStaticWidowHref("測試海運網","請先登入會員，才能使用此功能。",$parent_href."view/Member/MemberLogin.php",true,"NotLoginMessageFunction");
            return array(false,$msg);
        }else{
            $msg.=PopupWidowHref("測試海運網","請先登入會員，才能使用此功能",$parent_href."view/Member/MemberLogin.php",false,"NotLoginMessageFunction");
        }
    }
    if(getIpCommonHeadDecideInsert($member_id)){
        "Ip已成功更新紀錄";
    }
    $msg.="
<div id='top_div' >
    <div id='lm' >
        <div id='logo'><a href='".$parent_href."view/index.php'><img src='".$parent_href."images/little_bai86.png'  height='60' width='100' /></a></div>
        <div id='menu'>
            <ul class='drop-down-menu'>";
                $msg.="<li><a href='https://www.qatransport.com/' target='_blank'>測試公司官網</a></li>";
            if (isset($_SESSION['username'])){
                $msg.="<li><a href='#'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-file-person-fill' viewBox='0 0 16 16'>
  <path d='M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-1 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm-3 4c2.623 0 4.146.826 5 1.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-1.245C3.854 11.825 5.377 11 8 11z'/>
</svg>".$_SESSION['username']."</a>
    <ul>";
                $msg.="
                        <li><a href='".$parent_href."view/Member/MemberRegister.php?state=update'>修改註冊資料</a></li>
                        <li><a href='".$parent_href."view/Member/MemberUpdatePassword.php'>修改密碼</a></li>
                        <li><a href='".$parent_href."view/MemberLogout.php'>會員登出</a></li>
    </ul>
</li>";
            }else{
                $msg.="<li><a href='".$parent_href."view/Member/MemberLogin.php'>會員登入/註冊</a></li>";
            }
                $msg.="<li >";
                if(isset($_SESSION['username'])){
                    if ($pass==1){
                        $msg.="
                        <a href='".$parent_href."view/OceanQuote/OceanExportQuoteSearch.php'>海運整櫃出口報價</a>";
                        
                    }elseif($pass==0 || $pass==2 || $pass==3){
                        $msg.="<a href='javascript: PopupWidowClick(\"NotPassFunction\");'>海運整櫃出口報價</a>";
                    }
                }else{
                    $msg.="<a href='javascript: PopupWidowClick(\"NotLoginMessageFunction\");'>海運整櫃出口報價</a>";
                }
                //$msg.="<a href='".$parent_href."view/OceanQuote/OceanExportQuoteSearch.php'>海運整櫃出口報價</a>";
                $msg.="</li>";
                $msg.="<li >";
                if(isset($_SESSION['username'])){
                    if ($pass==1){
                        $msg.="
                        <a href='".$parent_href."view/OceanQuote/CFSOceanQuoteSearch.php'>海運併櫃出口報價</a>";
                        
                    }elseif($pass==0 || $pass==2 || $pass==3){
                        $msg.="<a href='javascript: PopupWidowClick(\"NotPassFunction\");'>海運併櫃出口報價</a>";
                    }
                }else{
                    $msg.="<a href='javascript: PopupWidowClick(\"NotLoginMessageFunction\");'>海運併櫃出口報價</a>";
                }
                //$msg.="<a href='".$parent_href."view/OceanQuote/CFSOceanQuoteSearch.php'>海運併櫃出口報價</a>";
                $msg.="</li>";
                $msg.="<li >
                <a href='#'>線上訂艙</a>
                    <ul>";
                $items=array("線上訂艙","線上訂艙進度查詢","訂艙修改","訂艙取消");
                if(isset($_SESSION['username'])){
                    $item_hrefs=array($parent_href."view/Booking/Booking.php?state=add&trading=export",
                        $parent_href."view/Booking/MemberBookingOrderList.php",
                        $parent_href."view/Booking/MemberBookingOrderList.php?state=update",
                        $parent_href."view/Booking/MemberBookingOrderList.php?state=cancel");
                    if ($pass==1){
                        foreach ($items as $key=>$item){
                            $msg.="
                        <li><a href='".$item_hrefs[$key]."'>".$items[$key]."</a></li>";
                        }
                    }elseif($pass==0 || $pass==2 || $pass==3){
                        foreach ($items as $key=>$item){
                            if($pass==3 && $key==1){
                                $msg.="
                        <li><a href='".$item_hrefs[$key]."'>".$items[$key]."</a></li>";
                            }else{
                                $msg.="<li><a href='javascript: PopupWidowClick(\"NotPassFunction\");'>".$item."</a></li>";
                            }
                        }
                    }
                }else{
                    foreach ($items as $item){
                        $msg.="<li><a href='javascript: PopupWidowClick(\"NotLoginMessageFunction\");'>".$item."</a></li>";
                   }
                }
                    $msg.="</ul>
                </li>";

                $msg.="<li><a href='".$parent_href."view/ContactInformation/ContactInformation.php'>聯絡我們</a></li>";
                
                $msg.="<li><a href='".$parent_href."view/index.php'>回首頁</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- 最上方最外層結束 //-->";
return array(true,$msg);
}
/**
 * 1.測試海運網會員首頁
 *
 * @author Peter Chang
 *
 * @return string
 */
// <img src='../banner/banner.jpg' class='img' width=100%/>
function QATransportIndex(){
    $marquee_array=getMarqueeMarqueeFirst();
    $msg="<!-- banner開始 //-->
  <div class='bn'>      
        <!--    跑馬燈 //-->
        <div id='promotion'><span valign=center>
            <table border=2 width=100%><tr><td valign=middle>
            <marquee behavior=scroll direction=left height=100% scrollamount=5 width=100%>
            <font size=5><b>".$marquee_array['marquee_content']."</b></font>
            </marquee>
            </td></tr></table>
        </span></div>
    
        <!--    底圖  //-->
        <img src='../images/bg.jpg' class='img' heigth='500'>
    </div>
    <!-- banner結束 //-->
    
    <div id='vision'>
      <table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tbody>
           <tr>
              <td colspan='2' align='center' valign='middle' class='title'>測試海運網的目標與願景</td>
            </tr>
            <tr>
              <td width='50%' align='left' valign='top'><img src='../images/Bottom_line.jpg' class='limg' /></td>
              <td width='50%' align='left' valign='top' class='l_text rstr'>我們的目標是讓所有需要海運服務的公司，都能透過測試海運網的線上詢價、線上訂艙，快速及高效率的完成每次貨物的運送。</td>
            </tr>
        </tbody>
      </table>
    </div>
    </br>
    <div id='bottom_div'>
        <div id='myicon'>
          <table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
            <tbody>
              <tr>
                <td colspan='5' align='center' valign='middle' class='title'>服務項目</td>  
              </tr>
              <tr valign='middle'>
                  <td colspan='5' align='center' class='hr'><img src='../images/Bottom line.png' width='263' height='6' alt=''/></td>
              </tr>
              <tr align='center' valign='middle'>
                <td width='20%'><img src='../images/5-1-1.png' width='150' height='150' alt=''/></td>
                <td width='20%'><img src='../images/5-2-1.jpg' width='150' height='150' alt=''/></td>
                <td width='20%'><img src='../images/5-3-1.jpg' width='150' height='150' alt=''/></td>
                <td width='20%'><img src='../images/5-4-1.jpg' width='150' height='150' alt=''/></td>
              </tr>
              <tr>
                <td class='c_text'><strong>運送地區</strong></td>
                <td class='c_text'><strong>專業海運團隊</strong></td>
                <td class='c_text'><strong>價格公開透明</strong></td>
                <td class='c_text'><strong>簡易操作介面</strong></td>
              </tr>
              

              <tr>
                <td align='left' valign='top' class='c_text_c'>運送地區涵蓋世界各地，貨物種類多元，讓您輕鬆將貨送至世界各地。</td>
                <td align='left' valign='top' class='c_text_c'>我們隨時掌握最新的船運動態，同時擁有專業的實務經驗，將貨物快速的送達目的地。</td>
                <td align='left' valign='top' class='c_text_c'>報價明細公開透明，並且以最優惠的價格，幫您節省成本。</td>
                <td align='left' valign='top' class='c_text_c'>測試海運網操作介面簡單、快速、便捷、易上手。</td>
              </tr>
            </tbody>
          </table>
      </div>
</div>";
return $msg;
}
/**
 * 1.會員頁面共用的Footer，且匯入js共用的彈跳視窗使用必須在尾端
 *
 * @author Peter Chang
 *
 * @return string
 */
function QATransportFooter(){
    $msg="<!-- Footer -->
<!-- Footer -->
<footer class='footer-color'>
    <p class='text-start'>電話：886-2-1234-5678 &nbsp;&nbsp; 傳真：886-2-1234-5678 &nbsp;&nbsp; </p>
    <p class='text-start'>地址：台北市松山區XXX路X段X號X樓 Copyright &copy; 2017, All Rights Reserved by QA Transport Co., LTD.</p>
    
    <span align=right><p>建議使用瀏覽器：IE 9以後版本或Chrome 60.0以上</p></span>
</footer>".getBoostrapBlundleJsImportEnd();
return $msg;
}
/**
 * 1.會員註冊頁面聯絡資訊專用的Footer，且匯入js共用的彈跳視窗使用必須在尾端
 *
 * @author Peter Chang
 *
 * @return string
 */
function QATransportMemberRegisterFooter(){
    $msg="<!-- Footer -->
<!-- Footer -->
<footer class='footer-color'>
    <p class='text-start'>如有任何疑問 TEL : 886-2-1234-5678 EXT : 116, Alex Wan ( E-Mail : cs@qatransport.com )</p>
    <p class='text-start'>地址：台北市松山區XXX路X段X號X樓 Copyright &copy; 2017, All Rights Reserved by QA Transport Co., LTD.</p>
    
    <span align=right><p>建議使用瀏覽器：IE 9以後版本或Chrome 60.0以上</p></span>
</footer>".getBoostrapBlundleJsImportEnd();
return $msg;
}
/**
 * 1.員工頁面共用的Header開頭
 * 2.這邊將員工權限做一些控管顯示
 *
 * @author Peter Chang
 * 
 * @param string $title 網頁標題文字
 * 
 * @param boolean $parent_link 判斷資料夾是幾層
 *
 * @return array(boolean,string)
 */
function QATransportStaffHeader($parent_link){
    $msg="";
    $ip=getRealIp();
    if(getIpBlackListIp($ip)){
        return array(false,getErrorUrlPage());
    }
    if ($parent_link){
        $parent_href="../../";
        $dropdown_href="../";
    }else{
        $parent_href="../";
        $dropdown_href="./";
    }
    if (isset($_SESSION['username']) && isset($_SESSION['identity'])){
        $row=getStaffAccountListUsername($_SESSION['username']);
        $staff_array=getStaffListStaffId($_SESSION['staff_id']);
        if (!$row){
            $msg.=PopupWidowScriptHiddenButton(false,"NotStaffLogin").PopupStaticWidowHref("測試海運網後台登入","不是此測試後台會員。",$parent_href."view/Staff/StaffLogin.php",true,"NotStaffLogin");
            $msg.=getBoostrapBlundleJsImportEnd();
            return array(false,$msg);
        }
    }else{
        $msg.=PopupWidowScriptHiddenButton(false,"NotStaffLogin").PopupStaticWidowHref("測試海運網後台登入","請先登入會員。",$parent_href."view/Staff/StaffLogin.php",true,"NotStaffLogin");
        $msg.=getBoostrapBlundleJsImportEnd();
        return array(false,$msg);
    }
    $num=getMemberPassCount(0);
    $msg.="
<nav class='navbar navbar-expand-lg navbar-dark navbar-static-top bg-dark '>
  <div class='container-fluid bg-dark'>
     <img src='".$parent_href."/images/little_bai86.png' width='200' height='150' class='me-3' alt='Bootstrap'>
      <a class='navbar-brand' >".$staff_array['extension']." ".ucfirst(strtolower($staff_array['ename']))." ".ucfirst(strtolower($staff_array['elastname']))."</a>
    <button class='navbar-toggler p-0 border-0' type='button' data-bs-toggle='offcanvas' aria-label='Toggle navigation'>
    </button>
    <div class='navbar-collapse offcanvas-collapse' id='navbarsExampleDefault'>
    <ul class='navbar-nav me-auto mb-2 mb-lg-0'>";
        $msg.=getStaffHeaderPriorityDropDownList($dropdown_href);
      $msg.="</ul>
        <button class='btn btn-outline-success' onclick=\"location.href='".$dropdown_href."StaffLogout.php'\" >登出</button>
    </div>
  </div>
</nav>
<div class='row'>
</div>
";
return array(true,$msg);
}
/**
 * 1.會員頁面共用的Footer開頭，且匯入js共用的彈跳視窗使用必須在尾端
 *
 * @author Peter Chang
 *
 * @return string
 */
function QATransportStaffFooter(){
    $msg="
<nav class='navbar text-light navbar-dark bg-dark'>
<div class='container-fluid'>
<ul class='list-unstyled' style='width:100%'>
    <li class='text-start'>電話：886-2-1234-5678 &nbsp;&nbsp; 傳真：886-2-1234-5678 &nbsp;&nbsp; </li>
    <li class='text-start'>地址：台北市松山區XXX路X段X號X樓 Copyright &copy; 2017, All Rights Reserved by QA Transport Co., LTD.</li>
    <li class='text-end'>建議使用瀏覽器：IE 9以後版本或Chrome 60.0以上</li>
</ul>
</div>
</nav>
".getBoostrapBlundleJsImportEnd();
return $msg;
}
/**
 * 1.在頁面資料開頭判斷錯誤，會有靜態彈跳視窗畫面時，先需匯入的Html
 *
 * @author Peter Chang
 *
 * @return string
 */
function QATransportStaffPageHeadDecideErrorImportHtml($head,$parent_link){
    $msg=QATransportStaffCommonHtmlHead($head,$parent_link);
    $msg.=PopupWidowScriptHiddenButton(false,"StaffPriorityMessage");
    $msg.=getBoostrapBlundleJsImportEnd();
return $msg;
}
/**
 * 1.Html Form頁面共用的Radio
 *
 * @author Peter Chang
 *
 * @param string $postname 為Form表單接收的資料
 * 
 * @param string $class 為將Radio加上class
 * 
 * @param string $data 為預設勾選的選項，若沒有就預設為第一個打勾
 * 
 * @param array $values 此陣列為Radio的value
 * 
 * @param array $shownames 此陣列為顯示的名稱
 * 
 * @return string
 */
function getHtmlRadio($postname,$class,$data,$values,$shownames)
{
    $result = "";
    foreach ($values as $key => $value){
        if ($data==$values[$key]){
            $result.="<input type='radio' name='".$postname."' class='".$class."' value=".$values[$key]." checked>".$shownames[$key];
        }elseif(trim($data)=="" AND $key==0){
            $result.="<input type='radio' name='".$postname."' class='".$class."' value=".$values[$key]." checked>".$shownames[$key];
        }
        else{
            $result.="<input type='radio' name='".$postname."' class='".$class."' value=".$values[$key]." >".$shownames[$key];
        }
    }
    return $result;
}
/**
 * 1.員工會員共用Form會員個人資訊依照狀態判斷顯示結果及輸入框
 *
 * @author Peter Chang
 *
 * @param string $state 接收資訊的狀態
 * 
 * @param string $identity 登入的身分
 * 
 * @param array $data_array 此為資料庫Member的資料
 * 
 * @param boolean|integer $pass 為員工審核會員接收時使用
 * 
 * @return string
 */
function getMemberInformationForm($state,$identity,$data_array,$pass=false){
    $company_name_readonly="";
    $company_area="";
    $readonly="";
    $disabled="";
    if ($identity=="staff"){
        $readonly='readonly="readonly"';
        $disabled='disabled="disabled"';
        $company_name_readonly='readonly="readonly"';
        $company_area='disabled="disabled"';
        if($state=="update"){
            $company_name_readonly="";
            $company_area="";
        }
    }
    $result="";
    if($state=="update" && $identity=="customer"){
     $result.='<div class="row justify-content-md-center">
        <div class="col col-lg-2 " style="text-align:right">
          <label for="inputUsername" class="control-label">使用者帳號</label>
        </div>
        <div class="col col-lg-3"  style="text-align:left">
          <input type="email" class="form-control" id="inputUsername" name="username" required="required" value="'.$data_array['username'].'"  placeholder="請輸入正確的E-MAIL" readonly="readonly>
          <small class="text-muted">
           * 請用E-MAIL註冊會員帳號
          </small>
        </div>
        <div class="col col-lg-2" style="text-align:left">    
          <span id="username_message">
          </span>  
        </div>
      </div>';
    }else{
     $result.='<div class="row justify-content-md-center">
        <div class="col col-lg-2 " style="text-align:right">
          <label for="inputUsername" class="control-label"><font color="red">*</font>使用者帳號</label>
        </div>
        <div class="col col-lg-3"  style="text-align:left">
          <input type="email" class="form-control" id="inputUsername" name="username" required="required" value="'.$data_array['username'].'"  placeholder="請輸入正確的E-MAIL" '.$readonly.'>
          <small class="text-muted">
           * 請用E-MAIL註冊會員帳號
          </small>
        </div>
        <div class="col col-lg-2" style="text-align:left">    
          <span id="username_message">
          </span>  
        </div>
      </div>';
    }
    if($state=="add"){
          $result.= '
      <div class="row justify-content-md-center">
        <div class="col col-lg-2" style="text-align:right">
          <label for="inputUsernameVerificationCode" class="control-label"><font color="red">*</font>帳號驗證</label>
        </div>
        <div class="col col-lg-3" style="text-align:left">
            <div class="input-group">
                <input type="text"  class="form-control col-xs-12 col-sm-10" id="inputUsernameVerificationCode" name="username_verification_code" placeholder="請輸入驗證碼" required="required">
                <input type="button" id="buttonUsernameVerificationCode" class="btn btn-secondary" value="點擊取得驗證碼" onclick="username_verification_code_onclick();" disabled>
            </div>
        </div>
        <div class="col col-lg-2" style="text-align:left">
          <span id="username_verification_code_message">
          </span>  
        </div>
      </div> 
      <div class="row justify-content-md-center">
        <div class="col col-lg-2" style="text-align:right">
          <label for="inputPassword" class="control-label"><font color="red">*</font>密碼</label>
        </div>
        <div class="col col-lg-3" style="text-align:left">
          <input type="password"  class="form-control col-xs-12 col-sm-10" id="inputPassword" name="password"  placeholder="請填寫英文及數字至少8碼" required="required">
          <small class="text-muted">
           * 限用英文字母及數字，限長8~16字
          </small>
        </div>
        <div class="col col-lg-2" style="text-align:left">
          <span id="password_message">
          </span>  
        </div>
      </div>      
      <div class="row justify-content-md-center">
        <div class="col col-lg-2" style="text-align:right">
          <label for="inputConfirmPassword" class="control-label"><font color="red">*</font>確認密碼</label>
        </div>
        <div class="col col-lg-3">
          <input type="password" class="form-control" id="inputConfirmPassword" name="confirm_password" required="required"  placeholder="請再輸入一次密碼">
        </div>
        <div class="col col-lg-2" style="text-align:left">
          <span id="confirm_password_message">
          </span>  
        </div>
      </div>';
    }
      
      $result.='
      <div class="row justify-content-md-center" style="text-align:right">
        <div class="col col-lg-2">
          <label for="inputTaxIdNumber" class="control-label"><font color="red">*</font>公司統一編號</label>
        </div>
        <div class="col col-lg-3">
          <input type="text" class="form-control" id="inputTaxIdNumber" name="tax_id_number" required="required" value="'.$data_array['tax_id_number'].'" placeholder="請填寫公司統一編號數字8碼" '.$readonly.'>
        </div>
        <div class="col col-lg-2" style="text-align:left">
          <span id="tax_id_number_message">
          </span>  
        </div>
      </div>
      <div class="row justify-content-md-center" style="text-align:right">
        <div class="col col-lg-2">
          <label for="inputCompanyChinese" class="control-label"><font color="red">*</font>公司中文名稱</label>
        </div>
        <div class="col col-lg-3" style="text-align:left">
          <input type="text" class="form-control" id="inputCompanyChinese" name="company_chinese" required="required" value="'.$data_array['company_chinese'].'"  placeholder="請填寫公司中文名稱" '.$company_name_readonly.'>
          <small class="text-muted">
           * 請填寫全名EX:測試股份有限公司
          </small>
        </div>
        <div class="col col-lg-2" style="text-align:left">
          <span id="company_chinese_message">
          </span>  
        </div>
      </div>
      <div class="row justify-content-md-center" style="text-align:right">
        <div class="col col-lg-2">
          <label for="inputCompanyEnglish" class="control-label">公司英文名稱</label>
        </div>
        <div class="col col-lg-3">
          <input type="text" class="form-control" id="inputCompanyEnglish" name="company_english" value="'.$data_array['company_english'].'"  placeholder="請填寫公司英文名稱" '.$company_name_readonly.'>
        </div>
        <div class="col col-lg-2" style="text-align:left">
          <span id="company_english_message">
          </span>  
        </div>
      </div>
      <div class="row justify-content-md-center" style="text-align:right">
        <div class="col col-lg-2">
          <label for="inputContactName" class="control-label"><font color="red">*</font>聯絡人姓名</label>
        </div>
        <div class="col col-lg-3" style="text-align:left">
            <input type="text" class="form-control" style="width: auto;float:left; display:inline;" id="inputContactName" name="contact_name" required="required" value="'.$data_array['contact_name'].'"  placeholder="請填寫聯絡人中文名稱" '.$readonly.'>';
        if($state=="information" || $state=="pass" || $state=="information_statistics"){
            $result.=getGenderChinese($data_array["gender"]);
        }else{
            $result.= getHtmlRadio("gender","form-check-input",$data_array["gender"],array("male","female"),array("先生","小姐"));
        }
        $result.='
      </div>
        <div class="col col-lg-2" style="text-align:left">
          <span id="contact_name_message">
          </span>  
        </div>
      </div>
      <div class="row justify-content-md-center" style="text-align:right">
        <div class="col col-lg-2">
          <label for="inputContactCellphone" class="control-label">聯絡人行動電話(選填)</label>
        </div>
        <div class="col col-lg-3" style="text-align:left">
          <input type="text" class="form-control" id="inputContactCellphone" name="contact_cellphone" value="'.$data_array['contact_cellphone'].'"  placeholder="請填寫手機號碼10碼" '.$readonly.'>
          <small class="text-muted">
           *格式：0912345678。
          </small>
        </div>
        <div class="col col-lg-2" style="text-align:left">
          <span id="contact_cellphone_message">
          </span>
        </div>
      </div>
      <div class="row justify-content-md-center" style="text-align:right">
        <div class="col col-lg-2">
          <label for="inputContactCompanyPhone" class="control-label"><font color="red">*</font>聯絡人公司電話</label>
        </div>
        <div class="col col-lg-3" style="text-align:left">
          <input type="text" class="form-control"  style="width:auto;float:left; display:inline;" id="inputContactCompanyPhone" name="contact_company_phone" required="required" value="'.$data_array['contact_company_phone'].'"   placeholder="請填寫公司電話" '.$readonly.'>
          <label for="inputContactCompanyExtension" style="float:left; display:inline;">分機</label>
          <input type="text" class="form-control" style="width:80px;"id="inputContactCompanyExtension" name="contact_company_extension" value="'.$data_array['contact_company_extension'].'" '.$readonly.'>
          <div>
          <small class="text-muted">
           *格式：(02)1234-5678。請以半形填寫，不留空白
          </small>
        </div>
        </div>
        <div class="col col-lg-2" style="text-align:left">
          <span id="contact_company_phone_message">
          </span>  
        </div>
      </div>
      <div class="row justify-content-md-center" style="text-align:right">
        <div class="col col-lg-2">
          <label for="inputContactCompanyFax" class="control-label">聯絡人公司傳真</label>
        </div>
        <div class="col col-lg-3" style="text-align:left">
          <input type="text" class="form-control"  id="inputContactCompanyFax" name="contact_company_fax" value="'.$data_array['contact_company_fax'].'"   placeholder="請填寫公司傳真" '.$readonly.'>
          <div>
          <small class="text-muted">
           *格式：(02)1234-5678。請以半形填寫，不留空白
          </small>
        </div>
        </div>
        <div class="col col-lg-2" style="text-align:left">
          <span id="contact_company_fax_message">
          </span>  
        </div>
      </div>
      <div class="row justify-content-md-center" style="text-align:right">
        <div class="col col-lg-2">
          <label for="inputContactEmail" class="control-label"><font color="red">*</font>聯絡人E-MAIL</label>
        </div>
        <div class="col col-lg-3">
          <input type="email" class="form-control" id="inputContactEmail" name="contact_email" required="required" value="'.$data_array['contact_email'].'"  placeholder="請輸入正確的E-MAIL" '.$readonly.'>
        </div>
        <div class="col col-lg-2" style="text-align:left">
          <span id="contact_email_message">
          </span>  
        </div>
      </div>
      
      <div class="row justify-content-md-center" style="text-align:right">
        <div class="col col-lg-2">
          <label for="inputCompanyArea" class="control-label">公司區域</label>
        </div>
        <div class="col col-lg-3">
          <div class="input-group">
            <select class="form-select" aria-label="Default select example" id="city_id" name="city_id" '.$company_area.'>
              <option value=0>請選擇</option>
              '.getCityOptionCityChineseValueId($data_array['city_id']).'
            </select>
            <select class="form-select" aria-label="Default select example" id="area_id" name="area_id" '.$company_area.'>';
                if($data_array['area_id']){
                  //$result.= "<option value=0>請選擇</option>";
                  $result.= getAreaOptionAreaChineseValueId($data_array['city_id'],$data_array['area_id']);
                }
            $result.='
            </select>
          </div>
        </div>
        <div class="col col-lg-2">
          <p class="text-danger"></p>
        </div>
      </div>

      <div class="row justify-content-md-center" style="text-align:right">
        <div class="col col-lg-2">
          <label for="inputCompanyAddress" class="control-label">公司地址</label>
        </div>
        <div class="col col-lg-4">';
          if($state=="add"){
            $result.= '<input type="text" class="form-control" id="inputCompanyAddress" name="company_address" placeholder="請輸入公司所在地址" readonly="readonly" required="required"> ';
          }elseif($state=="update" && $data_array['company_address']){
            $result.= '<input type="text" class="form-control" id="inputCompanyAddress" name="company_address" value="'.$data_array['company_address'].'"   placeholder="請輸入公司所在地址" '.$company_area.'> ';
          }else{
            $result.= '<input type="text" class="form-control" id="inputCompanyAddress" name="company_address" value="'.$data_array['company_address'].'"   placeholder="請輸入公司所在地址" '.$readonly.'> ';
          }
        
        $result.='</div>
            <div class="col col-lg-1">
            </div>
        </div>
    </div>';
        if($state=="pass" && $identity=="staff"){
            if($pass==1){
                $text="<font color='green'>審核通過</font>";
            }elseif($pass==2){
                $text="<font color='red'>審核不通過</font>";
            }
        $result.='
        <div class="row justify-content-md-center" style="text-align:right">
            <div class="col col-lg-2">
                <label for="inputPassMessage" class="control-label">審核選擇</label>
            </div>
            <div class="col col-lg-3"  style="text-align:left">';
        $result.= $text;        
        $result.='</div>
            <div class="col col-lg-2">
            </div>
        </div>';
        list($text,$textarea)=getStaffAuditMemberSelectTextarea($pass);
        $result.='
        <div class="row justify-content-md-center" style="text-align:right">
            <div class="col col-lg-2">
                '.$text.'
            </div>
            <div class="col col-lg-3"  style="text-align:left">';       
        $result.=$textarea.'</div>
            <div class="col col-lg-2">
            </div>
            </div>';
        }elseif($state=="information" && $identity=="staff" && $data_array["pass"]==2){
        $result.='
        <div class="row justify-content-md-center" style="text-align:right">
            <div class="col col-lg-2">
                審核未通過原因
            </div>
            <div class="col col-lg-3"  style="text-align:left">';       
        $result.="
        <textarea class='form-control' id='TextareaPassMessage' rows='3' name='pass_message' required='required' readonly='readonly'>".$data_array["pass_message"]."</textarea></div>
            <div class='col col-lg-2'>
            </div>
            </div>";

        }
    return $result;
}
/**
 * 1.員工會員共用訂艙單的上傳檔案及接手人員顯示資訊，會依照是否有人接單上傳檔案顯示有差異
 *
 * @author Peter Chang
 * 
 * @param array $data_array 此為資料庫BookingOrder的資料
 * 
 * @param boolean $send_mail 寄送Email是否顯示
 * 
 * @return string
 */
function getBookingOrderInformationTableStaffContactDate($data_array,$send_mail){
    $result="";
    $staff_date_result="";
    $staff_attachment_result="";
    if($data_array["cs_staff_date"]){
        $staff_date_result.="<tr>";
        $staff_attachment_result.="<tr>";
    }
    $booking_order_shcedule_array=getBookingOrderSchedulePriorityShowArray($data_array);
    foreach($booking_order_shcedule_array as $key=>$booking_order_shcedules){
        if($booking_order_shcedules["staff_id"] !== false &&
            $booking_order_shcedules["staff_id"]>0 && 
            $data_array['schedule']>=$booking_order_shcedules["schedule"] &&
            $booking_order_shcedules["show_table"] !== false){
            $staff_array=getStaffListStaffId($booking_order_shcedules["staff_id"]);
            $result.="
            <tr>
            <td>".$booking_order_shcedules["staff_department_show"]."</td>
            <td>".getStaffEnglishnameChineseNameGender($staff_array)."</td>
            <td>".$booking_order_shcedules["staff_department_show"]."E-MAIL</td>
            <td>".$staff_array['email']."</td>
            <td>分機</td>
            <td>".$staff_array['extension']."</td>
            </tr>";
        }
        if($booking_order_shcedules["staff_date"] !== false &&
            $booking_order_shcedules["staff_date"] &&
            $data_array['schedule']>=$booking_order_shcedules["schedule"] &&
            $booking_order_shcedules["show_table"] !== false){
            $staff_date_result.="
            <td>".$booking_order_shcedules["date_text"]."</td>
            <td>".$booking_order_shcedules["staff_date"]."</td>";
            $staff_attachment_result.="
            <td>".$booking_order_shcedules["attachment_text"]."</td>";
            if(!$send_mail){
                $path=getBookingOrderStaffAttachmentPath($booking_order_shcedules['schedule'],$data_array);
                $staff_attachment_result.="<td>";
                if(is_array($booking_order_shcedules['staff_attachment'])){
                    foreach ($booking_order_shcedules['staff_attachment'] as $attachment){
                        $staff_attachment_result.=getHtmlAHrefBookingOrderAttachmentIcon($path.$attachment,$attachment)."<br>";
                    }
                }elseif($booking_order_shcedules['staff_attachment']){
                    $staff_attachment_result.=getHtmlAHrefBookingOrderAttachmentIcon($path.$booking_order_shcedules['staff_attachment'],$booking_order_shcedules['staff_attachment']);
                }
                $staff_attachment_result.="</td>";
            }
        }elseif($data_array["cs_staff_date"] &&
            $booking_order_shcedules["show_table"] !== false){
            $staff_date_result.="<td></td><td></td>";
            $staff_attachment_result.="<td></td><td></td>";
        }
    }
    if($data_array["cs_staff_date"]){
        $staff_date_result.="</tr>";
        $staff_attachment_result.="</tr>";
    }
    if($send_mail){$staff_attachment_result="";}
    return $result.$staff_date_result.$staff_attachment_result;
}
/**
 * 1.員工會員共用訂艙單顯示資訊，會依照是否有人接單上傳檔案顯示有差異
 *
 * @author Peter Chang
 * 
 * @param array $data_array 此為資料庫BookingOrder的資料
 * 
 * @param boolean $show_href 是否需要提供附檔連結或是文字
 * 
 * @param string $identity 登入的身份
 * 
 * @param boolean $send_mail 寄送Email是否顯示
 * 
 * @return string
 */
function getBookingOrderInformationTable($data_array,$show_href,$identity,$send_mail){
    $contact_company_phone="";
    $cargo_weight_html="";
    $cabinet_volume_html="";
    $contact_company_phone.=getPhoneExtensionText($data_array['contact_company_phone'],$data_array['contact_company_extension']);
    $contact_company_fax=$data_array['contact_company_fax'];
    
    $case_closed_date="";
    if($data_array['case_closed_date'] && $identity=="staff"){
        $case_closed_date="
        <tr>
            <td>結案日期</td>
            <td>".$data_array['case_closed_date']."</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>";
    }
    $result="";
    //table-info
    if($send_mail){
        $result.='<table style="background-color:#E0F2F1;font-family:Microsoft JhengHei;" class="table text-start caption-top">';
    }else{
        $result.='<table class="table table-info text-start caption-top">';
    }
    if($data_array['shipment_type']=="CY"){
        $cabinet_volume_html="
        <td>訂艙櫃量</td>
        <td>".getCabinetVolumeText($data_array['cabinet_volume'])."</td>";
        $cargo_weight_html="
        <td>每一個貨櫃的貨重</td>
        <td>".$data_array['cargo_weight']."公斤</td>      
        <td>產品性質</td>
        <td>".getDangerousGoodsText($data_array)."</td>";
    }elseif($data_array['shipment_type']=="CFS"){
        $cabinet_volume_html="
        <td>預估總貨量</td>
        <td>".$data_array['volume']." CBM</td>";
        $cargo_weight_html="
      <td>預估總貨重</td>
      <td>".$data_array['cargo_weight']."公斤</td>      
      <td>總件數</td>
      <td>".$data_array['cabinet_volume']." ".$data_array['unit']."</td>";
    }
    $result.='
        <caption>訂艙詳細資訊</caption>
        '.$case_closed_date.'
            <tr>
                <td>訂艙編號</td>
                <td>'.$data_array['serial_head'].$data_array['serial_number'].'</td>
                <td>訂艙建立日期</td>
                <td>'.$data_array['create_time'].'</td>
                <td>訂艙狀態</td>
                <td>'.getBookingOrderScheduleShowName($data_array['schedule'],$data_array).'</td>
            </tr>
            <tr>
                <td>會員帳號</td>
                <td>'.$data_array['username'].'</td>      
                <td>統一編號</td>
                <td>'.$data_array['tax_id_number'].'</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>訂艙公司</td>
                <td>'.$data_array['company_chinese'].'</td>      
                <td>聯絡人</td>
                <td>'.$data_array['contact_name'].'</td>
                <td>聯絡人E-MAIL</td>
                <td>'.$data_array['contact_email'].'</td>
            </tr>
            <tr>
                <td>電話號碼</td>
                <td>'.$contact_company_phone.'</td>      
                <td>傳真號碼</td>
                <td colspan="3">'.$contact_company_fax.'</td>
            </tr>
            <tr>
                <td>貴公司訂艙編號</td>
                <td>'.$data_array['purchase_order_no'].'</td>      
                <td>L/C NO.</td>
                <td colspan="3">'.$data_array['lc_no'].'</td>
            </tr>
            <tr>
                <td>產品 HS CODE</td>
                <td>'.$data_array['hs_code'].'</td>'
                .$cargo_weight_html.'     
            </tr>';
    if($data_array['terms_of_trade']=="EX-WORK" ||
        $data_array['terms_of_trade']=="DDP" ||
        $data_array['terms_of_trade']=="DDU"){
        $result.='    
    <tr>
        '.$cabinet_volume_html.'  
      <td>預計貨好日期</td>
      <td>'.$data_array['goods_date'].'</td> 
      <td></td>
      <td></td>
    </tr>';
    }else{
        $result.='    
    <tr>
      '.$cabinet_volume_html.' 
      <td>貿易條件</td>
      <td>'.$data_array['terms_of_trade'].'</td> 
      <td>預計貨好日期</td>
      <td>'.$data_array['goods_date'].'</td>    
    </tr>';
    }

    if($data_array['terms_of_trade']=="EX-WORK"){
    $result.='
    <tr>
      <td>貿易條件</td>
      <td>'.$data_array['terms_of_trade'].'</td> 
      <td>提貨地址</td>
      <td colspan="5">'.$data_array['terms_of_trade_remark'].'</td> 
    </tr>';
    }elseif($data_array['terms_of_trade']=="DDU" || $data_array['terms_of_trade']=="DDP"){
    $result.='
    <tr>
      <td>貿易條件</td>
      <td>'.$data_array['terms_of_trade'].'</td> 
      <td>送貨地址</td>
      <td colspan="3">'.$data_array['terms_of_trade_remark'].'</td>      
    </tr>';
    }
    $result.='
    <tr>
      <td>結關地點</td>
      <td>'.CutOffPlaceIdFormat($data_array['cut_off_place_id']).'</td>    
      <td>結關日期</td>
      <td>'.$data_array['cut_off_date'].'</td>      
      <td>開航日</td>
      <td>'.$data_array['onboard_date'].'</td>
    </tr>
    <tr>
      <td>目的地</td>
      <td>'.$data_array['destination_country_english'].'/'.$data_array['destination_english'].'</td>    
      <td></td>
      <td></td>      
      <td></td>
      <td></td>
    </tr>';
    if($data_array['attachments'] && $show_href){
        $attachments=explode(";",$data_array['attachments']);
        $result.='
    <tr>
      <td>附檔</td>
      <td colspan="5">';
      foreach($attachments as $attachment){
        $result.=getHtmlButtonBookingOrderMemberAttachmentIcon(getBookingOrderAttachPath($data_array).$attachment,$attachment);
      }
      $result.='</td>    
    </tr>';
    }elseif($data_array['attachments']){
        $attachments=explode(";",$data_array['attachments']);
        $result.='
    <tr>
      <td>附檔</td>
      <td colspan="5">';
        foreach($attachments as $attachment){
            $result.=$attachment."  ";
        }
      $result.='</td>    
    </tr>';
    }
    $result.='<tr>
      <td>備註</td>
      <td colspan="5"><pre>'.$data_array['remark'].'</pre></td>
    </tr>
    '.getBookingOrderInformationTableStaffContactDate($data_array,$send_mail);
    $result.='
  </table>';
  return $result;
}
/**
 * 1.員工會員共用訂艙單顯示資訊，會依照是否有人接單上傳檔案顯示有差異
 *
 * @author Peter Chang
 * 
 * @param string $identity 登入的身份
 *
 * @param string $state 接收資訊的狀態
 * 
 * @param array $data_array 此為資料庫BookingOrder的資料
 * 
 * @return string
 */
function getBookingOrderFormHtml($identity,$state,$data_array){
    $result="<input type='text' id='state' value='".$state."' hidden>";
    $class_label="";
    $class_select="";
    $un_no_label="";
    $un_no_input="";
    $attachment_color="";
    $class_text="";
    $cargo_weight_text="";
    $cargo_weight_remark="";
    $cabinet_volume_text="";
    $cabinet_volume_remark="";
    $attachment_remark="";
    if($state=="update"){
    $result.="
    <div class='row justify-content-md-center'>
        <div class='col col-lg-1 d-flex align-items-center'>
            <label class='control-label'>訂艙編號</label>
        </div>
        <div class='col col-lg-3 d-flex align-items-center'>
            ".$data_array['serial_head'].$data_array['serial_number']."
        </div>            
        <div class='col'>
        </div>
    </div>";
    }
    if ($data_array['dangerous_goods']=='危險品'){
        $class_label.= "<label for='inputClass' class='control-label'>CLASS</label>";
        $class_select.= "<select id='selectClass' class='form-select' name='class'>";
        for($i=1;$i<10;$i++){
            if ($i==$data_array['class']){
                $class_select.= "<option selected>".$i."</option>";
            }else{
                $class_select.= "<option>".$i."</option>";
            }
        }
        $class_select.= "</select>";
        $un_no_label.= "<label for='inputUnNo' class='control-label'>UN.NO.</label>";
        $un_no_input.= "<input type='text' class='w-50 form-control' id='inputUnNo' name='un_no' value=".$data_array['un_no']."><small class='text-muted'>* 請輸入數字4碼 </small>";
        $attachment_color.="<font color='red'>*</font>";
    }
    if($data_array['shipment_type']=="CY"){

        $attachment_remark="<small class='text-muted'>*格式限定：DOC、PDF、JPEG，最多可上傳5個附檔。如為危險品，請附上MSDS檔案</small>";
        $cargo_weight_text="
        <div class='col col-lg-2 d-flex align-items-center'>
            <label for='inputCargoWeight' class='control-label'><font color='red'>*</font>每一個貨櫃的貨重(公斤)</label>
        </div>
        <div class='col col-lg-3 d-flex align-items-center'>
            <div class='row'>
                <div class='col col-lg-6 text-start'>
                    <input type='text' class='form-control' id='inputCargoWeight' name='cargo_weight' value='".$data_array['cargo_weight']."' required='required'>
                    <small class='text-muted'>
                        * 請輸入數字
                    </small>
                </div>
                <div class='col col d-flex align-items-center text-start'>
                    <span id='cargo_weight_message' class='d-flex align-items-center '>
                    </span>
                </div>
            </div>
        </div>";
        $cargo_weight_remark="
        <div class='row'>
            <div class='col col-lg-2'>
            </div>
            <div class='col col-lg-4' >
            </div>
            <div class='col col-lg-1'>
            </div>
            <div class='col col d-flex align-items-start'>
                <small class='text-muted'>
                    *訂艙櫃量1櫃以上，請於備註欄位提供每一貨櫃貨重(公斤)
                </small>
            </div>
        </div>";
        $class_text="
    <div class='row justify-content-md-center'>
        <div class='col col-lg-1 d-flex align-items-center'>
          <label for='inputDangerousGoods' class='control-label'><font color='red'>*</font>產品性質</label>
        </div>
        <div class='col col-lg-3'>
          <select class='form-select' id='inputDangerousGoods' name='dangerous_goods' aria-label='Default select example' required='required'>
            ".getDangerousGoodsSelect($data_array['dangerous_goods'])."
          </select>
        </div>

        <div class='col col-lg-1 d-flex align-items-center' id='class_div'>
        ".$class_label."
        </div>
        <div class='col col-lg-2 d-flex align-items-center' id='class_select_div'>
        ".$class_select."
        </div>
        <div class='col col-lg-1 d-flex align-items-center'id='un_no_div'>
        ".$un_no_label."
        </div>
        <div class='col'>
          <div class='row'>
            <div class='col col-lg-8 d-flex align-items-center' id='un_no_input_div'>
            ".$un_no_input."
            </div>
            <div class='col d-flex align-items-center'>
              <span class='d-flex align-items-center text-danger' id='un_no_message'>
              </span>
            </div>
          </div>
        </div>
    </div>";
    $cabinet_volume_text="
    <div class='row justify-content-md-center'>
        <div class='col col-lg-1 d-flex align-items-center'>
          <label for='inputCabinetVolume' class='control-label'><font color='red'>*</font>訂艙櫃量</label>
        </div>
        <div class='col col-lg-10'>
          <div class='row'>"
           .getCabinetVolumeInput($data_array['cabinet_volume'])."
            <div class='col col-lg-2 d-flex align-items-center'>
              <span id='cabient_volume_message'>
              </span>
            </div>
          </div>
        </div>
        <div class='col col'>
        </div>
    </div>";
    }elseif($data_array['shipment_type']=="CFS"){
        $cabinet_volume_remark="
        <div class='row'>
            <div class='col col-lg-7'>
            </div>
            <div class='col col-auto'>
                <p class='text-danger'>*每件尺寸請協助填於備註欄。EX:長X寬X高(公分)</p>
            </div>
            <div class='col'>
            </div>
        </div>
        ";
        $class_text="
        <div class='row'>
            <div class='col col-auto d-flex align-items-center'>
                <p class='text-danger'><b>併櫃不收危險品</b></p>
                <select class='form-select' id='inputDangerousGoods' name='dangerous_goods' aria-label='Default select example' required='required' hidden>
                    ".getDangerousGoodsSelect(false)."
                </select>
            </div>
            <div class='col'>
            </div>
        </div>";
        $cargo_weight_text="
        <div class='col col-lg-2 d-flex align-items-center'>
            <label for='inputCargoWeight' class='control-label'><font color='red'>*</font>預估總貨重</label>
        </div>
        <div class='col col-lg-3 d-flex align-items-center'>
            <div class='row'>
                <div class='col col-lg-6 text-start'>
                    <div class='input-group mb-3'>
                        <input type='text' class='form-control' id='inputCargoWeight' name='cargo_weight' value='".$data_array['cargo_weight']."' required='required'>
                        <span class='input-group-text' id='basic-addon2'>公斤</span>
                        <small class='text-muted'>
                            * 請輸入數字
                        </small>
                    </div>
                </div>
                <div class='col col d-flex align-items-center text-start'>
                    <span id='cargo_weight_message' class='d-flex align-items-center '>
                    </span>
                </div>
            </div>
        </div>";
        $cabinet_volume_text="
        <div class='row justify-content-md-center'>
            <div class='col col-lg-2 d-flex align-items-center'>
                <label for='inputCabinetVolume' class='control-label'><font color='red'>*</font>預估總貨量</label>
            </div>
            <div class='col col-lg-2 d-flex align-items-center'>
                <div class='input-group mb-3'>
                    <input type='text' class='form-control' id='inputVolume' name='volume' value='".$data_array['volume']."' required='required'>
                    <span class='input-group-text' id='basic-addon2'>CBM</span>
                </div>
            </div>
            <div class='col col-lg-3 d-flex align-items-center'>
                <span id='volume_message' class='d-flex align-items-center'>
                    </span>
            </div>
            <div class='col col-lg-2 d-flex align-items-center'>
                <label for='inputQuantityUnit' class='control-label'><font color='red'>*</font>總件數</label>
            </div>
            <div class='col col-lg-2'>
                <div class='input-group'>
                    <input type='number' class='form-control' id='inputQuantity' name='cabinet_volume' value='".$data_array['cabinet_volume']."' required='required'>
                    <select class='form-select' id='selectUnit' name='cfs_quantity_unit_id'>
                        ".getCFSQuantityUnitNotDelOptionUnitValueCFSQuantityUnitId(false)."
                    </select>
                </div>
            </div>
            <div class='col d-flex align-items-center'>
                <span id='quantity_message' class='d-flex align-items-center'>
                    </span>
            </div>
        </div>";
        $attachment_remark="
        <small class='text-muted'>
            *格式限定：DOC、PDF、JPEG，最多可上傳5個附檔。
        </small>";
    }
$result.="
     <div class='row justify-content-md-center'>
        <div class='col col-lg-1 d-flex align-items-center'>
          <label for='inputCompanyChinese' class='control-label'>訂艙公司</label>
        </div>
        <div class='col col-lg-3'>
          <input type='text' class='form-control' id='inputCompanyChinese' name='company_chinese' placeholder='請填寫公司全名' value='".$data_array['company_chinese']."' readonly='readonly'>
        </div>
        <div class='col col-lg-1  d-flex align-items-center'>
          <label for='inputContactName' class='control-label'>聯絡人</label>
        </div>
        <div class='col col-lg-2'>
          <input type='text' class='form-control' id='inputContactName' name='contact_name' value='".$data_array['contact_name']."' readonly='readonly'>
        </div>
        <div class='col col-lg-2 d-flex align-items-center'>
          <label for='inputContactEmail' class='control-label'>聯絡人E-MAIL</label>
        </div>
        <div class='col col-lg-3'>
          <input type='text' class='form-control' id='inputContactEmail' name='contact_email' value='".$data_array['contact_email']."' readonly='readonly'>
        </div>
      </div>
      <div class='row justify-content-md-center'>
        <div class='col col-lg-1  d-flex align-items-center'>
          <label for='inputContactCompanyPhone' class='control-label'>電話號碼</label>
        </div>
        <div class='col col-lg-3 d-flex align-items-center'>
          <input type='text' class='form-control'  style='width:150px;float:left; display:inline;' id='inputContactCompanyPhone' name='contact_company_phone' value='".$data_array['contact_company_phone']."' readonly='readonly'>
          <label for='inputContactCompanyExtension' style='float:left;display:inline;'>分機</label>
          <input type='text' class='form-control' style='width:70px;'id='inputContactCompanyExtension' name='contact_company_extension' value='".$data_array['contact_company_extension']."' readonly='readonly'>
        </div>
        <div class='col col-lg-1 d-flex align-items-center'>
          <label for='inputContactCompanyFax' class='control-label'>傳真號碼</label>
        </div>
        <div class='col col-lg-3  d-flex align-items-center'>
          <input type='text' class='form-control' id='inputContactCompanyFax' name='contact_company_fax' value='".$data_array['contact_company_fax']."' readonly='readonly'>
        </div>
        <div class='col'>

        </div>
      </div>
      <div class='row justify-content-md-center'>
        <div class='col col-lg-1  d-flex align-items-center'>
          <label for='inputPurchaseOrderNo' class='control-label'>貴公司訂艙編號</label>
        </div>
        <div class='col col-lg-3'>
          <input type='text' class='form-control'  id='inputPurchaseOrderNo' name='purchase_order_no' value='".$data_array['purchase_order_no']."'   placeholder='' >
        </div>
        <div class='col'>
        </div>
        <div class='col col-lg-2 d-flex align-items-center'>
          <label for='inputLcNo' class='control-label'>L/C NO.</label>
        </div>
        <div class='col col-lg-3'>
          <input type='text' class='form-control' id='inputLcNo' name='lc_no' value='".$data_array['lc_no']."'>
        </div>
      </div>

      <div class='row'>
        <div class='col col-lg-2 d-flex align-items-center'>
          <label for='inputHsCode' class='control-label'><font color='red'>*</font>產品 HS CODE</label>
        </div>
        <div class='col col-lg-4' >
          <div class='row'>
            <div class='col col-lg-6 '>
              <input type='text' class='form-control' id='inputHsCode' name='hs_code' value='".$data_array['hs_code']."' required='required'>
               <small class='text-muted'>
                * 請輸入數字
                </small>
            </div>
            <div class='col col-auto d-flex align-items-center'>
              <span id='hs_code_message'>
              </span>
            </div>
          </div>
        </div>
        <div class='col'>
        </div>
        ".$cargo_weight_text."
    </div>
      ".$cargo_weight_remark.$class_text.$cabinet_volume_text.$cabinet_volume_remark."
      
      <div class='row justify-content-md-center'>
        <div class='col col-lg-1 d-flex align-items-center'>
          <label for='inputTremsOfTrade' class='control-label'><font color='red'>*</font>貿易條件</label>
        </div>
        <div class='col col-lg-10'>
          <div class='row'>
            ".getTermsOfTradeRadio($data_array['terms_of_trade'])."
          </div>
        </div>
        <div class='col'>
        </div>
      </div>";
      $terms_of_trade_word_text="";
      $terms_of_trade_remark="";
      if($state=="update"){
        if($data_array['terms_of_trade']=="EX-WORK"){
            $terms_of_trade_word_text="提貨地址";
            
        }elseif($data_array['terms_of_trade']=="DDU" || 
                $data_array['terms_of_trade']=="DDP"){
            $terms_of_trade_word_text="送貨地址";
        }
        if($data_array['terms_of_trade']=="EX-WORK" ||
            $data_array['terms_of_trade']=="DDU" || 
            $data_array['terms_of_trade']=="DDP"){
            $terms_of_trade_remark="<input type='text' class='form-control' name='terms_of_trade_remark' value='".$data_array['terms_of_trade_remark']."'>";
        }
      }
      $result.="
      <div class='row'>
        <div id='terms_of_trade_word' class='col col-lg-1 d-flex align-items-center'>
        ".$terms_of_trade_word_text."
        </div>
        <div class='col col-lg-5' id='terms_of_trade_remark'>
            ".$terms_of_trade_remark."
        </div>
      </div>
      <div class='row justify-content-md-center'>
        <div class='col col-lg-1 d-flex align-items-center'>
          <label for='inputCutOffPlaceId' class='control-label'><font color='red'>*</font>結關地點</label>
        </div>
        <div class='col col-lg-3 d-flex align-items-center'>
          <select class='form-select' id='inputCutOffPlaceId' name='cut_off_place_id' aria-label='Default select example'>
            ".getCutOffPlaceOptionCityChineseValueCityId($data_array['cut_off_place_id'])."
          </select>
        </div>
        <div class='col col-lg-1 d-flex align-items-center'>
            <ul class='list-unstyled'>
                <li class='text-start'><font color='red'>*</font>預計</li>
                <li>貨好日期</li>
            </ul>
        </div>
        <div class='col col-lg-2'>
          <input type='date' class='form-control' id='inputGoodsDate' name='goods_date' value='".$data_array['goods_date']."' required='required'>
          <small class='text-muted'>
            *若貨已好，請填今日日期
          </small>
        </div>
        <div class='col col-lg-1 d-flex align-items-center'>
          <label for='inputCutOffDate' class='control-label'>結關日期</label>
        </div>
        <div class='col col-auto d-flex align-items-center'>
          <input type='date' class='form-control' id='inputCutOffDate' name='cut_off_date' value='".$data_array['cut_off_date']."'>
        </div>
        <div class='col'>
        </div>
      </div>
      <div class='row justify-content-md-center'>
        <div class='col col-lg-1 d-flex align-items-center'>
          <label for='inputDestination' class='control-label'><font color='red'>*</font>目的地</label>
        </div>
        <div class='col col-lg-3'>
          <select class='form-select' id='DestinationCountrySelectDestination' name='destination_country_id'>
            <option selected>請選擇</option>
            ".getShipmentTypeDestinationCountryOptionDestinationCountryEnglishValueCountryId($data_array['destination_country_id'],$data_array['shipment_type'])."
          </select>
        </div>
        <div class='col col-lg-3'>
            <select class='form-select' id='Destination' name='destination_id' required='required'>";
              if($data_array['destination_country_id']){
                $result.= getDestinationOptionDestinationEnglishValueId($data_array['destination_country_id'],$data_array['destination_id']);
              }
          $result.= "
          </select>
        </div>
        <div class='col col-lg-1 d-flex align-items-center'>
          <label for='inputOnBoardDate' class='control-label'>開航日</label>
        </div>
        <div class='col col-auto'>
          <input type='date' class='form-control' id='inputOnBoardDate' name='onboard_date' value='".$data_array['onboard_date']."'>
        </div>
        <div class='col'>
        </div>
      </div>
      <div class='row' id='OceanExportPriceShow' hidden>
      </div>
      <input type='text' id='inputOceanExportPriceData' name='ocean_export_price_data' value='".$data_array['ocean_export_price_data']."' hidden>
      <div class='row'>
        <div class='col col-lg-1 d-flex align-items-center' id='attachments_label_div'>
          <label for='inputAttachments' class='control-label'>".$attachment_color."附檔</label>
        </div>
        <div class='col col-lg-3 d-flex align-items-center'>
        <input type='file' class='form-control'name='attachments[]' id='inputAttachments'  multiple>
        </div>
        <div class='col col-lg-8 d-flex align-items-center'>
            ".$attachment_remark."
        </div>
      </div>
      <div class='row'>
        <div class='col col-lg-1 d-flex align-items-center' id='attachments_label_div'>
        </div>
        <div class='col  col-lg-3 d-flex align-items-center'>
        <input type='file' class='form-control' id='inputOldAttachments' hidden multiple>
        </div>
        <div class='col  col-lg-8 d-flex align-items-center'>
        </div>
      </div>
      <div id='FileList'>
      </div>";
      if($state=="update" && $data_array['attachments']){
        $attachments=explode(";",$data_array['attachments']);
        foreach($attachments as $key=>$attchment){
            if($identity=="staff"){
                $information_href="StaffBookingOrderInformation.php";
            }elseif($identity=="customer"){
                $information_href="BookingOrderInformation.php";
            }
            $result.="
    <div class='row'>
        <div class='col col-lg-1 d-flex align-items-center'>
        </div>
        <div class='col col d-flex align-items-start'>
                <button type='button' class='btn btn-secondary' onclick='PopupCloseWidowClick(\"DeleteFileMessage\",\"./".$information_href."?id=".$data_array['booking_order_id']."&state=delfile&key=".$key."\")'>".$attchment."
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-file-earmark-excel-fill' viewBox='0 0 16 16'>
  <path d='M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM5.884 6.68 8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64z'/>
</svg></button>
        </div>
    </div>";
        }
        $result.="<input type='text' id='file_num' value=".count($attachments)." hidden>";
    }else{
        $result.="<input type='text' id='file_num' value=0 hidden>";
    }
      $result.="
      <div class='row justify-content-md-center'>
        <div class='col col-lg-1 d-flex align-items-center'>
          <label for='textareaRemark' class='control-label'>備註</label>
        </div>
        <div class='col'>
          <textarea class='form-control' id='textareaRemark' name='remark' rows='3'>".$data_array['remark']."</textarea>
        </div>
      </div>
    <div class='checkbox mb-3'>
    </div>";
    return $result;
}
/**
 * 1.員工會員自動選Select會配合Jquery的Textarea內容
 *
 * @author Peter Chang
 * 
 * @param string $pass 為會員審核狀態
 * 
 * @return string
 */
function getStaffAuditMemberSelectTextarea($pass){
    if($pass==1){
        $text="";
        $textarea="
        <textarea class='form-control' id='TextareaPassMessage' rows='3' readonly='readonly' name='pass_message' required='required'>恭喜您已經成為 QAT 測試海運網的會員。</textarea>";
    }elseif($pass==2){
        $text="
    <div class='input-group mb-3'>
    <label class='input-group-text' for='inputGroupSelect01'>因為</label>
        <select class='form-select' id='inputGroupSelectPass'>
            <option value='1'>統一編號不符</option>
            <option value='2'>同行無法使用</option>
            <option value='3'>其他</option>
        </select>
    </div>";
        $textarea="
        <textarea class='form-control' id='TextareaPassMessage' rows='3' name='pass_message' required='required'></textarea>";
    }
    return array($text,$textarea);
}
/**
 * 1.一般彈跳視窗內容
 *
 * @author Peter Chang
 * 
 * @param string $title 彈跳視窗標題
 *
 * @param string $message 彈跳視窗訊息
 * 
 * @param boolean|string $href 是否需要連結到其他網頁
 * 
 * @param boolean $script 是否需要自動跳視窗
 * 
 * @param boolean|string $modal_id 此為彈跳視窗的Id
 * 
 * @return string
 */
function PopupWidowHref($title,$message,$href,$script,$modal_id){
    if (!$modal_id){
        $modal_id="";
    }
    $msg="
<div class='modal fade' id='exampleModal".$modal_id."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>".$title."</h5>
      </div>
      <div class='modal-body'>
        ".$message."
      </div>
      <div class='modal-footer'>";
      if($href=="reload"){
        $msg.="<input type='button' class='btn btn-secondary' data-bs-dismiss='modal'  value='關閉' onclick=\"history.go(0)\" >";
      }elseif($href=="back"){
        $msg.="<input type='button' class='btn btn-secondary' data-bs-dismiss='modal'  value='關閉' onclick=\"history.back()\" >";
      }elseif ($href){
        $msg.="<input type='button' class='btn btn-secondary' data-bs-dismiss='modal'  value='關閉' onclick=\"location.href='".$href."'\" >";
      }else{
                $msg.="<input type='button' class='btn btn-secondary' data-bs-dismiss='modal' value='關閉'>";
      }
      $msg.="</div>
    </div>
  </div>
</div>";
    if($script){
        $msg.='<script type="text/javascript">$(document).ready(function(){$( "#popupwidow'.$modal_id.'" ).click();});</script>';
    }
  return $msg;
}
/**
 * 1.靜態彈跳視窗必須按關閉才能關掉視窗
 *
 * @author Peter Chang
 * 
 * @param string $title 彈跳視窗標題
 *
 * @param string $message 彈跳視窗訊息
 * 
 * @param boolean|string $href 是否需要連結到其他網頁
 * 
 * @param boolean $script 是否需要自動跳視窗
 * 
 * @param boolean|string $modal_id 此為彈跳視窗的Id
 * 
 * @return string
 */
function PopupStaticWidowHref($title,$message,$href,$script,$modal_id){
    if (!$modal_id){
        $modal_id="";
    }
    $msg="
<div class='modal fade' id='examplestaticModal".$modal_id."' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='staticBackdropLabel'>".$title."</h5>
      </div>
      <div class='modal-body'>
        ".$message."
      </div>
      <div class='modal-footer'>";
      if($href=="reload"){
        $msg.="<input type='button' class='btn btn-secondary' data-bs-dismiss='modal'  value='關閉' onclick=\"history.go(0)\" >";
      }elseif($href=="back"){
        $msg.="<input type='button' class='btn btn-secondary' data-bs-dismiss='modal'  value='關閉' onclick=\"history.go(-1)\" >";
      }elseif ($href){
        $msg.="<input type='button' class='btn btn-secondary' data-bs-dismiss='modal'  value='關閉' onclick=\"location.href='".$href."'\" >";
      }else{
        $msg.="<input type='button' class='btn btn-secondary' data-bs-dismiss='modal' value='關閉'>";
      }
      $msg.="</div>
    </div>
  </div>
</div>";
    if($script){
        $msg.='<script type="text/javascript">$(document).ready(function(){$( "#staticBackdrop'.$modal_id.'" ).click();});</script>';
    }
  return $msg;
}
/**
 * 1.此為關閉視窗為確認及取消
 *
 * @author Peter Chang
 * 
 * @param string $title 彈跳視窗標題
 *
 * @param string $message 彈跳視窗訊息
 * 
 * @param string $value 為確認前往的按鈕顯示文字
 * 
 * @param string $close 為關閉視窗顯示的文字
 * 
 * @param boolean|string $href 是否需要連結到其他網頁
 * 
 * @param boolean $script 是否需要自動跳視窗
 * 
 * @param boolean|string $modal_id 此為彈跳視窗的Id
 * 
 * @return string
 */
function PopupCloseWidowHref($title,$message,$value,$close,$href,$script,$modal_id){
    if (!$modal_id){
        $modal_id="";
    }
    $msg="
<div class='modal fade' id='exampleModalclose".$modal_id."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>".$title."</h5>
         <input type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
      </div>
      <div class='modal-body'>
        ".$message."
      </div>
      <div class='modal-footer'>";
        $msg.="<input type='button' class='btn btn-secondary' id='popupclosewidowId".$modal_id."' data-bs-dismiss='modal'  value='".$value."'  >";
       $msg.="<input type='button' class='btn btn-secondary' data-bs-dismiss='modal' value='".$close."'>";
      $msg.="</div>
    </div>
  </div>
</div>";
    if($script){
        $msg.='<script type="text/javascript">$(document).ready(function(){$( "#popupclosewidow'.$modal_id.'" ).click();});</script>';
    }
  return $msg;
}
/**
 * 1.彈跳視窗隱藏按鈕
 *
 * @author Peter Chang
 * 
 * @param boolean|string $modal_id 此為彈跳視窗的Id
 * 
 * @param boolean|string $static_id 此為靜態彈跳視窗的Id
 * 
 * @param boolean|string $modal_close_id 此為關閉彈跳視窗的Id
 * 
 * @return string
 */
function PopupWidowScriptHiddenButton($modal_id,$static_id=false,$modal_close_id=false){
    $msg="
<input type='button' class='btn btn-primary' id='popupwidow' data-bs-toggle='modal' data-bs-target='#exampleModal' hidden>";
    if($modal_id){
        $msg.="<input type='button' class='btn btn-primary' id='popupwidow".$modal_id."' data-bs-toggle='modal' data-bs-target='#exampleModal".$modal_id."' hidden>";
    }
    if($static_id){
        $msg.="<input type='button' class='btn btn-primary' id='staticBackdrop".$static_id."' data-bs-toggle='modal' data-bs-target='#examplestaticModal".$static_id."' hidden>";
    }
    if($modal_close_id){
        $msg.="<input type='button' class='btn btn-primary' id='popupclosewidow".$modal_close_id."' data-bs-toggle='modal' data-bs-target='#exampleModalclose".$modal_close_id."' hidden>";
    }
    return $msg;

}
function JumpPageDelay($href,$second=3){
    $second=$second*1000;
    $msg='<script type="text/javascript">';
    $msg.='setTimeout("window.location.href= \''.$href.'\'",'.$second.')';
    $msg.='</script>';
    return $msg;
}
/**
 * 1.全部頁面共用頁數頁碼顯示
 *
 * @author Peter Chang
 * 
 * @param integer $page 目前第幾頁
 * 
 * @param integer $pages 總頁數
 * 
 * @return string
 */
function getAllPageNum($page,$pages){
    $select_num="";
    $content="<ul class='pagination'>";
    if($page==1)        {$disf = " btn disabled";}else {$disf="";}
    if($page==$pages)   {$disl = " btn disabled";}else {$disl="";}
    for ($co=1;$co<=$pages;$co++) {
        if ($co==$page){
            $select_num.= "\t<option value=$co selected>$co</option>";
        }else{
            $select_num.= "\t<option value=$co>$co</option>";
        }
    }
    //<button type='button' onclick='movepage(1)' ".$disf."> |< </button>
    $content.="
    <li class='page-item'>
    <a class='page-link".$disf."' href='#' onclick='movepage(1)'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-chevron-bar-left' viewBox='0 0 16 16'>
        <path fill-rule='evenodd' d='M11.854 3.646a.5.5 0 0 1 0 .708L8.207 8l3.647 3.646a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708 0zM4.5 1a.5.5 0 0 0-.5.5v13a.5.5 0 0 0 1 0v-13a.5.5 0 0 0-.5-.5z'/>
        </svg>
    </a>
    </li>
    <li class='page-item'>
    <a class='page-link".$disf."' href='#'  onclick='movepage(".($page-1).")' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a>
    </li>";
    for( $i=1 ; $i<=$pages ; $i++ ) {
        if ( $page-10 < $i && $i < $page+10 ) {
            $content.= "<li class='page-item'><a class='page-link' href='#' onclick='movepage($i)'>".$i."</a></li>";
        }
    } 
    $content.="
    <li class='page-item'>
      <a class='page-link".$disl."' href='#' aria-label='Next' onclick='movepage(".($page+1).")'><span aria-hidden='true'>&raquo;</span>
      </a>
      </li>
    <li class='page-item'>
    <a class='page-link".$disl."' href='#' onclick='movepage(".$pages.")'> 
    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-chevron-bar-right' viewBox='0 0 16 16'>
    <path fill-rule='evenodd' d='M4.146 3.646a.5.5 0 0 0 0 .708L7.793 8l-3.647 3.646a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708 0zM11.5 1a.5.5 0 0 1 .5.5v13a.5.5 0 0 1-1 0v-13a.5.5 0 0 1 .5-.5z'/>
    </svg>
     </a>
    </li>
    <li class='page-item'>
   <div class='input-group'>
    <select class='form-select' size='1' id='selectpage'>".$select_num."</select>
    <span class='align-self-center'>
     頁，共".$pages."頁</div>
    </div>
    </li>
    </ul>";
return $content;
}
/**
 * 1.若無預設顯示比數的話直接預設1頁10筆
 *
 * @author Peter Chang
 * 
 * @return integer
 */
function getAllPageNumPer(){
    $per=10;
    return $per;
}
/**
 * 1.全部頁面共用頁數計算
 *
 * @author Peter Chang
 * 
 * @param integer $page 目前第幾頁
 * 
 * @param integer $page_total 總筆數
 * 
 * @param boolean|integer $per 一頁幾筆
 * 
 * @return array(string,integer,integer,integer)
 */
function getListPageText($page,$page_total,$per=false){
    if ($page==0){$page=1;}
    if(!$per){
        $per=getAllPageNumPer();
    }
    $pages = ceil($page_total/$per);
    if($page>$pages && $pages!=0){$page=$pages;}
    $start = ($page-1)*$per;
    $page_text=getAllPageNum($page,$pages);
    return array($page_text,$page,$start,$per);
}
/**
 * 1.href右上顯示未處理訊息使用
 *
 * @author Peter Chang
 * 
 * @param integer $text 顯示數字為多少
 * 
 * @return string
 */
function getHtmlButtonAHrefBadge($text){
    $msg="<span class='position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger'>
            ".$text."
            <span class='visually-hidden'>unread messages</span>
            </span>";
    return $msg;
}
/**
 * 1.
 *
 * @author Peter Chang
 * 
 * @param string $href 超連結
 * 
 * @return string
 */
function getHtmlFormCheckInlineInputRadio($name,$ids,$values,$labels,$default_value){
    $result="";
    foreach($ids as $key=>$id){
        if(($default_value=="" || $default_value===false) && $key==0){
            $checked=" checked";
        }elseif($values[$key]==$default_value){
            $checked=" checked";
        }else{
            $checked="";
        }
        $result.="
    <div class='form-check form-check-inline'>
        <input class='form-check-input' type='radio' name='".$name."' id='".$ids[$key]."' value='".$values[$key]."' ".$checked.">
        <label class='form-check-label' for='".$ids[$key]."'>".$labels[$key]."</label>
    </div>
    ";
    }
    return $result;
}
/**
 * 1.
 *
 * @author Peter Chang
 * 
 * @param string $href 超連結
 * 
 * @return string
 */
function getHtmlFormCheckInlineInputCheckBoxCheckedOne($name,$value,$label,$default_value){
    $result="";
    if($default_value=="" || $default_value===false){
        $checked=" checked";
    }elseif($value==$default_value){
        $checked=" checked";
    }else{
        $checked="";
    }
        $result.="
    <input class='form-check-input' type='checkbox' name='".$name."' value='".$value."' ".$checked.">
          <label class='form-check-label' >".$label."</label>
    ";
    
    return $result;
}
/**
 * 1.HtmlAHref資訊Icon顯示
 *
 * @author Peter Chang
 * 
 * @param string $href 超連結
 * 
 * @return string
 */
function getHtmlAHrefInformationIcon($href){
    $result="<a href='".$href."' class='information'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-info-circle' viewBox='0 0 16 16'>
  <path d='M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z'/>
  <path d='m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z'/></svg></a>";
    return $result;
}
/**
 * 1.HtmlAHref修改Icon顯示
 *
 * @author Peter Chang
 * 
 * @param string $href 超連結
 * 
 * @return string
 */
function getHtmlAHrefUpdateIcon($href){
    $result="<a href='".$href."' class='update'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
  <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
  <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/></svg></a>";
    return $result;
}
/**
 * 1.HtmlAHref合併Icon顯示
 *
 * @author Peter Chang
 * 
 * @param string $href 超連結
 * 
 * @return string
 */
function getHtmlAHrefMergeIcon($href){
    $result="<a href='".$href."' class='merge'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-arrows-collapse' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M1 8a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 8zm7-8a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 4.293V.5A.5.5 0 0 1 8 0zm-.5 11.707-1.146 1.147a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 11.707V15.5a.5.5 0 0 1-1 0v-3.793z'/></svg></a>";
    return $result;
}
/**
 * 1.HtmlAHref還原Icon顯示
 *
 * @author Peter Chang
 * 
 * @param string $href 超連結
 * 
 * @param string $onclick 觸發Juery跳視窗
 * 
 * @return string
 */
function getHtmlAHrefReplyFillIcon($href,$onclick){
    $result="<a href='".$href."' onclick='".$onclick."' class='reply'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-reply-fill' viewBox='0 0 16 16'><path d='M5.921 11.9 1.353 8.62a.719.719 0 0 1 0-1.238L5.921 4.1A.716.716 0 0 1 7 4.719V6c1.5 0 6 0 7 8-2.5-4.5-7-4-7-4v1.281c0 .56-.606.898-1.079.62z'/></svg></a>";
    return $result;
}
/**
 * 1.HtmlAHref垃圾桶Icon顯示
 *
 * @author Peter Chang
 * 
 * @param string $href 超連結
 * 
 * @param string $onclick 觸發Juery跳視窗
 * 
 * @return string
 */
function getHtmlAHrefTrashIcon($href,$onclick){
    $result="<a href='".$href."' onclick='".$onclick."' class='trash'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
  <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></a>";
    return $result;
}
/**
 * 1.HtmlAHref取消Icon顯示
 *
 * @author Peter Chang
 * 
 * @param string $href 超連結
 * 
 * @param string $onclick 觸發Juery跳視窗
 * 
 * @return string
 */
function getHtmlAHrefCancelIcon($href,$onclick){
    $result="<a href='".$href."' onclick='".$onclick."' class='cancel'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-x-square' viewBox='0 0 16 16'>
  <path d='M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z'/>
  <path d='M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z'/></svg></a>";
    return $result;
}
/**
 * 1.HtmlAHref員工客服部成為客服人員Icon顯示
 *
 * @author Peter Chang
 * 
 * @param string $href 超連結
 * 
 * @param string $onclick 觸發Juery跳視窗
 * 
 * @return string
 */
function getHtmlAHrefRecieveBookingOrderIcon($href,$onclick){
    $result="<a href='".$href."' onclick='".$onclick."' class='recieve'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-clipboard-check' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z'/>
  <path d='M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z'/>
  <path d='M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z'/></svg></a>";
    return $result;
}
/**
 * 1.HtmlAHref員工結案Icon顯示
 *
 * @author Peter Chang
 * 
 * @param string $href 超連結
 * 
 * @param string $onclick 觸發Juery跳視窗
 * 
 * @return string
 */
function getHtmlAHrefCaseClosedBookingOrderIcon($href,$onclick){
    $result="<a href='".$href."' onclick='".$onclick."' class='case_closed'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-folder-check' viewBox='0 0 16 16'>
  <path d='m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z'/>
  <path d='M15.854 10.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.707 0l-1.5-1.5a.5.5 0 0 1 .707-.708l1.146 1.147 2.646-2.647a.5.5 0 0 1 .708 0z'/>
</svg></a>";
    return $result;
}
/**
 * 1.HtmlAHref員工提供S/O Icon顯示
 *
 * @author Peter Chang
 * 
 * @param string $href 超連結
 * 
 * @param string $onclick 觸發Juery跳視窗
 * 
 * @return string
 */
function getHtmlAHrefProvideSoBookingOrderIcon($href,$onclick){
    $result="<a href='".$href."' onclick='".$onclick."' class='provide_so'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-file-earmark-medical-fill' viewBox='0 0 16 16'>
  <path d='M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-3 2v.634l.549-.317a.5.5 0 1 1 .5.866L7 7l.549.317a.5.5 0 1 1-.5.866L6.5 7.866V8.5a.5.5 0 0 1-1 0v-.634l-.549.317a.5.5 0 1 1-.5-.866L5 7l-.549-.317a.5.5 0 0 1 .5-.866l.549.317V5.5a.5.5 0 1 1 1 0zm-2 4.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zm0 2h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z'/>
</svg></a>";
    return $result;
}
/**
 * 1.HtmlAHref文件核對Icon顯示
 *
 * @author Peter Chang
 * 
 * @param string $href 超連結
 * 
 * @param string $onclick 觸發Juery跳視窗
 * 
 * @return string
 */
function getHtmlAHrefDocumentCheckBookingOrderIcon($href,$onclick){
    $result="<a href='".$href."' onclick='".$onclick."' class='document_check'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-file-check-fill' viewBox='0 0 16 16'>
  <path d='M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-1.146 6.854-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708.708z'/>
</svg></a>";
    return $result;
}
/**
 * 1.HtmlAHref財務收款Icon顯示
 *
 * @author Peter Chang
 * 
 * @param string $href 超連結
 * 
 * @param string $onclick 觸發Juery跳視窗
 * 
 * @return string
 */
function getHtmlAHrefCollectionBookingOrderIcon($href,$onclick){
    $result="<a href='".$href."' onclick='".$onclick."' class='collection'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-server' viewBox='0 0 16 16'>
  <path d='M1.333 2.667C1.333 1.194 4.318 0 8 0s6.667 1.194 6.667 2.667V4c0 1.473-2.985 2.667-6.667 2.667S1.333 5.473 1.333 4V2.667z'/>
  <path d='M1.333 6.334v3C1.333 10.805 4.318 12 8 12s6.667-1.194 6.667-2.667V6.334a6.51 6.51 0 0 1-1.458.79C11.81 7.684 9.967 8 8 8c-1.966 0-3.809-.317-5.208-.876a6.508 6.508 0 0 1-1.458-.79z'/>
  <path d='M14.667 11.668a6.51 6.51 0 0 1-1.458.789c-1.4.56-3.242.876-5.21.876-1.966 0-3.809-.316-5.208-.876a6.51 6.51 0 0 1-1.458-.79v1.666C1.333 14.806 4.318 16 8 16s6.667-1.194 6.667-2.667v-1.665z'/>
</svg></a>";
    return $result;
}
/**
 * 1.HtmlAHref結關日Icon顯示
 *
 * @author Peter Chang
 * 
 * @param string $href 超連結
 * 
 * @param string $onclick 觸發Juery跳視窗
 * 
 * @return string
 */
function getHtmlAHrefBookingOrderCutOffDateIcon($href,$onclick){
    $result="<a href='".$href."' onclick='".$onclick."' class='cut_off_date'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-flag' viewBox='0 0 16 16'>
  <path d='M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12.435 12.435 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A19.626 19.626 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a19.587 19.587 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21.294 21.294 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21.317 21.317 0 0 0 14 7.655V1.222z'/>
</svg></a>";
    return $result;
}
/**
 * 1.HtmlAHref開航日Icon顯示
 *
 * @author Peter Chang
 * 
 * @param string $href 超連結
 * 
 * @param string $onclick 觸發Juery跳視窗
 * 
 * @return string
 */
function getHtmlAHrefBookingOrderOnBoardDateIcon($href,$onclick){
    $result="<a href='".$href."' onclick='".$onclick."' class='onboard_date'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-tsunami' viewBox='0 0 16 16'>
  <path d='M.036 12.314a.5.5 0 0 1 .65-.278l1.757.703a1.5 1.5 0 0 0 1.114 0l1.014-.406a2.5 2.5 0 0 1 1.857 0l1.015.406a1.5 1.5 0 0 0 1.114 0l1.014-.406a2.5 2.5 0 0 1 1.857 0l1.015.406a1.5 1.5 0 0 0 1.114 0l1.757-.703a.5.5 0 1 1 .372.928l-1.758.703a2.5 2.5 0 0 1-1.857 0l-1.014-.406a1.5 1.5 0 0 0-1.114 0l-1.015.406a2.5 2.5 0 0 1-1.857 0l-1.014-.406a1.5 1.5 0 0 0-1.114 0l-1.015.406a2.5 2.5 0 0 1-1.857 0l-1.757-.703a.5.5 0 0 1-.278-.65zm0 2a.5.5 0 0 1 .65-.278l1.757.703a1.5 1.5 0 0 0 1.114 0l1.014-.406a2.5 2.5 0 0 1 1.857 0l1.015.406a1.5 1.5 0 0 0 1.114 0l1.014-.406a2.5 2.5 0 0 1 1.857 0l1.015.406a1.5 1.5 0 0 0 1.114 0l1.757-.703a.5.5 0 1 1 .372.928l-1.758.703a2.5 2.5 0 0 1-1.857 0l-1.014-.406a1.5 1.5 0 0 0-1.114 0l-1.015.406a2.5 2.5 0 0 1-1.857 0l-1.014-.406a1.5 1.5 0 0 0-1.114 0l-1.015.406a2.5 2.5 0 0 1-1.857 0l-1.757-.703a.5.5 0 0 1-.278-.65zM2.662 8.08c-.456 1.063-.994 2.098-1.842 2.804a.5.5 0 0 1-.64-.768c.652-.544 1.114-1.384 1.564-2.43.14-.328.281-.68.427-1.044.302-.754.624-1.559 1.01-2.308C3.763 3.2 4.528 2.105 5.7 1.299 6.877.49 8.418 0 10.5 0c1.463 0 2.511.4 3.179 1.058.67.66.893 1.518.819 2.302-.074.771-.441 1.516-1.02 1.965a1.878 1.878 0 0 1-1.904.27c-.65.642-.907 1.679-.71 2.614C11.076 9.215 11.784 10 13 10h2.5a.5.5 0 0 1 0 1H13c-1.784 0-2.826-1.215-3.114-2.585-.232-1.1.005-2.373.758-3.284L10.5 5.06l-.777.388a.5.5 0 0 1-.447 0l-1-.5a.5.5 0 0 1 .447-.894l.777.388.776-.388a.5.5 0 0 1 .447 0l1 .5a.493.493 0 0 1 .034.018c.44.264.81.195 1.108-.036.328-.255.586-.729.637-1.27.05-.529-.1-1.076-.525-1.495-.426-.42-1.19-.77-2.477-.77-1.918 0-3.252.448-4.232 1.123C5.283 2.8 4.61 3.738 4.07 4.79c-.365.71-.655 1.433-.945 2.16-.15.376-.301.753-.463 1.13z'/>
</svg></a>";
    return $result;
}
/**
 * 1.HtmlAHref往下個步驟Icon顯示
 *
 * @author Peter Chang
 * 
 * @param string $href 超連結
 * 
 * @param string $onclick 觸發Juery跳視窗
 * 
 * @param string $class 設定class
 * 
 * @return string
 */
function getHtmlAHrefBookingOrderNextScheduleIcon($href,$onclick,$class){
    $result="<a href='".$href."'  onclick='".$onclick."' class='".$class."'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-box-arrow-right' viewBox='0 0 16 16'>
  <path fill-rule='evenodd' d='M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z'/>
  <path fill-rule='evenodd' d='M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z'/>
</svg></a>";
    return $result;
}
/**
 * 1.HtmlAHref上傳檔案及日期Icon顯示
 *
 * @author Peter Chang
 * 
 * @param string $href 超連結
 * 
 * @param string $onclick 觸發Juery跳視窗
 * 
 * @param string $class 設定class
 * 
 * @return string
 */
function getHtmlAHrefBookingOrderDateIcon($href,$onclick,$class){
    $result="<a href='".$href."' onclick='".$onclick."' class='".$class."'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-calendar-check' viewBox='0 0 16 16'>
  <path d='M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z'/>
  <path d='M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z'/>
</svg></a>";
    return $result;
}
/**
 * 1.HtmlAHref回復至上個步驟Icon顯示
 *
 * @author Peter Chang
 * 
 * @param string $href 超連結
 * 
 * @param string $onclick 觸發Juery跳視窗
 * 
 * @param string $class 設定class
 * 
 * @return string
 */
function getHtmlAHrefBookingOrderScheduleReplyIcon($href,$onclick,$class){
    $result="<a href='".$href."' onclick='".$onclick."' class='".$class."'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-skip-backward-circle-fill' viewBox='0 0 16 16'>
  <path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.79-2.907L8.5 7.028V5.5a.5.5 0 0 0-.79-.407L5 7.028V5.5a.5.5 0 0 0-1 0v5a.5.5 0 0 0 1 0V8.972l2.71 1.935a.5.5 0 0 0 .79-.407V8.972l2.71 1.935A.5.5 0 0 0 12 10.5v-5a.5.5 0 0 0-.79-.407z'/>
</svg></a>";
    return $result;
}
/**
 * 1.HtmlAHref附檔Icon顯示
 *
 * @author Peter Chang
 * 
 * @param string $href 超連結
 * 
 * @param string $text 附檔檔名
 * 
 * @return string
 */
function getHtmlAHrefBookingOrderAttachmentIcon($href,$text){
    $result="<a href='".$href."'  target='_blank' class='text-decoration-none'>".$text."<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-file-earmark-check-fill' viewBox='0 0 16 16'>
  <path d='M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm1.354 4.354-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708z'/>
</svg></a>";
    return $result;
}
/**
 * 1.HtmlAHref附檔Icon顯示
 *
 * @author Peter Chang
 * 
 * @param string $href 超連結
 * 
 * @param string $attachment 附檔檔名
 * 
 * @return string
 */
function getHtmlButtonBookingOrderMemberAttachmentIcon($href,$attachment){
    $result="<button type='button' class='btn btn-secondary' onclick='window.open(\"".$href."\", \"_blank\")'>".$attachment."<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-file-earmark-check-fill' viewBox='0 0 16 16'>
  <path d='M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm1.354 4.354-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708z'/>
</svg></button> ";
    return $result;
}
/**
 * 1.HtmlAHref黑單Icon顯示
 *
 * @author Peter Chang
 * 
 * @param string $href 超連結
 * 
 * @param string $onclick 點擊觸發Juqery事件
 * 
 * @return string
 */
function getHtmlAHrefAddBlackListIcon($href,$onclick){
    $result="<a href='".$href."' onclick='".$onclick."' class='add_blacklist'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-person-x' viewBox='0 0 16 16'><path d='M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z'/>
  <path fill-rule='evenodd' d='M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z'/>
</svg></a>";
    return $result;
}
/**
 * 1.HtmlAHref移除黑單Icon顯示
 *
 * @author Peter Chang
 * 
 * @param string $href 超連結
 * 
 * @param string $onclick 點擊觸發Juqery事件
 * 
 * @return string
 */
function getHtmlAHrefRemoveBlackListIcon($href,$onclick){
    $result="<a href='".$href."'  onclick='".$onclick."' class='remove_blacklist'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-person-check' viewBox='0 0 16 16'>
  <path d='M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z'/>
  <path fill-rule='evenodd' d='M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z'/>
</svg></a>";
    return $result;
}

?>