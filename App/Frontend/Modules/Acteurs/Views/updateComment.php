<h2>Modifier un commentaire</h2>
<div class="logoShowActeur text-center mb-20">
    <img src="/images/<?= htmlspecialchars($acteur['logo']) ?>" alt="logo de <?= htmlspecialchars($acteur['acteur']) ?>" />
</div>

<form action="#" method="post">
    <script>
        document.querySelector("form").setAttribute("action", "")
    </script>
    <div class="form-group-large">
        <?= $form ?>
        <div class="form-button">
            <button type="submit" class="btn">Enregistrer</button>
            <a href="/acteur-<?= $acteur['idActeur'] ?>.html"><button type="button" class="btn">Annuler</button></a>
        </div>
    </div>
</form>