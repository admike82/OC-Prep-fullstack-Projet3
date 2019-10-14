<?php
namespace Entity;

use \Fram\Entity;

class Vote extends Entity
{
  protected $idUser,
            $idActeur,
            $vote;

  // SETTERS //

  public function setIdUser(int $idUser)
  {
    $this->idUser = $idUser;
  }

  public function setIdActeur(int $idActeur)
  {
    $this->idActeur = $idActeur;
  }

  public function setVote(bool $vote)
  {
    $this->vote = $vote;
  }

  // GETTERS //

  public function idUser()
  {
    return $this->idUser;
  }

  public function idActeur()
  {
    return $this->idActeur;
  }

  public function vote() :bool
  {
    return $this->vote;
  }
}