<!DOCTYPE html>
<?php
function h($s){
	return htmlspecialchars($s,ENT_QUOTES,'UTF-8');
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
//リクエストがポストでパスワードの入力が確認出来たとき
if($_POST['password']!="" &&
	$_SERVER['REQUEST_METHOD']=='POST'){
	$password = $_POST['password'];
	$user = $_POST['user'];
	//IDを生成
	$id = uniqid();

	//mysqlへの接続確認
	$link = mysql_connect('localhost', 'co-67.3919.com', 'qTbEEOwCT');
	if (!$link) {
		die('接続失敗です。'.mysql_error());
	}
	//データベースを選ぶ
	mysql_select_db('co_67_3919_com') or die("データベースを選ぶのに失敗しました。" . mysql_error());
	//テーブル作成
	$sql ="CREATE TABLE user_data(
	Id CHAR(30),
	Password CHAR(50)
	)";
	if(mysql_query($sql)){
	echo "Table Comment_data created successfully";
	}else{
	//echo "Error creating table:" . mysql_error($link);
	}
	//ユーザー情報を保存
	$sql = sprintf("INSERT INTO user_data(Id,Password) VALUES(%s,%s)",quote_smart($id),quote_smart($password));
	$result_flag = mysql_query($sql);
	if(!$result_flag){
		die('INSERTクエリが失敗しました。'.mysql_error());
	}

}

?>
<html lang="ja">
<head>
	<meta charset='utf-8'>
	<title>ユーザー登録画面</title>
</head>
<body>
	<h1>ユーザー登録画面</h1>
	<form action="" method="post">
		名前:<input type="text" name="user">
		パスワード:<input type="password" name="password">
		<input type="submit" name="submit" value="">
		<?php if(isset($id) && isset($password)):?>
			</br><?php echo "<ユーザー情報> ID：".$id.'&nbsp;'.'&nbsp;'."パスワード：".$password;?>
		<?php endif;?>
	</form>
</body>
</html>