<?php
/**
 * 1.資料庫連接正式用
 *
 * @author Peter Chang
 * 
 * @return mysqli
 */
function getSQLLink() {
    $db = mysqli_connect("127.0.0.1", "qa_trans", "qat-1968");
    if (!$db) die("Error: 無法連接MySQL伺服器!" . mysqli_connect_error());
    mysqli_select_db($db, "qat_logistics") or
        die("Error: 無法選擇資料庫!" . mysqli_error($db));
    mysqli_query($db, "SET NAMES utf8");
    return $db;
}
/**
 * 1.資料庫連接測試用改用自己主機的帳號及密碼
 *
 * @author Peter Chang
 * 
 * @return mysqli
 */
function getSQLLink_test() {
    $db = mysqli_connect("127.0.0.1", "root", "123456");
    if (!$db) die("Error: 無法連接MySQL伺服器!" . mysqli_connect_error());
    mysqli_select_db($db, "ocean_website") or
        die("Error: 無法選擇資料庫!" . mysqli_error($db));
    mysqli_query($db, "SET NAMES utf8");
    return $db;
}
/**
 * 1.網址連接處
 *
 * @author Peter Chang
 * 
 * @return string
 */
function getURLLink(){
    if (isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS'])) {
        $http="https";
    }else{
        $http="http";
    }
    return $http."://".$_SERVER['HTTP_HOST']."/qat_logistics/";}
    //return $http."://".$_SERVER['HTTP_HOST']."/test_qat/";}
?>