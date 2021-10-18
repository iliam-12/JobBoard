<?php
    require_once("../../configs/database.php");

    if ($_POST['action'] == 'supp') {
        $id = $_POST['id'];
    
        $db->exec("DELETE FROM people WHERE id = '$id'");
    }
?>