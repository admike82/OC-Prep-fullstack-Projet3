<div class="presentation">
    <h1>Texte de présentation du GBAF</h1>
    <img src="/images/illustration.jpg" alt="illustration" width="95%">
</div>
<div class="bodyList">
    <div class="headerList">
        <h2>Texte acteurs et partenaires</h2>
    </div>
    <div class="listActeur">
        <?php foreach ($listeActeurs as $acteur) { ?>
            <div class="acteur">
                <div class="logoActeur">
                    <img src="/images/<?= $acteur['logo'] ?>" alt="logo de <?= $acteur['acteur'] ?>" width="200px" />
                </div>
                <div class="contentActeur">
                    <h3><?= $acteur['acteur'] ?></h3>
                    <p><?= nl2br($acteur['description']) ?></p>
                    <a href="#">www.<?= str_replace(' ', '-', strtolower($acteur['acteur'])) ?>.com</a>
                    <a href="acteur-<?= $acteur['idActeur'] ?>.html">lire la suite</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>