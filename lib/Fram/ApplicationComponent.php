<?php

namespace Fram;

abstract class ApplicationComponent
{
  protected $app;

  public function __construct(Application $app)
  {
    $this->app = $app;
  }

  // GETTERS //

  /**
   * retourne l'application
   *
   * @return Application
   */
  public function app(): Application
  {
    return $this->app;
  }
}
