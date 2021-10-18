<?php
session_start();
session_destroy();
// MDP : Vm=,Vo0~

require_once("../configs/config.php");
require_once("../configs/database.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="icon" type="image/png" href="../logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
    <title>JobBoard - Admin</title>
</head>

<body>
    <div class="contain">
        <div class="title">
            <h1>JobBoard - Admin Page</h1>
        </div>
        <?php

if (isset($_POST) && (!empty($_POST))) {
    $passwordToHash = $_POST["password"] . $config["SECRET_KEY"];
    $hash = md5($passwordToHash);
    $req = $db->prepare("SELECT * FROM admin_job WHERE email = :email AND password = :password");
    $req->bindParam(":email", $_POST["email"]);
    $req->bindParam(":password", $hash);
    $req->execute();
    $res = $req->fetch(PDO::FETCH_ASSOC);

    if (!$res) {
?>
        <div class="alert_tag">
            <div id="alert" style="width: fit-content; justify-content: center; margin: 20px auto;" class="alert alert-danger fade show text-center" role="alert">
                Email ou mot de passe incorrect
            </div>
        </div>
<?php
    } else {
        session_start();
        session_reset();
        $_SESSION['acces'] = "OK";
        header("Location: people.php");
    }
}
?>
        <div class="form">
            <form action="" method="POST">
                <div class="input">
                    <div class="top">
                        <label for="email">Email</label>
                    </div>
                    <div class="bottom">
                        <input type="text" name="email" required="required">
                    </div>
                </div>
                <div class="input">
                    <div class="top">
                        <label for="password">Mot de passe</label>
                    </div>
                    <div class="bottom">
                        <input type="password" name="password" required="required">
                    </div>
                </div>
                <div class="btn">
                    <button type="submit">Connexion</button>
                </div>
            </form>
        </div>
    </div>
</body>