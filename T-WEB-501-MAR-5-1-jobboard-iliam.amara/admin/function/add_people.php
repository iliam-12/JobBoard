<?php 
    require_once("../../configs/database.php");
    if (isset($_POST) && $_POST['create'] == 1) {
        $email = $_POST['email'];
        foreach($db->query("SELECT * FROM people") as $row) {
            if($row['email'] == $email) {
                $error = "email_find";
                break;
            } else {
                $error = "email_not_find";
            }
        }
        if ($error == "email_find") {
            $response = array(
                "error" => "compte deja cree",
            );
        } else {
            if ($_POST['mdp'] != $_POST['cmdp']) {
                $response = array(
                    "error" => "mdp_diff",
                );
                echo json_encode($response);
                return;
            }
            $passwordToHash = $_POST["mdp"] . $config["SECRET_KEY"];
            $pass = md5($passwordToHash);
            $db->exec("INSERT INTO `people`(`email`, `password`) VALUES ('$email', '$pass')");
            $response = array(
                "error" => "succes",
            );
        }
    }
    echo json_encode($response);
?>