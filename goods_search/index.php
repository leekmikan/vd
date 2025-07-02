<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width,initial-scale=1.0,minimum-scale=1.0' name='viewport'/>
    <meta name="google-site-verification" content="CbDnvL6rMRyk8Thyq_2hoGiOR44qnbxasIA2RAS9Ke8" />
    <meta name="description" content="　　　">
    <title>グッズ検索</title>
    <link rel="stylesheet" href="../des.css">
</head>
<body>
    <header>
		<?php require_once("../server.php"); mk_header(); ?>
	</header>
    <div class="title">
        <h1>グッズ検索</h1>
    </div>
    <div class="main">
        <p>すべて部分検索</p>
        <form action="index.php" method="GET">
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $db_link = null;
            try {
                $db_link = new PDO($DSN, $USER, $PASS);
            } catch (PDOException $e) {
                header("Location:../index.php");exit;
            }
            $page = 0;
            $q_name = "%";
            $q_whr = "%";
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
                echo '<label for="name">グッズ名： </label><input type="text" id="name" name="name" value="'.$_GET["name"].'"><br>';
            }else{
                echo '<label for="name">グッズ名： </label><input type="text" id="name" name="name"><br>';
            }
            if(isset($_GET["date"])){
                $ip .= "<input type='hidden' name='date' value='". $_GET["date"] ."' form='gf'>";
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
            if(isset($_GET["whr"])){
                $ip .= "<input type='hidden' name='whr' value='".htmlspecialchars($_GET["whr"], ENT_QUOTES, 'UTF-8')."' form='gf'>";
                $q_whr = "%".htmlspecialchars($_GET["whr"], ENT_QUOTES, 'UTF-8')."%";
                echo '<label for="whr">発売元　：</label><input type="text" id="whr" name="whr" value="'.$_GET["whr"].'"><br>';
            }else{
                echo '<label for="whr">発売元　：</label><input type="text" id="whr" name="whr"><br>';
            }
            if(isset($_GET["detail"])){
                $ip .= "<input type='hidden' name='detail' value='".htmlspecialchars($_GET["detail"], ENT_QUOTES, 'UTF-8')."' form='gf'>";
                $q_detail = "%".htmlspecialchars($_GET["detail"], ENT_QUOTES, 'UTF-8')."%";
                echo '<label for="detail">詳細文　：</label><input type="text" id="detail" name="detail" value="'.$_GET["detail"].'"><br><br>';
            }else{
                echo '<label for="detail">詳細文　：</label><input type="text" id="detail" name="detail"><br><br>';
            }
            echo '<input type="submit" value="検索"></form></div>';
            $stmt = $db_link->prepare("SELECT * FROM goods WHERE name LIKE ? AND whr LIKE ? AND detail LIKE ? AND ABS(DATEDIFF(date, ?)) <= ? AND status < 2;");
            $stmt->execute(array($q_name,$q_whr,$q_detail,$q_date,$q_range));
            $hit = $stmt->rowCount();
            $stmt = $db_link->prepare("SELECT * FROM goods WHERE name LIKE ? AND whr LIKE ? AND detail LIKE ? AND ABS(DATEDIFF(date, ?)) <= ? AND status < 2 " . ' LIMIT '. ($page * $SEARCH ) . ',' . (($page + 1) * $SEARCH) . ";");
            $stmt->execute(array($q_name,$q_whr,$q_detail,$q_date,$q_range));
            $n_hit = $stmt->rowCount();
            $headers = getallheaders();
            if( $n_hit > 0 )
            {
                echo $hit . "件中　" . $n_hit . "件表示";
                echo "<table border>";
                echo "<tr>";
                echo "<td>名前</td>";
                echo "<td>画像</td>";
                echo "<td>価格</td>";
                echo "<td>中古価格</td>";
                echo "<td>発売日</td>";
                echo "<td>発売元</td>";
                echo "<td>詳細</td>";
                echo "<td>修正</td>";
                echo "</tr>";
                $i = 0;
                while( $row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . "(未実装)" . "</td>";
                    echo "<td>" . $row["price"] . "</td>";
                    echo "<td>" . $row["s_price"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td>" . $row["whr"] . "</td>";
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
                echo "<p><a href='../goods_reg'>存在するグッズならこちらで登録しましょう！</a></p>";
            }    
            $db_link = null;
            $stmt = null;
        }
    ?>
    <footer>
        <?php mk_footer(); ?>
    </footer>
</body>
