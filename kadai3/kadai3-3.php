<?php

//include '/home/co-67.3919.com/public_html/kadai3/kadai3-2.php'; //認証スクリプトの呼び出し

//mysqlへの接続確認
$link = mysql_connect('localhost', 'co-67.3919.com', 'qTbEEOwCT');
if (!$link) {
    die('接続失敗です。'.mysql_error());
}
//データベースを選ぶ
mysql_select_db('co_67_3919_com') or die("データベースを選ぶのに失敗しました。" . mysql_error());

//テーブルにFile_type,File_pathを追加しました。
//extend_db();


//リクエストが投稿の時
if($_SERVER['REQUEST_METHOD']=='POST' &&
	isset($_POST['submit_input'])&&
	$_POST['message']!="" &&
	$_POST['password_input']!=""){
	//必要な変数確保
	$user = $_POST['user'];
	$message = $_POST['message'];
	if($user==""){
		$user="名無しさん";
	}
	//投稿番号の初期値
	$Commnet_number=1;
	//投稿番号の最新を取得
	$sql = sprintf("SELECT  MAX(Comment_number) FROM bbs_data");

	$result_flag = mysql_query($sql);
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$Comment_number = $row[0];
	if (!$result_flag) {
		die('投稿番号の最新を取得するのに失敗しました。'.mysql_error());
	}
	$Comment_number++;
	//投稿時間の取得
	$postedAt = date('Y-m-d H:i:s');
	//パスワードの取得
	$password = $_POST['password_input'];
	//アップロードファイルが存在するとき、ファイルをfilesフォルダに保存。返り値は拡張子
	$extension = upload();
	echo $extension;
	//mysqlに保存する
	//拡張子から画像ファイルだと分かったとき
	if($extension === "pdf" || $extension === "bmp" || $extension ===  "png" || $extension ===  "gif" || $extension ===  "jpeg" || $extension === "jpg"){
		$sql = sprintf("INSERT INTO bbs_data(Comment_number,User,Comment,Time,Password,File_type,File_path) VALUES (%d,%s,%s,%s,%s,%s,%s)",quote_smart($Comment_number),quote_smart($user),quote_smart($message),quote_smart($postedAt),quote_smart($password),quote_smart("画像"),quote_smart("http://co-67.3919.com/kadai3/files/" . $_FILES["upfile"]["name"]));
		echo "画像";
	}else if($extension === "wmv" || $extension === "avi" || $extension === "mpeg" || $extension === "divx" || $extension === "rm" || $extension === "mpg" || $extension === "flv" || $extension === "mp4"){
		$sql = sprintf("INSERT INTO bbs_data(Comment_number,User,Comment,Time,Password,File_type,File_path) VALUES (%d,%s,%s,%s,%s,%s,%s)",quote_smart($Comment_number),quote_smart($user),quote_smart($message),quote_smart($postedAt),quote_smart($password),quote_smart("動画"),quote_smart("http://co-67.3919.com/kadai3/files/" . $_FILES["upfile"]["name"]));
		echo "動画";
	}
	$result_flag = mysql_query($sql);
	if(!$result_flag){
		die('INSERTクエリーが失敗しました。'.mysql_error());
	}
}
//リクエストが削除の時
if($_SERVER['REQUEST_METHOD']=='POST'&&
	isset($_POST['delete_number']) &&
	$_POST['password_delete']!=""){
//削除対象番号と同じ投稿番号の行を削除する
	$quryset = mysql_query("SELECT * FROM bbs_data");
	while ($data = mysql_fetch_array($quryset)){
		if($_POST['delete_number'] == $data[0] && $_POST['password_delete'] == $data[4]){
			$sql = sprintf("DELETE FROM bbs_data WHERE Comment_number = %d", quote_smart($data[0]));
			$result_flag = mysql_query($sql);
			if (!$result_flag) {
				die('DELETEクエリーが失敗しました。'.mysql_error());
			}
		}
	}
}
//リクエストが編集
if($_SERVER['REQUEST_METHOD']=='POST'&&
	isset($_POST['submit_edit']) &&
	$_POST['password_edit']!=""){
	//mysqlのデータを1行ずつ見ていく
	$quryset = mysql_query("SELECT * FROM bbs_data");
	while ($data = mysql_fetch_array($quryset)){
		if($_POST['edit_number'] == $data[0] && $_POST['password_edit'] == $data[4]){
			//編集する項目の変数確保
			$edit_user = $data[1];
			$edit_message = $data[2];
		}
	}
}
//リクエストが投稿で編集モードの時
if($_SERVER['REQUEST_METHOD']=='POST'&&
	isset($_POST['edit_mode']) &&
	$_POST['password_input']!=""){
	$edit_user = $_POST['user'];
	$edit_message = $_POST['message'];
	$edit_number = $_POST['edit_mode'];
	//投稿時間の取得
	$postedAt = date('Y-m-d H:i:s');
	//mysqlのデータを1行ずつ見ていく
	$quryset = mysql_query("SELECT * FROM bbs_data");
	while ($data = mysql_fetch_array($quryset)){
		if($edit_number == $data[0] && $_POST['password_input'] == $data[4]){
			//mysqlをupdate
			$sql = sprintf("UPDATE bbs_data SET User = %s,Comment = %s,Time = %s WHERE Comment_number = %d",
				quote_smart($edit_user), quote_smart($edit_message),quote_smart($postedAt),quote_smart($data[0]));
			$result_flag = mysql_query($sql);
			if (!$result_flag) {
				die('UPDATEクエリーが失敗しました。'.mysql_error());
			}
		}
	}
}
//ログアウトボタンが押されたらログアウトする。
if($_SERVER['REQUEST_METHOD']=='POST'&&
	isset($_POST['submit_logout'])){

	session_off();
}
//mysqlの行数をカウント
$sql = "SELECT  COUNT(*) FROM bbs_data";
$result_flag = mysql_query($sql);
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
$data_count = $row[0];
//mysqlの全データを参照
$quryset = mysql_query("SELECT * FROM bbs_data ORDER BY Comment_number DESC");
if (!$quryset) { die("SQL文が発行できへんぞ？"); }

