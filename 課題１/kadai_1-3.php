<?php
	//ファイルを開く
$fp = fopen("file.txt", "r");
	//ファイルを1行ずつ読み込む
while ($line = fgets($fp)) {
	echo "$line<br />";
}
	//ファイルを閉じる
fclose($fp);
?>