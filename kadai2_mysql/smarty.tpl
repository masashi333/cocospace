{*Smarty *}
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
		{if(isset($_POST['submit_edit']))}
			メッセージ:<input type="text" name="message" value="{echo $edit_message}">
			ユーザー:<input type="text" name="user" value="{echo $edit_user}">
			パスワード:<input type="password" name="password_input">
			<input type="hidden" name="edit_mode" value="<?=h($edit_number)?>">
		{else}
			メッセージ:<input type="text" name="message">
			ユーザー:<input type="text" name="user" value="{echo $GLOBALS['id']}">
			パスワード:<input type="password" name="password_input">
			<!-- <input type="submit" name="submit_input" value="投稿"> -->
		{/if}<br/>
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
	<h2>投稿一覧（{echo $data_count}件）</h2>
	<ul>
		{if($data_count > 0)}
			{while ($data = mysql_fetch_array($quryset))}
				{if($data[5] == "画像")}
				<li>{echo "投稿番号：",h($data[0])}{echo "ユーザー：",h($data[1])} {echo "コメント：",h($data[2])}- {echo h($data[3])}<br/>{echo "<img src = $data[6] alt=\"表示できません。\">"}</li>
				{elseif($data[5] == "動画")}
					<li>{echo "投稿番号：",h($data[0])} {echo "ユーザー：",h($data[1])} {echo "コメント：",h($data[2])} - {echo h($data[3])}<br/>{echo "<video src = $data[6]></video>"}</li>
				{/if}
			{/while}
		{else}
		<li>まだ投稿はありません。</li>
		{/if}
	</ul>
</body>
</html>