<?php
namespace Model;

use \Fram\Manager;
use \Entity\Vote;

abstract class VotesManager extends Manager {
    /**
     * Méthode permettant d'enregistrer un vote.
     * @param $vote Vote Le vote à enregistrer
     * @return void
     */
    public function save(Vote $vote)
    {
        $this->add($vote);
    }

    /**
     * Méthode permettant d'ajouter un vote.
     * @param $vote Vote Le vote à ajouter
     * @return void
     */
    abstract protected function add(Vote $vote);

    /**
     * Méthode permettant de supprimer un vote.
     * @param $idVote int, $idActeur int Les identifiants de l'utilasteur et de l'acteur
     * @return void
     */
    abstract public function delete(int $idUser, int $idActeur);

    /**
     * Méthode permettant d'obtenir un vote spécifique.
     * @param $idVote int, $idActeur int Les identifiants de l'utilasteur et de l'acteur
     * @return Vote
     */
    abstract public function get(int $idUser, int $idActeur);

    /**
     * Méthode permettant de récupérer une liste de vote.
     * @param $idActeur int L'identifiant de l'acteur sur lequel on veut récupérer les votes
     * @return array
     */
    abstract public function getListOf(int $idActeur);

    /**
     * Méthode renvoyant le nombre de like total.
     * @param $idActeur int L'identifiant de l'acteur sur lequel on veut récupérer le nbre de like
     * @return int
     */
    abstract public function countLike(int $idActeur);

    /**
     * Méthode renvoyant le nombre de dislike total.
     * @param $idActeur int L'identifiant de l'acteur sur lequel on veut récupérer le nbre de dislike
     * @return int
     */
    abstract public function countDislike(int $idActeur);
}