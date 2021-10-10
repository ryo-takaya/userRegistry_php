<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require_once __DIR__ .DIRECTORY_SEPARATOR. 'util' .DIRECTORY_SEPARATOR. 'validation.php';
require_once dirname(__FILE__).DIRECTORY_SEPARATOR. 'util' .DIRECTORY_SEPARATOR.'db'.DIRECTORY_SEPARATOR.'db.php';


$displayErrors = function(array $errorMsg){
    foreach ($errorMsg as $msg) {
        echo "※" . $msg . PHP_EOL;
    }
};


if(!($_SERVER["REQUEST_METHOD"]=== 'GET')){

  $validator = new UserRegisterValidation($_POST);
  $validator->validate();
  if($validator->isError()){
      $errors = $validator->getErrors();
  }else{
      try{
          $db = SettingDb::connectDb();
          $stmt = $db->prepare('INSERT INTO users (email, pass, created_at) VALUES (:email, :pass, :created_at)');
          $stmt->execute([':email' => $_POST['email'], ':pass' => $_POST['pass'], ':created_at' => date('Y-m-d H:i:s')]);
          header('Location:mypage.php');
      }catch(PDOException $err){
          $msg = $err->getMessage();
          echo $msg;
      }

  }

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登録画面</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
<h1>ユーザー登録</h1>

<form method="post">
    <span class="error"><?php isset($errors['email']) && $displayErrors($errors['email']) ?></span>>
    <input name="email"  type="email" placeholder="eメール">
    <span class="error"><?php isset($errors['pass']) && $displayErrors($errors['pass']) ?></span>>
    <input name="pass" type="password" placeholder="パスワード">
    <span class="error"><?php isset($errors['rePass']) && $displayErrors($errors['rePass']) ?></span>>
    <input name="rePass" type="password" placeholder="パスワード再入力">
    <input type="submit" value="送信">
</form>
<a href="mypage.php">マイページへ</a>
</body>
</html>