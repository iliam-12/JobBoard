<?php

    require_once('configs/database.php');
    $error = "none";

    if (isset($_POST) && !empty($_POST)) {
        $email = $_POST['email'];
        $id_add = $_GET['id'];
        foreach ($db->query("SELECT * FROM advertising WHERE id = '$id_add'") as $row) {
            $id_ese = $row['companies_id'];
        }
        if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
            $error = "email_not_find";
            foreach ($db->query("SELECT * FROM people") as $row) {
                if ($email == $row['email']) {
                    $error = "email_find";
                    $people_id = $row['id'];
                }
            }
            if ($error == "email_not_find") {
                $req_people = $db->prepare("INSERT INTO People(email, first_name, last_name, phone, CV) VALUE(:email, :first_name, :last_name, :phone, :CV)");
                $req_people->bindParam(":email", $_POST["email"]);
                $req_people->bindParam(":first_name", $_POST["first_name"]);
                $req_people->bindParam(":last_name", $_POST["last_name"]);
                $req_people->bindParam(":phone", $_POST["phone"]);
                $req_people->bindParam(":CV", $_POST["cv"]);
                $req_people->execute();
                foreach ($db->query("SELECT * FROM people WHERE email = '$email'") as $row) {
                    $people_id = $row['id'];
                }
            } else {
                foreach ($db->query("SELECT * FROM people WHERE email = '$email'") as $row) {
                    if ($row['password'] != NULL) {
                        ?>  
                        <div class="alert alert-danger" role="alert" style="margin-top: 5vh;">
                            Email déja enregistré. Veuillez vous connecter <a href="register.php">ici</a>.
                        </div>
                        <?php
                    }else {
                        $people_id = $row['id'];
                        $req_people = $db->prepare("UPDATE People SET first_name = :first_name, last_name = :last_name, phone = :phone, CV = :CV WHERE email = '$email'");
                        $req_people->bindParam(":first_name", $_POST["first_name"]);
                        $req_people->bindParam(":last_name", $_POST["last_name"]);
                        $req_people->bindParam(":phone", $_POST["phone"]);
                        $req_people->bindParam(":CV", $_POST["cv"]);
                        $req_people->execute();
                    }
                }
            }
            $db->exec("INSERT INTO `applied`(`companies_id`, `people_id`, `add_id`) VALUES ($id_ese, $people_id, $id_add)");
            ?>  
                <div class="alert alert-success" role="alert" style="margin-top: 5vh;">
                    Votre candiature a été envoyé avec succès. L'entreprise vous contactera par mail si votre profil l'interesse.
                </div>
            <?php
        } else {
            $email = $_SESSION['email'];
            foreach ($db->query("SELECT * FROM people WHERE email = '$email'") as $row) {
                $people_id = $row['id'];
            }
            $db->exec("INSERT INTO `applied`(`companies_id`, `people_id`, `add_id`) VALUES ($id_ese, $people_id, $id_add)");
            ?>  
                <div class="alert alert-success" role="alert" style="margin-top: 5vh;">
                    Votre candiature a été envoyé avec succès. L'entreprise vous contactera par mail si votre profil l'interesse.
                </div>
            <?php
        }
    }
    unset($_POST);
?>