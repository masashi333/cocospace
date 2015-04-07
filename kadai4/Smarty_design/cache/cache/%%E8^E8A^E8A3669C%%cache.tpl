257
a:5:{s:8:"template";a:1:{s:9:"cache.tpl";b:1;}s:11:"insert_tags";a:1:{s:11:"getkeiziban";a:5:{i:0;s:6:"insert";i:1;s:11:"getkeiziban";i:2;s:9:"cache.tpl";i:3;i:55;i:4;b:0;}}s:9:"timestamp";i:1428379223;s:7:"expires";i:1428379323;s:13:"cache_serials";a:0:{}}PC
<html lang="ja">
<head>
	<meta name="viewport" content="width=device-width,user-scalable=no,maximum-scale=1" />
		<link rel="stylesheet" media="all" type="text/css" href="style.css" />
		<meta charset='utf-8'>
	<title>簡易掲示板</title>
</head>
<body>
	<h1>簡易掲示板</h1>
	<h2>投稿フォーム</h1>
	<form action="" method="post" enctype="multipart/form-data">
					メッセージ:<input type="text" name="message">
			ユーザー:<input type="text" name="user" value="54f12d6834524">
			パスワード:<input type="password" name="password_input">
			<!-- <input type="submit" name="submit_input" value="投稿"> -->
		<br/>
		ファイル：<br />
		<input type="file" name="upfile" size="30" />
		<input type="submit" name="submit_input" value="投稿">
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
		2015/04/07 13:00:23	f8d698aea36fcbead2b9d5359ffca76f{insert_cache a:1:{s:4:"name";s:11:"getkeiziban";}}f8d698aea36fcbead2b9d5359ffca76f
</body>
</html>