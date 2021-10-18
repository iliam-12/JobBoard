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
    require_once("../configs/database.php");
    require_once("component/nav.php");
    ?>
    <table>
        <tr>
            <th>Email</th>
            <th>Nom</th>
            <th>Siret</th>
            <th>Ville</th>
            <th>Nombre d'annonce</th>
            <th>Actions</th>
        </tr>
        <?php
        foreach ($db->query("SELECT * FROM companies") as $row) { ?>
            <tr>
                <td><?php if (!$row['email']) {
                        echo "(Vide)";
                    } else {
                        echo $row['email'];
                    } ?></td>
                <td><?php if (!$row['name_e']) {
                        echo "(Vide)";
                    } else {
                        echo $row['name_e'];
                    } ?></td>
                <td><?php if (!$row['siret']) {
                        echo "(Vide)";
                    } else {
                        echo $row['siret'];
                    } ?></td>
                <td><?php if (!$row['city']) {
                        echo "(Vide)";
                    } else {
                        echo $row['city'];
                    } ?></td>
                <td><?php
                    $i = 0;
                    $id = $row['id'];
                    foreach ($db->query("SELECT * FROM advertising WHERE companies_id = '$id'") as $row1) {
                        $i++;
                    }
                    echo $i;
                    ?></td>
                <td>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="supp_ese(<?php echo $id ?>, 0)">Supprimer</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $id?>" onclick="up_ese(<?php echo $id ?>, 0)">Modifier</button>
                    <button type="button" class="btn btn-primary" onclick="go_adds(<?php echo $id ?>)">Annonces</button>
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
                                <button type="button" class="btn btn-danger" onclick="supp_ese(-1, 1)">Supprimer</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal<?= $id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modifier l'Entreprise</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                    <div id="message2">
                                    </div>
                                    <div class="form">
                                        <div class="content">
                                            <label style="margin-top: 1vh;" for="name_e">Nom de l'entreprise </label>
                                            <input class="form-control" type="text" name="name_e" required="required" id="<?= $id?>2name_e" value="<?= $row['name_e'] ?>">
                                        </div>
                                        <div class="content">
                                            <label style="margin-top: 1vh;" for="email">Email</label>
                                            <input class="form-control" type="email" name="email" required="required" id="<?= $id?>2email" value="<?php echo $row['email'] ?>">
                                        </div>
                                        <div class="content">
                                            <label style="margin-top: 1vh;" for="tel">Téléphone</label>
                                            <input class="form-control" type="tel" name="tel" required="required" id="<?= $id?>2tel" value="<?= $row['phone'] ?>">
                                        </div>
                                        <div class="content">
                                            <label style="margin-top: 1vh;" for="website">Site Web</label>
                                            <input class="form-control" type="text" name="website" required="required" id="<?= $id?>2website" value="<?= $row['website'] ?>">
                                        </div>
                                        <div class="content">
                                            <label style="margin-top: 1vh;" for="city">Ville</label>
                                            <input class="form-control" type="text" name="city" required="required" id="<?= $id?>2city" value="<?= $row['city'] ?>">
                                        </div>
                                        <div class="content">
                                            <label style="margin-top: 1vh;" for="postal_code">Code Postal</label>
                                            <input class="form-control" type="text" name="postal_code" required="required" id="<?= $id?>2postal_code" value="<?= $row['postal_code'] ?>">
                                        </div>
                                        <div class="content">
                                            <label style="margin-top: 1vh;" for="addr">Adresse</label>
                                            <input class="form-control" type="text" name="addr" required="required" id="<?= $id?>2addr" value="<?= $row['addr'] ?>">
                                        </div>
                                        <div class="content">
                                            <label style="margin-top: 1vh;" for="siret">Siret</label>
                                            <input class="form-control" type="text" name="siret" required="required" id="<?= $id?>2siret" value="<?= $row['siret'] ?>">
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="button" class="btn btn-success" onclick="up_ese(-1, 1)">Enregistrer les modifications</button>
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
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal-1">Ajouter une entreprise</button>
    </div>
    <div class="modal fade" id="exampleModal-1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouvelle Entreprise</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_create">
                        <div id="message">
                        </div>
                        <div class="form">
                            <div class="content">
                                <label style="margin-top: 1vh;" for="name_e">Nom de l'entreprise</label>
                                <input class="form-control" type="text" name="name_e" required="required" id="name_e">
                            </div>
                            <div class="content">
                                <label style="margin-top: 1vh;" for="city">Ville</label>
                                <input class="form-control" type="text" name="city" required="required" id="city">
                            </div>
                            <div class="content">
                                <label style="margin-top: 1vh;" for="siret">Siret</label>
                                <input class="form-control" type="text" name="siret" required="required" id="siret">
                            </div>
                            <div class="content">
                                <label style="margin-top: 1vh;" for="email">Email</label>
                                <input class="form-control" type="email" name="email" required="required" id="email">
                            </div>
                            <div class="content">
                                <label style="margin-top: 1vh;" for="mdp">Mot de passe</label>
                                <input class="form-control" type="password" name="mdp" required="required" id="mdp">
                            </div>
                            <div class="content">
                                <label style="margin-top: 1vh;" for="cmdp">Confirmer le mot de passe</label>
                                <input class="form-control" type="password" name="cmdp" required="required" id="cmdp">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-success" onclick="add_ese()" value="Créer une Entreprise"></button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var supp = 0;
        var up = 0;

        function go_adds(id) {
            url = "http://localhost/T-WEB-501-MAR-5-1-jobboard-iliam.amara/admin/advertising.php?id=" + id
            window.location = url
        }

        function up_ese(ese, act) {
            if(act == 0) {
                up = ese
            } else {
                event.preventDefault();
            var postarg = {
                'type': "up",
                'id' : up,
                'name_e': document.getElementById(up + "2name_e").value,
                'city': document.getElementById(up +"2city").value,
                'siret': document.getElementById(up +"2siret").value,
                'email': document.getElementById(up +"2email").value,
                'phone': document.getElementById(up +"2tel").value,
                'website': document.getElementById(up +"2website").value,
                'addr': document.getElementById(up +"2addr").value,
                'postal_code': document.getElementById(up +"2postal_code").value,
            };
            $.ajax({
                type: "POST",
                url: "http://localhost/T-WEB-501-MAR-5-1-jobboard-iliam.amara/admin/function/change_ese.php",
                data: postarg,
                success: function(response) {
                    var div = document.getElementById("message2")
                    div.innerHTML = '<div class="alert alert-succes">Modification éffectué</div>'
                }
            });
            }
        }

        function add_ese() {
            event.preventDefault();
            var postarg = {
                'type': "add",
                'name_e': document.getElementById("name_e").value,
                'city': document.getElementById("city").value,
                'siret': document.getElementById("siret").value,
                'email': document.getElementById("email").value,
                'mdp': document.getElementById("mdp").value,
                'cmdp': document.getElementById("cmdp").value,
            };
            $.ajax({
                type: "POST",
                url: "http://localhost/T-WEB-501-MAR-5-1-jobboard-iliam.amara/admin/function/change_ese.php",
                data: postarg,
                success: function(response) {
                    console.log(response)
                    var div = document.getElementById("message")
                    if (response == '"succes"') {
                        div.innerHTML = '<div class="alert alert-succes">Entreprise créer</div>'
                        location.reload()
                    }
                    if (response == '"name_known"') {
                        div.innerHTML = '<div class="alert alert-danger">Nom d\'entreprise déja utilisé</div>'
                    }
                    if (response == '"email_find"') {
                        div.innerHTML = '<div class="alert alert-danger">Email déja utilisé</div>'
                    }
                    if (response == '"mdp_diff"') {
                        div.innerHTML = '<div class="alert alert-danger">les mots de passe sont différents</div>'
                    }

                }
            });
        }

        function supp_ese(ese, act) {
            if (act == 0) {
                supp = ese
            } else {
                var postarg = {
                    'type': "supp",
                    'id': supp
                };
                $.ajax({
                    type: "POST",
                    url: "http://localhost/T-WEB-501-MAR-5-1-jobboard-iliam.amara/admin/function/change_ese.php",
                    data: postarg,
                    success: function(response) {
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