<?php

namespace Fram;

/**
 * Classe permettent d'initialiser le controller
 * 
 * @author Michaël GROSS <admike@admike.fr>
 */
abstract class BackController extends ApplicationComponent
{
  protected $action = '';
  protected $module = '';
  protected $page = null;
  protected $view = '';
  protected $managers = null;

  /**
   * Undocumented function
   *
   * @param Application $app
   * @param string $module
   * @param string $action
   */
  public function __construct(Application $app, string $module, string $action)
  {
    parent::__construct($app);

    $this->managers = new Managers('PDO', PDOFactory::getMysqlConnexion());
    $this->page = new Page($app);

    $this->setModule($module);
    $this->setAction($action);
    $this->setView($action);
  }

  /**
   * Lancement de l'action du controlleur
   *
   * @return void
   */
  public function execute()
  {
    $method = 'execute' . ucfirst($this->action);

    if (!is_callable([$this, $method])) {
      throw new \RuntimeException('L\'action "' . $this->action . '" n\'est pas définie sur ce module');
    }

    $this->$method($this->app->httpRequest());
  }

  // GETTERS //

  /**
   * retourne la page
   * @return Page
   */
  public function page()
  {
    return $this->page;
  }

  // SETTERS //

  /**
   * renseigne le module
   *
   * @param string $module
   * @return void
   */
  public function setModule($module)
  {
    if (!is_string($module) || empty($module)) {
      throw new \InvalidArgumentException('Le module doit être une chaine de caractères valide');
    }

    $this->module = $module;
  }

  /**
   * renseigne l'action
   *
   * @param string $action
   * @return void
   */
  public function setAction($action)
  {
    if (!is_string($action) || empty($action)) {
      throw new \InvalidArgumentException('L\'action doit être une chaine de caractères valide');
    }

    $this->action = $action;
  }

  /**
   * renseigne la vue
   *
   * @param string $view
   * @return void
   */
  public function setView($view)
  {
    if (!is_string($view) || empty($view)) {
      throw new \InvalidArgumentException('La vue doit être une chaine de caractères valide');
    }

    $this->view = $view;

    $this->page->setContentFile(__DIR__ . '/../../App/' . $this->app->name() . '/Modules/' . $this->module . '/Views/' . $this->view . '.php');
  }
}
