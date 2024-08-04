<?php
require_once __DIR__ . '/../common/functions.php';

$document = [];
$mens = [];

try {
    $dbh = connect_db();

    $id = filter_input(INPUT_GET, 'id');

    $stmt = $dbh->prepare("SELECT * FROM doc WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $document = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$document) {
        $document = ['id' => '', 'title' => '', 'contents' => '', 'created_at' => '', 'maker' => ''];
    }
} catch (PDOException $e) {
    echo '接続失敗: ' . $e->getMessage();
}

try {
    $stmt = $dbh->prepare("SELECT * FROM men");
    $stmt->execute();
    $mens = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '接続失敗: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/../common/_head.html' ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>作成</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
            color: #555;
        }

        input[type="text"],
        input[type="date"],
        input[list] {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            margin-top: 20px;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function validateForm() {
            var maker = document.forms["myForm"]["maker"].value;
            var team = document.forms["myForm"]["team"].value;
            var post = document.forms["myForm"]["post"].value;
            var title = document.forms["myForm"]["title"].value;
            var contents = document.forms["myForm"]["contents"].value;
            if (maker == "" || team == "" || post == "" || title == "" || contents == "") {
                alert("空欄がありますのでご注意ください。");
            }
            return true;
        }
    </script>
</head>

<body class="create_body">
    <?php include_once __DIR__ . '/../common/_header.php' ?>
    <main>
        <div class="container">
            <h1>起案文書作成</h1>
            <form name="myForm" action="view.php" method="post" onsubmit="return validateForm()">
                <label>起案番号</label>
                <?php $currentDate = date('Ymd'); ?>
                <input type="text" name="doc_num" value="<?php echo $currentDate; ?>">

                <label>文章の日付</label>
                <?php $currentDate = date('Y-m-d'); ?>
                <input type="date" name="updated_at" value="<?php echo $currentDate; ?>">

                <label>起案</label>
                <?php $currentDate = date('Y-m-d'); ?>
                <input type="date" name="created_at" value="<?php echo $currentDate; ?>">

                <label>課</label>
                <input name="team" list="team">
                <datalist id="team">
                    <?php foreach ($mens as $men) : ?>
                        <option value="<?= htmlspecialchars($men['team']) ?>"><?= htmlspecialchars($men['team']) ?></option>
                    <?php endforeach; ?>
                </datalist>
                <div class="col2_wrap">
                    <div class="inner">
                        <label>役職</label>
                        <input name="post" list="post">
                        <datalist id="post">
                            <?php foreach ($mens as $men) : ?>
                                <option value="<?= htmlspecialchars($men['post']) ?>"><?= htmlspecialchars($men['post']) ?></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                    <div class="inner">
                        <label>名前</label>
                        <input name="maker" list="maker">
                        <datalist id="maker">
                            <?php foreach ($mens as $men) : ?>
                                <option value="<?= htmlspecialchars($men['maker']) ?>"><?= htmlspecialchars($men['maker']) ?></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                </div>
                <label>タイトル</label>
                <input type="text" name="title" value="<?= htmlspecialchars($document['title']) ?>">

                <label>内容</label>
                <textarea id="message" name="contents" rows="7" cols="50"><?= htmlspecialchars($document['contents']) ?></textarea>
                <button type="submit">OK</button>
            </form>
            <a class="back_btn" href="index.php">戻る</a>
        </div>
    </main>
    <?php include_once __DIR__ . '/../common/_footer.html' ?>
</body>

</html>
