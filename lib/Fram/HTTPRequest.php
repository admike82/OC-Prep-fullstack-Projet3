<?php
namespace Fram;

class HTTPRequest extends ApplicationComponent
{

  /**
   * Récupération des données du cookie
   *
   * @param string $key
   * @return string|null
   */
  public function cookieData($key)
  {
    return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
  }

  /**
   * Vérification de l'éxistence du cookie
   *
   * @param string $key
   * @return boolean
   */
  public function cookieExists($key)
  {
    return isset($_COOKIE[$key]);
  }

  /**
   * Récupération des variables GET
   *
   * @param string $key
   * @return mixed
   */
  public function getData($key)
  {
    return isset($_GET[$key]) ? $_GET[$key] : null;
  }

  /**
   * Vérification de l'existence de la variable GET
   *
   * @param string $key
   * @return boolean
   */
  public function getExists($key)
  {
    return isset($_GET[$key]);
  }

  /**
   * Récupération de la méthode http
   *
   * @return string
   */
  public function method()
  {
    return $_SERVER['REQUEST_METHOD'];
  }

  /**
   * Récupération de la variables POST
   *
   * @param string $key
   * @return string|null
   */
  public function postData($key)
  {
    return isset($_POST[$key]) ? $_POST[$key] : null;
  }

  /**
   * Vérification de l'existence de la variable POST
   *
   * @param string $key
   * @return boolean
   */
  public function postExists($key)
  {
    return isset($_POST[$key]);
  }

  /**
   * Récupération de l'URI de la requète
   *
   * @return string
   */
  public function requestURI()
  {
    return $_SERVER['REQUEST_URI'];
  }
}