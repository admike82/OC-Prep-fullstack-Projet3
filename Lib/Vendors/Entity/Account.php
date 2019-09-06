<?php
namespace Entity;

use \Fram\Entity;

class Account extends Entity
{
  protected $nom,
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

  public function isValid()
  {
    return !(empty($this->nom) || empty($this->prenom) || empty($this->username) || empty($this->password) || empty($this->question) || empty($this->reponse));
  }


  // SETTERS //

  public function setNom(string $nom)
  {
    if (!is_string($nom) || empty($nom))
    {
      $this->erreurs[] = self::NOM_INVALIDE;
    }
    $this->nom = $nom;
  }

  public function setPrenom(string $prenom)
  {
    if (!is_string($prenom) || empty($prenom))
    {
      $this->erreurs[] = self::PRENOM_INVALIDE;
    }
    $this->prenom = $prenom;
  }

  public function setUsername(string $username)
  {
    if (!is_string($username) || empty($username))
    {
      $this->erreurs[] = self::USERNAME_INVALIDE;
    }
    $this->username = $username;
  }

  public function setPassword(string $password)
  {
    if (!is_string($password) || empty($password)) 
    {
      $this->erreurs[] = self::PASSWORD_INVALIDE;
    }
    $this->password = $password;
  }

  public function setQuestion(string $question)
  {
    if (!is_string($question) || empty($question)) {
      $this->erreurs[] = self::QUESTION_INVALIDE;
    }
    $this->question = $question;
  }

  public function setReponse(string $reponse)
  {
    if (!is_string($reponse) || empty($reponse)) {
      $this->erreurs[] = self::REPONSE_INVALIDE;
    }
    $this->reponse = $reponse;
  }

  // GETTERS //

  public function nom():string
  {
    return $this->nom;
  }

  public function prenom():string
  {
    return $this->prenom;
  }

  public function username():string
  {
    return $this->username;
  }

  public function password():string
  {
    return $this->password;
  }

  public function question():string
  {
    return $this->question;
  }
}