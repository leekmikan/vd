<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once("../server.php");
    session_start();
    if(!isset($_SESSION["id"])){
        header("Location:../index.php");exit;
    }
    $db_link = null;
    try {
        $db_link = new PDO($DSN, $USER, $PASS);
    } catch (PDOException $e) {
        header("Location:../index.php");exit;
    }
    $stmt = $db_link->prepare("SELECT * FROM histories WHERE id = ? LIMIT 1;");
    $stmt->execute(array($_SESSION["id"]));
    if($stmt->rowCount() == 0){
        header("Location:../index.php");exit;
    }
    $date = "";
    if(preg_match('/\A[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}\z/', $_POST["date"])){
        list($year, $month, $day) = explode('-', $_POST["date"]);
        if(checkdate($month, $day, $year)){
            $date = $_POST["date"];
        }else{
            $date = "2000-01-01";
        }
    }else{
        $date = "2000-01-01";
    }
    $stmt = $db_link->prepare("UPDATE histories SET name = ? , date = ? , detail = ? WHERE id = ? LIMIT 1;");
    $stmt->execute(array($_POST["name"],$date,$_POST["detail"],$_SESSION["id"]));
    $db_link = null;
    $stmt = null;
    $_SESSION["id"] = -1;
    session_destroy();
}
header("Location:../index.php");exit;
?>