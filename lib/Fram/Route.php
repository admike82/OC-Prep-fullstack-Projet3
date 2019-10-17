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
  public function match($url)
  {
    if (preg_match('`^' . $this->url . '$`', $url, $matches)) {
      return $matches;
    } else {
      return false;
    }
  }

  // SETTERS //

  public function setAction($action)
  {
    if (is_string($action)) {
      $this->action = $action;
    }
  }

  public function setModule($module)
  {
    if (is_string($module)) {
      $this->module = $module;
    }
  }

  public function setUrl($url)
  {
    if (is_string($url)) {
      $this->url = $url;
    }
  }

  public function setVarsNames(array $varsNames)
  {
    $this->varsNames = $varsNames;
  }

  public function setVars(array $vars)
  {
    $this->vars = $vars;
  }

  // GETTERS //

  public function action(): string
  {
    return $this->action;
  }

  public function module(): string
  {
    return $this->module;
  }

  public function vars(): array
  {
    return $this->vars;
  }

  public function varsNames(): array
  {
    return $this->varsNames;
  }
}
