<?php

namespace Fram;

trait Hydrator
{
  /**
   * Méthode permettant d'alimenter les Entités
   *
   * @param array $data
   * @return void
   */
  public function hydrate($data)
  {
    foreach ($data as $key => $value) {
      $method = 'set' . ucfirst($key);

      if (is_callable([$this, $method])) {
        $this->$method($value);
      }
    }
  }
}
