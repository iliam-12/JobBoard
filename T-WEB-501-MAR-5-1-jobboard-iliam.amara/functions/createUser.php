<?php
require_once(dirname(__FILE__) . "/../configs/database.php");

if ($_POST["password"] !== $_POST["confirm_password"])
    header("Location: ../register.php?connect=1&message=Error confirm password");
else {
    $req = $db->prepare("SELECT * FROM People WHERE email = :email");
    $req->bindParam(":email", $_POST["email"]);
    $req->execute();

    $result = $req->fetch(PDO::FETCH_ASSOC);

    $req2 = $db->prepare("SELECT * FROM Companies WHERE email = :email");
    $req2->bindParam(":email", $_POST["email"]);
    $req2->execute();

    $result2 = $req2->fetch(PDO::FETCH_ASSOC);

    if ($result || $result2) {
        if (empty($result['password']) && $_POST['status'] == 'particulier') {
            $passwordToHash = $_POST["password"] . $config["SECRET_KEY"];
            $hash = md5($passwordToHash);
            $email = $_POST['email'];
            if ($_POST["status"] == "particulier") {
                $db->exec("UPDATE People SET email='$email', password='$hash' WHERE email='$email'");
            }
            $message = "Compte créé";
            header("Location: ../register.php?message=$message&type=success");
            return;
        }
        if (empty($result2['password']) && $_POST['status'] == 'entreprise') {
            $passwordToHash = $_POST["password"] . $config["SECRET_KEY"];
            $hash = md5($passwordToHash);
            if ($_POST["status"] == "entreprise") {
                $db->exec("UPDATE companies SET email='$email', password='$hash' WHERE email='$email'");
            }
            $message = "Compte créé";
            header("Location: ../register.php?message=$message&type=success");
            return;
        } else {
            $message = "Compte existe déjà";
            header("Location: ../register.php?message=$message");
            return;
        }
    } else {
        $passwordToHash = $_POST["password"] . $config["SECRET_KEY"];
        $hash = md5($passwordToHash);
        if ($_POST["status"] == "particulier") {
            $req = $db->prepare("INSERT INTO People(email, password) VALUE(:email, :password)");
        } else {
            $req = $db->prepare("INSERT INTO companies(email, password) VALUE(:email, :password)");
        }
        $req->bindParam(":email", $_POST["email"]);
        $req->bindParam(":password", $hash);
        $req->execute();
        $message = "Compte créé";
        header("Location: ../register.php?message=$message&type=success");
    }
}
?>