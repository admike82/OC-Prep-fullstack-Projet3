<?php
namespace Model;

use \Entity\Vote;

class VotesManagerPDO extends VotesManager {

    protected function add(Vote $vote) {
        $test = $this->get($vote->idUser(), $vote->idActeur());
        if (empty($test)){
            $q = $this->dao->prepare('INSERT INTO vote SET id_user = :idUser, id_acteur = :idActeur, vote = :vote');

            $q->bindValue(':idUser', $vote->idUser(), \PDO::PARAM_INT);
            $q->bindValue(':idActeur', $vote->idActeur(), \PDO::PARAM_INT);
            $q->bindValue(':vote', $vote->vote(), \PDO::PARAM_BOOL);

            $q->execute();
        }
    }

    public function delete(int $idUser, int $idActeur) {
        $this->dao->exec('DELETE FROM vote WHERE id_user = '.$idUser.' AND id_acteur = '.$idActeur);
    }

    public function get(int $idUser, int $idActeur) {
        $q = $this->dao->prepare('SELECT id_user as idUser, id_acteur as idActeur, vote FROM vote WHERE id_user = :idUser AND id_acteur = :idActeur');
        $q->bindValue(':idUser', $idUser, \PDO::PARAM_INT);
        $q->bindValue(':idActeur', $idActeur, \PDO::PARAM_INT);
        $q->execute();

        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Vote');

        return $q->fetch();
    }

    public function getListOf(int $idActeur) {

        $q = $this->dao->prepare('SELECT id_user as idUser, id_acteur as idActeur, vote FROM vote WHERE id_acteur = :idActeur');
        $q->bindValue(':idActeur', $idActeur, \PDO::PARAM_INT);
        $q->execute();

        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Vote');

        return $q->fetchAll();
    }

    public function countLike(int $idActeur) {
        return $this->dao->query('SELECT COUNT(*) FROM vote WHERE id_acteur = '.$idActeur.' AND vote = true')->fetchColumn();
    }

    public function countDislike(int $idActeur){
        return $this->dao->query('SELECT COUNT(*) FROM vote WHERE id_acteur = ' . $idActeur . ' AND vote = false')->fetchColumn();
    }
}