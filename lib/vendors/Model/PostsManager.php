<?php

namespace Model;

use \Fram\Manager;
use \Entity\Post;

/**
 * @author Michaël GROSS <admike@admike.fr>
 */
abstract class PostsManager extends Manager
{

  /**
   * Méthode permettant d'enregistrer un post.
   * @param Post $post Le post à enregistrer
   * @return void
   */
  public function save(Post $post)
  {
    if ($post->isValid()) {
      $post->isNew() ? $this->add($post) : $this->modify($post);
    } else {
      throw new \RuntimeException('Le post doit être validé pour être enregistré');
    }
  }

  /**
   * Méthode permettant d'ajouter un post.
   * @param Post $post Le post à ajouter
   * @return void
   */
  abstract protected function add(Post $post);

  /**
   * Méthode permettant de supprimer un post.
   * @param int $idPost L'identifiant du post à supprimer
   * @return void
   */
  abstract public function delete(int $idPost);

  /**
   * Méthode permettant de supprimer tous les post liés à un acteur
   * @param int $idActeur L'identifiant de l'acteur dont les post doivent être supprimés
   * @return void
   */
  abstract public function deleteFromActeur(int $idActeur);

  /**
   * Méthode permettant de récupérer une liste de post.
   * @param int $idActeur L'identifiant de l'acteur sur lequel on veut récupérer les post
   * @return Post[]
   */
  abstract public function getListOf(int $idActeur);

  /**
   * Méthode permettant de modifier un post.
   * @param Post $post Le post à modifier
   * @return void
   */
  abstract protected function modify(Post $post);

  /**
   * Méthode permettant d'obtenir un post spécifique.
   * @param int $idPost L'identifiant du post
   * @return Post
   */
  abstract public function get(int $idPost);
}
