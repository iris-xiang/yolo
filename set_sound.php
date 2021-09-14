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

$sound = $_GET['sound'];

//$json = json_decode( file_get_contents('php://input'), true );
//$api = $json['api'];
//$mask = $json['mask'];

$sqlStr = "UPDATE image_num
    SET sound = '$sound'
    WHERE num = 1";
    $rs = $dbh->query($sqlStr);

?>