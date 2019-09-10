<div class="comments">
    <div class="headComments">
        <div class="countComments">
            <span>
                <?= count($listPosts) ?> <?= (count($listPosts) > 1) ? 'commentaires' : 'commentaire' ?>
            </span>
            <span>
                <a href="/acteur-<?= $acteur['idActeur'] ?>-add.html"><button type="button">Nouveau Commentaire</button></a>
            </span>
            <p class="like">
                <?= $nbrLike ?> <img src="/images/Like.png" alt="like" width="30px"> <? if ($like) { ?>
                    <a href="/acteur-<?= $acteur['idActeur'] ?>-dislike.html">
                        <button type="button"><img src="/images/Dislike.png" alt="dislike" width="30px" /> Je n'aime plus !</button>
                    </a>
                <? } else { ?>
                    <a href="/acteur-<?= $acteur['idActeur'] ?>-like.html">
                    <button type="button"><img src="/images/Like.png" alt="like" width="30px"> J'aime!</button>
                </a>
                <? } ?>
            </p>
        </div>
    </div>
    <?php if (empty($listPosts)) { ?>
        <p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
    <?php }
    foreach ($listPosts as $post) { ?>
        <p><?= htmlspecialchars($post['user']['prenom']) ?></p>
        <p><?= $post['post']['dateAdd']->format('d/m/Y à H\hi') ?></p>
        <p><?= nl2br(htmlspecialchars($post['post']['post'])) ?></p>
    <?php } ?>
</div>