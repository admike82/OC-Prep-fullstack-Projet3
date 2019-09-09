<?php
namespace Model;

use \Entity\Account;

class AccountsManagerPDO extends AccountsManager{
  
  protected function add(Account $account)
  {
    $q = $this->dao->prepare('INSERT INTO account SET nom = :nom, prenom = :prenom, username = :username, password = :password, question = :question, reponse = :reponse');
    
    $q->bindValue(':nom', $account->nom());
    $q->bindValue(':prenom', $account->prenom());
    $q->bindValue(':username', $account->username());
    $q->bindValue(':password', $account->password());
    $q->bindValue(':question', $account->question());
    $q->bindValue(':reponse', $account->reponse());
    
    $q->execute();
    
    $account->setIdUser($this->dao->lastInsertId());
  }

  public function delete(int $idUser)
  {
    $this->dao->exec('DELETE FROM account WHERE id_user = '.$idUser);
  }

  protected function modify(Account $account)
  {
    $q = $this->dao->prepare('UPDATE account SET nom = :nom, prenom = :prenom, username = :username, password = :password, question = :question, reponse = :reponse WHERE id_user = :id');

    $q->bindValue(':nom', $account->nom());
    $q->bindValue(':prenom', $account->prenom());
    $q->bindValue(':username', $account->username());
    $q->bindValue(':password', $account->password());
    $q->bindValue(':question', $account->question());
    $q->bindValue(':reponse', $account->reponse());
    $q->bindValue(':id', $account->idUser(), \PDO::PARAM_INT);
    
    $q->execute();
  }
  
  public function get(int $idUser)
  {
    $q = $this->dao->prepare('SELECT id_user as idUser, nom, prenom, username, password, question, reponse FROM account WHERE id_user = :idUser');
    $q->bindValue(':idUser', $idUser, \PDO::PARAM_INT);
    $q->execute();
    
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Account');
    
    return $q->fetch();
  }

  public function getByUsername(string $username){
    $q = $this->dao->prepare('SELECT id_user as idUser, nom, prenom, username, password, question, reponse FROM account WHERE username = :username');
    $q->bindValue(':username', $username);
    $q->execute();

    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Account');

    return $q->fetch();
  }

  public function getList($debut = -1, $limite = -1){
    $sql = 'SELECT id_user as idUser, nom, prenom, username, password, question, reponse FROM account ORDER BY id_user DESC';

    if ($debut != -1 || $limite != -1) {
      $sql .= ' LIMIT ' . (int) $limite . ' OFFSET ' . (int) $debut;
    }

    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Account');

    $listeAccounts = $requete->fetchAll();

    $requete->closeCursor();

    return $listeAccounts;
  }
}