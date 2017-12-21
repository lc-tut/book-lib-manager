<?php

function getDb() {
  $dsn = 'mysql:dbname=lc_user; host=127.0.0.1';
  $usr = 'user';
  $passwd = 'password';

  try {
    $user = new PDO($dsn, $usr, $passwd);
    $user->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $user->exec('SET NAMES utf8');
  } catch (PDOException $e) {
    die("接続エラー：{$e->getMessage()}");
  }
  return $user;
}
?>
