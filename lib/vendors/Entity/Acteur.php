<?php
namespace Entity;

use \Fram\Entity;

class Acteur extends Entity
{
  protected $idActeur,
            $acteur,
            $description,
            $logo;

  const ACTEUR_INVALIDE = 1;
  const DESCRIPTION_INVALIDE = 2;
  const LOGO_INVALIDE = 3;

  public function isValid()
  {
    return !(empty($this->acteur) || empty($this->description) || empty($this->logo));
  }

  public function isNew()
  {
    return empty($this->idActeur);
  }

  // SETTERS //

  public function setIdActeur(int $idActeur)
  {
    $this->idActeur = $idActeur;
  }

  public function setActeur(string $acteur)
  {
    if (!is_string($acteur) || empty($acteur)) {
      $this->erreurs[] = self::ACTEUR_INVALIDE;
    }
    $this->acteur = $acteur;
  }

  public function setDescription(string $description)
  {
    if (!is_string($description) || empty($description))
    {
      $this->erreurs[] = self::DESCRIPTION_INVALIDE;
    }
    $this->description = $description;
  }

  public function setLogo(string $logo)
  {
    if (!is_string($logo) || empty($logo))
    {
      $this->erreurs[] = self::LOGO_INVALIDE;
    }

    $this->logo = $logo;
  }

  // GETTERS //

  public function idActeur()
  {
    return $this->idActeur;
  }

  public function acteur()
  {
    return $this->acteur;
  }

  public function description()
  {
    return $this->description;
  }

  public function logo()
  {
    return $this->logo;
  }
}