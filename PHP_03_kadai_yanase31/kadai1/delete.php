<?php
require_once('funcs.php');
$pdo = db_conn();
$id = $_GET['id'];

//２．データ登録SQL作成

// 削除は以下
// DELETE
// FROM
// テーブル名
// WHERE 場所＝値


$stmt = $pdo->prepare('DELETE FROM gs_bm_table WHERE id = :id;');
$stmt -> bindValue(':id',$id, PDO::PARAM_INT);
$status = $stmt->execute();



//３．データ表示
$view = '';
if ($status == false) {
    sql_error($status);
} else {
    redirect('select.php');
}


// PHPだけのファイルは終了タグは省略する（公式）

// 削除ボタンを押したら、アラートが出ると親切
// データベース上では削除してないこともある（論理削除・物理削除）