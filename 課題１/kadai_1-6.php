<?php

$file = 'form.txt';
	// ファイルをオープンして既存のコンテンツを取得します
$current = file_get_contents($file);
	// 新しい文字列をファイルに追加します
$current .= "\nphp\n" . "java\n"."perl\n";
	// 結果をファイルに書き出します
file_put_contents($file, $current);
echo('Info - ファイル追記保存完了。 file name:['.$file.']');
?>