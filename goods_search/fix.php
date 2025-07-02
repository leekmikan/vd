<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width,initial-scale=1.0,minimum-scale=1.0' name='viewport'/>
    <meta name="google-site-verification" content="CbDnvL6rMRyk8Thyq_2hoGiOR44qnbxasIA2RAS9Ke8" />
    <meta name="description" content="　　　">
    <title>グッズ登録修正</title>
    <link rel="stylesheet" href="../des.css">
</head>
<body>
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once("../server.php");
            $db_link = null;
            try {
                $db_link = new PDO($DSN, $USER, $PASS);
            } catch (PDOException $e) {
                header("Location:../index.php");exit;
            }
            $stmt = $db_link->prepare("SELECT * FROM goods WHERE id = ? LIMIT 1;");
            $stmt->execute(array($_POST["id"]));
            if($stmt->rowCount() == 0){
                header("Location:../index.php");exit;
            }
    }else{
        header("Location:index.php");exit;
    }
    ?>
    <div class="title">
        <h1>グッズ登録修正</h1>
    </div>
    <div class="main">
        <form action="reg.php" method="POST">
        <?php
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["id"] = $row["id"];
        echo '<label for="name">グッズ名( 必須 )： </label>';
        echo '<input type="text" id="name" name="name" value="'.$row["name"].'" required><br>';
        echo '<label for="price">定価　　　　　：</label>';
        echo '<input type="number" id="price" name="price" value="'.$row["price"].'"><br>';
        echo '<label for="s_price">中古価格　　　：</label>';
        echo '<input type="number" id="s_price" name="s_price" value="'.$row["s_price"].'"><br>';
        echo '<label for="date">発売日　　　　：</label>';
        echo '<input type="date" id="date" name="date" value="'.$row["date"].'"><br>';
        echo '<label for="whr">発売元　　　　：</label>';
        echo '<input type="text" id="whr" name="whr" value="'.$row["whr"].'"><br><br>';
        echo '<label for="detail">詳細</label><br>';
        echo '<textarea id="detail" name="detail" rows="20" cols="50">'.$row["detail"].'</textarea><br><br>';
        ?>
        <input type="submit" value="修正">
    </div>
</body>
