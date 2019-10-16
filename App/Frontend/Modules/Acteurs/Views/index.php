<section id="presentation">
        <h1>Bienvenue sur l'extranet GBAF</h1>
        <div id="illustration"></div>
</section>

<section id="acteurs">
    <div class="headerList">
        <h2>Acteurs et partenaires</h2>
    </div>
    <article class="listActeur">
        <?php foreach ($listeActeurs as $acteur) { ?>
            <section class="acteur">
                <figure class="logoActeur">
                    <img src="/images/<?= htmlspecialchars($acteur['logo']) ?>" alt="logo de <?= htmlspecialchars($acteur['acteur']) ?>" />
                </figure>
                <div class="contentActeur">
                    <h3><?= $acteur['acteur'] ?></h3>
                    <p><?= nl2br(htmlspecialchars($acteur['description'])) ?></p>
                    <a href="#">www.<?= str_replace(' ', '-', strtolower($acteur['acteur'])) ?>.com</a>
                    <div class="more">
                        <a href="acteur-<?= $acteur['idActeur'] ?>.html" class="btn bg-bluelight">lire la suite</a>
                    </div>
                </div>
            </section>
        <?php } ?>
    </article>
</section>