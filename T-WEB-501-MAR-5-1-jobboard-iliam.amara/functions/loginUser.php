<?php 
session_start();
require_once(dirname(__FILE__). "/../configs/database.php");

if ($_SESSION['email']) {
    header("Location: ../accueil.php");
} else {
    $passwordToHash = $_POST["password"] . $config["SECRET_KEY"];
    $hash = md5($passwordToHash);
    $req = $db->prepare("SELECT * FROM People WHERE email = :email AND password = :password");
    $req->bindParam(":email", $_POST["email"]);
    $req->bindParam(":password", $hash);
    $req->execute();
    
    $result = $req->fetch(PDO::FETCH_ASSOC);
    
    $req2 = $db->prepare("SELECT * FROM Companies WHERE email = :email AND password = :password");
    $req2->bindParam(":email", $_POST["email"]);
    $req2->bindParam(":password", $hash);
    $req2->execute();
    
    $result2 = $req2->fetch(PDO::FETCH_ASSOC);
    
    if (!$result && !$result2)
        header("Location: ../register.php?message=Identifiants incorrects");
    else {
        if ($result)
            $_SESSION['profession'] = "particulier";
        else
            $_SESSION['profession'] = "entreprise";
        $_SESSION['email'] = $_POST['email'];
        header("Location: ../profile.php");
    }
}
?>