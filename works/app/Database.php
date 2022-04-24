<?php
require_once('env.php');

class Database
{
  private static $instance; //このクラスに一つだけの値になるようにクラス変数を作成

  public static function getInstance()
  {
    try {
      if (!isset(self::$instance)) { //もしクラス変数に値がセットされていないときだけ接続
        self::$instance = new PDO(
          DSN,
          DB_USER,
          DB_PASS,
          [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //エラー時に例外を投げる
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, //オブジェクト形式で結果を取得
            PDO::ATTR_EMULATE_PREPARES => false, //SQL で定義した型に合わせて取得
          ]
        );
      }
      return self::$instance;
    } catch (PDOException $e) {
      echo '接続に失敗しました。' . $e->getMessage();
      exit;
    }
  }
}
