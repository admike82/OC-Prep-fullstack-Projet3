<h1><?= $title ?></h1>

<form action="#" method="post">
    <script>
        document.querySelector("form").setAttribute("action", "")
    </script>
    <div class="form-group">
        <label>Nom d'utilisateur</label>
        <input type="text" name="username" class="form-control" /><br />
        <label>Mot de passe</label>
        <input type="password" name="password" class="form-control" /><br />
        <div class="form-button">
            <button type="submit" class="btn">Connexion</button>
        </div>
    </div>
</form>
<div class="text-center">
    <a href="forget.html">Mot de passe oublié</a> <br>
    <a href="register.html">Creer un compte</a>
</div>
