<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', 'on');

if(!($_SERVER["REQUEST_METHOD"]=== 'GET')){
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $text = $_POST['text'];

}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>コンタクト画面</title>
</head>
<body>
<h1>コンタクト</h1>
<form action="">
    <textarea name="text" id="" cols="30" rows="10"></textarea>
    <input type="text" name="subject">
    <input type="email" name="to">
    <input type="submit" value="送信">
</form>

<a href="index.php">ユーザー登録画面へ</a>
</body>
</html>

