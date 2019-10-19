<?php

namespace Model;

use \Fram\Manager;
use \Entity\Acteur;

/**
 * @author Michaël GROSS <admike@admike.fr>
 */
abstract class ActeursManager extends Manager
{

  /**
   * Méthode permettant d'enregistrer un acteur.
   * @param Acteur $acteur l'acteur à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(Acteur $acteur)
  {
    if ($acteur->isValid()) {
      $acteur->isNew() ? $this->add($acteur) : $this->modify($acteur);
    } else {
      throw new \RuntimeException('L\'acteur doit être validée pour être enregistré');
    }
  }

  /**
   * Méthode permettant d'ajouter un acteur.
   * @param Acteur $acteur L'acteur à ajouter
   * @return void
   */
  abstract protected function add(Acteur $acteur);

  /**
   * Méthode renvoyant le nombre de acteur total.
   * @return int
   */
  abstract public function count();

  /**
   * Méthode permettant de supprimer un acteur.
   * @param int $idActeur L'identifiant de l'acteur à supprimer
   * @return void
   */
  abstract public function delete(int $idActeur);

  /**
   * Méthode retournant la liste d'acteur
   * @param int $debut Le premier acteur à sélectionner
   * @param int $limite Le nombre d'acteur à sélectionner
   * @return Acteur[] La liste des acteurs. Chaque entrée est une instance de Acteur.
   */
  abstract public function getList($debut = -1, $limite = -1);

  /**
   * Méthode retournant un acteur précis.
   * @param int $idActeur L'identifiant de l'acteur à récupérer
   * @return Acteur L'acteur demandé
   */
  abstract public function getUnique(int $idActeur);

  /**
   * Méthode permettant de modifier un acteur.
   * @param Acteur $acteur l'acteur à modifier
   * @return void
   */
  abstract protected function modify(Acteur $acteur);
}
