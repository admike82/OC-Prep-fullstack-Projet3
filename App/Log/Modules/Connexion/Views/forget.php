<h2>Mot de passe oublié</h2>

<form action="#" method="post">
    <script>
        document.querySelector("form").setAttribute("action", "")
    </script>
    <div class="form-group">
        <?= $form ?>
        <div class="form-button">
            <button type="submit" class="btn">Valider</button>
            <a href="/"><button type="button" class="btn">Annuler</button></a>
        </div>
    </div>
</form>