<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require_once dirname(__FILE__).DIRECTORY_SEPARATOR. 'util' .DIRECTORY_SEPARATOR.'db'.DIRECTORY_SEPARATOR.'db.php';

$errorMsg = [];

if(!($_SERVER["REQUEST_METHOD"]=== 'GET')) {
  $dbh = SettingDb::connectDb();
  $stmt = $dbh->prepare('select * from users where email = :email');
  $stmt->execute([':email' => $_POST['email']]);
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  if(empty($result)){
      $errorMsg[] = 'emailかpasswordが間違っています';
  }else{
      $passwordVerifyResult = password_verify($_POST['pass'], $result['pass']);

      if(!$passwordVerifyResult){
          $errorMsg[] = 'emailかpasswordが間違っています';
      } else {
          session_start();
          $_SESSION['login'] = 'true';
          $_SESSION['email'] = $result['email'];
          header('Location:mypage.php');
      }
  }
}


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
<br>
<h1>ログインしてください</h1>

<form method="post">
    <span class="error"><?php if(isset($errorMsg[0])) echo $errorMsg[0] ?></span></br>
<input name="email"  type="email" placeholder="eメール">

<input name="pass" type="password" placeholder="パスワード">

<input type="submit" value="送信">
</form>
<a href="mypage.php">マイページへ</a></br>
<a href="index.php">登録画面へ</a>
</body>
</html>
