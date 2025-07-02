<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width,initial-scale=1.0,minimum-scale=1.0' name='viewport'/>
    <meta name="google-site-verification" content="CbDnvL6rMRyk8Thyq_2hoGiOR44qnbxasIA2RAS9Ke8" />
    <meta name="description" content="　　　">
    <title>ホーム</title>
    <link rel="stylesheet" href="des.css">
</head>
<body>
    <header>
		<?php require_once("server.php"); mk_header_h(); ?>
	</header>
    <div class="title">
        <h1>メインページ</h1>
    </div>
    <div class="main ct">
        <button class="tab_button button_green"onclick="location.href='goods_reg/index.php'">グッズを登録したい</button>
        <button class="tab_button button_green"onclick="location.href='songs_reg/index.php'">CDを登録したい</button>
        <button class="tab_button button_green"onclick="location.href='history_reg/index.php'">歴史を登録したい</button><br><br>
        <button class="tab_button button_blue"onclick="location.href='goods_search/index.php'">グッズを検索したい</button>
        <button class="tab_button button_blue"onclick="location.href='songs_search/index.php'">CDを検索したい</button>
        <button class="tab_button button_blue"onclick="location.href='history_search/index.php'">歴史を検索したい</button>
    </div>
    <footer>
        <?php mk_footer(); ?>
    </footer>
</body>