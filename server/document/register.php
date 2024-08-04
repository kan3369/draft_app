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
    $team = $_POST['team'] ?? null;
    $post = $_POST['post'] ?? null;
    // var_dump($maker);
    $title = $_POST['title'] ?? null;
    $contents = $_POST['contents'] ?? null;

    // データを挿入するSQL文
    $sql = "INSERT INTO doc (id, doc_num, maker, team, post, title, contents) 
            VALUES (:id, :doc_num, :maker, :team, :post, :title, :contents)";

    // SQL文を準備
    $stmt = $pdo->prepare($sql);

    // パラメータをバインド
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':doc_num', $doc_num); // doc_numパラメータをバインド
    $stmt->bindParam(':maker', $maker);
    $stmt->bindParam(':team', $team);
    $stmt->bindParam(':post', $post);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':contents', $contents);

    // SQL文を実行
    $stmt->execute();

    // 成功メッセージ
    // echo 'データが正常に登録されました。';
} catch (PDOException $e) {
    // エラーメッセージ
    echo 'データベースエラー: ' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/../common/_head.html' ?>

<body class="register_body">
    <main>
        <div class="inner">
            <h1>登録完了</h1>
            <div class="back_btn">
                <a href="index.php">文書一覧を見る</a>
            </div>
        </div>
    </main>
</body>

</html>
