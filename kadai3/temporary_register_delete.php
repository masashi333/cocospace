<?php
//エスケープ関数
function quote_smart($value)
{
    // 数値以外をクオートする
	if (!is_numeric($value)) {
		$value = "'" . mysql_real_escape_string($value) . "'";
	}
	return $value;
}
//mysqlへの接続確認
$link = mysql_connect('localhost', 'co-67.3919.com', 'qTbEEOwCT');
if (!$link) {
	die('接続失敗です。'.mysql_error());
}
	//データベースを選ぶ
mysql_select_db('co_67_3919_com') or die("データベースを選ぶのに失敗しました。" . mysql_error());
$time_now = date('Y-m-d H:i:s');
$sql = sprintf("SELECT Time FROM user_data WHERE Register_flag = '0'");
$result = mysql_query($sql);
while($row = mysql_fetch_assoc($result)){
	print($row["id"]);
	print($row["password"]);
	print($row["Time"]);
	$time_post_sec = strtotime($time_post);
	$time_now_sec = strtotime($time_now);
	$differences = $time_now_sec - $time_post_sec;

	$differences = gmdate("d",$differences);
	echo "時間差：".$differences;
	if($differences > 0){
		$sql = sprintf("DELETE FROM user_data WHERE Time = %s AND Register_flag = '0'",quote_smart($time_post));
	}
}
