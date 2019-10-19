<?php

namespace Entity;

use \Fram\Entity;

/**
 * Classe représentant un compte
 * @author Michaël GROSS <admike@admike.fr>
 */
class Account extends Entity
{
  protected $idUser,
    $nom,
    $prenom,
    $username,
    $password,
    $question,
    $reponse;

  const NOM_INVALIDE = 1;
  const PRENOM_INVALIDE = 2;
  const USERNAME_INVALIDE = 3;
  const PASSWORD_INVALIDE = 4;
  const QUESTION_INVALIDE = 5;
  const REPONSE_INVALIDE = 6;

  /**
   * Vérification de la validité de l'entité
   *
   * @return boolean
   */
  public function isValid()
  {
    return !(empty($this->nom) || empty($this->prenom) || empty($this->username) || empty($this->password) || empty($this->question) || empty($this->reponse));
  }

  /**
   * Méthode permettant de verifié si il s'agit d'une création
   *
   * @return boolean
   */
  public function isNew()
  {
    return empty($this->idUser);
  }

  // SETTERS //

  /**
   * Renseigne l'id de l'utilisateur
   * @param integer $idUser
   * @return void
   */
  public function setIdUser(int $idUser)
  {
    $this->idUser = $idUser;
  }

  /**
   * Renseigne le nom de l'utilisateur
   * @param string $nom
   * @return void
   */
  public function setNom(string $nom)
  {
    if (!is_string($nom) || empty($nom)) {
      $this->erreurs[] = self::NOM_INVALIDE;
    }
    $this->nom = $nom;
  }

  /**
   * Renseigne le prénom de l'utilisateur
   * @param string $prenom
   * @return void
   */
  public function setPrenom(string $prenom)
  {
    if (!is_string($prenom) || empty($prenom)) {
      $this->erreurs[] = self::PRENOM_INVALIDE;
    }
    $this->prenom = $prenom;
  }

  /**
   * renseigne le nom d'utilisateur
   * @param string $username
   * @return void
   */
  public function setUsername(string $username)
  {
    if (!is_string($username) || empty($username)) {
      $this->erreurs[] = self::USERNAME_INVALIDE;
    }
    $this->username = $username;
  }

  /**
   * Renseigne le mot de passe (crypté)
   * @param string $password
   * @return void
   */
  public function setPassword(string $password)
  {
    if (!is_string($password) || empty($password)) {
      $this->erreurs[] = self::PASSWORD_INVALIDE;
    }
    $this->password = $password;
  }

  /**
   * Renseigne la question secrète
   * @param string $question
   * @return void
   */
  public function setQuestion(string $question)
  {
    if (!is_string($question) || empty($question)) {
      $this->erreurs[] = self::QUESTION_INVALIDE;
    }
    $this->question = $question;
  }

  /**
   * Renseigne la réponse à la question secrète
   * @param string $reponse
   * @return void
   */
  public function setReponse(string $reponse)
  {
    if (!is_string($reponse) || empty($reponse)) {
      $this->erreurs[] = self::REPONSE_INVALIDE;
    }
    $this->reponse = $reponse;
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
   * Retourne le nom de l'utilisateur
   * @return string
   */
  public function nom()
  {
    return $this->nom;
  }

  /**
   * Retourne le prénom de l'utilisateur
   * @return string
   */
  public function prenom()
  {
    return $this->prenom;
  }

  /**
   * Retourne le nom d'utilisateur
   * @return string
   */
  public function username()
  {
    return $this->username;
  }

  /**
   * Retourne le password crypté
   * @return string
   */
  public function password()
  {
    return $this->password;
  }

  /**
   * Retourne la question secrète
   * @return string
   */
  public function question()
  {
    return $this->question;
  }

  /**
   * retourne la réponse à la question secrète
   * @return string
   */
  public function reponse()
  {
    return $this->reponse;
  }
}
