<?php

namespace Fram;

class Route
{
  protected $action;
  protected $module;
  protected $url;
  protected $varsNames;
  protected $vars = [];

  public function __construct($url, $module, $action, array $varsNames)
  {
    $this->setUrl($url);
    $this->setModule($module);
    $this->setAction($action);
    $this->setVarsNames($varsNames);
  }

  /**
   * Vérification de l'éxistence de la variable
   *
   * @return boolean
   */
  public function hasVars()
  {
    return !empty($this->varsNames);
  }

  /**
   * Vérification de la validité de l'url et récupération des variables dans l'url
   *
   * @param string $url
   * @return mixed
   */
  public function match(string $url)
  {
    if (preg_match('`^' . $this->url . '$`', $url, $matches)) {
      return $matches;
    } else {
      return false;
    }
  }

  // SETTERS //

  /**
   * renseigne l'action
   *
   * @param string $action
   * @return void
   */
  public function setAction(string $action)
  {
    if (is_string($action)) {
      $this->action = $action;
    }
  }

  /**
   * renseigne le module
   *
   * @param string $module
   * @return void
   */
  public function setModule(string $module)
  {
    if (is_string($module)) {
      $this->module = $module;
    }
  }

  /**
   * Renseigne l'url
   *
   * @param string $url
   * @return void
   */
  public function setUrl(string $url)
  {
    if (is_string($url)) {
      $this->url = $url;
    }
  }

  /**
   * renseigne le nom des variables
   *
   * @param array $varsNames
   * @return void
   */
  public function setVarsNames(array $varsNames)
  {
    $this->varsNames = $varsNames;
  }

  /**
   * Renseigne les variables
   *
   * @param array $vars
   * @return void
   */
  public function setVars(array $vars)
  {
    $this->vars = $vars;
  }

  // GETTERS //

  /**
   * retourne l'action
   *
   * @return string
   */
  public function action(): string
  {
    return $this->action;
  }

  /**
   * retourne le module
   *
   * @return string
   */
  public function module(): string
  {
    return $this->module;
  }

  /**
   * retourne les variables
   *
   * @return array
   */
  public function vars(): array
  {
    return $this->vars;
  }

  /**
   * Retourne le nom des variables
   *
   * @return array
   */
  public function varsNames(): array
  {
    return $this->varsNames;
  }
}
