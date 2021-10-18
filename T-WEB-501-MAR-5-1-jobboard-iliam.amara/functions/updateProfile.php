<?php
session_start();

require_once(dirname(__FILE__) . "/../configs/database.php");

$email = $_POST['email'];

if ($_SESSION['profession'] == 'particulier') {
    var_dump($_POST);
    $max = 0;
    $tab = array();
    foreach ($_POST as $k => $v) {
        if (strlen(($_POST[$k])) != 0) {
            $tab[$k] = $v;
            $max++;
        }
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
    $db->exec("UPDATE `people` SET $str WHERE email = '$email'");
    $message = "Les données ont été mis à jour.";
    header("Location: ../profile.php?message=$message&type=success");
}
if ($_SESSION['profession'] == 'entreprise') {
    $max = 0;
    $tab = array();
    foreach ($_POST as $k => $v) {
        if (strlen(($_POST[$k])) != 0) {
            $tab[$k] = $v;
            $max++;
        }
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
    $db->exec("UPDATE `companies` SET $str WHERE email = '$email'");
    $message = "Les données ont été mis à jour.";
    header("Location: ../profile.php?message=$message&type=success");
}
?>