<?php

namespace Fram;

class Router
{
  /** @var Route[] $routes */
  protected $routes = [];

  const NO_ROUTE = 1;

  /**
   * Ajout de la route au tableau des routes
   *
   * @param Route $route
   * @return void
   */
  public function addRoute(Route $route)
  {
    if (!in_array($route, $this->routes)) {
      $this->routes[] = $route;
    }
  }

  // GETTER //

  /**
   * Retourne la route
   *
   * @param string $url
   * @return Route
   */
  public function getRoute($url): Route
  {
    foreach ($this->routes as $route) {
      // Si la route correspond à l'URL
      if (($varsValues = $route->match($url)) !== false) {
        // Si elle a des variables
        if ($route->hasVars()) {
          $varsNames = $route->varsNames();
          $listVars = [];

          // On crée un nouveau tableau clé/valeur
          // (clé = nom de la variable, valeur = sa valeur)
          foreach ($varsValues as $key => $match) {
            // La première valeur contient entièrement la chaine capturée (voir la doc sur preg_match)
            if ($key !== 0) {
              $listVars[$varsNames[$key - 1]] = $match;
            }
          }

          // On assigne ce tableau de variables à la route
          $route->setVars($listVars);
        }

        return $route;
      }
    }

    throw new \RuntimeException('Aucune route ne correspond à l\'URL', self::NO_ROUTE);
  }
}
