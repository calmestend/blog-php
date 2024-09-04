<?php
namespace App\includes;
use PDO;

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "blogreto01";
$db_charset = "utf8mb4";
$db_attr = "mysql:host=$db_host;dbname=$db_name;charset=$db_charset";

$db = new PDO($db_attr, $db_user, $db_password);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
