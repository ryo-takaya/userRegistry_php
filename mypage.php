<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', 'on');
session_start();

if(is_null($_SESSION['login'])){
    header('Location:login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登録画面</title>
</head>
<body>
<h1>マイページ</h1>
<section>
    <p>
        あなたのemailは<?= $_SESSION['email'] ?>
    </p>
    <p>
        あなたの名前は@@@
    </p>
</section>

<a href="index.php">ユーザー登録画面へ</a>
</body>
</html>
