<div class="inde_advert_e">
  <div class="title_ad centre-bloc">
    <h2>Poster une annonce</h2>
  </div>
  <?php if (isset($_GET["message"])) : ?>
    <?php
    if (isset($_GET["type"]) && $_GET["type"] === "success") {
      $classMessage = "alert alert-success fade show text-center";
    } else
      $classMessage = "alert alert-danger fade show text-center";
    ?>
    <div class="<?= $classMessage ?>" role="alert">
      <?= $_GET["message"]; ?>
    </div>
  <?php endif ?>
  <form action="functions/addPost.php" method="POST">
    <div class="row">
      <div class="col-8">
        <label for="intitule_post">Intitulé du poste à promouvoir: </label>
        <input class="form-control" name="titre" type="text" for="intitule_post" required="required">
      </div>
      <div class="col-4">
        <label for="city">Ville: </label>
        <input class="form-control" name="city" type="text" for="city" required="required">
      </div>
      <div class="col-6">
        <label for="salaire">Salaire: </label>
        <input class="form-control" name="wages" type="number" required="required">
      </div>
      <div class="col-6">
        <label for="type-contrat">Type de contrat: </label>
        <select style="-webkit-appearance: menulist;" class="form-control" name="contrat" required>
          <option value="" disabled selected></option>
          <option value="CDI">CDI</option>
          <option value="CDD">CDD</option>
          <option value="CTT">CTT</option>
          <option value="alternance">Alternance</option>
          <option value="stage">Stage</option>
        </select>
      </div>
      <div class="col-12">
        <label for="descript">Description: </label>
        <textarea name="descript" rows="7" class="form-control" aria-label="With textarea" required="required"></textarea>
      </div>
      <div class="boutton poster">
        <button type="submit" class="form-control" name="poster">Poster</button>
      </div>
    </div>
  </form>
</div>
<script>
  tinymce.init({
    selector: '#mytextarea'
  });
</script>
<div style="margin: 10vh; text-align: center;">
  <h1 style="color: #EEEFA8; padding-top: 5vh; padding-bottom: 8vh;">Mes annonces</h1>
  <div style="width:50%; height:auto; margin: auto;">
    <?php if (isset($_GET["message3"])) : ?>
      <?php
      if (isset($_GET["type"]) && $_GET["type"] === "success") {
        $classMessage3 = "alert alert-success fade show text-center";
      } else
        $classMessage3 = "alert alert-danger fade show text-center";
      ?>
      <div class="<?= $classMessage3 ?>" role="alert">
        <?= $_GET["message3"]; ?>
      </div>
    <?php endif ?>
  </div>
</div>
<div class="all_annonce_e">
  <?php
  require_once("functions/check_db.php");

  $email = $_SESSION['email'];
  $name_e = '';
  $id = 0;
  foreach ($db->query("SELECT * FROM Companies WHERE email = '$email'") as $line) {
    if ($line['name_e']) {
      $name_e = $line['name_e'];
      $i = 0;
      foreach ($db->query("SELECT * FROM Advertising WHERE companie_name = '$name_e' ORDER BY titre ASC") as $row) { ?>
        <div class="container container2" id="inde_advert_<?php echo $row['id'] ?>">
          <div class="box">
            <div class="card" data-tilt data-tilt-scale="1">
              <div class="content">
                <button type="button" style="float: right; margin-top: -20px; margin-right: -20px;" class="btn-close page-link" aria-label="Close" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $row['id'] ?>"></button>
                <button type="button" class="btn page-link" style=" margin-top: -23px; color: #222; float: right;" data-bs-toggle="modal" data-bs-target="#exampleModal2-<?= $row['id'] ?>" class="btn btn-primary"><i class="bi-pencil-square"></i></button>
                <?php
                if ($row['contrat'] == 'alternance') { ?>
                  <h2 class="noselect" style="font-size: 3.5em; margin-top: 30px; z-index: -4"><?= $row['contrat'] ?></h2>
                <?php } else { ?>
                  <h2 class="noselect" style="z-index: -4"><?= $row['contrat'] ?></h2>
                <?php } ?>
                <h3><?= $row['titre'] ?></h3>
                <h3><?= check_ese_id($row['companies_id'], $db->query("SELECT id, name_e FROM Companies")); ?> - <?= $row['city'] ?></h3>
                <h5 style="font-style: italic;"><?= $row['wages'] ?>€/mois</h5>
                <div id="desc_<?php echo $id ?>">
                  <p><?= $row['descript'] ?></p>
                </div>
              </div>
              <a class="more"></a>
            </div>
          </div>
        </div>
        <div class="modal fade" id="exampleModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="text-align: center;">Voulez-vous vraiment supprimer cette annonce ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="delPost(<?php echo $row['id'] ?>)">Supprimer</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="exampleModal2-<?= $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="text-align: center;">Voulez-vous vraiment supprimer cette annonce ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-footer">
                <form action="functions/updatePost.php" method="POST">
                  <div class="row">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>" required="required">
                    <div class="col-8">
                      <label for="intitule_post">Intitulé du poste à promouvoir: </label>
                      <input class="form-control" name="titre" value="<?= $row['titre'] ?>" type="text" for="intitule_post">
                    </div>
                    <div class="col-4">
                      <label for="city">Ville: </label>
                      <input class="form-control" name="city" value="<?= $row['city'] ?>" type="text" for="city" required="required">
                    </div>
                    <div class="col-6">
                      <label for="salaire">Salaire: </label>
                      <input class="form-control" name="wages" value="<?= $row['wages'] ?>" type="number" required="required">
                    </div>
                    <div class="col-6">
                      <label for="type-contrat">Type de contrat: </label>
                      <select style="-webkit-appearance: menulist;" class="form-control" name="contrat">
                        <option value="<?= $row['contrat'] ?>"><?= $row['contrat'] ?></option>
                        <option value="CDI">CDI</option>
                        <option value="CDD">CDD</option>
                        <option value="CTT">CTT</option>
                        <option value="alternance">Alternance</option>
                        <option value="stage">Stage</option>
                      </select>
                    </div>
                    <div class="col-12">
                      <label for="descript">Description: </label>
                      <textarea name="descript" rows="7" class="form-control" aria-label="With textarea" required="required"><?= $row['descript'] ?></textarea>
                    </div>
                    <div class="boutton poster">
                      <button type="submit" data-dismiss="modal" class="form-control" name="modifier">Modifier</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      <?php $i++;
      }
      if ($i == 0) { ?>
        <div style="margin-top: 20vh; margin-bottom: 20vh;">
          <i>
            <h2>Vous avez posté aucune annonce</h2>
          </i>
        </div>
      <?php } ?>
</div>
<?php }
  } ?>
</div>