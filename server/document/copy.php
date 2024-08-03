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

        // docテーブルから指定されたidの行を取得
        $sql = 'SELECT * FROM doc WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $doc_id, PDO::PARAM_INT);
        $stmt->execute();
        $document = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($document) {
            // 新しい行としてdocテーブルに挿入
            $sql = 'INSERT INTO doc (maker, image, title, contents, created_at, updated_at) 
                    VALUES (:maker, :image, :title, :contents, :created_at, :updated_at)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':maker', $document['maker'], PDO::PARAM_STR);
            $stmt->bindParam(':image', $document['image'], PDO::PARAM_STR);
            $stmt->bindParam(':title', $document['title'], PDO::PARAM_STR);
            $stmt->bindParam(':contents', $document['contents'], PDO::PARAM_STR);
            $stmt->bindParam(':created_at', $document['created_at'], PDO::PARAM_STR);
            $stmt->bindParam(':updated_at', $document['updated_at'], PDO::PARAM_STR);
            $stmt->execute();

            echo "データが正常にコピーされました。";
        } else {
            echo "指定されたIDのデータが見つかりませんでした。";
        }
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
    <title>Copy Page</title>
</head>
<body>

<h1>コピー結果</h1>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $document) : ?>
    <p>ID: <?= htmlspecialchars($doc_id, ENT_QUOTES, 'UTF-8') ?> のデータがコピーされました。</p>
<?php endif; ?>

<a href="index.php">戻る</a>

</body>
</html>
