<?php
$dbHost = "localhost";
$dbUser = "co-67.3919.com";
$dbPass = "qTbEEOwCT";
$dbName = "co_67_3919_com";




/*//mysqlへの接続確認
$link = mysql_connect('localhost', 'co-67.3919.com', 'qTbEEOwCT');
if (!$link) {
    die('接続失敗です。'.mysql_error());
}

print('<p>接続に成功しました。</p>');

// MySQLに対する処理

//データベースを選ぶ
mysql_select_db('co_67_3919_com') or die("データベースを選ぶのに失敗しました。" . mysql_error());*/

$filePath = "/home";
$fileName = "backup_file";
$command = "mysqldump ".$dbName." --host=".$dbHost." --user=".$dbUser." --password=".$dbPass." > ".$fileName;
echo $command;
exec("ls",$out,$ret);
print_r($out);
var_dump($ret);
exec("crontab -l",$out2,$ret2);
print_r($out2);
var_dump($ret2);
exec("ls",$out3,$ret3);
print_r($out3);
var_dump($ret3);
/*exec("ls /var/spool/cron/",$out4,$ret4);
print_r($out4);
var_dump($ret4);*/
/*
     * 毎月/毎週/毎日 実行されるコマンドを cron に登録する
     *
     * $date:       毎月実行を指定した場合に実行される日を指定
     * $time:       毎日実行を指定した場合に実行される時間を指定
     * $dayofweek:  毎週実行を指定した場合に実行される曜日を指定
     * $frequency:  実行の頻度 ("MONTH" | "WEEK" | "DAY")
     * $command:    実行するコマンド
     */

$frequency = "DAY";
$time = "00:05";
$command = "/usr/local/bin/php /home/co-67.3919.com/public_html/kadai2_mysql/backup.php ".">"." /home/co-67.3919.com/public_html/kadai2_mysql/log.txt 2>&1 ";
/* cron への登録 */
if($cron = popen("/usr/bin/crontab -", "w")){
	while ($line = fgets($cron)) {
		echo "$line<br />";
	}
	fwrite($cron, _cronline($date, $time, $dayofweek, $frequency, $command));
	echo "オープンできたよ！！";
	echo _cronline($date,$time,$dayofweek,$frequency,$command);
	pclose($cron);
}
/*exec("crontab /home/co-67.3919.com/public_html/kadai2_mysql/crontab.txt",$out4,$ret4);
print_r($out4);
var_dump($ret4);*/

/* crontab に登録する行情報を生成 */
function _cronline($date, $time, $dayofweek, $frequency, $command)
{

	$name = array(
		"MONTH" => array("day", $date),
		"WEEK" => array("dow", $dayofweek),
		"DAY" => array("dummy", null),
		);

	/* デフォルトは '*' */
	$day = $month = $dow = "*";

	/*
	 * MONTH の場合は $day に $date を代入
	 * WEEK の場合は $dow に $dayofweek を代入
	 * DAY の場合は未使用なので $dummy とする
	 */
        ${$name[$frequency][0]} = preg_replace("!.*/!", "", $name[$frequency][1]);
        list($hour, $min) = split(":", $time);

        return(sprintf("%s  %s  %s  %s  %s  %s\n",$min, $hour, $day, $month, $dow, $command));

    }