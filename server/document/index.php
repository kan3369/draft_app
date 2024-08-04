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
    $sql = 'SELECT id, maker, contents, title, created_at FROM doc';
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
<head>
    <?php include_once __DIR__ . '/../common/_head.html'; ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .main.wrapper {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .search-bar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .search-bar input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }

        .search-bar button {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #0056b3;
        }

        .document-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .document-table th, .document-table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .document-table th {
            background-color: #f8f8f8;
        }

        .document-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .document-table tr:hover {
            background-color: #e9e9e9;
        }

        .sort-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 12px;
            color: #007bff;
        }

        .sort-btn:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include_once __DIR__ . '/../common/_header.php'; ?>
    <main class="main wrapper">
        <div class="search-bar">
            <input type="text" placeholder="文字検索">
            <button><i class="fa fa-search"></i></button>
        </div>
        <table class="document-table">
            <thead>
                <tr>
                    <th></th>
                    <th>タイトル <button class="sort-btn">▼</button></th>
                    <th>作成日 <button class="sort-btn">▼</button></th>
                    <th>作成者 <button class="sort-btn">▼</button></th>
                    <th>操作</th>
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
                            <a href="create.php?id=<?= htmlspecialchars($document['id']) ?>">起案</a>
                            <a href="preview.php?id=<?= htmlspecialchars($document['id']) ?>">view</a>
                            <a href="javascript:void(0);" onclick="confirmDeletion('delete.php?id=<?= htmlspecialchars($document['id'], ENT_QUOTES, 'UTF-8') ?>')">削除</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <?php include_once __DIR__ . '/../common/_footer.html'; ?>
</body>
</html>
