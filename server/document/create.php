<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>作成</title>
</head>

<body>
    <h1>起案文書作成</h1>
    <form action="view.php" method="POST">
        <!-- エラーが発生した場合、エラーメッセージを出力 -->
        <label>起案番号</label>
        <!-- 現在の年月日を取得して表示 -->
        <div>
            <?php
            $currentDate = date('Ymd');
            ?>
            <input type="text" name="document_number" value="<?php echo $currentDate; ?>">
        </div>
        <div>
            <label>文章の日付</label>
            <!-- 現在の年月日を取得して表示 -->
            <?php
            $currentDate = date('Y-m-d');
            ?>
            <input type="date" name="document_date" value="<?php echo $currentDate; ?>">
        </div>
        <div>
            <label>起案</label>
            <!-- 現在の年月日を取得して表示 -->
            <?php
            $currentDate = date('Y-m-d');
            ?>
            <input type="date" name="draft_date" value="<?php echo $currentDate; ?>">
        </div>
        <div>
            <label>課</label>
            <!-- 起案文書DBから課を抜き出してプルダウンで表示 -->
            <input type="text" name="section" value="起案者DBから課取得">
        </div>
        <div>
            <label>名前</label>
            <input type="text" name="name" value="起案者DBから名前取得">
        </div>
        <div>
            <label>タイトル</label>
            <input type="text" name="title" value="起案文書DBからタイトル取得">
        </div>
        <div>
            <label>内容</label>
            <textarea type="text" name="contents" value="起案文書DBから内容取得"></textarea>
        </div>
        <div>
            <!-- 確認ボタン -->
            <button type="submit">OK</button>
            <!-- 戻るボタン -->
            <button type="submit">戻る</button>
        </div>
    </form>
</body>

</html>
