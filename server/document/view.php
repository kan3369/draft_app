<?php

$doc_num = filter_input(INPUT_POST, 'doc_num');
$updated_at = filter_input(INPUT_POST, 'updated_at');
$created_at = filter_input(INPUT_POST, 'created_at');
$created_at = filter_input(INPUT_POST, 'created_at');
$maker = filter_input(INPUT_POST, 'maker');
$title = filter_input(INPUT_POST, 'title');
$contents = filter_input(INPUT_POST, 'contents');
?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/../common/_head.html' ?>

<body>
    <?php include_once __DIR__ . '/../common/_header.php' ?>
    <main class="main">
        <div class="form_wrap">
            <form class="form" action="register.php" method="POST">
                <div class="row_01">
                    <h1>回議用紙</h1>
                    <div class="doc_num">
                        <div class="num">
                            <label for="doc_num">文書番号:</label>
                            <input class="name" type="text" name="doc_num" value="<?php echo $doc_num; ?>">
                        </div>
                        <div class="date">
                            <label for="updated_at">文書の日付:</label>
                            <input class="name" type="text" name="updated_at" value="<?php echo $updated_at ?>">
                        </div>
                    </div>
                </div>
                <div class="row_02">
                    <div class="draft-name_wrap">
                        <div class="draft_date">
                            <label for="created_at">起案:</label>
                            <input class="name" type="text" name="created_at" value="<?php echo $created_at ?>">
                        </div>
                        <!-- <div class="name">担当者: </div> -->
                        <div class="maker_name">
                            <label for="maker">部署:</label>
                            <input class="name" type="text" name="maker" value="<?php echo $maker ?>">
                            <label for="maker">役職:</label>
                            <input class="name" type="text" name="maker" value="<?php echo $maker ?>">
                            <label for="maker">担当者:</label>
                            <input class="name" type="text" name="maker" value="<?php echo $maker ?>">
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
                        <textarea type="text" name="title"><?php echo $title ?></textarea>
                    </div>
                    <div class="contents_wrap">
                        <label for="contents">内容</label>
                        <textarea type="text" name="contents"><?php echo $contents ?></textarea>
                    </div>
                </div>
                <div class="link_wrap">
                    <div class="btn"><input type="submit" value="登録" class="upload_submit"></div>
                    <div class="btn"><input type="submit" value="PDF化" class="upload_submit"></div>
                    <div class="btn"><a href="/document/create.php">戻る</a></div>
                </div>
            </form>
        </div>
    </main>
    <?php include_once __DIR__ . '/../common/_footer.html' ?>
</body>

</html>
