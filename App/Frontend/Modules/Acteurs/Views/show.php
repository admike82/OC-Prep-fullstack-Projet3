<section id="acteur">
    <div class="showActeur">
        <div class="logoShowActeur">
            <img src="/images/<?= $acteur['logo'] ?>" alt="logo de <?= $acteur['acteur'] ?>" />
        </div>
        <div class="contentActeur">
            <h2><?= $acteur['acteur'] ?></h2>
            <a href="#">www.<?= str_replace(' ', '-', strtolower($acteur['acteur'])) ?>.com</a>
            <p><?= nl2br($acteur['description']) ?></p>
        </div>
    </div>

    <div class="comments">
        <div class="headComments">
            <div class="countComments">
                <div class="comment-flex-between">
                    <div>
                        <?= count($listPosts) ?> <?= (count($listPosts) > 1) ? 'commentaires' : 'commentaire' ?>
                    </div>
                    <div class="like">
                        
                        <div>
                            <div><?= $nbrLike ?></div> <img src="/images/Like.png" alt="like" width="30px">
                        </div>
                        <? if ($like) { ?>
                            <a href="/acteur-<?= $acteur['idActeur'] ?>-dislike.html" class="btn-dislike"> Je n'aime plus !</a>
                        <? } else { ?>
                            <a href="/acteur-<?= $acteur['idActeur'] ?>-like.html" class="btn-like">J'aime!</a>
                        <? } ?>
                        <a href="/acteur-<?= $acteur['idActeur'] ?>-add.html" class="btn">Nouveau Commentaire</a>
                    </div>
                </div>
            </div>
        </div>
        <?php if (empty($listPosts)) { ?>
            <p class="no-comment">Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
        <?php }
        foreach ($listPosts as $post) { ?>
            <div class="comment">
                <span class="flex-between">
                    <small><?= htmlspecialchars($post['user']['prenom']) ?></small>
                    <small><?= $post['post']['dateAdd']->format('d/m/Y à H\hi') ?></small>
                </span>
                <p><?= nl2br(htmlspecialchars($post['post']['post'])) ?></p>
            </div>
        <?php } ?>

    </div>
    <div class="form-button">
        <a href="/"><button type="button" class="btn">Retour a l'acceuil</button></a>
    </div>
</section>