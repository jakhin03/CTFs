<?php

class DB
{
    private static $instance = NULl;
    public static function getInstance() {
      if (!isset(self::$instance)) {
        try {
          $connectionString = "mysql:host=10.7.0.3;dbname=user2_db";
          self::$instance = new PDO($connectionString, "user2", "user2password");
          self::$instance->exec("SET NAMES 'utf8'");
        } catch (PDOException $ex) {
          die($ex->getMessage());
        }
      }
      return self::$instance;
    }
}