<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="icon" type="image/png" href="logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/addvertising.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
    <title>JobBoard</title>
</head>

<body>
    <?php
    require_once("component/nav.php");
    require_once("configs/database.php");
    $_SESSION['type'] = 'none';

    $id = $_GET['id'];
    $req = "SELECT * FROM advertising WHERE id = '$id'";
    if (isset($_SESSION['email']) && isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $req2 = "SELECT * FROM people WHERE email = '$email'";
        foreach ($db->query($req2) as $line) {
            $people = $line['id'];
            $nom = $line['last_name'];
            $prénom = $line['first_name'];
            $tel = $line['phone'];
            $cv = $line['CV'];
        }
    } else {
        $nom = "";
        $people = "";
        $prénom = "";
        $tel = "";
        $cv = "";
        $email = "";
    }
    foreach ($db->query($req) as $add) {
    ?>
        <div class="title_ad">
            <h1 style="color: #EEEFA8;"><?= $add['titre'] ?></h1>
        </div>
        <div class="add">
            <div class="row">
                <div class="fixed-content col-md-7 col-sm-12">
                    <div class="content">
                        <h1>Description</h5>
                            <p><?= $add['descript'] ?></p>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12" style="position: absolute; right: 0;">
                    <div class="content">
                        <h1>Information</h5>
                            <div class="infos">
                                <h4>Entreprise :</h4>
                                <p><?= $add['companie_name'] ?></p>
                            </div>
                            <div class="info">
                                <h4>Ville :</h4>
                                <p><?= $add['city'] ?></p>
                            </div>
                            <div class="info">
                                <h4>Type de contrat :</h4>
                                <p><?= $add['contrat'] ?></p>
                            </div>
                            <div class="info">
                                <h4>Salaire :</h4>
                                <p><?= $add['wages'] ?>€</p>
                            </div>
                    </div>
                    <div class="content">
                        <h1>Postuler</h1>
                        <form action="" method="POST" id="form_ad">
                            <input type="hidden" name="type" value="applyed">
                            <div class="in">
                                <label for="last_name">Nom</label>
                                <input type="text" name="last_name" id="last_name" required="required" placeholder="Nom" value="<?= $nom ?>">
                            </div>
                            <div class="in">
                                <label for="first_name">Prénom</label>
                                <input type="text" name="first_name" id="first_name" required="required" placeholder="Prénom" value="<?= $prénom ?>">
                            </div>
                            <div class="in">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" required="required" placeholder="Email" value="<?= $email ?>">
                            </div>
                            <div class="in">
                                <label for="phone">Téléphone</label>
                                <input type="tel" name="phone" id="phone" required="required" placeholder="Téléphone" value="<?= $tel ?>">
                            </div>
                            <div class="file">
                                <label for="cv">CV</label>
                                <input type="file" name="cv" id="cv" required="required" accept=".pdf" value="<?= $cv ?>">
                            </div>
                            <button type="submit">Postuler</button>
                        </form>
                        <div><?php
                                require_once('functions/applyed.php');
                                ?>
                        </div>
                    </div>
                </div>
            <?php
        }
            ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
</body>

</html>