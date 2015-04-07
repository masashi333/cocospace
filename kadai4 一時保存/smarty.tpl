{*Smarty *}
<html lang="ja">
<head>
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
	<h2>投稿一覧（{$data_count}件）</h2>
	<ul>
		{php} if ($this->_tpl_vars['data_count'] > 0):{/php}
			{php}while ($data = mysql_fetch_array($this->_tpl_vars['queryset'])):{/php}
				{php}if ($data[5] == "画像"):{/php}
				<li>{php}echo "投稿番号：",h($data[0]);{/php}{php}echo "ユーザー：",h($data[1]);{/php} {php}echo "コメント：",h($data[2]);{/php}- {php}echo h($data[3]);{/php}<br/>{php}echo "<img src = $data[6] alt=\"表示できません。\">";{/php}</li>
				{php}elseif ($data[5] == "動画"):{/php}
					<li>{php}echo "投稿番号：",h($data[0]);{/php} {php}echo "ユーザー：",h($data[1]);{/php} {php}echo "コメント：",h($data[2]);{/php} - {php}echo h($data[3]);{/php}<br/>{php}echo "<video src = $data[6]></video>";{/php}</li>
				{php}endif;{/php}
			{php}endwhile;{/php}
		{php}else:{/php}
		<li>まだ投稿はありません。</li>
		{php}endif;{/php}
	</ul>
</body>
</html>