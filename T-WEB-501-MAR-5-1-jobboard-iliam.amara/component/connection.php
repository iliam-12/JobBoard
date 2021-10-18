<div class="container">
    <form action="functions/loginUser.php" method="post">
        <h1 class="color_h">Connexion</h1>
        <?php if (isset($_GET["message"])) : ?>
            <?php
            if (isset($_GET["type"]) && $_GET["type"] === "success") {
                $classMessage = "alert alert-success fade show text-center";
            } else
                $classMessage = "alert alert-danger fade show text-center";
            ?>
            <div class="<?= $classMessage ?>" role="alert">
                <?= $_GET["message"];?>
            </div>
        <?php endif ?>
        <div class="mb-3">
            <label class="color_h" for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="email@example.com">
        </div>
        <div class="mb-3">
            <label class="color_h" for="mdp" class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" id="mdp" placeholder="Mot de passe">
            <input class="checkbox" type="checkbox" onclick="Show()">
            <label class="color_h">Afficher le mot de passe</label>
        </div>
        <div class="row">
            <div class="col-auto" class="btn-primary">
                <button type="submit">Connexion</button>
            </div>
            <div class="col-auto text-center">
                <a href="register.php?connect=1">S'inscrire</a>
            </div>
        </div>
    </form>
</div>
<div class="back">
    <a style="color: #EEEFA8" href="javascript:history.go(-1)">Retour</a>
</div>
<script>
    function Show() {
        mdp = document.getElementById('mdp')
        cmdp = document.getElementById('cmdp')

        if (mdp.type === "password") {
            mdp.type = "text"
            cmdp.type = "text"
        } else {
            mdp.type = "password"
            cmdp.type = "password"
        }
    }
</script>