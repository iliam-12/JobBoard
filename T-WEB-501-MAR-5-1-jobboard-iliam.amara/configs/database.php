<?php
require_once("config.php");
try {
    $db = new PDO("mysql:host={$config["DB_HOST"]};dbname={$config["DB_NAME"]}", $config["DB_USER"], $config["DB_PASSWORD"]);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
$db->query("SET NAMES UTF8");
?>