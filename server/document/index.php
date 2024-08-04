
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
        .header-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .user-register {
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .user-register:hover {
            background-color: #218838;
        }
        .search-bar {
            display: flex;
            align-items: center;
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
        .action-buttons a {
            padding: 5px 10px;
            margin-right: 5px;
            border-radius: 4px;
            text-decoration: none;
            color: #fff;
            font-size: 12px;
        }
        .action-buttons .create-btn {
            background-color: #007bff;
        }
        .action-buttons .view-btn {
            background-color: #28a745;
        }
        .action-buttons .delete-btn {
            background-color: #dc3545;
        }
        .action-buttons a:hover {
            opacity: 0.8;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;
            const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
                v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
            )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));
            document.querySelectorAll('.document-table th').forEach(th => th.addEventListener('click', (() => {
                const table = th.closest('table');
                Array.from(table.querySelectorAll('tr:nth-child(n+2)'))
                    .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
                    .forEach(tr => table.appendChild(tr) );
            })));
        });
    </script>
</head>
<body>
    <?php include_once __DIR__ . '/../common/_header.php'; ?>
    <main class="main wrapper">
        <div class="header-buttons">
            <a href="/users/signup.php" class="user-register">ユーザ登録</a>
            <div class="search-bar">
                <input type="text" placeholder="文字検索">
                <button><i class="fa fa-search"></i></button>
            </div>
        </div>
        <table class="document-table">
            <thead>
                <tr>
                    <th>タイトル <button class="sort-btn">▼</button></th>
                    <th>作成日 <button class="sort-btn">▼</button></th>
                    <th>作成者 <button class="sort-btn">▼</button></th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($documents as $document) : ?>
                    <tr>
                        <td><?= htmlspecialchars($document['title'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($document['created_at'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($document['maker'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="action-buttons">
                            <a href="create.php?id=<?= htmlspecialchars($document['id']) ?>" class="create-btn">起案</a>
                            <a href="preview.php?id=<?= htmlspecialchars($document['id']) ?>" class="view-btn">view</a>
                            <a href="javascript:void(0);" onclick="confirmDeletion('delete.php?id=<?= htmlspecialchars($document['id'], ENT_QUOTES, 'UTF-8') ?>')" class="delete-btn">削除</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <?php include_once __DIR__ . '/../common/_footer.html'; ?>
</body>
</html>

