<h2>Paramètres du compte</h2>
<p class="info">Le mot de passe est obligatoire pour valider les modifications !</p>
<div class="flex user-page">
    <div class="menu-user">
        <a href="/update-user.html" class="menu-user-item btn-dark">Données personnelles</a>
        <a href="/modify-password.html" class="menu-user-item btn-active">Changer de mot de passe</a>
        <a href="delete-user.html" class="menu-user-item btn-dark del">Supprimmer le compte</a>
    </div>

    <div class="form-group">
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
                <button type="submit" class="btn">Modifier</button>
                <a href="/"><button type="button" class="btn">Retour à l'accueil</button></a>
            </div>
        </form>
    </div>
</div>