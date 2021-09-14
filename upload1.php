<?php

$db_user = "iris";
$db_pwd = "iris890324";
$db_sever = "127.0.0.1";
$db_name = "project";
$dbms = 'mysql';
$dsn = "$dbms:host=$db_sever;dbname=$db_name";

try {
    $dbh = new PDO($dsn, $db_user, $db_pwd
     ,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'")
    ); // init PDO
    // $dbh->query("SET NAMES 'UTF8'");
} catch (PDOException $e) {
    // die ("Error!: " . $e->getMessage() . "<br/>");
}
$str = file_get_contents('php://input');
//$time = microtime(true);
file_put_contents("C:/xampp/htdocs/yolov4_detect/YOLOV4_detect2/YOLOV4_detect/detect/timestamp_micro.jpg", $str);



set_time_limit(20);
$command = "C:\\xampp\\htdocs\\run.bat";
exec("$command");

$time = 0;
$sqlStr = "SELECT * 
    FROM door
    WHERE id = 1 AND sound = 'N'";
    $rs = $dbh->query($sqlStr);
	$rows = $rs->fetchAll();
	foreach($rows as $row) {
		$time = $row['time'];
	}

echo $time;
echo "\r\n==============\r\n";
// step1 讀取資料庫 reply 上次修改時間
$finish = false;
$count = 1;
while(true) {
	echo $replyTime = filemtime("C:/xampp/htdocs/yolov4_detect/YOLOV4_detect2/YOLOV4_detect/reply.txt") . "";
	echo "\r\n";
	// step 2 比對 $replyTime 和資料庫時間是否不同，不同表示已更新 mask 結果，結束迴圈
	if($time != $replyTime) {
		$finish = true;
		echo "Get reply time\r\n";
		break;
	}
	
	if($count >= 20) {
		// timeout 時間內未完成辨識，結束
		break;
	}
	clearstatcache();
	sleep(1);
	$count += 1;
}

// 有比對到，把結果存進資料庫包含修改時間
if($finish) {
	$reply = file_get_contents("C:/xampp/htdocs/yolov4_detect/YOLOV4_detect2/YOLOV4_detect/reply.txt");
	// MySQL Update reply to mask and replyTIme to Time
	$sqlStr = "UPDATE door SET mask = '$reply' ,time = '$replyTime',sound = 'N' WHERE id = 1";
	$rs = $dbh->query($sqlStr);
}
echo "OK";
?>