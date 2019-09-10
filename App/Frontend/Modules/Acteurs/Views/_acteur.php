<div class="showActeur">
    <div class="logoActeur">
        <img src="/images/<?= $acteur['logo'] ?>" alt="logo de <?= $acteur['acteur'] ?>" />
    </div>
    <div class="contentActeur">
        <h2><?= $acteur['acteur'] ?></h2>
        <a href="#">www.<?= str_replace(' ', '-', strtolower($acteur['acteur'])) ?>.com</a>
        <p><?= nl2br($acteur['description']) ?></p>
    </div>
</div>