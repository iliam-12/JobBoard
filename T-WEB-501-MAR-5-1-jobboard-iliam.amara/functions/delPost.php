<?php
    require_once("../configs/database.php");

    $id = $_POST['id'];

    $db->exec("DELETE FROM Advertising WHERE id = '$id'");
?>