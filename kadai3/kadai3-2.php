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
//リクエストがポストでパスワード、IDの入力が確認出来たとき
if($_POST['password']!="" &&
	$_POST['id']!="" &&
	$_SERVER['REQUEST_METHOD']=='POST'){
	$password = $_POST['password'];
	$id = $_POST['id'];


	//mysqlへの接続確認
	$link = mysql_connect('localhost', 'co-67.3919.com', 'qTbEEOwCT');
	if (!$link) {
		die('接続失敗です。'.mysql_error());
	}
	//データベースを選ぶ
	mysql_select_db('co_67_3919_com') or die("データベースを選ぶのに失敗しました。" . mysql_error());

	//ユーザー情報を保存
	$sql = sprintf("SELECT COUNT(*) FROM user_data where (Id = %s AND Password = %s)",quote_smart($id),quote_smart($password));
	$result_flag = mysql_query($sql);
	$row = mysql_fetch_array($result_flag);
	$result = $row[0];
	if(!$result){
		die('あなたは登録されていません。'.mysql_error());
	}else{
		//認証に成功したらセッションスタート
		session_start();
		header("Location: http://co-67.3919.com/kadai3/keiziban.php");
		$_SESSION['id']=$id;
		$_SESSION['password']=$password;
	}

}

?>
<html lang="ja">
<head>
	<meta charset='utf-8'>
	<title>ユーザーログイン画面</title>
</head>
<body>
	<h1>ユーザーログイン画面</h1>
	<form action="" method="post">
		ID:<input type="text" name="id">
		パスワード:<input type="password" name="password">
		<input type="submit" name="submit" value="ログイン">
	</form>
</body>
</html>