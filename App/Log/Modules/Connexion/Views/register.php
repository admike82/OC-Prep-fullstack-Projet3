<h2>Creer un compte</h2>
<form action="#" method="post">
    <script>
        document.querySelector("form").setAttribute("action", "")
    </script>
    <div class="form-group">
        <?= $form ?>
        <div class="form-button">
            <button type="submit" class="btn">S'enregistrer</button>
            <a href="/"><button type="button" class="btn">Annuler</button></a>
        </div>

    </div>
</form>