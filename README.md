# book-ilb-manager

PHPとMySQLで作った蔵書管理システムです。

よしなに改造することで、蔵書以外にも対応できるかと思います。

ちなみに作者はコミックスと同人誌管理に使っています。

## MySQLのデータベース作成法

このようにデータベースおよびテーブルを作って下さい。

```MySQL

CREATE DATABASE '<作成したいデータベース名>' COLLATE 'utf8mb4_general_ci';

grant all on <データベース名>.* to <作成したいユーザー名>@localhost identified by '<設定したいパスワード>';

CREATE TABLE 'test' (
  '蔵書番号' int(3) unsigned zerofill NOT NULL AUTO_INCREMENT PRIMARY KEY,
  'タイトル' varchar(240) COLLATE 'utf8mb4_general_ci' NOT NULL,
  '著者' varchar(50) COLLATE 'utf8mb4_general_ci' NOT NULL,
  'イラスト' varchar(50) COLLATE 'utf8mb4_general_ci' NULL,
  '出版' varchar(50) COLLATE 'utf8mb4_general_ci' NOT NULL,
  '種別' varchar(20) COLLATE 'utf8mb4_general_ci' NOT NULL DEFAULT '一般書籍'
) ENGINE='InnoDB' COLLATE 'utf8mb4_general_ci';

```
