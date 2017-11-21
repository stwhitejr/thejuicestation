<?php
  class Db {
    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
      if (!isset(self::$instance)) {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        self::$instance = new PDO('mysql:host=50.62.177.78;dbname=JSSQL01', 'stwhite', 'Br0ken!', $pdo_options);
      }
      return self::$instance;
    }
  }
?>