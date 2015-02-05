<?php
  // 作成するファイル名の指定
$file_name = 'form.txt';

  // ファイルの存在確認
if( !file_exists($file_name) ){
    // ファイル作成
	touch( $file_name );
}else{
    // すでにファイルが存在する為エラーとする
	echo('Warning - ファイルが存在しています。 file name:['.$file_name.']');
	exit();
}

  // ファイルのパーティションの変更
chmod( $file_name, 0666 );
  //ファイルの中身を取得　
$current = file_get_contents($file_name);
  // 書き込み内容を追加
$current .= $_POST['message'];
  // 結果をファイルに書き出します
file_put_contents($file_name, $current);
echo('Info - ファイル作成完了。 file name:['.$file_name.']');

?>