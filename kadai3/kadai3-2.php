
<?php

//処理振り分け
session_name("sid"); //セッションIDキーを指定。デフォルトはPHPSESSID
switch (true) {
	case login():
		if(session_on()) break;
	default:
		page_login();
		break;
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
//requestは現在の $_GET、$_POST、$_COOKIEなどの内容をまとめた変数
function req($key) {
	return(isset($_REQUEST[$key]) ? $_REQUEST[$key] : '');
}
//セッションIDを発行
function session_on() {
	//echo session_name(),'=',session_id(),"<br />\n"; // 発行されたセッションＩＤを表示
	//session_off();	// ログアウト処理
	if ($_SESSION['login']==1) {	// login時なら　セッションIDがクッキーに保存されていない時
		$_SESSION['id'] = $GLOBALS['id'] = req('id');
	} else {	// セッション継続
		//session_off();	// ログアウト処理
		if (empty($_SESSION['id'])) {
			return false;
		}
		$GLOBALS['id'] = $_SESSION['id'];
		/*// セッションＩＤを更新
		$tmp = $_SESSION;
		$_SESSION = array();　//セッション配列を削除
		session_destroy();
		session_id(md5(uniqid(rand(), 1)));
		session_start();
		$_SESSION = $tmp;*/
	}
	return true;
}
function login() //ログイン認証を行う
{
	//URLに自動的にセッションIDを付加させない
	ini_set('session.use_trans_sid', '0');
	session_start();	// セッション開始
//セッション変数のログインの値が1以上であれば認証を行わない
	$login = $_SESSION['login'];
	if($login > 0){
		$_SESSION['login']++;
		return true;
	}else{
	//認証を開始
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
			$_SESSION["login"]=1;
			return true;
			//認証に成功したらセッションスタート session_on()
			}
		}
	}
}
function session_off() {
	setcookie(session_name(), "", time()-42000,"/");	// クッキーを消す
	$_SESSION = array();	// セッション変数を消す
	session_destroy();	// セッションファイルを消す
	header("Location:http://co-67.3919.com/kadai3/keiziban.php");
	exit;
}
function page_login() //ログイン画面を表示
{
// ログインフォーム
//phpにhtml文書を埋め込む時にはecho <<<EOT~EOT;を用いる
	echo <<<EOT
<!DOCTYPE html>
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
EOT;
	exit;
}