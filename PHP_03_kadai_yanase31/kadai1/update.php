<?php
//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//   POSTデータ受信 → DB接続 → SQL実行 → 前ページへ戻る
//2. $id = POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更


// funcs.phpの中身を使えるようにする
require_once('funcs.php');


//1. POSTデータ取得
$BookTitle = $_POST['BookTitle'];
$BookURL = $_POST['BookURL'];
$BookStatus = $_POST['BookStatus'];
$BookComment = $_POST['BookComment'];
$id = $_POST['id'];


// db_connをpdoの中で使えるようにする
$pdo = db_conn();



// UPDATE　テーブル　SET　場所＝値
//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE
                       gs_bm_table 
                       SET BookTitle = :BookTitle,
                                              BookURL = :BookURL,
                                              BookStatus = :BookStatus,
                                              BookComment = :BookComment,
                                              date = sysdate()
                                              WHERE
                                              id = :id;");

// 数値の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR
//  2. バインド変数を用意
$stmt->bindValue(':BookTitle', $BookTitle, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':BookURL', $BookURL, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':BookStatus', $BookStatus, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':BookComment', $BookComment,PDO::PARAM_STR);
$stmt->bindValue(':id', $id,PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)


//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    //*** function化する！******\
  sql_error($stmt);
}else{
  //５．index.phpへリダイレクト
    //*** function化する！******\
  redirect('index.php');
}

