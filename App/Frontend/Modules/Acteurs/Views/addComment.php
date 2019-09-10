<div class="logoActeur">
    <img src="/images/<?= $acteur['logo'] ?>" alt="logo de <?= $acteur['acteur'] ?>" />
</div>
<h2>Ajouter un commentaire</h2>
<form action="" method="post">
    <p>
        <?= $form ?>

        <input type="submit" value="enregistrer" />
        <a href="/acteur-<?= $acteur['idActeur'] ?>.html"><button type="button">Annuler</button></a>
    </p>
</form>
