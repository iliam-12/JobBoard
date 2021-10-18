<nav class="navbar">
    <img src="logo.png" width="40" height="40">
    <h1>JobBoard</h1>
    <ul class="nav-menu">
        <div class="nav-content">
            <a href="accueil.php" id="dropdownMenuLink" class="nav-link"><?= (isset($_SESSION['profession']) && ($_SESSION['profession'] == 'entreprise')) ? "Mes annonces" : "Annonces"?></a>
        </div>
        <div class="dropdown profile">
            <?php
            if ($_SERVER['SCRIPT_NAME'] == "/T-WEB-501-MAR-5-1-jobboard-iliam.amara/profile.php") { ?>
                <button class="nav-link" id="dropdownMenuLink" role="button">
                    <a href="/T-WEB-501-MAR-5-1-jobboard-iliam.amara/component/deconnection.php">Déconnexion</a>
                </button>
            <?php } else { ?>
                <button class="nav-link" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    Profil
                </button>
            <?php } ?>
            <ul class="dropdown-menu dropdown-menu-lg-end text-center" aria-labelledby="dropdownMenuLink">
                <?php
                if (!empty($_SESSION['email'])) {
                ?>
                    <li><a class="dropdown-item" href="profile.php">Mes Informations</a></li>
                    <li><a class="dropdown-item" href="component/deconnection.php">Déconnexion</a></li>
                <?php
                } else {
                ?>
                    <li><a class="dropdown-item" href="profile.php">Connexion</a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </ul>
</nav>