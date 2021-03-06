<?php

class UserRegisterValidation {

    /**
     * このクラスでバリデーションするパラメータ
     */
    const VALIDATION_PARAMS = ['email', 'pass', 'rePass'];

    /**
     * @var array エラーの文言
     */
    private $errors = [];

    /**
     * @var array リクエストデータ
     */
    private $data;

    /**
     * @var PDO $dbh データベースハンドラ
     */
    private $dbh;

    /**
     * UserRegisterValidation constructor.
     * @param array $data
     * @param PDO $dbh
     */
    public function __construct(array $data, PDO $dbh)
    {
        $this->data = $data;
        $this->dbh = $dbh;
    }

    public function validate(){
      $requestData = $this->data;
      $validationParams = self::VALIDATION_PARAMS;

      // 必須パラメータがあるか確認
      foreach ($requestData as $key => $value) {
          if(!in_array($key,$validationParams)){
            $this->setError($key,"${key}が空です");
          }
      }

      // emailの形式が正しいか
      if(!preg_match("/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/",$requestData['email'])){
        $this->setError('email', 'emailの形式が正しくありません');
      }

      // emailがユニークか
      if(!$this->isUniqEmail()){
          $this->setError('email', '既に登録されているemailです');
      }

      // パスワードと再入力のパスワードが一緒かどうか
      if($requestData['pass'] !== $requestData['rePass']){
          $this->setError('rePass', 'passWordが一致しておりません');
      }

      // パスワードが半角英数字か
      if (!preg_match("/^[0-9a-zA-Z]*$/", $requestData['pass'])) {
        $this->setError('pass', 'パスワードが半角英数字じゃありません');
      }

      // パスワードが6文字以上か
      if (strlen($requestData['pass']) < 5) {
          $this->setError('pass','passwordは6文字以上です');
      }
    }

    // emailアドレスが一意か調べる
    private function isUniqEmail(){
        $stmt = $this->dbh->prepare('select email from users where email = :email');
        $stmt->execute([':email' => $this->data['email']]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump(count($result));
        return count($result) === 0;
    }

    private function setError(string $key, string $message){
        $this->errors[$key][] = $message;
    }

    public function getErrors(){
      return $this->errors;
   }

   public function isError(){
     return count($this->errors) > 0;
   }


}
