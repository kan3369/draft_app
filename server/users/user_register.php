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
    $maker = $_POST['maker'] ?? null;
    $team = $_POST['team'] ?? null;
    $post = $_POST['post'] ?? null;

    // データを挿入するSQL文
    $sql = "INSERT INTO men (id, maker, team, post) 
            VALUES (:id, :maker, :team, :post)";

    // SQL文を準備
    $stmt = $pdo->prepare($sql);

    // パラメータをバインド
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':maker', $maker);
    $stmt->bindParam(':team', $team);
    $stmt->bindParam(':post', $post);

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
        <a href="/document/index.php">戻る</a>
    </div>
</body>

</html>
