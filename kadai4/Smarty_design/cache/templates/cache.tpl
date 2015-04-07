{*cache*}
{$user_agent}
<html lang="ja">
<head>
	<meta name="viewport" content="width=device-width,user-scalable=no,maximum-scale=1" />
	{php}if ($this->_tpl_vars['user_agent'] == 'smartphone'):{/php}
	<link rel="stylesheet" media="all" type="text/css" href="smart.css" />
	{php} elseif ($this->_tpl_vars['user_agent'] == 'mobile'):{/php}
	<link rel="stylesheet" media="all" type="text/css" href="mobile.css" />
	{php} elseif ($this->_tpl_vars['user_agent'] == 'PC'):{/php}
	<link rel="stylesheet" media="all" type="text/css" href="style.css" />
	{php} endif;{/php}
	<meta charset='utf-8'>
	<title>簡易掲示板</title>
</head>
<body>
	<h1>簡易掲示板</h1>
	<h2>投稿フォーム</h1>
	<form action="" method="post" enctype="multipart/form-data">
		{if isset($smarty.post.submit_edit|smarty:nodefaults)}
			メッセージ:<input type="text" name="message" value="{php}echo $edit_message;{/php}">
			ユーザー:<input type="text" name="user" value="{php}echo $edit_user;{/php}">
			パスワード:<input type="password" name="password_input">
			<input type="hidden" name="edit_mode" value="<?=h($edit_number)?>">
		{else}
			メッセージ:<input type="text" name="message">
			ユーザー:<input type="text" name="user" value="{php}echo $GLOBALS['id'];{/php}">
			パスワード:<input type="password" name="password_input">
			<!-- <input type="submit" name="submit_input" value="投稿"> -->
		{/if}<br/>
		ファイル：<br />
		<input type="file" name="upfile" size="30" />
		<input type="submit" name="submit_input" value="投稿">
		{*<input type="submit" value="アップロード" /> -->*}
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
	{insert name="getkeiziban"}
</body>
</html>