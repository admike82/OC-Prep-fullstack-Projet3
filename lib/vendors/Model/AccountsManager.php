<?php

namespace Model;

use \Fram\Manager;
use \Entity\Account;

/**
 * @author Michaël GROSS <admike@admike.fr>
 */
abstract class AccountsManager extends Manager
{

  /**
   * Méthode permettant d'enregistrer un compte.
   * @param Account $account Le compte à enregistrer
   * @return void
   */
  public function save(Account $account)
  {
    if ($account->isValid()) {
      $account->isNew() ? $this->add($account) : $this->modify($account);
    } else {
      throw new \RuntimeException('Le compte doit être validé pour être enregistré');
    }
  }

  /**
   * Méthode permettant d'ajouter un compte utilisateur.
   * @param Account $account Le compte à ajouter
   * @return void
   */
  abstract protected function add(Account $account);

  /**
   * Méthode permettant de supprimer un compte.
   * @param int $id L'identifiant du compte à supprimer
   * @return void
   */
  abstract public function delete(int $id);

  /**
   * Méthode permettant de modifier un compte.
   * @param Account $account Le compte à modifier
   * @return void
   */
  abstract protected function modify(Account $account);

  /**
   * Méthode permettant d'obtenir un compte spécifique.
   * @param int $id L'identifiant du compte
   * @return Account
   */
  abstract public function get(int $id);

  /**
   * Méthode permettant d'obtenir un compte spécifique.
   * @param string $username Le nom d'utilisateur du compte
   * @return Account
   */
  abstract public function getByUsername(string $username);

  /**
   * Méthode retournant une liste de compte demandée.
   * @param int $debut La première compte à sélectionner
   * @param int $limite Le nombre de compte à sélectionner
   * @return Account[] La liste des compte. Chaque entrée est une instance de Account.
   */
  abstract public function getList($debut = -1, $limite = -1);
}
