<?php
$dbHost = "localhost";
$dbUser = "co-67.3919.com";
$dbPass = "qTbEEOwCT";
$dbName = "co_67_3919_com";


//mysqlへの接続確認
$link = mysql_connect('localhost', 'co-67.3919.com', 'qTbEEOwCT');
if (!$link) {
    die('接続失敗です。'.mysql_error());
}

print('<p>接続に成功しました。</p>');

// MySQLに対する処理

//データベースを選ぶ
mysql_select_db('co_67_3919_com') or die("データベースを選ぶのに失敗しました。" . mysql_error());
//時間の取得
$postedAt = date('Y-m-d');
$fileName = $postedAt;
$command = "mysql ".$dbName." --host=".$dbHost." --user=".$dbUser." --password=".$dbPass." <".$fileName;
echo $command;
exec($command, $output, $return_var);
var_dump($output, $return_var);