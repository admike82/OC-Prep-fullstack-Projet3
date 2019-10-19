<?php

namespace Model;

use \Fram\Manager;
use \Entity\Vote;

/**
 * @author Michaël GROSS <admike@admike.fr>
 */
abstract class VotesManager extends Manager
{
    /**
     * Méthode permettant d'enregistrer un vote.
     * @param Vote $vote Le vote à enregistrer
     * @return void
     */
    public function save(Vote $vote)
    {
        $test = $this->get($vote->idUser(), $vote->idActeur());
        if (empty($test)) {
            $this->add($vote);
        } else if ($vote->vote() !== $test->vote()) {
            $this->modify($vote);
        }
    }

    /**
     * Méthode permettant d'ajouter un vote.
     * @param Vote $vote Le vote à ajouter
     * @return void
     */
    abstract protected function add(Vote $vote);

    /**
     * Méthode permettant de mettre à jour le vote.
     * @param Vote $vote Le vote à supprimer
     * @return void
     */
    abstract protected function modify(Vote $vote);

    /**
     * Méthode permettant de supprimer un vote.
     * @param int $idUser L'identifiant de l'utilasteur
     * @param int $idActeur L'identifiant de de l'acteur
     * @return void
     */
    abstract public function delete(int $idUser, int $idActeur);

    /**
     * Méthode permettant d'obtenir un vote spécifique.
     * @param int $idUser L'identifiant de l'utilasteur
     * @param int $idActeur L'identifiant de de l'acteur
     * @return Vote
     */
    abstract public function get(int $idUser, int $idActeur);

    /**
     * Méthode permettant de récupérer la valeur du champs vote d'un vote
     * @param int $idUser L'identifiant de l'utilasteur
     * @param int $idActeur L'identifiant de de l'acteur
     * @return boolean|Null
     */
    abstract function getVote(int $idUser, int $idActeur);

    /**
     * Méthode permettant de récupérer une liste de vote.
     * @param int $idActeur L'identifiant de l'acteur
     * @return Vote[]
     */
    abstract public function getListOf(int $idActeur);

    /**
     * Méthode renvoyant le nombre de like total.
     * @param int $idActeur L'identifiant de l'acteur sur lequel on veut récupérer le nbre de like
     * @return int
     */
    abstract public function countLike(int $idActeur);

    /**
     * Méthode renvoyant le nombre de dislike total.
     * @param int $idActeur L'identifiant de l'acteur sur lequel on veut récupérer le nbre de dislike
     * @return int
     */
    abstract public function countDislike(int $idActeur);
}
