<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>作成</title>
</head>

<body>
    <h1>起案文書作成</h1>
    <!-- エラーが発生した場合、エラーメッセージを出力 -->
    <label>起案番号</label> 
    <!-- 現在の年月日を取得して表示 -->
    <form action="" method="post">
        <?php
            $currentDate = date('Ymd');
        ?>
        <input type="text" value="<?php echo $currentDate; ?>">
    </form>
    <label>文章の日付</label>
    <form action="" method="post">
    <!-- 現在の年月日を取得して表示 -->
        <?php
            $currentDate = date('Y-m-d');
        ?>
        <input type="date" value="<?php echo $currentDate; ?>">

    </form>
    <label>起案</label>
    <form action="" method="post">
    <!-- 現在の年月日を取得して表示 -->
        <?php
        $currentDate = date('Y-m-d');
        ?>
        <input type="date" value="<?php echo $currentDate; ?>">

    </form>
    <label>課</label>
    <form action="" method="post">
    <!-- 起案文書DBから課を抜き出してプルダウンで表示 -->
        <input type="text" value="起案者DBから課取得">
    </form>
    <label>名前</label>
    <form action="" method="post">
        <input type="text" value="起案者DBから名前取得">
    </form>
    <label>タイトル</label>
    <form action="" method="post">
        <input type="text" value="起案文書DBからタイトル取得">
    </form>
    <label>内容</label>
    <form action="" method="post">
        <input type="text" value="起案文書DBから内容取得">
    </form>

    <!-- 確認ボタン -->
    <form action="view.php" method="get">
        <button type="submit">OK</button>
    </form>

        <!-- 戻るボタン -->
    <form action="index.php" method="get">
        <button type="submit">戻る</button>
    </form>
</body>

</html>
