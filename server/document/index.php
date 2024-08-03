<?php

// データベース接続
$host = 'db';
$db = 'draft_db';
$user = 'draft_admin';
$pass = '1234';
$documents = [];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // データを取得するSQL
    $sql = 'SELECT maker, title, created_at FROM doc';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // 結果を取得
    $documents = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '接続失敗: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/../common/_head.html'; ?>

<body>
    <?php include_once __DIR__ . '/../common/_header.php'; ?>
    <main class="article wrapper">
        <div class="search-bar">
            <input type="text" placeholder="文字検索">
            <button><i class="fa fa-search"></i></button>
        </div>
        <table class="document-table">
            <thead>
                <tr>
                    <th></th>
                    <th>タイトル(内容③) <button class="sort-btn">▼</button></th>
                    <th>作成日(内容②) <button class="sort-btn">▼</button></th>
                    <th>作成者(内容②) <button class="sort-btn">▼</button></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($documents as $document) : ?>
                    <tr>
                        <td></td>
                        <td><?= htmlspecialchars($document['title'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($document['created_at'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($document['maker'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td>
                            <!-- 起案ボタン -->
                            <form action="create.php" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($document['id'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                <!-- <input type="hidden" name="title" value="<?= htmlspecialchars($document['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="created_at" value="<?= htmlspecialchars($document['created_at'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="maker" value="<?= htmlspecialchars($document['maker'] ?? '', ENT_QUOTES, 'UTF-8') ?>"> -->
                                <!-- menテーブルからデータを追加 -->
                                <!-- <input type="hidden" name="maker_id" value="<?= htmlspecialchars($document['maker_id'] ?? '', ENT_QUOTES, 'UTF-8') ?>"> -->
                                <button type="submit">起案</button>
                            </form>
                            <!-- Viewボタン -->
                            <form action="view.php" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($document['id'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="title" value="<?= htmlspecialchars($document['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="created_at" value="<?= htmlspecialchars($document['created_at'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="maker" value="<?= htmlspecialchars($document['maker'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                <button type="submit">View</button>
                            </form>
                            <!-- 編集ボタン -->
                            <form action="edit.php" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($document['id'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="title" value="<?= htmlspecialchars($document['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="created_at" value="<?= htmlspecialchars($document['created_at'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="maker" value="<?= htmlspecialchars($document['maker'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                <button type="submit">編集</button>
                            </form>
                            <!-- 削除ボタン -->
                            <form action="delete.php" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($document['id'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="title" value="<?= htmlspecialchars($document['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="created_at" value="<?= htmlspecialchars($document['created_at'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="maker" value="<?= htmlspecialchars($document['maker'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                <button type="submit">削除</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
    </main>
    <?php include_once __DIR__ . '/../common/_footer.html'; ?>
</body>

</html>
