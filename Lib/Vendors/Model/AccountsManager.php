<?php
namespace Model;

use \Fram\Manager;
use \Entity\Account;

abstract class AccountsManager extends Manager
{
  
  /**
   * Méthode permettant d'enregistrer un compte.
   * @param $account Le compte à enregistrer
   * @return void
   */
  public function save(Account $account)
  {
    if ($account->isValid())
    {
      $account->isNew() ? $this->add($account) : $this->modify($account);
    }
    else
    {
      throw new \RuntimeException('Le compte doit être validé pour être enregistré');
    }
  }

  /**
   * Méthode permettant d'ajouter un compte utilisateur.
   * @param $account Le compte à ajouter
   * @return void
   */
  abstract protected function add(Account $account);

  /**
   * Méthode permettant de supprimer un compte.
   * @param $id L'identifiant du compte à supprimer
   * @return void
   */
  abstract public function delete($id);

  /**
   * Méthode permettant de modifier un compte.
   * @param $account Le compte à modifier
   * @return void
   */
  abstract protected function modify(Account $account);
  
  /**
   * Méthode permettant d'obtenir un compte spécifique.
   * @param $id L'identifiant du compte
   * @return Account
   */
  abstract public function get($id);

  /**
   * Méthode permettant d'obtenir un compte spécifique.
   * @param $username Le nom d'utilisateur du compte
   * @return Account
   */
  abstract public function getByUsername($username);

  /**
   * Méthode retournant une liste de compte demandée.
   * @param $debut int La première compte à sélectionner
   * @param $limite int Le nombre de compte à sélectionner
   * @return array La liste des compte. Chaque entrée est une instance de Account.
   */
  abstract public function getList($debut = -1, $limite = -1);
}