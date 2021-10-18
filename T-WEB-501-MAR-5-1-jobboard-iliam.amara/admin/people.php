<?php session_start();
if ($_SESSION["acces"] == 'OK') {
?>
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
        <title>JobBoard - Personnes</title>
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
                <th>Prénom</th>
                <th>Nombre de candidature</th>
                <th>Actions</th>
            </tr>
            <?php
            foreach ($db->query("SELECT * FROM people") as $row) {
                $email = $row['email'];
            ?>
                <tr class="content">
                    <td><?php if (!$row['email']) {
                            echo "(Vide)";
                        } else {
                            echo $row['email'];
                        } ?></td>
                    <td><?php if (!$row['last_name']) {
                            echo "(Vide)";
                        } else {
                            echo $row['last_name'];
                        } ?></td>
                    <td><?php if (!$row['first_name']) {
                            echo "(Vide)";
                        } else {
                            echo $row['first_name'];
                        } ?></td>
                    <td>
                        <?php
                        $i = 0;
                        $id = $row['id'];
                        foreach ($db->query("SELECT * FROM applied WHERE people_id = '$id'") as $row2) {
                            $i++;
                        }
                        echo $i;
                        ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" onclick="supp_people(2, <?php echo $row['id'] ?>)" data-bs-target="#Supprimer">Supprimer</button>
                        <button type="submit" class="btn btn-primary" onclick="show_update(<?php echo $row['id'] ?>)">Modifier</button>
                    </td>
                    <div class="modal fade" id="Supprimer" tabindex="-1" aria-labelledby="Supprimer" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="Supprimer">Supprimer</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Voulez-vous vraiment supprimer l'utilisateur ?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="supp_people(-1, -1)">Annuler</button>
                                    <button type="button" class="btn btn-danger" onclick="supp_people(1, 0)">Supprimer</button>
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
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal2" style="text-align: center;">Ajouter un utilisateur</button>
        </div>
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="text-align: center;">
                        <h5 class="modal-title" id="exampleModalLabel">Nouvel utilisateur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" id="form_create">
                            <div id="message">
                            </div>
                            <input type="hidden" name="create" id="create" value="1">
                            <div class="form">
                                <div class="content">
                                    <label style="margin-top: 1vh;" for="email">Email</label>
                                    <input class="form-control" type="email" name="email" required="required" id="email">
                                </div>
                                <div class="content">
                                    <label style="margin-top: 1vh;" for="mdp">Mot de passe</label>
                                    <input class="form-control" type="password" name="mdp" required="required" id="mdp">
                                </div>
                                <div class="content">
                                    <label style="margin-top: 1vh;" for="cmdp">Confirmer Mot de passe</label>
                                    <input class="form-control" type="password" name="cmdp" required="required" id="cmdp">
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary" onclick="add_people()" value="Créer un compte"></button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function add_people() {
                event.preventDefault();
                var postarg = {
                    'create': document.getElementById("create").value,
                    'email': document.getElementById("email").value,
                    'mdp': document.getElementById("mdp").value,
                    'cmdp': document.getElementById("cmdp").value,
                };
                $.ajax({
                    type: "POST",
                    url: "http://localhost/T-WEB-501-MAR-5-1-jobboard-iliam.amara/admin/function/add_people.php",
                    data: postarg,
                    success: function(response) {
                        req = response.substr(10);
                        var div = document.getElementById("message");
                        if (req == "compte deja cree\"}") {
                            div.innerHTML = '<div class="alert alert-danger">l\'email existe déja</div>'
                        }
                        if (req == "mdp_diff\"}") {
                            div.innerHTML = '<div class="alert alert-danger">les mots de passe sont différents</div>'
                        }
                        if (req == "succes\"}") {
                            div.innerHTML = '<div class="alert alert-success">l\'utilisateur a bien été créé</div>'
                            location.reload();
                        }
                    },
                });
            }

            function show_update(id) {
                console.log("hey")
                var url = "http://localhost/T-WEB-501-MAR-5-1-jobboard-iliam.amara/admin/update_people.php?id=" + id
                window.location = url;
            }

            var id_supp = 0;

            function supp_people(check, id_add) {
                if (check === 2) {
                    id_supp = id_add
                    return;
                }
                if (check == 1) {
                    var postarg = {
                        'action': "supp",
                        'id': id_supp
                    };
                    $.ajax({
                        type: "Post",
                        url: "http://localhost/T-WEB-501-MAR-5-1-jobboard-iliam.amara/admin/function/supp_people.php",
                        data: postarg,
                        success: function(response) {
                            location.reload()
                        }
                    });
                    id_supp = 0;
                } else {
                    id_supp = 0;
                }
            }
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
    </body>

    </html>
<?php

} else {
    header("Location: index.php");
}
?>