<?php
$frequency = "DAY";
$time = "00:05";
$command = "/usr/local/bin/php /home/co-67.3919.com/public_html/kadai3/temporary_register_delete.php ".">"." /home/co-67.3919.com/public_html/kadai3/log.txt 2>&1 ";
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