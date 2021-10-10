<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', 'on');

if(!empty($to) && !empty($subject) && !empty($text)){

    mb_language('ja');
    mb_internal_encoding('UTF-8');

    $result = mb_send_mail($to,$subject,$text);

    if($result){
        unset($_POST);
        $msg = '成功';
    }else{
        $msg = '失敗';
    }
}else{
    $msg = '全て必須です';
}