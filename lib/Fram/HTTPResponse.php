<?php

namespace Fram;

class HTTPResponse extends ApplicationComponent
{
  protected $page;

  /**
   * Méthode permettant creer le header html
   *
   * @param string $header
   * @return void
   */
  public function addHeader($header)
  {
    header($header);
  }

  /**
   * Méthode permettant la redirection
   *
   * @param string $location
   * @return void
   */
  public function redirect($location)
  {
    header('Location: ' . $location);
    exit;
  }

  /**
   * Méthode créant une redirection 404
   *
   * @return void
   */
  public function redirect404()
  {
    $this->page = new Page($this->app);
    $this->page->setContentFile(__DIR__ . '/../../Errors/404.html');

    $this->addHeader('HTTP/1.0 404 Not Found');

    $this->send();
  }

  /**
   * Méthode appelant la génération de la page
   *
   * @return void
   */
  public function send()
  {
    exit($this->page->getGeneratedPage());
  }

  // SETTERS //

  /**
   * Renseigne la page
   *
   * @param Page $page
   * @return void
   */
  public function setPage(Page $page)
  {
    $this->page = $page;
  }

  /**
   * Renseigne un cookie
   *
   * @param string $name
   * @param string $value
   * @param int $expire
   * @param string $path
   * @param string $domain
   * @param boolean $secure
   * @param boolean $httpOnly
   * @return void
   */
  public function setCookie($name, $value = '', $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = true)
  {
    setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
  }
}
