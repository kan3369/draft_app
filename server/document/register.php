<?php
require_once __DIR__ . '/../common/functions.php';
require_once __DIR__ . '/../common/config.php';

// データベース接続情報
$dsn = 'mysql:host=db;dbname=draft_db;charset=utf8';
$username = 'draft_admin';
$password = '1234';

try {
    // データベースに接続
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // フォームから送信されたデータを取得
    $id = $_POST['id'] ?? null;
    $doc_num = $_POST['doc_num'] ?? null;
    $maker = $_POST['maker'] ?? null;
    var_dump($maker);
    $title = $_POST['title'] ?? null;
    $contents = $_POST['contents'] ?? null;

    // データを挿入するSQL文
    $sql = "INSERT INTO doc (id, doc_num, maker, title, contents) 
            VALUES (:id, :doc_num, :maker, :title, :contents)";

    // SQL文を準備
    $stmt = $pdo->prepare($sql);

    // パラメータをバインド
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':doc_num', $doc_num); // doc_numパラメータをバインド
    $stmt->bindParam(':maker', $maker);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':contents', $contents);

    // SQL文を実行
    $stmt->execute();

    // 成功メッセージ
    echo 'データが正常に登録されました。';
} catch (PDOException $e) {
    // エラーメッセージ
    echo 'データベースエラー: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録完了</title>
</head>

<body>
    <h1>登録完了</h1>
    <div>
        <a href="index.php">文書一覧を見る</a>
    </div>
</body>

</html>
