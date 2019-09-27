<?php
namespace Fram;

session_start();

class User
{
  /**
   * Méthode permettant la déconnection
   *
   * @return void
   */
  public function logOut() {
    session_destroy();
  }

  /**
   * Suppression d'un attibut
   *
   * @param string $attr
   * @return void
   */
  public function delAttribute($attr)
  {
    unset($_SESSION[$attr]);
  }

  /**
   * Vérification de l'éxistence d'un message flash
   *
   * @return boolean
   */
  public function hasFlash()
  {
    return isset($_SESSION['flash']);
  }

  /**
   * Vérification de l'authentification de l'utilisateur
   *
   * @return boolean
   */
  public function isAuthenticated()
  {
    return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
  }

  // GETTERS //

  public function getAttribute($attr)
  {
    return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
  }

  public function getFlash()
  {
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);

    return $flash;
  }

  // SETTERS //

  public function setAttribute($attr, $value)
  {
    $_SESSION[$attr] = $value;
  }

  public function setAuthenticated($authenticated = true)
  {
    if (!is_bool($authenticated))
    {
      throw new \InvalidArgumentException('La valeur spécifiée à la méthode User::setAuthenticated() doit être un boolean');
    }

    $_SESSION['auth'] = $authenticated;
  }

  public function setFlash($value)
  {
    $_SESSION['flash'] = $value;
  }
}