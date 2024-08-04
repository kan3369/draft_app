<?php
// 必要なファイルを読み込む
require_once __DIR__ . '/../common/functions.php';

// 出力バッファリングを開始する
ob_start();

// セッション開始
session_start();

// POSTリクエストからIDを取得
$doc_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (!$doc_id) {
    $_SESSION['message'] = 'IDが不正です。';
    header('Location: /document/index.php');
    exit;
}

try {
    $dbh = connect_db();
    // docテーブルからデータを削除するSQL
    $sql = 'DELETE FROM doc WHERE id = :id';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':id', $doc_id, PDO::PARAM_INT);
    $stmt->execute();

    $_SESSION['message'] = "データが正常に削除されました。";
} catch (PDOException $e) {
    $_SESSION['message'] = '接続失敗: ' . $e->getMessage();
}

// 一覧画面にリダイレクト
header('Location: /document/index.php');
exit;

// 出力バッファリングを終了する
ob_end_flush();
