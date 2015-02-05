<?php
//データを保存するファイルを作成
$dataFile = 'bbs.dat';

//リクエストがpostメソッドの時
if($_SERVER['REQUEST_METHOD'])=='POST'){

//必要な変数確保
	$number = $_POST['number'];
	$user = $_POST['user'];
	$message = $_POST['message'];
	$time = $_POST['time'];

//ファイルに保存する形式
	$newData = $number . "<>" . $user . "<>" . $message . "<>" . $time . "\n";

//ファイルを開く
	$fp = fopen($dataFile,'a');
//ファイルにデータを書き込む
	fwrite($fp,$newData);
//ファイルを閉じる
	fclose($fp);

}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset='utf-8'>
	<title>簡易掲示板</title>
</head>
<body>
	<h1>簡易掲示板</h1>
	<form　action ="" method="post">
		message:<input type="text" name="message">
		user:<input type="text" name="user">
		<input type="submit" value="投稿">
	</form>
	<h2>投稿一覧（0件）</h2>
	<ul>
		<li>まだ投稿はありません。</li>
	</ul>
</body>
</html>