<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/profile.css">
    <title>Profile</title>
</head>

<body>
    <?php
    if (isset($_SESSION['email'])) {
        require_once("component/nav.php");
        require_once("configs/database.php");
        $email = $_SESSION['email'];
        $req = "SELECT * FROM people WHERE email = '$email'";
        $req2 = "SELECT * FROM companies WHERE email = '$email'";
        foreach ($db->query($req) as $add) {
    ?>
            <div class="profile">
                <h1>Profile</h1>
            </div>
            <div class="div-profile">
                <form action="functions/updateProfile.php" method="POST" class="find_form find">
                    <?php
                    if (isset($_GET["message"])) : ?>
                        <?php
                        if (isset($_GET["type"]) && $_GET["type"] === "success") {
                            $classMessage_p = "alert alert-success fade show text-center";
                        } else
                            $classMessage_p = "alert alert-danger fade show text-center";
                        ?>
                        <div class="<?= $classMessage_p ?>" role="alert">
                            <?= $_GET["message"]; ?>
                        </div>
                    <?php endif ?>
                    <div class="first_name">
                        <label for="first_name">First name: </label>
                        <input name="first_name" type="text" for="first_name" value="<?= $add['first_name'] ?>">
                    </div>
                    <div class="last_name">
                        <label for="last_name">Last name: </label>
                        <input name="last_name" type="text" for="last_name" value="<?= $add['last_name'] ?>">
                    </div>
                    <div class="email" style="opacity: 0.5;">
                        <label for="email">Email: </label>
                        <input name="email" type="email" for="email" readonly="readonly" value="<?= $add['email'] ?>">
                    </div>
                    <div class="phone">
                        <label for="phone">Phone: </label>
                        <input name="phone" type="text" for="phone" value="<?= $add['phone'] ?>">
                    </div>
                    <div class="postal_code">
                        <label for="postal_code">Postal code: </label>
                        <input name="postal_code" type="text" for="postal_code" value="<?= $add['postal_code'] ?>">
                    </div>
                    <div class="city">
                        <label for="city">City: </label>
                        <input name="city" type="text" for="city" value="<?= $add['city'] ?>">
                    </div>
                    <div class="addr">
                        <label for="addr">Address: </label>
                        <input name="addr" type="text" for="addr" value="<?= $add['addr'] ?>">
                    </div>
                    <div class="birthdate">
                        <label for="birthdate">Birthdate: </label>
                        <input name="birthdate" type="date" for="birthdate" value="<?= $add['birthdate'] ?>">
                    </div>
                    <div class="CV">
                        <label for="CV">CV: </label>
                        <input name="CV" type="file" for="CV" value="<?= $add['CV'] ?>">
                    </div>
                    <div class="sex">
                        <label for="sex">Sex: </label>
                        <select name="sex" id="sex">
                            <option value="Homme" <?php if ($add['sex'] == 'Homme') {
                                                        echo 'selected="selected"';
                                                    } ?>>Homme</option>
                            <option value="Femme" <?php if ($add['sex'] == 'Femme') {
                                                        echo 'selected="selected"';
                                                    } ?>>Femme</option>
                            <option value="Autre" <?php if ($add['sex'] == 'Autre') {
                                                        echo 'selected="selected"';
                                                    } ?>>Autre</option>
                        </select>
                    </div>
                    <div class="picture">
                        <label for="picture">Picture: </label>
                        <input name="picture" type="file" for="picture" value="<?= $add['picture'] ?>">
                    </div>
                    <button name="submit" type="submit submit_profile" style="margin-top: 5vh; margin-bottom: 7vh; border-radius: 1vh; padding-left:5vh; padding-right:5vh;">Enregistrer</button>
                </form>
            </div>
        <?php }
        foreach ($db->query($req2) as $add2) { ?>
            <div class="profile">
                <h1>Profile</h1>
            </div>
            <div class="div-profile">
                <form action="functions/updateProfile.php" name="jobboard" method="POST" class="find_form find">
                <?php
                    if (isset($_GET["message"])) : ?>
                        <?php
                        if (isset($_GET["type"]) && $_GET["type"] === "success") {
                            $classMessage_p = "alert alert-success fade show text-center";
                        } else
                            $classMessage_p = "alert alert-danger fade show text-center";
                        ?>
                        <div class="<?= $classMessage_p ?>" role="alert">
                            <?= $_GET["message"]; ?>
                        </div>
                    <?php endif ?>
                    <div class="name_e">
                        <label for="name_e">Name: </label>
                        <input name="name_e" type="text" for="name_e" value="<?= $add2['name_e'] ?>">
                    </div>
                    <div class="email" style="opacity: 0.5;">
                        <label for="email">Email: </label>
                        <input name="email" type="email" readonly="readonly" for="email" value="<?= $add2['email'] ?>">
                    </div>
                    <div class="phone">
                        <label for="phone">Phone: </label>
                        <input name="phone" type="text" for="phone" value="<?= $add2['phone'] ?>">
                    </div>
                    <div class="website">
                        <label for="website">Website: </label>
                        <input name="website" type="text" for="website" value="<?= $add2['website'] ?>">
                    </div>
                    <div class="addr">
                        <label for="addr">Address: </label>
                        <input name="addr" type="text" for="addr" value="<?= $add2['addr'] ?>">
                    </div>
                    <div class="postal_code">
                        <label for="postal_code">Postal code: </label>
                        <input name="postal_code" type="text" for="postal_code" value="<?= $add2['postal_code'] ?>">
                    </div>
                    <div class="city">
                        <label for="city">City: </label>
                        <input name="city" type="text" for="city" value="<?= $add2['city'] ?>">
                    </div>
                    <div class="siret">
                        <label for="siret">Siret: </label>
                        <input name="siret" type="text" for="siret" value="<?= $add2['siret'] ?>">
                    </div>
                    <button type="submit submit_profile" style="margin-top: 5vh; margin-bottom: 7vh; border-radius: 1vh; padding-left:5vh; padding-right:5vh;">Enregistrer</button>
                </form>
            </div>
    <?php }
    } else {
        header("Location: register.php");
    }
    ?>
</body>

</html>