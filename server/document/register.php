<?php
// データベース接続情報
$host = 'db';
$dbname = 'draft_db';
$user = 'draft_admin';
$pass = '1234';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'データベース接続失敗: ' . $e->getMessage();
    exit();
}

// POSTデータの取得
$title = $_POST['title'];
$contents = $_POST['contents'];

// データベースに登録
try {
    $stmt = $pdo->prepare("INSERT INTO doc (title, contents) VALUES (:title, :contents)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':contents', $contents);
    $stmt->execute();
    $message = "データが正常に登録されました。";
} catch (PDOException $e) {
    $message = 'データベース登録失敗: ' . $e->getMessage();
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
    <p><?php echo htmlspecialchars($message); ?></p>
    <div>
        <a href="create.php">新しい文書を作成する</a>
    </div>
</body>

</html>
