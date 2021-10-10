<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', 'on');

$displayErrors = function(array $errorMsg){
    foreach ($errorMsg as $msg) {
        echo "※" . $msg . PHP_EOL;
    }
};


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ログイン画面</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
<h1>ログインしてください</h1>

<form method="post">
    <span class="error"><?php isset($errors['email']) && $displayErrors($errors['email']) ?></span>>
<input name="email"  type="email" placeholder="eメール">
<span class="error"><?php isset($errors['pass']) && $displayErrors($errors['pass']) ?></span>>
<input name="pass" type="password" placeholder="パスワード">

<input type="submit" value="送信">
</form>
<a href="mypage.php">マイページへ</a>
</body>
</html>
