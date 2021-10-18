<?php session_start();
if (isset($_SESSION['email']))
  header("Location: profile.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="Description" content="Enter your description here"/>
        <link rel="icon" type="image/png" href="logo.png" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="style/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com"> 
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
        <title>JobBoard</title>
    </head>
    <body>
      <h1 class="title">JobBoard</h1>
      <?php
        if (isset($_GET['connect'])) {
          if ($_GET['connect'] == '1')
            require_once("component/creation.php");
          else {
            require_once("component/connection.php");
          }
        } else {
          require_once("component/connection.php");
        }
        ?>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
    </body>

    <!-- remain text input after reloading -->
    <!--<script type="text/javascript" src="functions/remainer-text.js"></script>-->
</html>