<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', 'on');

$msg = '';
if(!($_SERVER["REQUEST_METHOD"]=== 'GET')){

    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $text = $_POST['text'];

    require_once __DIR__ .DIRECTORY_SEPARATOR. 'mail.php';
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
<?=$msg?>
<form action="" method="post">
    <textarea name="text" id="" cols="30" rows="10" placeholder="text"><?php if(!empty($_POST['text']))$_POST['text']?></textarea>
    <input type="text" name="subject" placeholder="subject" value=<?php if(!empty($_POST['subject']))$_POST['subject']?>>
    <input type="email" name="to" placeholder="email" value=<?php if(!empty($_POST['to']))$_POST['to'] ?>>
    <input type="submit" value="送信">
</form>

<a href="index.php">ユーザー登録画面へ</a>
</body>
</html>

