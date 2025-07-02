<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width,initial-scale=1.0,minimum-scale=1.0' name='viewport'/>
    <meta name="google-site-verification" content="CbDnvL6rMRyk8Thyq_2hoGiOR44qnbxasIA2RAS9Ke8" />
    <meta name="description" content="　　　">
    <title>楽曲登録</title>
    <link rel="stylesheet" href="../des.css">
</head>
<body>
    <div class="title">
        <h1>楽曲登録</h1>
    </div>
    <div class="main">
        <form action="reg.php" method="POST">
        <label for="name">曲名( 必須 )　　　　　： </label>
        <input type="text" id="name" name="name" required><br>
        <label for="artists">アーティスト名( 必須 )：</label>
        <input type="text" id="artists" name="artists" required><br>
        <label for="vocals">使用ボカロ( 必須 )　　：</label>
        <input type="text" id="vocals" name="vocals" required><br>
        <label for="date">公開日　　　　　　　：</label>
        <input type="date" id="date" name="date"><br><br>
        <label for="lyrics">歌詞</label><br>
        <textarea id="lyrics" name="lyrics" rows="40" cols="50">
2000字以内
        </textarea><br><br>
                <label for="detail">詳細</label><br>
        <textarea id="detail" name="detail" rows="20" cols="50">
1000字以内
        </textarea><br><br>
        <input type="submit" value="送信">
        <p>注意</p>
        <ul>
            <li>使用ボカロはカンマ区切りで書くこと</li>
            <li>アーティスト名はカンマで区切りかつ、複数名義は書かないこと(こちらで統一する)</li>
        </ul>
    </div>
</body>