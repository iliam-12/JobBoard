<?php
require_once("../../configs/database.php");

if (isset($_POST) && $_POST['type'] == "supp") {
    $id = $_POST['id'];

    echo json_encode($id);
    $db->exec("DELETE FROM advertising WHERE id = '$id'");
    unset($_POST);
}
if (isset($_POST) && $_POST['type'] == "add") {
    $titre = $_POST['titre'];
    $descript = $_POST['descript'];
    $contrat = $_POST['contrat'];
    $city = $_POST['city'];
    $wages = $_POST['wages'];
    $id = $_POST['id_ese'];
    if (ctype_digit($wages) == false) {
        echo json_encode("wages_wrong");
        return;
    }
    foreach ($db->query("SELECT * FROM companies WHERE id = '$id'") as $row) {
        $name_e = $row['name_e'];
    }
    $db->exec("INSERT INTO advertising(titre, descript, city, wages, companies_id, companie_name, published, contrat) VALUE('$titre', '$descript', '$city', '$wages', '$id', '$name_e', '1','$contrat')");
    echo json_encode("succes");
    unset($_POST);
}
if (isset($_POST) && $_POST['type'] == "up") {
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
    var_dump($tab);
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
    $db->exec("UPDATE `advertising` SET $str WHERE id = $id");
    unset($_POST);
}
?>