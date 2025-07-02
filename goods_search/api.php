<?php
require_once("../server.php");
header("Access-Control-Allow-Origin: *");
if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, Content-Type");
    exit;
}
else if($_SERVER['REQUEST_METHOD'] == 'GET') {
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
    $headers = getallheaders();
    if (isset($headers['Content-Type'])) {
        if($headers['Content-Type'] == "application/json"){
            if(isset($_GET["page"])){
                $page = $_GET["page"];
            }
            if(isset($_GET["name"])){
                $q_name = "%".htmlspecialchars($_GET["name"], ENT_QUOTES, 'UTF-8')."%";
            }
            if(isset($_GET["date"])){
                $q_date = $_GET["date"];
            }
            if(isset($_GET["range"])){
                $q_range = $_GET["range"];
            }
            if(isset($_GET["whr"])){
                $q_whr = "%".htmlspecialchars($_GET["whr"], ENT_QUOTES, 'UTF-8')."%";
            }
            if(isset($_GET["detail"])){
                $q_detail = "%".htmlspecialchars($_GET["detail"], ENT_QUOTES, 'UTF-8')."%";
            }
            $stmt = $db_link->prepare("SELECT * FROM goods WHERE name LIKE ? AND whr LIKE ? AND detail LIKE ? AND ABS(DATEDIFF(date, ?)) <= ? AND status < 2 " . ' LIMIT '. ($page * $SEARCH ) . ',' . (($page + 1) * $SEARCH) . ";");
            $stmt->execute(array($q_name,$q_whr,$q_detail,$q_date,$q_range));
            $Data = array();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            	$Data[]=array(
            	'name'=>$row['name'],
            	'image'=>$row['image'],
                'price'=>$row['price'],
                's_price'=>$row['s_price'],
                'date'=>$row['date'],
                'whr'=>$row['whr'],
                'detail'=>$row['detail'],
            	);
            }
            header('Content-type: application/json');
            echo json_encode($Data);
        }
    }
    $db_link = null;
    $stmt = null;
}
