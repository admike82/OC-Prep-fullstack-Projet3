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
  
  public function app()
  {
    return $this->app;
  }
}