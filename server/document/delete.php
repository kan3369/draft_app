<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $doc_id = $_POST['id'];

    // データベース接続
    $host = 'db';
    $db = 'draft_db';
    $user = 'draft_admin';
    $pass = '1234';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // docテーブルからデータを削除するSQL
        $sql = 'DELETE FROM doc WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $doc_id, PDO::PARAM_INT);
        $stmt->execute();

        echo "データが正常に削除されました。";
    } catch (PDOException $e) {
        echo '接続失敗: ' . $e->getMessage();
    }
} else {
    echo '不正なアクセスです。';
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Page</title>
</head>
<body>

<h1>削除結果</h1>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
    <p>ID: <?= htmlspecialchars($doc_id, ENT_QUOTES, 'UTF-8') ?> のデータが削除されました。</p>
<?php endif; ?>

<a href="index.php">戻る</a>

</body>
</html>
