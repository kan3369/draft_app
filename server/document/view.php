<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/../common/_head.html' ?>

<body>
    <?php include_once __DIR__ . '/../common/_header.php' ?>
    <main class="main">
        <div class="form_wrap">
            <form action="">
                <div class="row_01">
                    <h1>回議用紙</h1>
                    <div class="doc_num">
                        <div class="num">文書番号</div>
                        <div class="date">文書の日付</div>
                    </div>
                </div>
                <div class="row_02">
                    <div class="draft-name_wrap">
                        <div class="draft_date">起案</div>
                        <div class="name">担当者</div>
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
                    <div class="tilte_wrap"></div>
                    <div class="contents_wrap"></div>
                </div>
            </form>
        </div>
    </main>
    <?php include_once __DIR__ . '/../common/_footer.html' ?>
</body>

</html>
