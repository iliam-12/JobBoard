<?php
session_start();
require_once('../configs/database.php');

$email = $_SESSION['email'];
$r = "SELECT * FROM Companies WHERE email = '$email'";
foreach ($db->query($r) as $line) {
    if (!$line['name_e']) {
        $message = "Vous devez renseigner le nom de l'entreprise dans Profil";
        header("Location: ../accueil.php?message=$message&type=error");
    }
    else if ($_SESSION['email'] && $_POST["titre"] && $_POST["city"] && $_POST["wages"] && $_POST["contrat"] && $_POST["descript"]) {
        $req = $db->prepare("INSERT INTO Advertising(`titre`, `descript`, `wages`, `companie_name`, `city`, `date_e`, `published`, `companies_id`, `contrat`) VALUE(:titre, :descript, :wages, :companie_name, :city, :date_e, :published, :companies_id, :contrat)");
        $date = date("Y-m-j");
        $published = 1;
        $req->bindParam(":titre", $_POST["titre"]);
        $req->bindParam(":descript", $_POST["descript"]);
        $req->bindParam(":wages", $_POST["wages"]);
        $req->bindParam(":companie_name", $line['name_e']);
        $req->bindParam(":city", $_POST["city"]);
        $req->bindParam(":date_e", $date);
        $req->bindParam(":published", $published);
        $req->bindParam(":companies_id", $line['id']);
        $req->bindParam(":contrat", $_POST["contrat"]);
        $req->execute();
        $message = "Annonce postée avec succès";
        header("Location: ../accueil.php?message=$message&type=success");
    } else {
        $message = "Une erreur s'est produite";
        header("Location: ../accueil.php?message=$message&type=error");
    }
}
?>