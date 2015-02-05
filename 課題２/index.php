<?php
//データを保存するファイルを作成
$dataFile = 'bbs.dat';
function h($s){
	return htmlspecialchars($s,ENT_QUOTES,'UTF-8');
}
//リクエストが投稿の時
if($_SERVER['REQUEST_METHOD']=='POST' &&
	isset($_POST['submit_input'])){
	//必要な変数確保
	$user = $_POST['user'];
	$message = $_POST['message'];
	//投稿番号の初期値
	$number=1;
	//投稿番号の最新を取得
	$posts = file($dataFile,FILE_IGNORE_NEW_LINES);
	$posts = array_reverse($posts);
	foreach($posts as $post){
		list($number,$user2,$message2,$postedAt2) = explode("<>",$post);
		$number++;
		break;
	}
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
//リクエストが削除の時
if($_SERVER['REQUEST_METHOD']=='POST'&&
	isset($_POST['delete_number'])){
	//ファイルを読み込んで、新しい順番に並び替え
	$posts = file($dataFile,FILE_IGNORE_NEW_LINES);
	// ファイルオープン
	$fp = fopen($dataFile, 'r+');
	// ファイルを0に丸める
	ftruncate($fp, 0);
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
//リクエストが編集
if($_SERVER['REQUEST_METHOD']=='POST'&&
	isset($_POST['edit_number'])){
	//ファイルを読み込んで、新しい順番に並び替え
	$posts = file($dataFile,FILE_IGNORE_NEW_LINES);
	foreach ($posts as $post){
		list($number,$user,$message,$postedAt) = explode("<>",$post) ;
		if($_POST['edit_number']== $number){
			//編集する項目の変数確保
			$edit_user = $user;
			$edit_message = $message;
		}
	}
}
//リクエストが投稿で編集モードの時
if($_SERVER['REQUEST_METHOD']=='POST'&&
	isset($_POST['edit_mode'])){
	$edit_user = $_POST['user'];
	$edit_message = $_POST['message'];
	$edit_number = $_POST['edit_mode'];
	//ファイルを読み込んで、新しい順番に並び替え
	$posts = file($dataFile,FILE_IGNORE_NEW_LINES);
	print_r($posts);
	echo "\n";
	//投稿時間の取得
	$postedAt = date('Y-m-d H:i:s');
	//配列の番号を取得するための変数
	$i=0;
	echo $edit_number ."\n";
	foreach ($posts as $post){
		list($number,$user,$message,$postedAt) = explode("<>",$post) ;
		if($edit_number == $number){
			$posts[$i] = $edit_number. "<>" . $edit_user . "<>" . $edit_message . "<>" . $postedAt. "\n";
		}
		$i++;
	}
	print_r($posts);
	// ファイルを中身を削除し、上書き保存
	$fp = fopen($dataFile, 'r+');
	ftruncate($fp, 0);
	fseek($fp, 0);
	foreach($posts as $post){
		fwrite($fp,$post);
	}
	fclose($fp);
}
//配列に格納
$posts = file($dataFile,FILE_IGNORE_NEW_LINES);
//配列をリバース
$posts = array_reverse($posts);
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
		<?php if(isset($edit_user)):?>
			message:<input type="text" name="message" value="<?php echo $edit_message;?>">
			user:<input type="text" name="user" value="<?php echo $edit_message;?>">
			<input type="submit" name="submit_edit" value="投稿">
			<input type="hidden" name="edit_mode" value=<?php $edit_number;?>>
		<?php else:?>
			message:<input type="text" name="message">
			user:<input type="text" name="user">
			<input type="submit" name="submit_input" value="投稿">
		<?php endif;?>
	</form>
	<h2>削除対象番号</h2>
	<form action="" method="post">
		削除番号:<input type="text" name="delete_number">
		<input type="submit" name="submit_delete" value="削除番号送信">
	</form>
	</form>
	<h2>編集対象番号</h2>
	<form action="" method="post">
		編集番号:<input type="text" name="edit_number">
		<input type="submit" name="submit_edit" value="編集番号送信">
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