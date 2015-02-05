<?php
	//出力する文字をutf-8に設定
echo htmlspecialchars($_POST['message'],ENT_QUOTES, 'UTF-8');
?>