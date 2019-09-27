<?php
namespace Fram;

abstract class Entity implements \ArrayAccess
{
  use Hydrator;

  protected $erreurs = [];

  public function __construct(array $donnees = [])
  {
    if (!empty($donnees))
    {
      $this->hydrate($donnees);
    }
  }

  // GETTER //
  public function erreurs()
  {
    return $this->erreurs;
  }

  /**
   * Appel au getter
   *
   * @param string $var
   * @return string
   */
  public function offsetGet($var)
  {
    if (isset($this->$var) && is_callable([$this, $var]))
    {
      return $this->$var();
    }
  }

  /**
   * Appel au setter
   *
   * @param string $var
   * @param $value
   * @return void
   */
  public function offsetSet($var, $value)
  {
    $method = 'set'.ucfirst($var);

    if (isset($this->$var) && is_callable([$this, $method]))
    {
      $this->$method($value);
    }
  }

  /**
   * Vérification de l'existence du setter
   *
   * @param string $var
   * @return boolean
   */
  public function offsetExists($var)
  {
    return isset($this->$var) && is_callable([$this, $var]);
  }

  /**
   * Appel aux unsetter
   *
   * @param string $var
   * @return void
   */
  public function offsetUnset($var)
  {
    throw new \Exception('Impossible de supprimer une quelconque valeur');
  }
}