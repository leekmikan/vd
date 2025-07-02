<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width,initial-scale=1.0,minimum-scale=1.0' name='viewport'/>
    <meta name="google-site-verification" content="CbDnvL6rMRyk8Thyq_2hoGiOR44qnbxasIA2RAS9Ke8" />
    <meta name="description" content="　　　">
    <title>グッズ登録</title>
    <link rel="stylesheet" href="../des.css">
</head>
<body>
    <div class="title">
        <h1>グッズ登録</h1>
    </div>
    <div class="main">
        <form action="reg.php" method="POST">
        <label for="name">グッズ名( 必須 )： </label>
        <input type="text" id="name" name="name" required><br>
        <label for="price">定価　　　　　：</label>
        <input type="number" id="price" name="price"><br>
        <label for="s_price">中古価格　　　：</label>
        <input type="number" id="s_price" name="s_price"><br>
        <label for="date">発売日　　　　：</label>
        <input type="date" id="date" name="date"><br>
        <label for="whr">発売元　　　　：</label>
        <input type="text" id="whr" name="whr"><br><br>
        <label for="detail">詳細</label><br>
        <textarea id="detail" name="detail" rows="20" cols="50">
1000字以内
アルバムの場合は、箇条書きで曲名を書くこと。
        </textarea><br><br>
        <input type="submit" value="送信">
    </div>
</body>
