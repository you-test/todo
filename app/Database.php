<?php

//データベースへの接続
class Database
{
  public static $instance;

  public static function getInstance()
  {
    try {
      if (!isset($instance)) {
        self::$instance = new PDO(
          DSN,
          USERNAME,
          PASSWORD,
          [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES => false,
          ]
        );
      }
      return self::$instance;
    } catch (PDOException $e){
      echo $e->getMessage();
      exit;
    }
  }
}
