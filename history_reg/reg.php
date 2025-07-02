<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
require_once("../server.php");
$db_link = null;
try {
    $db_link = new PDO($DSN, $USER, $PASS);
} catch (PDOException $e) {
    header("Location:../index.php");exit;
}
$stmt = $db_link->prepare('INSERT INTO histories (name, date, detail) VALUE (? , ? , ?)');
$stmt->execute(array($_POST["name"],$_POST["date"],$_POST["detail"]));
$db_link = null;
$stmt = null;
}
header("Location:../index.php");exit;
?>