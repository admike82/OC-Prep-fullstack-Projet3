<?php

namespace Entity;

use \Fram\Entity;

/**
 * Classe représentant un acteur
 * @author Michaël GROSS <admike@admike.fr>
 */
class Acteur extends Entity
{
  protected $idActeur,
    $acteur,
    $description,
    $logo;

  const ACTEUR_INVALIDE = 1;
  const DESCRIPTION_INVALIDE = 2;
  const LOGO_INVALIDE = 3;

  /**
   * Vérification de la validité de l'entité
   *
   * @return boolean
   */
  public function isValid()
  {
    return !(empty($this->acteur) || empty($this->description) || empty($this->logo));
  }

  /**
   * Méthode permettant de verifié si il s'agit d'une création
   *
   * @return boolean
   */
  public function isNew()
  {
    return empty($this->idActeur);
  }

  // SETTERS //

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
   * renseigne le nom de l'acteur
   * @param string $acteur
   * @return void
   */
  public function setActeur(string $acteur)
  {
    if (!is_string($acteur) || empty($acteur)) {
      $this->erreurs[] = self::ACTEUR_INVALIDE;
    }
    $this->acteur = $acteur;
  }

  /**
   * renseigne la description
   * @param string $description
   * @return void
   */
  public function setDescription(string $description)
  {
    if (!is_string($description) || empty($description)) {
      $this->erreurs[] = self::DESCRIPTION_INVALIDE;
    }
    $this->description = $description;
  }

  /**
   * renseigne le logo
   * @param string $logo
   * @return void
   */
  public function setLogo(string $logo)
  {
    if (!is_string($logo) || empty($logo)) {
      $this->erreurs[] = self::LOGO_INVALIDE;
    }
    $this->logo = $logo;
  }

  // GETTERS //

  /**
   * retourne l'id de l'acteur
   * @return int
   */
  public function idActeur()
  {
    return $this->idActeur;
  }

  /**
   * retourne le nom de l'acteur
   * @return string
   */
  public function acteur()
  {
    return $this->acteur;
  }

  /**
   * Retourne la description de l'acteur
   * @return string
   */
  public function description()
  {
    return $this->description;
  }

  /**
   * Retourne le logo
   * @return string
   */
  public function logo()
  {
    return $this->logo;
  }
}
