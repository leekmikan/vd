<?php
function stoi($val){
 if(is_numeric($val)){
    if(intval($val) == floatval($val)){
        return true;
    }else{
        return false;
    }
 }else{
    return false;
 }
}
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
    $stmt = $db_link->prepare("SELECT * FROM goods WHERE id = ? LIMIT 1;");
    $stmt->execute(array($_SESSION["id"]));
    if($stmt->rowCount() == 0){
        header("Location:../index.php");exit;
    }
    $price = stoi($_POST["price"]) ? $_POST["price"] : "0";
    $s_price = stoi($_POST["s_price"]) ? $_POST["s_price"] : "0";
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
    $stmt = $db_link->prepare("UPDATE goods SET name = ? , image = ? , price = ? , s_price = ? , date = ? , whr = ? , detail = ? WHERE id = ? LIMIT 1;");
    $tmp = "...";//未実装分.
    $stmt->execute(array($_POST["name"],$tmp,$price,$s_price,$date,$_POST["whr"],$_POST["detail"],$_SESSION["id"]));
    $db_link = null;
    $stmt = null;
    $_SESSION["id"] = -1;
    session_destroy();
}
header("Location:../index.php");exit;
?>