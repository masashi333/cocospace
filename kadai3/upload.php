<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>upload</title>
</head>
<body>
<p><?php
//アップロードファイルが存在している時
if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
	 //fileフォルダの中にアップロードしたファイルの名前で移動させる
  if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "/home/co-67.3919.com/public_html/kadai3/files/" . $_FILES["upfile"]["name"])) {
    chmod("/home/co-67.3919.com/public_html/kadai3/files/" . $_FILES["upfile"]["name"], 0777);
    echo $_FILES["upfile"]["name"] . "をアップロードしました。";
  } else {
    echo "ファイルをアップロードできません。";
  }
} else {
  echo "ファイルが選択されていません。";
}

?></p>
</body>
</html>