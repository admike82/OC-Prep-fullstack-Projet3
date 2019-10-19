<?php

namespace Fram;

class Page extends ApplicationComponent
{
  protected $contentFile;
  protected $vars = [];

  /**
   * Ajout de variable a la page
   *
   * @param string $var
   * @param mixed $value
   * @return self
   */
  public function addVar($var, $value)
  {
    if (!is_string($var) || is_numeric($var) || empty($var)) {
      throw new \InvalidArgumentException('Le nom de la variable doit être une chaine de caractères non nulle');
    }

    $this->vars[$var] = $value;
    return $this;
  }

  // GETTER //

  /**
   * Génération de la page
   *
   * @return string|false
   */
  public function getGeneratedPage()
  {
    if (!file_exists($this->contentFile)) {
      throw new \RuntimeException('La vue spécifiée n\'existe pas');
    }

    $user = $this->app->user();

    extract($this->vars);

    ob_start();
    require $this->contentFile;
    $content = ob_get_clean();

    ob_start();
    require __DIR__ . '/../../App/' . $this->app->name() . '/Templates/layout.php';
    return ob_get_clean();
  }

  // SETTER //

  /**
   * Renseigne le contenu de la page
   *
   * @param string $contentFile
   * @return void
   */
  public function setContentFile(string $contentFile)
  {
    if (!is_string($contentFile) || empty($contentFile)) {
      throw new \InvalidArgumentException('La vue spécifiée est invalide');
    }

    $this->contentFile = $contentFile;
  }
}
