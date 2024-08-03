<?php
require_once __DIR__ . '/../common/functions.php';
require_once __DIR__ . '/../common/config.php';

/* view.phpから値を受け取る
---------------------------------------------*/
// 初期化
$title = '';

// リクエストメソッドの判定
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // フォームに入力されたデータを受け取る
    $title = filter_input(INPUT_POST, 'title');

    // タスク登録処理の実行
    insert_doc($title);
}


// DB接続

// SQLで登録


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
    <div>
        <a href="create.php">新しい文書を作成する</a>
    </div>
</body>

</html>
