<?PHP
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
if(in_array('sha512', hash_algos())) {
	ini_set('session.hash_function', 'sha512');
}
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") {
	ini_set('session.cookie_secure', 1);
	if(!headers_sent()) {
		header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload;");
	}
}
session_start();

header("Content-Type: application/json; charset=UTF-8");

require_once('../other/config.php');
require_once('../other/session.php');

$mysqlcon->query("SET @a:=0");

if(isset($_GET['serverusagechart'])) {
    switch ($_GET[ 'serverusagechart' ]) {
        case 'week':
            $server_usage =
                $mysqlcon->query("SELECT `u1`.`timestamp`,`u1`.`clients`,`u1`.`channel` FROM (SELECT @a:=@a+1,mod(@a,6) AS `row_count`,`timestamp`,`clients`,`channel` FROM `$dbname`.`server_usage`) AS `u2`, `$dbname`.`server_usage` AS `u1` WHERE `u1`.`timestamp`=`u2`.`timestamp` AND `u2`.`row_count`='1' ORDER BY `u2`.`timestamp` DESC LIMIT 168")
                         ->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'month':
            $server_usage =
                $mysqlcon->query("SELECT `u1`.`timestamp`,`u1`.`clients`,`u1`.`channel` FROM (SELECT @a:=@a+1,mod(@a,12) AS `row_count`,`timestamp`,`clients`,`channel` FROM `$dbname`.`server_usage`) AS `u2`, `$dbname`.`server_usage` AS `u1` WHERE `u1`.`timestamp`=`u2`.`timestamp` AND `u2`.`row_count`='1' ORDER BY `u2`.`timestamp` DESC LIMIT 720")
                         ->fetchAll(PDO::FETCH_ASSOC);
            break;
        case '3month':
            $server_usage =
                $mysqlcon->query("SELECT `u1`.`timestamp`,`u1`.`clients`,`u1`.`channel` FROM (SELECT @a:=@a+1,mod(@a,48) AS `row_count`,`timestamp`,`clients`,`channel` FROM `$dbname`.`server_usage`) AS `u2`, `$dbname`.`server_usage` AS `u1` WHERE `u1`.`timestamp`=`u2`.`timestamp` AND `u2`.`row_count`='1' ORDER BY `u2`.`timestamp` DESC LIMIT 548")
                         ->fetchAll(PDO::FETCH_ASSOC);
            break;
        default:
            $server_usage =
                $mysqlcon->query("SELECT `u1`.`timestamp`,`u1`.`clients`,`u1`.`channel` FROM (SELECT @a:=@a+1,mod(@a,3) AS `row_count`,`timestamp`,`clients`,`channel` FROM `$dbname`.`server_usage`) AS `u2`, `$dbname`.`server_usage` AS `u1` WHERE `u1`.`timestamp`=`u2`.`timestamp` AND `u2`.`row_count`='1' ORDER BY `u2`.`timestamp` DESC LIMIT 228")
                         ->fetchAll(PDO::FETCH_ASSOC);
    }
} else {
    switch ($_GET[ 'serverusagenewchart' ]) {
        case 'week':
            $server_usage =
                $mysqlcon->query("SELECT `u1`.`timestamp`,`u1`.`clients`,`u1`.`channel` FROM (SELECT @a:=@a+1,mod(@a,6) AS `row_count`,`timestamp`,`clients`,`channel` FROM `$dbname`.`server_usage_new`) AS `u2`, `$dbname`.`server_usage_new` AS `u1` WHERE `u1`.`timestamp`=`u2`.`timestamp` AND `u2`.`row_count`='1' ORDER BY `u2`.`timestamp` DESC LIMIT 336")
                         ->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'month':
            $server_usage =
                $mysqlcon->query("SELECT `u1`.`timestamp`,`u1`.`clients`,`u1`.`channel` FROM (SELECT @a:=@a+1,mod(@a,12) AS `row_count`,`timestamp`,`clients`,`channel` FROM `$dbname`.`server_usage_new`) AS `u2`, `$dbname`.`server_usage_new` AS `u1` WHERE `u1`.`timestamp`=`u2`.`timestamp` AND `u2`.`row_count`='1' ORDER BY `u2`.`timestamp` DESC LIMIT 720")
                         ->fetchAll(PDO::FETCH_ASSOC);
            break;
        case '3month':
            $server_usage =
                $mysqlcon->query("SELECT `u1`.`timestamp`,`u1`.`clients`,`u1`.`channel` FROM (SELECT @a:=@a+1,mod(@a,48) AS `row_count`,`timestamp`,`clients`,`channel` FROM `$dbname`.`server_usage_new`) AS `u2`, `$dbname`.`server_usage_new` AS `u1` WHERE `u1`.`timestamp`=`u2`.`timestamp` AND `u2`.`row_count`='1' ORDER BY `u2`.`timestamp` DESC LIMIT 548")
                         ->fetchAll(PDO::FETCH_ASSOC);
            break;
        default:
            $server_usage =
                $mysqlcon->query("SELECT `u1`.`timestamp`,`u1`.`clients`,`u1`.`channel` FROM (SELECT @a:=@a+1,mod(@a,3) AS `row_count`,`timestamp`,`clients`,`channel` FROM `$dbname`.`server_usage_new`) AS `u2`, `$dbname`.`server_usage_new` AS `u1` WHERE `u1`.`timestamp`=`u2`.`timestamp` AND `u2`.`row_count`='1' ORDER BY `u2`.`timestamp` DESC LIMIT 228")
                         ->fetchAll(PDO::FETCH_ASSOC);
    }
}

$chart_data = array();

foreach($server_usage as $chart_value) {
	$chart_data[] = array(
		"y" => date('Y-m-d H:i',$chart_value['timestamp']),
		"a" => $chart_value['clients'],
		"b" => $chart_value['channel']
	);
}

echo json_encode($chart_data);
?>