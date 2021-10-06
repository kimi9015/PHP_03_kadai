<?php
//XSS対応（ echoする場所で使用！）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

//DB接続関数：db_conn() 
//※関数を作成し、内容をreturnさせる。
//※ DBname等、今回の授業に合わせる。


// db_conn();で今後使えるように関数化

function db_conn(){
    try {
        //ID:'root', Password: 'root'
        $db_name = 'kadai_02';    //データベース名
        $db_id   = 'root';      //アカウント名
        $db_pw   = 'root';      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = 'localhost'; //DBホスト
        $pdo = new PDO('mysql:dbname=kadai_02;charset=utf8;host=localhost','root','root');

        // 外で使えるように
        return $pdo;

      } catch (PDOException $e) {
        exit('DBConnectError:'.$e->getMessage());
      }
}



//SQLエラー関数：sql_error($stmt)

function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
}


//リダイレクト関数: redirect($file_name)

function redirect ($file_name){
    header('Location: ' . $file_name);
    exit();
}