function upload(){
//アップロードファイルが存在している時
if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
	 //fileフォルダの中にアップロードしたファイルの名前で移動させる
	if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "/home/co-67.3919.com/public_html/kadai3/files/" . $_FILES["upfile"]["name"])) {
		chmod("/home/co-67.3919.com/public_html/kadai3/files/" . $_FILES["upfile"]["name"], 0777);
		//ファイルの拡張子を取得
			//ファイルの拡張子を取得
			$file_nm = $_FILES['upfile']['name'];
			$tmp_ary = explode('.', $file_nm);
			print_r($tmp_ary);
			$extension = $tmp_ary[count($tmp_ary)-1];
			echo $extension;
			return $extension;
		}
	}
}
function h($s){
	return htmlspecialchars($s,ENT_QUOTES,'UTF-8');
}
function extend_db(){
	$sql = "ALTER TABLE bbs_data ADD (File_type char(20), File_path char(100))";
	$result_flag = mysql_query($sql);
	if (!$result_flag) {
		echo "カラムの追加に失敗しました。" .mysql_error();
	}
	return true;
}
//エスケープ関数
function quote_smart($value)
{
    // 数値以外をクオートする
	if (!is_numeric($value)) {
		$value = "'" . mysql_real_escape_string($value) . "'";
	}
	return $value;
}
//テーブル作成
/*function create_table(){
$sql ="CREATE TABLE bbs_data(
Comment_number INT,
User CHAR(30),
Comment CHAR(200),
Time CHAR(50),
Password CHAR(50)
)";
//queryの実行
if(mysql_query($sql)){
	echo "Table Comment_data created successfully";
	return true;
}else{
	echo "Error creating table:" . mysql_error($link);
}
//print('<p>接続に成功しました。</p>');
}*/
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset='utf-8'>
	<title>簡易掲示板</title>
</head>
<body>
	<h1>簡易掲示板</h1>
	<h2>投稿フォーム</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<?php if(isset($_POST['submit_edit'])):?>
			メッセージ:<input type="text" name="message" value="<?php echo $edit_message;?>">
			ユーザー:<input type="text" name="user" value="<?php echo $edit_user;?>">
			パスワード:<input type="password" name="password_input">
			<input type="hidden" name="edit_mode" value="<?=h($edit_number)?>">
		<?php else:?>
			メッセージ:<input type="text" name="message">
			ユーザー:<input type="text" name="user" value="<?php echo $GLOBALS['id'];?>">
			パスワード:<input type="password" name="password_input">
			<!-- <input type="submit" name="submit_input" value="投稿"> -->
		<?php endif;?><br/>
		ファイル：<br />
		<input type="file" name="upfile" size="30" />
		<input type="submit" name="submit_input" value="投稿">
<!-- 		<input type="submit" value="アップロード" /> -->
	</form>
	<h2>削除対象番号</h2>
	<form action="" method="post">
		削除番号:<input type="text" name="delete_number">
		パスワード:<input type="password" name="password_delete">
		<input type="submit" name="submit_delete" value="削除番号送信">
	</form>
	</form>
	<h2>編集対象番号</h2>
	<form action="" method="post">
		編集番号:<input type="text" name="edit_number">
		パスワード:<input type="password" name="password_edit">
		<input type="submit" name="submit_edit" value="編集番号送信">
	<form action="" method="post">
		<br/><br/><input type="submit" name="submit_logout" value="ログアウト">
	</form>
	<h2>投稿一覧（<?php echo $data_count; ?>件）</h2>
	<ul>
		<?php if($data_count > 0):?>
			<?php while ($data = mysql_fetch_array($quryset)):?>
				<?php if($data[5] == "画像"):?>
				<li><?php echo "投稿番号：",h($data[0]);?> <?php echo "ユーザー：",h($data[1]);?> <?php echo "コメント：",h($data[2]);?> - <?php echo h($data[3]);?><br/><?php echo "<img src = $data[6] alt=\"表示できません。\">";?></li>
				<?php elseif($data[5] == "動画"):?>
					<li><?php echo "投稿番号：",h($data[0]);?> <?php echo "ユーザー：",h($data[1]);?> <?php echo "コメント：",h($data[2]);?> - <?php echo h($data[3]);?><br/><?php echo "<video src = $data[6]></video>";?></li>
				<?php endif;?>
			<?php endwhile; ?>
		<?php else:?>
		<li>まだ投稿はありません。</li>
		<?php endif;?>
	</ul>
</body>
</html>