<div class="showActeur">
    <div class="logoActeur">
        <img src="/images/<?= $acteur['logo'] ?>" alt="logo de <?= $acteur['acteur'] ?>" />
    </div>
    <div class="contentActeur">
        <h2><?= $acteur['acteur'] ?></h2>
        <p><?= nl2br($acteur['description']) ?></p>
    </div>
</div>
<div class="comments">
    <?php if (empty($listPosts)) { ?>
        <p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
    <?php }
    foreach ($listPosts as $post) { ?>
        <p><?= htmlspecialchars($post['user']['prenom']) ?></p>
        <p><?= $post['post']['dateAdd']->format('d/m/Y à H\hi') ?></p>
        <p><?= nl2br(htmlspecialchars($post['post']['post'])) ?></p>
    <?php } ?>
</div>