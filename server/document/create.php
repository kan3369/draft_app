<?php
require_once __DIR__ . '/../common/functions.php';
// データベース接続
// $host = 'db';
// $db = 'draft_db';
// $user = 'draft_admin';
// $pass = '1234';
$document = [];
$mens = [];

try {
    // データベースに接続
// $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
//         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh = connect_db();

        // GETパラメータからIDを取得
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        // データを取得するSQL
        $stmt = $dbh->prepare("SELECT * FROM doc WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // 結果を取得
        $document = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo '接続失敗: ' . $e->getMessage();
    }
try {
        // データを取得するSQL
        $stmt = $dbh->prepare("SELECT * FROM men");
        $stmt->execute();

        // 結果を取得
        $mens = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo '接続失敗: ' . $e->getMessage();
    }
    // $maker = htmlspecialchars($document['maker']);
    //     echo $maker;
    //     echo "title: " . htmlspecialchars($document['title']);
    //     echo "contents: " . htmlspecialchars($document['contents']);

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>作成</title>
</head>

<body>
    <h1>起案文書作成</h1>
    <!-- <h1>選択されたID: <?php echo htmlspecialchars($_GET['id']); ?></h1> -->
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
    <!-- 起案文書DBから課を抜き出してプルダウンで表示 -->
    <form action="" method="post">
        <select team="selected_team">
            <?php
            // fetch_data.phpをインクルードしてデータを取得
            include 'fetch_data.php';
            foreach ($mens as $men) {
                echo '<option value="' . htmlspecialchars($men['id']) . '">' . htmlspecialchars($men['team']) . '</option>';
            }
            ?>
        </select>
    </form>

    <label>名前</label>
    <form action="" method="post">
        <select name="selected_name">
            <?php
            // fetch_data.phpをインクルードしてデータを取得
            include 'fetch_data.php';
            foreach ($mens as $men) {
                echo '<option value="' . htmlspecialchars($men['id']) . '">' . htmlspecialchars($men['name']) . '</option>';
            }
            ?>
        </select>
    </form>

    <label>タイトル</label>
    <form action="" method="post">
        <input type="text" value= "<?= h($document['title']) ?>">
    </form>
    <label>内容</label>
    <form action="" method="post">
        <input type="text" value="<?= h($document['contents']) ?>">
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
