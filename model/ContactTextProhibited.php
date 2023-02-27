<?php
/**
 * 1.資料庫ContactTextProhibited 聯絡文字禁止的資料
 *
 * @author Peter Chang
 * 
 * @return array
 */
function sqlSelectContactTextProhibited(){
    $sql = "SELECT * 
    FROM `contact_text_prohibited`";
    return sendSQL($sql);
}

?>