<?php

namespace Entity;

use \Fram\Entity;

/**
 * Classe représentant un vote
 * @author Michaël GROSS <admike@admike.fr>
 */
class Vote extends Entity
{
  protected $idUser,
    $idActeur,
    $vote;

  // SETTERS //

  /**
   * Renseigne l'id de l'utilisateur
   * @param int $idUser
   * @return void
   */
  public function setIdUser(int $idUser)
  {
    $this->idUser = $idUser;
  }

  /**
   * renseigne l'id de l'acteur
   * @param int $idActeur
   * @return void
   */
  public function setIdActeur(int $idActeur)
  {
    $this->idActeur = $idActeur;
  }

  /**
   * renseigne la vote
   * @param boolean $vote
   * @return void
   */
  public function setVote(bool $vote)
  {
    $this->vote = $vote;
  }

  // GETTERS //

  /**
   * Retourne l'id de l'utilisateur
   * @return int
   */
  public function idUser()
  {
    return $this->idUser;
  }

  /**
   * retourne l'id de l'acteur
   * @return int
   */
  public function idActeur()
  {
    return $this->idActeur;
  }

  /**
   * return le vote
   * @return bool
   */
  public function vote()
  {
    return $this->vote;
  }
}
