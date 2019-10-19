<?php

namespace Entity;

use DateTime;
use \Fram\Entity;

/**
 * Classe représentant un commentaire
 * @author Michaël GROSS <admike@admike.fr>
 */
class Post extends Entity
{
  protected $idPost,
    $idUser,
    $idActeur,
    $dateAdd,
    $post;

  const POST_INVALIDE = 1;

  /**
   * Vérification de la validité de l'entité
   *
   * @return boolean
   */
  public function isValid()
  {
    return !(empty($this->post));
  }

  /**
   * Méthode permettant de verifié si il s'agit d'une création
   *
   * @return boolean
   */
  public function isNew()
  {
    return empty($this->idPost);
  }

  // SETTERS //

  /**
   * renseigne l'id du commentaire
   * @param integer $idPost
   * @return void
   */
  public function setIdPost(int $idPost)
  {
    $this->idPost = $idPost;
  }

  /**
   * renseigne l'id de l'utilisateur
   * @param integer $idUser
   * @return void
   */
  public function setIdUser(int $idUser)
  {
    $this->idUser = $idUser;
  }

  /**
   * renseigne l'id de l'acteur
   * @param integer $idActeur
   * @return void
   */
  public function setIdActeur(int $idActeur)
  {
    $this->idActeur = $idActeur;
  }

  /**
   * renseigne la date d'ajout
   * @param DateTime $dateAdd
   * @return void
   */
  public function setDateAdd(DateTime $dateAdd)
  {
    $this->dateAdd = $dateAdd;
  }

  /**
   * renseigne le commentaire
   * @param string $post
   * @return void
   */
  public function setPost(string $post)
  {
    if (!is_string($post) || empty($post)) {
      $this->erreurs[] = self::POST_INVALIDE;
    }

    $this->post = $post;
  }

  // GETTERS //

  /**
   * Retourne l'id du commentaire
   * @return int
   */
  public function idPost()
  {
    return $this->idPost;
  }

  /**
   * retourne l'id de l'utilisateur
   * @return int
   */
  public function idUser()
  {
    return $this->idUser;
  }

  /**
   * Retourne l'id de l'acteur
   * @return int
   */
  public function idActeur()
  {
    return $this->idActeur;
  }

  /**
   * retourne la date d'ajout
   * @return DateTime
   */
  public function dateAdd()
  {
    return $this->dateAdd;
  }

  /**
   * Retourne le commentaire
   * @return string
   */
  public function post()
  {
    return $this->post;
  }
}
