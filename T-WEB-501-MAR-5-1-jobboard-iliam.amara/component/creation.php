<div class="container">
    <form action="functions/createUser.php" method="post">
        <h1 class="color_h">Créer votre compte</h1>
        <?php if (isset($_GET["message"])) : ?> 
            <div class="alert alert-danger fade show text-center" role="alert">
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
        </div>
        <div class="mb-3">
            <label class="color_h" for="cmdp" class="form-label">Confirmez le mot de passe</label>
            <input type="password" name="confirm_password" class="form-control" id="cmdp" placeholder="Confirmez le mot de passe">
            <input type="checkbox" onclick="Show()">
            <label class="color_h">Afficher le mot de passe</label>
        </div>
        <div class="row">
            <p class="color_h">Je suis un :</p>
            <div style="margin-top:-0.8rem; margin-bottom: 0.8rem;">
                <input type="radio" id="particulier" name="status" value="particulier" required=required>
                <label class="color_h" for="particulier">Particulier</label>
                <input type="radio" id="entreprise" name="status" value="entreprise" required=required>
                <label class="color_h" for="entreprise">Entreprise</label>
            </div>
            <div class="col-auto" class="btn-primary">
                <button class="color_h" type="submit">S'inscrire</button>
            </div>
            <div class="col-auto text-center">
                <a class="color_h" href="register.php?connect=0">Déja membre ?</a>
            </div>
        </div>
    </form>
</div>
<div class="back">
    <a style="color: #EEEFA8;" href="javascript:history.go(-1)">Retour</a>
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