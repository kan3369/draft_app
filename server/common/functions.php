<?php
require_once __DIR__ . '/config.php';
// 接続処理を行う関数
function connect_db()
{
    try {
        return new PDO(
            DSN,
            USER,
            PASSWORD,
            [PDO::ATTR_ERRMODE =>
            PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}
// エスケープ処理を行う関数
function h($str)
{
    // ENT_QUOTES: シングルクオートとダブルクオートを共に変換する。
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// DBに登録
function insert_doc($title)
{
    // データベースに接続
    $dbh = connect_db();

    // レコードを追加
    $sql = <<<EOM
    INSERT INTO
        doc
        (title)
    VALUES
        (:title)
    EOM;

    // プリペアドステートメントの準備
    $stmt = $dbh->prepare($sql);

    // パラメータのバインド
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);

    // プリペアドステートメントの実行
    $stmt->execute();
}
