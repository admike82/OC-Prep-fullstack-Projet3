<?php
namespace Fram;

class PDOFactory
{
  /**
   * Récupération de l'interface de connection à la BDD
   *
   * @return \PDO
   */
  public static function getMysqlConnexion()
  {
    $xml = new \DOMDocument;
    $xml->load(__DIR__ . '/../../config.xml');

    $elements = $xml->getElementsByTagName('define');

    foreach ($elements as $element) {
      $vars[$element->getAttribute('var')] = $element->getAttribute('value');
    }
    $db = new \PDO('mysql:host='.$vars["dbhost"].';dbname='.$vars["dbname"].';charset=utf8', $vars["dbuser"], $vars["dbmdp"]);
    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    
    return $db;
  }
}