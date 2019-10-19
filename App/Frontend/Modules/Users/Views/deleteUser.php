<h1><?= $title ?></h1>
<p class="info">Le mot de passe est obligatoire pour valider les modifications !</p>
<article class="flex user-page">
    <section class="menu-user">
        <a href="/update-user.html" class="menu-user-item btn-dark">Données personnelles</a>
        <a href="/modify-password.html" class="menu-user-item btn-dark">Changer de mot de passe</a>
        <a href="/delete-user.html" class="menu-user-item btn-active bg-bluelight del">Supprimer le compte</a>
    </section>

    <section class="form-group">
        <form action="#" method="post">
            <script>
                document.querySelector("form").setAttribute("action", "")
            </script>
            <label>Veuillez saisir votre mot de passe pour confirmer la suppression du compte</label>
            <input type="password" name="password" class="form-control" /><br />
            <div class="form-button">
                <button type="submit" class="btn" onclick="return confirm('<?= htmlspecialchars($user->getAttribute('account')['prenom']) ?>, êtes-vous sûr de vouloir supprimer votre compte ?')">Supprimer</button>
                <a href="/" class="btn">Retour à l'accueil</a>
            </div>
        </form>
    </section>
</article>