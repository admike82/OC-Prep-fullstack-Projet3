<?php
namespace Model;

use \Entity\Post;

class PostsManagerPDO extends PostsManager {

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
        $q = $this->dao->prepare('SELECT id_post as idPost, id_user as idUser, id_acteur as idActeur, post, date_add as dateAdd FROM post WHERE id_acteur = :id ORDER BY date_add DESC');
        $q->bindValue(':id', $idActeur, \PDO::PARAM_INT);
        $q->execute();

        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Post');

        $posts = $q->fetchAll();

        foreach ($posts as $post) {
            $post->setDateAdd(new \DateTime($post->dateAdd()));
        }

        return $posts;
    }

    protected function modify(Post $post) {
        $q = $this->dao->prepare('UPDATE post SET id_user = :idUser, post = :post WHERE id_post = :id');

        $q->bindValue(':idUser', $post->idUser(), \PDO::PARAM_INT);
        $q->bindValue(':post', $post->post());
        $q->bindValue(':id', $post->idPost(), \PDO::PARAM_INT);

        $q->execute();
    }

    public function get(int $idPost){
        $q = $this->dao->prepare('SELECT id_post as idPost, id_user as idUser, id_acteur as idActeur, post, date_add as dateAdd FROM post WHERE id_post = :id');
        $q->bindValue(':id', $idPost, \PDO::PARAM_INT);
        $q->execute();

        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Post');

        $post = $q->fetch();

        if (!empty($post)){
            $post->setDateAdd(new \DateTime($post->dateAdd()));
        }
        
        return $post;
    }
}