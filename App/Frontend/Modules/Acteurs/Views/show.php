<section id="acteur">
    <div class="showActeur">
        <div class="logoShowActeur">
            <img src="/images/<?= htmlspecialchars($acteur['logo']) ?>" alt="logo de <?= htmlspecialchars($acteur['acteur']) ?>" />
        </div>
        <div class="contentActeur">
            <h2><?= htmlspecialchars($acteur['acteur']) ?></h2>
            <a href="#">www.<?= str_replace(' ', '-', strtolower($acteur['acteur'])) ?>.com</a>
            <p><?= nl2br(htmlspecialchars($acteur['description'])) ?></p>
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
                            <div><?= $nbrLike ?></div>
                            <a href="/acteur-<?= $acteur['idActeur'] ?>-<?= $like == true ? "delLike" : "like"; ?>.html">
                                <img src="/images/<?= $like == true ? "Like" : "Unlike"; ?>.png" alt="like" width="30px">
                            </a>
                            <div><?= $nbrDislike ?></div>
                            <a href="/acteur-<?= $acteur['idActeur'] ?>-<?= $like == false && $like !== '' ? "delLike" : "dislike"; ?>.html">
                                <img src="/images/<?= $like == false && $like !== '' ? "Dislike" : "Undislike"; ?>.png" alt="like" width="30px">
                            </a>
                        </div>

                        <a href="/acteur-<?= $acteur['idActeur'] ?>-add.html" class="btn bg-bluelight">Nouveau Commentaire</a>
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
                    <small><?= $post['post']['dateAdd']->format('d/m/Y à H\hi') ?>
                        <?php if ($post['post']['idUser'] == $user->getAttribute('account')['idUser']) { ?>
                            <a href="comment-<?= $post['post']['idPost'] ?>-update.html" title="Modifier">
                                <img src="images/modif.png" alt="modify">
                            </a>
                            <a href="comment-<?= $post['post']['idPost'] ?>-del.html" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer le commentaire ?')">
                                <img src="images/delete.png" alt="delete">
                            </a>
                        <?php } ?>
                    </small>
                </span>
                <p><?= nl2br(htmlspecialchars($post['post']['post'])) ?></p>
            </div>
        <?php } ?>

    </div>
    <div class="form-button">
        <a href="/" class="btn bg-bluelight">Retour à l'acceuil</a>
    </div>
</section>