<?php
namespace Entity;

use DateTime;
use \Fram\Entity;

class Post extends Entity
{
  protected $idPost,
            $idUser,
            $idActeur,
            $dateAdd,
            $post;

  const POST_INVALIDE = 1;

  public function isValid()
  {
    return !(empty($this->post));
  }

  public function isNew()
  {
    return empty($this->idPost);
  }

  // SETTERS //

  public function setIdPost(int $idPost)
  {
    $this->idPost = $idPost;
  }

  public function setIdUser(int $idUser)
  {
    $this->idUser = $idUser;
  }

  public function setIdActeur(int $idActeur)
  {
    $this->idActeur = $idActeur;
  }

  public function setDateAdd(DateTime $dateAdd)
    {
      $this->dateAdd = $dateAdd;
    }

  public function setPost(string $post)
  {
    if (!is_string($post) || empty($post))
    {
      $this->erreurs[] = self::POST_INVALIDE;
    }

    $this->post = $post;
  }

  // GETTERS //

  public function idPost() :int
  {
    return $this->idPost;
  }

  public function idUser():int
  {
    return $this->idUser;
  }

  public function idActeur():int
  {
    return $this->idActeur;
  }

  public function dateAdd():DateTime
  {
    return $this->dateAdd;
  }

  public function post():string
  {
    return $this->post;
  }
}