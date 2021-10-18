<?php session_start();
require_once("functions/pagination.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="Description" content="Enter your description here" />
  <link rel="icon" type="image/png" href="logo.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="style/nav.css">
  <link rel="stylesheet" href="style/accueil.css">
  <link rel="stylesheet" href="style/accueil_e.css">
  <link rel="stylesheet" href="style/card.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script src="functions/learn_more.js"></script>
  <script src="functions/delPost.js"></script>
  <title>JobBoard</title>
</head>

<body>
  <?php
  require_once("component/nav.php");
  require_once("configs/database.php");
  if (empty($_SESSION['profession']) || $_SESSION['profession'] == 'particulier') {
  ?>
    <div class="find">
      <form action="accueil.php" method="GET" class="find_form searchBar">
        <div class="find-div">
          <input type="text" name="find" id="find" placeholder="Que cherchez-vous ?">
          <button type="submit">Rechercher</button>
        </div>
      </form>
    </div>
    <div class="advert">
      <?php
      require_once("functions/check_db.php");

      $id = 0;
      $recherche = NULL;
      if (isset($_GET['find']) && strlen($_GET['find']) > 0) {
        $recherche = $_GET['find'];
        $ad = "SELECT * FROM Advertising WHERE titre LIKE '%$recherche%' OR companie_name LIKE '$recherche%' OR city LIKE '$recherche%' OR contrat LIKE '$recherche' ORDER BY titre ASC LIMIT $premier, $parPage";
      } else
        $ad = "SELECT * FROM Advertising ORDER BY titre ASC LIMIT $premier, $parPage";
      foreach ($db->query($ad) as $row) {
        if ($row['published'] == 1) {
          $id = intval($row['id'], 10);
      ?>
          <div class="container" id="inde_advert_<?php echo $id ?>">
            <div class="box">
            <div class="card" data-tilt data-tilt-scale="1">
              <div class="content">
                <?php
                if ($row['contrat'] == 'alternance'){ ?>
                  <h2 style="font-size: 3.5em; margin-top: 15px;"><?= $row['contrat'] ?></h2>
                  <?php } else { ?>
                  <h2><?= $row['contrat'] ?></h2>
                  <?php } ?>
                <h3><?= $row['titre'] ?></h3>
                <h3><?= check_ese_id($row['companies_id'], $db->query("SELECT id, name_e FROM Companies")); ?> - <?= $row['city'] ?></h3>
                <h5 style="font-style: italic;"><?= $row['wages'] ?>€/mois</h5>
                <div id="desc_<?php echo $id ?>">
                  <p><?= $row['descript'] ?></p>
                </div>
              </div>
              
              <a class="more"></a>
              <button type="submit" class="applied button-postuler" id="applied_<?php echo $id ?>" onclick="applied(<?php echo json_encode($id) ?>)">Postuler</button>
            </div>
          </div>
        </div>

      <?php
        }
      }
      ?>
    </div>
    <div style="text-align: center; margin-top: 4vh; margin-bottom: 8vh;">
      <nav style="display: inline-block;">
        <ul class="pagination">
          <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
            <a style="<?= ($currentPage == 1) ? "" : "color: #525252;" ?>background-color: #dbdbdb;" href="accueil.php?page=<?= $currentPage - 1 ?>" class="page-link">Précédent</a>
          </li>
          <?php for ($page = 1; $page <= $pages; $page++) : ?>
            <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
              <a style="background-color: #B8B8B8; color: #fff;<?= ($currentPage == $page) ? "border-color: #3f3f3f !important; color: #3f3f3f;" : ""?>" href="accueil.php?page=<?= $page ?>" class="page-link"><?= $page ?></a>
            </li>
          <?php endfor ?>
          <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
            <a style="<?= ($currentPage == $pages) ? "" : "color: #525252;" ?>background-color: #dbdbdb;" href="accueil.php?page=<?= $currentPage + 1 ?>" class="page-link">Suivant</a>
          </li>
        </ul>
        </ul>
      </nav>
    </div>
  <?php } else
    require_once("accueil_e.php");
  ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
  <script src="functions/vanilla-tilt.min.js"></script>
  <script>
    let more = document.querySelectorAll('.more');
    for (let i = 0; i < more.length; i++) {
      more[i].addEventListener('click', function() {
        more[i].parentNode.classList.toggle('active')
      })
    }
  </script>
</body>

</html>