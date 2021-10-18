<?php 
    require_once("../../configs/database.php");

    if (isset($_POST) && $_POST['type'] == "supp" ) {
        $id = $_POST['id'];
        
        $db->exec("DELETE FROM companies WHERE id = '$id'");
        $db->exec("DELETE FROM advertising WHERE companies_id = '$id'");
        unset($_POST);
    }
    if (isset($_POST) && $_POST['type'] == "add" ) {
        $email = $_POST['email'];
        $error = "email_not_find";
        foreach ($db->query("SELECT * FROM companies") as $row) {
            if ($row['email'] == $email) {
                $error = "email_find";
            }
            if ($row['name_e'] == $_POST['name_e']) {
                $error = "name_known";
            }
        }
        if ($error == "email_find" || $error == "name_known") {
            echo json_encode($error);
        }else {
            if ($_POST['mdp'] != $_POST['cmdp']) {
                $error = "mdp_diff";
                echo json_encode($error);
            } else {
                $name = $_POST['name_e'];
                $city = $_POST['city'];
                $siret = $_POST['siret'];
                $email = $_POST['email'];
                $passwordToHash = $_POST["mdp"] . $config["SECRET_KEY"];
                $mdp = md5($passwordToHash);
                $db->exec("INSERT INTO companies(name_e, city, siret, email, password) VALUE('$name', '$city', '$siret', '$email', '$mdp')");
                echo json_encode("succes");
            }
        }
        unset($_POST);
    }
    if (isset($_POST) && $_POST['type'] == "up" ) {
        $id = $_POST['id'];
        $i = 0;
        $max = 0;
        $tab = array();
        foreach ($_POST as $k => $v) {
            if (strlen(($_POST[$k])) != 0 && $i > 1) {
                $tab[$k] = $v;
                $max++;
            }
            $i++;
        }
        $y = 0;
        $str = null;
        foreach ($tab as $k => $v) {
            if ($y != ($max - 1)) {
                $str = $str . $k . "='" . $v . "',";
            } else {
                $str = $str . $k . "='" . $v . "'";
            }
            $y++;
        }
        $db->exec("UPDATE `companies` SET $str WHERE id = $id");
        unset($_POST);
    }
