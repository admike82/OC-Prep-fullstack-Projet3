<h2>Paramètres du compte</h2>
<p class="info">Le mot de passe est obligatoire pour valider les modifications !</p>
<div class="flex user-page">
    <div class="menu-user">
        <a href="/update-user.html" class="menu-user-item btn-active">Données personnelles</a>
        <a href="/modify-password.html" class="menu-user-item btn-dark">Changer de mot de passe</a>
        <a href="delete-user.html" class="menu-user-item btn-dark del">Supprimmer le compte</a>
    </div>

    <div class="form-group">
        <form action="" method="post">
            <?= $form ?>
            <div class="form-button">
                <button type="submit" class="btn">Modifier</button>
                <a href="/"><button type="button" class="btn">Retour à l'accueil</button></a>
            </div>
        </form>
    </div>
</div>