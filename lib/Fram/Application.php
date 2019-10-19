<?php

namespace Fram;

abstract class Application
{
  protected $httpRequest;
  protected $httpResponse;
  protected $name;
  protected $user;
  protected $config;

  public function __construct()
  {
    $this->httpRequest = new HTTPRequest($this);
    $this->httpResponse = new HTTPResponse($this);
    $this->user = new User($this);
    $this->config = new Config($this);

    $this->name = '';
  }

  /**
   * Méthode permettant d'instancier le controller
   *
   * @return BackController
   */
  public function getController()
  {
    $router = new Router;

    $xml = new \DOMDocument;
    $xml->load(__DIR__ . '/../../App/' . $this->name . '/Config/routes.xml');

    $routes = $xml->getElementsByTagName('route');

    // On parcourt les routes du fichier XML.
    foreach ($routes as $route) {
      $vars = [];

      // On regarde si des variables sont présentes dans l'URL.
      if ($route->hasAttribute('vars')) {
        $vars = explode(',', $route->getAttribute('vars'));
      }

      // On ajoute la route au routeur.
      $router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
    }

    try {
      // On récupère la route correspondante à l'URL.
      $matchedRoute = $router->getRoute($this->httpRequest->requestURI());
    } catch (\RuntimeException $e) {
      if ($e->getCode() == Router::NO_ROUTE) {
        // Si aucune route ne correspond, c'est que la page demandée n'existe pas.
        $this->httpResponse->redirect404();
      }
    }

    // On ajoute les variables de l'URL au tableau $_GET.
    $_GET = array_merge($_GET, $matchedRoute->vars());

    // On instancie le contrôleur.
    $controllerClass = 'App\\' . $this->name . '\\Modules\\' . $matchedRoute->module() . '\\' . $matchedRoute->module() . 'Controller';
    return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());
  }

  /**
   * Méthode permettant le lancement du composant de l'app
   *
   * @return void
   */
  abstract public function run();

  // GETTERS //

  /**
   * retourne le requète http
   *
   * @return HTTPRequest
   */
  public function httpRequest(): HTTPRequest
  {
    return $this->httpRequest;
  }

  /**
   * retourne le réponse http
   *
   * @return HTTPResponse
   */
  public function httpResponse(): HTTPResponse
  {
    return $this->httpResponse;
  }

  /**
   * retourne le nom de l'application
   *
   * @return string
   */
  public function name(): string
  {
    return $this->name;
  }

  /**
   * retourne la configuration
   *
   * @return Config
   */
  public function config(): Config
  {
    return $this->config;
  }

  /**
   * retourne l'utilisateur
   *
   * @return User
   */
  public function user(): User
  {
    return $this->user;
  }
}
