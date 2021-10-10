<?php

class SettingDb {
    /**
     * @return PDO dbハンドラを返す
     * @throws PDOException データベースの接続に失敗したらthrow
     */
    public static function connectDb() {
        try{
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true
            ];
            return new PDO('mysql:dbname=users;host=localhost;charset=utf8','root','root',$options);
        } catch(PDOException $exception){
            throw new RUNtimeException('dbの接続に失敗しました');
        }
    }
}