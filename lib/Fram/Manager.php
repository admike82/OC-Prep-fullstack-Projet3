<?php

namespace Fram;

abstract class Manager
{
  /** @var \PDO $dao */
  protected $dao;

  public function __construct($dao)
  {
    $this->dao = $dao;
  }
}
