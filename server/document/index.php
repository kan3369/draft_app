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
                <?php foreach ($documents as $document): ?>
                <tr>
                    <td><input type="checkbox"></td>
                    <td><a href="#"><?= htmlspecialchars($document['title'], ENT_QUOTES, 'UTF-8') ?></a></td>
                    <td><?= htmlspecialchars($document['created_at'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($document['maker'], ENT_QUOTES, 'UTF-8') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="button-group">
            <button>起案</button>
            <button>View</button>
            <button>編集</button>
            <button>削除</button>
        </div>
    </main>

    <?php include_once __DIR__ . '/../common/_footer.html'; ?>
</body>
</html>
