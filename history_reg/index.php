<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width,initial-scale=1.0,minimum-scale=1.0' name='viewport'/>
    <meta name="google-site-verification" content="CbDnvL6rMRyk8Thyq_2hoGiOR44qnbxasIA2RAS9Ke8" />
    <meta name="description" content="　　　">
    <title>歴史登録</title>
    <link rel="stylesheet" href="../des.css">
</head>
<body>
    <div class="title">
        <h1>歴史登録</h1>
    </div>
    <div class="main">
        <form action="reg.php" method="POST">
        <label for="name">タイトル( 必須 )　　： </label>
        <input type="text" id="name" name="name" required><br>
        <label for="date">日付( 必須 )　　　　：</label>
        <input type="date" id="date" name="date" required><br><br>
        <label for="detail">詳細文</label><br>
        <textarea id="detail" name="detail" rows="40" cols="50">
2000字以内
        </textarea><br><br>
        <input type="submit" value="送信">
        <p>注意</p>
        <ul>
            <li>客観的な内容であること</li>
            <li>出来るだけ名前がある、検索が容易なもの</li>
        </ul>
    </div>
</body>