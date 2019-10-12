<section id="presentation">
    <div>
        <h1>Bienvenu sur l'extranet GBAF</h1>
        <div id="illustration"></div>
    </div>
</section>

<section id="acteurs">
    <div class="headerList">
        <h2>Acteurs et partenaires</h2>
    </div>
    <div class="listActeur">
        <?php foreach ($listeActeurs as $acteur) { ?>
            <div class="acteur">
                <div class="logoActeur">
                    <img src="/images/<?= htmlspecialchars($acteur['logo']) ?>" alt="logo de <?= htmlspecialchars($acteur['acteur']) ?>" />
                </div>
                <div class="contentActeur">
                    <h3><?= $acteur['acteur'] ?></h3>
                    <p><?= nl2br(htmlspecialchars($acteur['description'])) ?></p>
                    <a href="#">www.<?= str_replace(' ', '-', strtolower($acteur['acteur'])) ?>.com</a>
                    <div class="more">
                        <a href="acteur-<?= $acteur['idActeur'] ?>.html" class="btn bg-bluelight">lire la suite</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>