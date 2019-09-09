<?php
namespace Model;

use \Entity\Post;

class PostsMangerPDO extends PostsManager {

    protected function add(Post $post){
        $q = $this->dao->prepare('INSERT INTO post SET id_user = :idUser, id_acteur = :idActeur, post = :post, date_add = NOW()');

        $q->bindValue(':idUser', $post->idUser(), \PDO::PARAM_INT);
        $q->bindValue(':idActeur', $post->idActeur(), \PDO::PARAM_INT);
        $q->bindValue(':post', $post->post());

        $q->execute();

        $post->setIdPost($this->dao->lastInsertId());
    }

    public function delete(int $idPost) {
        $this->dao->exec('DELETE FROM post WHERE id_post = ' .$idPost);
    }

    public function deleteFromActeur(int $idActeur) {
        $this->dao->exec('DELETE FROM post WHERE id_acteur = ' .$idActeur);
    }

    public function getListOf(int $idActeur) {
        if (!ctype_digit($idActeur)) {
            throw new \InvalidArgumentException('L\'identifiant de l\'acteur passé doit être un nombre entier valide');
        }

        $q = $this->dao->prepare('SELECT id_post, id_user, id_acteur, post, date_add FROM post WHERE id_acteur = :idActeur');
        $q->bindValue(':idActeur', $idActeur, \PDO::PARAM_INT);
        $q->execute();

        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Post');

        $posts = $q->fetchAll();

        foreach ($posts as $post) {
            $post->setDateAdd(new \DateTime($post->dateAdd()));
        }

        return $posts;
    }

    protected function modify(Post $post) {
        $q = $this->dao->prepare('UPDATE post SET id_user = :idUser, post = :post WHERE id_post = :idPost');

        $q->bindValue(':idUser', $post->idUser(), \PDO::PARAM_INT);
        $q->bindValue(':post', $post->post());
        $q->bindValue(':idPost', $post->idPost(), \PDO::PARAM_INT);

        $q->execute();
    }

    public function get(int $idPost){
        $q = $this->dao->prepare('SELECT id_post, id_user, id_acteur, post, date_add FROM post WHERE id_post = :idPost');
        $q->bindValue(':idPost', $idPost, \PDO::PARAM_INT);
        $q->execute();

        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Post');

        $post = $q->fetch();

        $post->setDateAdd(new \DateTime($post->dateAdd()));

        return $post;
    }
}