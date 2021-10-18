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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/update.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
    <title>JobBoard - Personnes</title>
</head>

<body>
    <?php session_start();
    if ($_SESSION["acces"] != 'OK') {
        header("Location: index.php");
    }
    require_once('component/nav.php');
    require_once('../configs/database.php');
    $id = $_GET['id'];

    if (isset($_POST['up']) && $_POST['up'] == 1) {
        $i = 0;
        $max = 0;
        $tab = array();
        foreach ($_POST as $k => $v) {
            if (isset($_POST[$k]) && strlen(($_POST[$k])) != 0 && $i != 0) {
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
        $db->exec("UPDATE `people` SET $str WHERE id = $id");
    ?>
        <div class="alert alert-success" role="alert">
            Vous avez modifier les informations de cet utilisateur
        </div>
    <?php
        unset($_POST);
    }

    foreach ($db->query("SELECT * FROM people WHERE id = $id") as $row) {
    ?>
        <h1 style="margin-top: 5vh; text-align:center">Informations</h1>
        <form action="" method="POST">
            <input type="hidden" name="up" value="1">
            <div class="form">
                <div class="content">
                    <label for="first_name">Prénom</label>
                    <input type="text" name="first_name" id="first_name" value="<?= $row['first_name'] ?>">
                </div>
                <div class="content">
                    <label for="last_name">Nom</label>
                    <input type="text" name="last_name" id="last_name" value="<?= $row['last_name'] ?>">
                </div>
                <div class="content">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?= $row['email'] ?>">
                </div>
                <div class="content">
                    <label for="phone">Téléphone</label>
                    <input type="tel" name="phone" id="phone" value="<?= $row['phone'] ?>">
                </div>
                <div class="content">
                    <label for="addr">Addresse</label>
                    <input type="text" name="addr" id="addr" value="<?= $row['addr'] ?>">
                </div>
                <div class="content">
                    <label for="city">Ville</label>
                    <input type="text" name="city" id="city" value="<?= $row['city'] ?>">
                </div>
                <div class="content">
                    <label for="postal_code">Code Postal</label>
                    <input type="text" name="postal_code" id="postal_code" value="<?= $row['postal_code'] ?>">
                </div>
                <div class="content">
                    <label for="birthdate">Date de naissance</label>
                    <input type="date" name="birthdate" id="birthdate" value="<?= $row['birthdate'] ?>">
                </div>
                <div class="content">
                    <label for="CV">CV</label>
                    <input type="file" name="CV" id="CV" value="<?= $row['CV'] ?>">
                </div>
                <div class="content">
                    <label for="sex">Sexe</label>
                    <select name="sex" id="sex">
                        <option value="Homme">Homme</option>
                        <option value="Femme">Femme</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>
                <div class="content">
                    <label for="picture">Photo de profil</label>
                    <input type="file" name="picture" id="picture" value="<?= $row['picture'] ?>">
                </div>
                <button style="background-color: grey;" type="submit">Enregister</button>
            </div>
        </form>
    <?php

    }
    ?>
</body>

</html>