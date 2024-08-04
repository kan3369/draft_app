<?php
require_once __DIR__ . '/../common/functions.php';

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
    $sql = 'SELECT id, team, post, maker, contents, title, created_at, doc_num FROM doc';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // 結果を取得
    $documents = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '接続失敗: ' . $e->getMessage();
}

$id = 0;

// パラメータが渡されていなけらば一覧画面に戻す
$id = filter_input(INPUT_GET, 'id');
if (empty($id)) {
    header('Location: index.php');
    exit;
}

$doc = find_doc_by_id($id);


?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/../common/_head.html' ?>

<body>
    <?php include_once __DIR__ . '/../common/_header.php' ?>
    <main class="main">
        <div class="form_wrap">
            <form class="form" action="register.php" method="POST">
                <div class="inner_height">
                    <div class="row_01">
                        <h1>回議用紙</h1>
                        <div class="doc_num">
                            <div class="num">
                                <label for="doc_num">文書番号:</label>
                                <input class="name" type="text" name="doc_num" value="<?= h($doc['doc_num']); ?>">
                            </div>
                            <div class="date">
                                <label for="updated_at">文書の日付:</label>
                                <input class="name" type="text" name="updated_at" value="<?= h($doc['updated_at']); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row_02">
                        <div class="draft-name_wrap">
                            <div class="draft_date">
                                <label for="created_at">起案:</label>
                                <input class="name" type="text" name="created_at" value="<?= h($doc['created_at']); ?>">
                            </div>
                            <!-- <div class="name">担当者: </div> -->
                            <div class="maker_name">
                                <p>
                                    <label for="team">部署:</label>
                                    <input class="name" type="text" name="team" value="<?= h($doc['team']); ?>">
                                </p>
                                <p>
                                    <label for="post">役職:</label>
                                    <input class="name" type="text" name="post" value="<?= h($doc['post']); ?>">
                                </p>
                                <p>
                                    <label for="maker">担当者:</label>
                                    <input class="name" type="text" name="maker" value="<?= h($doc['maker']); ?>">
                                </p>
                            </div>
                        </div>
                        <div class="stamp_wrap">
                            <ul class="stamp_list">
                                <li><span>校合</span><span></span></li>
                                <li><span>浄書</span><span></span></li>
                                <li><span>発送</span><span></span></li>
                                <li><span>公印</span><span></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row_03">
                        <div class="approval">決裁年月日<span></span></div>
                        <div class="abstract">摘要<span></span></div>
                        <div class="send">発送年月日<span></span></div>
                    </div>
                    <div class="row_04">
                        <ul class="check_list">
                            <li><span>町長</span><span></span></li>
                            <li><span>副町長</span><span></span></li>
                            <li><span>課長</span><span></span></li>
                            <li><span>課長補佐</span><span></span></li>
                            <li><span>副主幹</span><span></span></li>
                            <li><span>課員</span><span></span></li>
                        </ul>
                    </div>
                    <div class="row_05">
                        <div class="title_wrap">
                            <label for="title">タイトル</label>
                            <textarea class="title_fz" type="text" name="title" rows="1" cols="20"><?= h($doc['title']); ?></textarea>
                        </div>
                        <div class="contents_wrap">
                            <label for="contents">内容</label>
                            <textarea id="message" name="contents" rows="19" cols="300"><?= h($doc['contents']); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="link_wrap">
                    <div class="btn"><input type="submit" value="コピー" class="upload_submit"></div>
                    <div class="btn"><a href="/document/index.php">戻る</a></div>
                </div>
            </form>
        </div>
    </main>
    <?php include_once __DIR__ . '/../common/_footer.html' ?>
</body>

</html>
