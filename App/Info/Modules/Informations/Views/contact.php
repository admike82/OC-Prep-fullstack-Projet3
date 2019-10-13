<h1><?= $title ?></h1>
<div class="form-group">
    <form action="#" method="post">
        <script>
            document.querySelector("form").setAttribute("action", "")
        </script>
        <?= $form ?>
        <div class="form-button">
            <button type="submit" class="btn">Envoyer</button>
            <a href="/" class="btn">Retour à l'accueil</a>
        </div>
    </form>
</div>