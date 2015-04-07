<?php /* Smarty version 2.6.22, created on 2015-04-07 13:00:23
         compiled from cache.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'getkeiziban', 'cache.tpl', 55, false),)), $this); ?>
<?php echo $this->_tpl_vars['user_agent']; ?>

<html lang="ja">
<head>
	<meta name="viewport" content="width=device-width,user-scalable=no,maximum-scale=1" />
	<?php if ($this->_tpl_vars['user_agent'] == 'smartphone'): ?>
	<link rel="stylesheet" media="all" type="text/css" href="smart.css" />
	<?php  elseif ($this->_tpl_vars['user_agent'] == 'mobile'): ?>
	<link rel="stylesheet" media="all" type="text/css" href="mobile.css" />
	<?php  elseif ($this->_tpl_vars['user_agent'] == 'PC'): ?>
	<link rel="stylesheet" media="all" type="text/css" href="style.css" />
	<?php  endif; ?>
	<meta charset='utf-8'>
	<title>簡易掲示板</title>
</head>
<body>
	<h1>簡易掲示板</h1>
	<h2>投稿フォーム</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<?php if (isset ( $_POST['submit_edit'] )): ?>
			メッセージ:<input type="text" name="message" value="<?php echo $edit_message; ?>">
			ユーザー:<input type="text" name="user" value="<?php echo $edit_user; ?>">
			パスワード:<input type="password" name="password_input">
			<input type="hidden" name="edit_mode" value="<?php echo '<?='; ?>
h($edit_number)<?php echo '?>'; ?>
">
		<?php else: ?>
			メッセージ:<input type="text" name="message">
			ユーザー:<input type="text" name="user" value="<?php echo $GLOBALS['id']; ?>">
			パスワード:<input type="password" name="password_input">
			<!-- <input type="submit" name="submit_input" value="投稿"> -->
		<?php endif; ?><br/>
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
	<?php  $timenow=date("Y/m/d H:i:s"); ?>
	<?php  echo $timenow; ?>
	<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getkeiziban')), $this); ?>

</body>
</html>