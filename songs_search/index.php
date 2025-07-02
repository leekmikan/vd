<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width,initial-scale=1.0,minimum-scale=1.0' name='viewport'/>
    <meta name="google-site-verification" content="CbDnvL6rMRyk8Thyq_2hoGiOR44qnbxasIA2RAS9Ke8" />
    <meta name="description" content="　　　">
    <title>楽曲検索</title>
    <link rel="stylesheet" href="../des.css">
</head>
<body>
    <header>
		<?php require_once("../server.php"); mk_header(); ?>
	</header>
    <div class="title">
        <h1>楽曲検索</h1>
    </div>
    <div class="main">
        <p>すべて部分検索</p>
        <form action="index.php" method="GET">
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $db_link = new PDO($DSN, $USER, $PASS);
            $page = 0;
            $q_name = "%";
            $q_artists = "%";
            $q_vocals = "%";
            $q_lyrics = "%";
            $q_detail = "%";
            $q_date = "2000-01-01";
            $q_range = "1000000";
             $ip = "<form action='index.php' method='GET' id='gf'>";
            if(isset($_GET["page"])){
                $page = $_GET["page"];
            }
            if(isset($_GET["name"])){
                $ip .= "<input type='hidden' name='name' value='".htmlspecialchars($_GET["name"], ENT_QUOTES, 'UTF-8')."' form='gf'>";
                $q_name = "%".htmlspecialchars($_GET["name"], ENT_QUOTES, 'UTF-8')."%";
                echo '<label for="name">曲名　　　　　： </label><input type="text" id="name" name="name" value="'.$_GET["name"].'"><br>';
            }else{
                echo '<label for="name">曲名　　　　　： </label><input type="text" id="name" name="name"><br>';
            }
            if(isset($_GET["artists"])){
                $ip .= "<input type='hidden' name='artists' value='".htmlspecialchars($_GET["name"], ENT_QUOTES, 'UTF-8')."' form='gf'>";
                $q_artists = "%".htmlspecialchars($_GET["artists"], ENT_QUOTES, 'UTF-8')."%";
                echo '<label for="artists">アーティスト名： </label><input type="text" id="artists" name="artists" value="'.$_GET["artists"].'"><br>';
            }else{
                echo '<label for="artists">アーティスト名： </label><input type="text" id="artists" name="artists"><br>';
            }
            if(isset($_GET["vocals"])){
                $ip .= "<input type='hidden' name='vocals' value='".htmlspecialchars($_GET["vocals"], ENT_QUOTES, 'UTF-8')."' form='gf'>";
                $q_vocals = "%".htmlspecialchars($_GET["vocals"], ENT_QUOTES, 'UTF-8')."%";
                echo '<label for="vocals">使用ボカロ　　：</label><input type="text" id="vocals" name="vocals" value="'.$_GET["vocals"].'"><br>';
            }else{
                echo '<label for="vocals">使用ボカロ　　：</label><input type="text" id="vocals" name="vocals"><br>';
            }
            if(isset($_GET["date"])){
                $ip .= "<input type='hidden' name='date' value='". $q_date ."' form='gf'>";
                $q_date = $_GET["date"];
                echo '<label for="date">発売日　：</label><input type="date" id="date" name="date" value="'.$_GET["date"].'"><br>';
            }else{
                echo '<label for="date">発売日　：</label><input type="date" id="date" name="date"><br>';
            }
            if(isset($_GET["range"])){
                $ip .= "<input type='hidden' name='range' value='". $_GET["range"] ."' form='gf'>";
                $q_range = $_GET["range"];
            }
            echo '<label for="year">年：</label>';
            if($q_range == 365) echo '<input type="radio" id="year" name="range" value="365" checked>'; else echo '<input type="radio" id="year" name="range" value="365">';
            echo '<label for="month">　　月：</label>';
            if($q_range == 31) echo '<input type="radio" id="month" name="range" value="31" checked>'; else echo '<input type="radio" id="month" name="range" value="31">';
            echo '<label for="day">　　日：</label>';
            if($q_range == 0) echo '<input type="radio" id="day" name="range" value="0" checked><br><br>'; else echo '<input type="radio" id="day" name="range" value="0"><br><br>';
            if(isset($_GET["lyrics"])){
                $ip .= "<input type='hidden' name='lyrics' value='".htmlspecialchars($_GET["lyrics"], ENT_QUOTES, 'UTF-8')."' form='gf'>";
                $q_lyrics = "%".htmlspecialchars($_GET["lyrics"], ENT_QUOTES, 'UTF-8')."%";
                echo '<label for="lyrics">歌詞　　　　　：</label><input type="text" id="lyrics" name="lyrics" value="'.$_GET["lyrics"].'"><br>';
            }else{
                echo '<label for="lyrics">歌詞　　　　　：</label><input type="text" id="lyrics" name="lyrics"><br>';
            }
            if(isset($_GET["detail"])){
                $ip .= "<input type='hidden' name='detail' value='".htmlspecialchars($_GET["detail"], ENT_QUOTES, 'UTF-8')."' form='gf'>";
                $q_detail = "%".htmlspecialchars($_GET["detail"], ENT_QUOTES, 'UTF-8')."%";
                echo '<label for="detail">詳細文　　　　：</label><input type="text" id="detail" name="detail" value="'.$_GET["detail"].'"><br><br>';
            }else{
                echo '<label for="detail">詳細文　　　　：</label><input type="text" id="detail" name="detail"><br><br>';
            }
            echo '<input type="submit" value="検索"></form></div>';
            $stmt = $db_link->prepare('SELECT * FROM songs WHERE name LIKE ? AND artists LIKE ? AND vocals LIKE ? AND lyrics LIKE ? AND detail LIKE ? AND ABS(DATEDIFF(date, ?)) <= ? AND status < 2;');
            $stmt->execute(array($q_name,$q_artists,$q_vocals,$q_lyrics,$q_detail,$q_date,$q_range));
            $hit = $stmt->rowCount();
            $stmt = $db_link->prepare('SELECT * FROM songs WHERE name LIKE ? AND artists LIKE ? AND vocals LIKE ? AND lyrics LIKE ? AND detail LIKE ? AND ABS(DATEDIFF(date, ?)) <= ? AND status < 2;' . ' LIMIT '. ($page * $SEARCH ) . ',' . (($page + 1) * $SEARCH) . ';');
            $stmt->execute(array($q_name,$q_artists,$q_vocals,$q_lyrics,$q_detail,$q_date,$q_range));
            $n_hit = $stmt->rowCount();
            if( $n_hit > 0 )
            {
                echo $hit . "件中　" . $n_hit . "件表示";
                echo "<table border>";
                echo "<tr>";
                echo "<td>曲名</td>";
                echo "<td>アーティスト名</td>";
                echo "<td>使用ボカロ</td>";
                echo "<td>発売日</td>";
                echo "<td>歌詞</td>";
                echo "<td>詳細</td>";
                echo "<td>修正</td>";
                echo "</tr>";
                $i = 0;
                while( $row = $stmt->fetch(PDO::FETCH_ASSOC) )
                {
                    echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["artists"] . "</td>";
                    echo "<td>" . $row["vocals"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td>" . nl2br($row["lyrics"]) . "</td>";
                    echo "<td>" . nl2br($row["detail"]) . "</td>";
                    echo "<td>";
                    if($row["status"] == 1){
                        echo "<p>修正禁止</p>";
                    }else{
                        echo "<form action='fix.php' method='POST' id='form".$i."'>";
                        echo "<input type='hidden' name='id' value='".$row["id"]."'>";
                        echo "<input type='submit' value='修正' form='form".$i."'>";
                        echo "</form>";
                    }
                    echo "</td>";
                    echo "</tr>";
                    $i++;
                }
                echo "</table><br>";
                echo $ip;
                echo "<label for='page'>ページ：</label>";
                echo "<input name='page' type='number' min='0' max='". floor($hit / $SEARCH) ."' step='1' value='". $page ."' form='gf'>";
                echo "<input type='submit' value='検索' form='gf'>";
                echo "</form>";
            }
            else
            {
                echo "<p>見つかりません...</p>";
                echo "<p><a href='../songs_reg'>存在する曲ならこちらで登録しましょう！</a></p>";
            }    
            $db_link = null;
            $stmt = null;
        }
    ?>
    <footer>
        <?php mk_footer(); ?>
    </footer>
</body>
