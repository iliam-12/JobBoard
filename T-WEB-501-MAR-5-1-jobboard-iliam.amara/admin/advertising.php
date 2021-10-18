<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="icon" type="image/png" href="../logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/accueil.css">
    <link rel="stylesheet" href="style/nav.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
    <title>JobBorad - Entreprise</title>
</head>

<body>
    <?php
    require_once("component/nav.php");
    require_once("../configs/database.php");
    $id = 0;
    $id_ese = $_GET['id'];
    ?>
    <table>
        <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Ville</th>
            <th>Contrat</th>
            <th>Nombre de candidat</th>
            <th>Actions</th>
        </tr>
        <?php
        foreach ($db->query("SELECT * FROM advertising WHERE companies_id = $id_ese") as $row) {
            $id = $row["id"];
        ?>

            <tr>
                <td><?php if (!$row['titre']) {
                        echo "(Vide)";
                    } else {
                        echo $row['titre'];
                    } ?></td>
                <td class="descript">
                    <p><?php if (!$row['descript']) {
                            echo "(Vide)";
                        } else {
                            echo $row['descript'];
                        } ?></p>
                </td>
                <td><?php if (!$row['city']) {
                        echo "(Vide)";
                    } else {
                        echo $row['city'];
                    } ?></td>
                <td><?php if (!$row['contrat']) {
                        echo "(Vide)";
                    } else {
                        echo $row['contrat'];
                    } ?></td>
                <td><?php
                    $i = 0;
                    foreach ($db->query("SELECT * FROM applied WHERE add_id = '$id'") as $row1) {
                        $i++;
                    }
                    echo $i;
                    ?></td>
                <td>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="supp_add(<?= $id ?>, 0)">Supprimer</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2<?php echo $id ?>" onclick="up_add(<?= $id ?>, 0)">Modifier</button>
                </td>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Supprimer</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Êtes-vous sur de vouloir supprimer cette entreprise ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="button" class="btn btn-danger" onclick="supp_add(-1, 1)">Supprimer</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal2<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modifier les informations</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="message2<?= $id ?>">
                                </div>
                                <div class="form">
                                    <div class="content">
                                        <label style="margin-top: 1vh;" for="titre">Titre </label>
                                        <input class="form-control" type="text" name="titre" id="<?= $id ?>2titre" value="<?= $row['titre'] ?>">
                                    </div>
                                    <div class="content">
                                        <label style="margin-top: 1vh;" for="descript">Description</label>
                                        <textarea class="form-control" name="descript" id="<?= $id ?>2descript" cols="30" rows="10"><?php echo $row['descript'] ?></textarea>
                                    </div>
                                    <div class="content">
                                        <label style="margin-top: 1vh;" for="contrat">Contrat</label>
                                        <select class="form-control" name="contrat" id="<?= $id ?>2contrat">
                                            <option value="CDI">CDI</option>
                                            <option value="CDD">CDD</option>
                                            <option value="CTT">CTT</option>
                                            <option value="alternance">Alternance</option>
                                            <option value="stage">Stage</option>
                                        </select>
                                    </div>
                                    <div class="content">
                                        <label style="margin-top: 1vh;" for="wages">Salaire</label>
                                        <input class="form-control" type="text" name="wages" id="<?= $id ?>2wages" value="<?= $row['wages'] ?>">
                                    </div>
                                    <div class="content">
                                        <label style="margin-top: 1vh;" for="city">Ville</label>
                                        <input class="form-control" type="text" name="city" id="<?= $id ?>2city" value="<?= $row['city'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="button" class="btn btn-success" onclick="up_add(-1, 1)">Enregistrer les modifications</button>
                            </div>
                        </div>
                    </div>
                </div>
            </tr>
        <?php
        }
        ?>
    </table>
    <div style="text-align: center; margin-top:5vh;">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal3">Ajouter une annonce</button>
    </div>
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouvelle entreprise</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_create">
                        <div id="message">
                        </div>
                        <div class="form">
                            <div class="content">
                                <label style="margin-top: 1vh;" for="titre">Titre </label>
                                <input required="required" class="form-control" type="text" name="titre" id="3titre">
                            </div>
                            <div class="content">
                                <label style="margin-top: 1vh;" for="descript">Description</label>
                                <textarea class="form-control" name="descript" id="3descript" cols="30" rows="10"></textarea>
                            </div>
                            <div class="content">
                                <label style="margin-top: 1vh;" for="contrat">Contrat</label>
                                <select class="form-control" name="contrat" id="3contrat">
                                    <option value="CDI">CDI</option>
                                    <option value="CDD">CDD</option>
                                    <option value="CTT">CTT</option>
                                    <option value="alternance">Alternance</option>
                                    <option value="stage">Stage</option>
                                </select>
                            </div>
                            <div class="content">
                                <label style="margin-top: 1vh;" for="wages">Salaire</label>
                                <input required="required" class="form-control" type="text" name="wages" id="3wages">
                            </div>
                            <div class="content">
                                <label style="margin-top: 1vh;" for="city">Ville</label>
                                <input required="required" class="form-control" type="text" name="city" id="3city">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-success" onclick="add_add(<?= $_GET['id'] ?>)" value="Créer l'annonce"></button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var supp = 0;
        var up = 0;

        function up_add(ese, act) {
            if (act == 0) {
                up = ese
            } else {
                event.preventDefault();
                var postarg = {
                    'type': "up",
                    'id': up,
                    'titre': document.getElementById(up + "2titre").value,
                    'descript': document.getElementById(up + "2descript").value,
                    'contrat': document.getElementById(up + "2contrat").value,
                    'city': document.getElementById(up + "2city").value,
                    'wages': document.getElementById(up + "2wages").value
                };
                $.ajax({
                    type: "POST",
                    url: "http://localhost/T-WEB-501-MAR-5-1-jobboard-iliam.amara/admin/function/change_add.php",
                    data: postarg,
                    success: function(response) {
                        var div = document.getElementById("message2" + up)
                        div.innerHTML = '<div class="alert alert-success">Modification éffectué</div>'
                    }
                });
            }
        }

        function add_add(id_ese) {
            event.preventDefault();
            var postarg = {
                'type': "add",
                'id_ese': id_ese,
                'titre': document.getElementById("3titre").value,
                'descript': document.getElementById("3descript").value,
                'contrat': document.getElementById("3contrat").value,
                'city': document.getElementById("3city").value,
                'wages': document.getElementById("3wages").value
            };
            $.ajax({
                type: "POST",
                url: "http://localhost/T-WEB-501-MAR-5-1-jobboard-iliam.amara/admin/function/change_add.php",
                data: postarg,
                success: function(response) {
                    if (response == '"wages_wrong"') {
                        alert("le salaire doit être seulement des chiffres")
                    } else {
                        var div = document.getElementById("message")
                        alert("Annonce créee")
                        location.reload()
                    }
                }
            });
        }

        function supp_add(add, act) {
            if (act == 0) {
                supp = add
            } else {
                var postarg = {
                    'type': "supp",
                    'id': supp
                };
                $.ajax({
                    type: "POST",
                    url: "http://localhost/T-WEB-501-MAR-5-1-jobboard-iliam.amara/admin/function/change_add.php",
                    data: postarg,
                    success: function(response) {
                        console.log(response)
                        location.reload()
                    }
                });
            }
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
</body>

</html>