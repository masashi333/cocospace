<?php
//データを保存するファイルを作成
$dataFile = 'bbs.dat';

//リクエストがpostメソッドの時
if($_SERVER['REQUEST_METHOD']=='POST' &&
	isset($_POST['submit_input']){
	//必要な変数確保
	$user = $_POST['user'];
	$message = $_POST['message'];
	//投稿番号の初期値
	$number=1;
	//投稿時間の取得
	$postedAt = date('Y-m-d H:i:s');
	//ファイルに保存する形式
	$newData = $number . "<>" . $user . "<>" . $message . "<>" . $postedAt . "\n";
	//ファイルを開く
	$fp = fopen($dataFile,'a');
	//ファイルにデータを書き込む
	fwrite($fp,$newData);
	//ファイルを閉じる
	fclose($fp);
}
//リクエストがpostメソッドの時
if($_SERVER['REQUEST_METHOD']=='POST'&&
	isset($_POST['delete_number'])){
	//ファイルを読み込んで、新しい順番に並び替え
	$posts = file($dataFile,FILE_IGNORE_NEW_LINES);
	// ファイルオープン
	$fp = fopen($dataFile, 'r+');
	// ファイルを0に丸める
	fturncate($fp, 0);
	// ファイルポインタを先頭に戻す
	fseek($fp, 0);
	fclose($fp);
	foreach ($posts as $post){
		list($number,$user,$message,$postedAt) = explode("<>",$post) ;
		if($_POST['delete_number']!= $number){
			//ファイルに保存する形式
			$newData = $number. "<>" . $user . "<>" . $message . "<>" . $postedAt. "\n";
			//ファイルを開く
			$fp = fopen($dataFile,'a');
			//ファイルにデータを書き込む
			fwrite($fp,$newData);
			//ファイルを閉じる
			fclose($fp);
		}
	}
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
	<form action="" method="post">
		message:<input type="text" name="message">
		user:<input type="text" name="user">
		<input type="submit" name="submit_input" value="投稿">
	</form>
	<h2>削除対象番号</h2>
	<form action="" method="post">
		削除番号:<input type="text" name="delete_number">
		<input type="submit" name="submit_delete" value="削除番号送信">
	</form>
	<h2>投稿一覧（<?php echo count($posts); ?>件）</h2>
	<ul>
		<?php if(count($posts)) :?>
			<?php foreach ($posts as $post) :?>
			<?php list($number,$user,$message,$postedAt) = explode("<>",$post) ; ?>
			<li><?php echo "投稿番号：",h($number);?> <?php echo "ユーザー：",h($user);?> <?php echo "コメント：",h($message);?> - <?php echo h($postedAt);?></li>
			<?php endforeach; ?>
		<?php else :?>
			<li>まだ投稿はありません。</li>
		<?php endif;?>
	</ul>
</body>
</html>