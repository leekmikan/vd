<?php 
$USER = "V_D";
$DSN = "mysql:host=s323.xrea.com;dbname=vocalos";
$PASS = "UKIMENUSTAH";
$SEARCH = 100;
function mk_header(){
    echo '<button onclick="location.href=\'../index.php\'">ホーム</button>';
	echo '<button onclick="location.href=\'https://x.com/leekmikan\'">Xメイン(ボカロ)</button>';
    echo '<button onclick="location.href=\'https://x.com/mirilelumeka\'">Xサブ(プログラミング)</button>';
}
function mk_header_h(){
    echo '<button onclick="location.href=\'index.php\'">ホーム(ココ)</button>';
	echo '<button onclick="location.href=\'https://x.com/leekmikan\'">Xメイン(ボカロ)</button>';
    echo '<button onclick="location.href=\'https://x.com/mirilelumeka\'">Xサブ(プログラミング)</button>';
}
function mk_footer(){
    echo '<p>アットウィキよりも情報量を減らす代わりに、データ分析で取得しやすくしたり、最低限の情報を知ることができるようにしやすくしたりしたやつ</p>';
    echo '<p>情報の登録/修正も簡単(多分)</p>';
    echo '<p>一応、データベースには可能な限り目を通して、怪しいものは削除、荒れが発覚したら修正不可に変更予定</p>';
    echo '<p>こちらのページは作りたて(2025/7/2)';
}
?>