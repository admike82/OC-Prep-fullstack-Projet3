<h1><?= $title ?></h1>

<form action="#" method="post">
    <script>
        document.querySelector("form").setAttribute("action", "")
    </script>
    <div class="form-group">
        <?= $form ?>
        <div class="form-button">
            <button type="submit" class="btn">Valider</button>
            <a href="/" class="btn">Annuler</a>
        </div>
    </div>
</form>