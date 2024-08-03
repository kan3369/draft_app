<?php
require_once __DIR__ . '/../common/functions.php';

$message = ''; // $message 変数を初期化

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POSTリクエストからIDを取得
    $doc_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    if (!$doc_id) {
        $message = 'IDが不正です。';
        exit;
    }
    try {

    $dbh = connect_db();
        // docテーブルからデータを削除するSQL
        $sql = 'DELETE FROM doc WHERE id = :id';
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id', $doc_id, PDO::PARAM_INT);
        $stmt->execute();

        $message = "データが正常に削除されました。";
    } catch (PDOException $e) {
        $message = '接続失敗: ' . $e->getMessage();
    }
} else {
    $message = '不正なアクセスです。';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Page</title>
</head>
<body>

<h1>削除結果</h1>

<p><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
<?php if (isset($doc_id) && $message === "データが正常に削除されました。") : ?>
    <p>ID: <?= htmlspecialchars($doc_id, ENT_QUOTES, 'UTF-8') ?> のデータが削除されました。</p>
<?php endif; ?>

<a href="index.php">戻る</a>

</body>
</html>
