<?php
require_once("../configs/database.php");

if (!empty($_POST['titre']) && !empty($_POST['city']) && !empty($_POST['wages']) && !empty($_POST['contrat']) && !empty($_POST['descript'])) {
    $id = $_POST['id'];
    $req = $db->prepare("UPDATE Advertising SET titre = :titre, city = :city, wages = :wages, contrat = :contrat, descript = :descript WHERE id = '$id'");
    $req->bindParam(":titre", $_POST["titre"]);
    $req->bindParam(":city", $_POST["city"]);
    $req->bindParam(":wages", $_POST["wages"]);
    $req->bindParam(":contrat", $_POST["contrat"]);
    $req->bindParam(":descript", $_POST["descript"]);
    $req->execute();
    $message3 = "Modification effectuée";
    header("Location: ../accueil.php?message3=$message3&type=success");
} else {
    $message3 = "Tous les champs doivent être remplis";
    header("Location: ../accueil.php?message3=$message3&type=error");
}
?>