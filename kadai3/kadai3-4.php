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
	$_POST['mail']!="" &&
	$_SERVER['REQUEST_METHOD']=='POST'){
	$password = $_POST['password'];
	$user = $_POST['user'];
	$mail = $_POST['mail'];
	//IDを生成
	$id = uniqid();
	//timeを取得
	$time = date('Y-m-d H:i:s');
	$register_flag = 0; //仮登録フラグをたてる
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
	extend_db();
		//ユーザー情報を保存
	$sql = sprintf("INSERT INTO user_data(Id,Password,Adress,Register_flag,Time) VALUES(%s,%s,%s,%s,%s)",quote_smart($id),quote_smart($password),quote_smart($mail),quote_smart($register_flag),quote_smart($time));
	$result_flag = mysql_query($sql);
	if(!$result_flag){
		die('INSERTクエリが失敗しました。'.mysql_error());
	}
	mail_send($id,$mail);
}

function extend_db(){
	//登録フラグには仮登録のときに０、本登録のときに１を入れる。
	$sql = "ALTER TABLE user_data ADD (Adress char(50), Register_flag char(100),Time char(50))";
	$result_flag = mysql_query($sql);
	if (!$result_flag) {
		echo "カラムの追加に失敗しました。" .mysql_error();
	}
	return true;
}
function mail_send($id,$mail){
	mb_language("Japanese");
	mb_internal_encoding("UTF-8");
	//$array = array( 'ID'=> $id);
	if (mb_send_mail($mail, "テストメール", "http://co-67.3919.com/kadai3/kadai3-4_url.php/?".$id, "From: masashi3331524@gmail.com")) {
		 echo "メールが送信されました。";
	} else {
  	echo "メールの送信に失敗しました。";
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
	メールアドレス:<input type="email" name="mail">
	<input type="submit" name="submit" value="登録">
	<?php if(isset($id) && isset($password)):?>
</br><?php echo "<ユーザー情報> ID：".$id.'&nbsp;'.'&nbsp;'."パスワード：".$password;?>
<?php endif;?>
</form>
</body>
</html>