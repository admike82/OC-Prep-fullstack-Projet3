<h2>Nouveau mot de passe</h2>

<form action="#" method="post">
    <script>
        document.querySelector("form").setAttribute("action", "")
    </script>
    <div class="form-group">
        <?= $form ?>
        <div class="form-button">
            <button type="submit" class="btn">Enregistrer</button>
            <a href="/" class="btn">Annuler</a>
        </div>
    </div>
</form>