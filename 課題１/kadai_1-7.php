<?php
	//配列を作成
	$array=array();
	//ファイルを開く
	$fp = fopen("form.txt", "r");
	//ファイルを1行ずつ読み込む
	while ($line = fgets($fp)) {
		$i=0;
		$array[$i]=$line;
		$i++;
	}
	//ファイルを閉じる
	fclose($fp);

	//配列の中身を表示
	for($i = 0 ; $i < count($array); $i++){
	echo $test_array[$i] ;
	}
?>