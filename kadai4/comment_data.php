<html>
<head><title>PHP TEST</title></head>
<body>

<?php
//エスケープ関数
function quote_smart($value)
{
    // 数値以外をクオートする
    if (!is_numeric($value)) {
        $value = "'" . mysql_real_escape_string($value) . "'";
    }
    return $value;
}

//mysqlへの接続確認
$link = mysql_connect('localhost', 'co-67.3919.com', 'qTbEEOwCT');
if (!$link) {
    die('接続失敗です。'.mysql_error());
}

print('<p>接続に成功しました。</p>');

// MySQLに対する処理

//データベースを選ぶ
mysql_select_db('co_67_3919_com') or die("データベースを選ぶのに失敗しました。" . mysql_error());

/*//テーブル作成
$sql ="CREATE TABLE Comment_data(
Comment_number INT,
User CHAR(30),
Comment CHAR(200),
Time CHAR(50)
)";
//queryの実行
if(mysql_query($sql)){
    echo "Table Comment_data created successfully";
}else{
    echo "Error creating table:" . mysql_error($link);
}

if(!$result_flag){
    die('INSERTクエリーが失敗しました。'.'mysql_error()');
}*/

$sql = "SELECT * FROM bbs_data";
$res = mysql_query($sql);

//フィールドの数を取得する
$numFields = mysql_num_fields($res);

//フィールド名を格納する配列を用意する
$nameFields = array();

for($i=0;$i<$numFields;$i++){
$nameFields[] = mysql_field_name($res, $i);
}

foreach($nameFields as $name){
echo $name."<br />";
}
print('<p>データを追加します。</p>');

$sql = "INSERT INTO Comment_data (Comment_number,User,Comment,Time)VALUES(1,'えりか','わーい','16時33分')";
$result_flag=mysql_query($sql);

if(!$result_flag){
    die('INSERTクエリーが失敗しました。'.'mysql_error()');
}
print('<p>追加後のデータを取得します。</p>');

print('<p>データを更新します。</p>');

$Comment_number = 1;
$User = 'masashi';
$Comment = 'Hello World!';

$sql = sprintf("UPDATE Comment_data SET Comment = %s ,User = %s WHERE Comment_number = %d",
quote_smart($Comment), quote_smart($User),quote_smart($Comment_number));

$result_flag = mysql_query($sql);

if (!$result_flag) {
    die('UPDATEクエリーが失敗しました。'.mysql_error());
}

/*print('<p>データを削除します。</p>');

$Comment_number = 1;

$sql = sprintf("DELETE FROM bbs_data "
         , quote_smart($Comment_number));

$result_flag = mysql_query($sql);

if (!$result_flag) {
    die('DELETEクエリーが失敗しました。'.mysql_error());
}

print('<p>削除後のデータを取得します。</p>');
*/

print('<p>更新後のデータを取得します。</p>');
//SQL文をセット/////////////////////////////////////////////
$quryset = mysql_query("SELECT * FROM bbs_data ORDER BY Comment_number DESC");

echo "<TABLE  border='1' >";
echo "<TR>";
echo "<TD>投稿番号";
echo "</TD>";
echo "<TD>ユーザー";
echo "</TD>";
echo "<TD>コメント";
echo "</TD>";
echo "<TD>投稿日時";
echo "</TD>";
echo "<TD>パスワード";
echo "</TD>";
echo "<TD>ファイルの種類";
echo "</TD>";
echo "<TD>ファイルのパス";
echo "</TD>";
echo "</TR>";
//１ループで１行データが取り出され、データが無くなるとループを抜けます。
while ($data = mysql_fetch_array($quryset)){

    echo "<TR>";
        //列１を出力//////////////
        echo "<TD>" . $data[0];
        echo "</TD>";
        //列２を出力//////////////
        echo "<TD>" . $data[1];
        echo "</TD>";
        //列3を出力//////////////
        echo "<TD>" . $data[2];
        echo "</TD>";
        //列4を出力//////////////
        echo "<TD>" . $data[3];
        echo "</TD>";
       //列5を出力//////////////
        echo "<TD>" . $data[4];
        echo "</TD>";
       //列6を出力//////////////
        echo "<TD>" . $data[5];
        echo "</TD>";
        //列7を出力//////////////
        echo "<TD>" . $data[6];
        echo "</TD>";
            echo "</TR>";
}
echo "</TABLE>";
$close_flag = mysql_close($link);

if ($close_flag){
    print('<p>切断に成功しました。</p>');
}

?>
</body>
</html>
