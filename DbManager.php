<?php

function getDb() {
  $dsn = 'mysql:dbname=lclib; host=127.0.0.1';
  $usr = 'user';
  $passwd = 'pass';

  try {
    $db = new PDO($dsn, $usr, $passwd);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec('SET NAMES utf8');
  } catch (PDOException $e) {
    die("接続エラー：{$e->getMessage()}");
  }
  return $db;
}

function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

?>
