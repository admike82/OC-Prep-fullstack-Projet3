<h1><?= $title ?></h1>
<p class="info">Le mot de passe est obligatoire pour valider les modifications !</p>
<article class="flex user-page">
    <section class="menu-user">
        <a href="/update-user.html" class="menu-user-item btn-dark">Données personnelles</a>
        <a href="/modify-password.html" class="menu-user-item btn-active bg-bluelight">Changer de mot de passe</a>
        <a href="delete-user.html" class="menu-user-item btn-dark del">Supprimer le compte</a>
    </section>

    <section class="form-group">
        <form action="#" method="post">
            <script>
                document.querySelector("form").setAttribute("action", "")
            </script>
            <label>Mot de passe actuel</label>
            <input type="password" name="oldPassword" class="form-control" /><br />
            <label>Nouveau mot de passe (8 caractères minimum)</label>
            <input type="password" name="newPassword" class="form-control" /><br />
            <label>Confirmation du nauveau mot de passe</label>
            <input type="password" name="confirmPassword" class="form-control" /><br />
            <div class="form-button">
                <button type="submit" class="btn" onclick="return confirm('<?= htmlspecialchars($user->getAttribute('account')['prenom']) ?>, êtes-vous sûr de vouloir changer le mot de passe ?')">Modifier</button>
                <a href="/" class="btn">Retour à l'accueil</a>
            </div>
        </form>
    </section>
</article>