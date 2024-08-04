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

<?php include_once __DIR__ . '/../common/_head.html'; ?>
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
                .forEach(tr => table.appendChild(tr));
        })));
    });
</script>

<body class="index_body">
    <?php include_once __DIR__ . '/../common/_header.php'; ?>
    <main class="main wrapper">
        <div class="header-buttons">
            <div class="btn_wrap">
                <a href="/users/signup.php" class="user-register">ユーザ登録</a>
                <a class="new_add" href="/document/create.php" class="user-register">起案の新規登録</a>
            </div>
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
