<?php

namespace Model;

use \Entity\Acteur;

class ActeursManagerPDO extends ActeursManager
{

    protected function add(Acteur $acteur)
    {
        $requete = $this->dao->prepare('INSERT INTO acteur SET acteur = :acteur, description = :description, logo = :logo');

        $requete->bindValue(':acteur', $acteur->acteur());
        $requete->bindValue(':description', $acteur->description());
        $requete->bindValue(':logo', $acteur->logo());

        $requete->execute();

        $acteur->setIdActeur($this->dao->lastInsertId());
    }

    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM acteur')->fetchColumn();
    }

    public function delete(int $idActeur)
    {
        $this->dao->exec('DELETE FROM post WHERE id_acteur = ' . $idActeur);
        $this->dao->exec('DELETE FROM vote WHERE id_acteur = ' . $idActeur);
        $this->dao->exec('DELETE FROM acteur WHERE id_acteur = ' . $idActeur);
    }

    public function getList($debut = -1, $limite = -1)
    {
        $sql = 'SELECT id_acteur as idActeur, acteur, description, logo FROM acteur ORDER BY id_acteur DESC';

        if ($debut != -1 || $limite != -1) {
            $sql .= ' LIMIT ' . (int) $limite . ' OFFSET ' . (int) $debut;
        }

        $requete = $this->dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Acteur');

        $listeActeurs = $requete->fetchAll();

        $requete->closeCursor();

        return $listeActeurs;
    }

    public function getUnique(int $idActeur)
    {
        $requete = $this->dao->prepare('SELECT id_acteur as idActeur, acteur, description, logo FROM acteur WHERE id_acteur = :id');
        $requete->bindValue(':id', $idActeur, \PDO::PARAM_INT);
        $requete->execute();

        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Acteur');

        if ($acteur = $requete->fetch()) {
            return $acteur;
        }
        return null;
    }

    protected function modify(Acteur $acteur)
    {
        $requete = $this->dao->prepare('UPDATE acteur SET acteur = :acteur, description = :description, logo = :logo WHERE id_acteur = :id');

        $requete->bindValue(':acteur', $acteur->acteur());
        $requete->bindValue(':dexription', $acteur->description());
        $requete->bindValue(':logo', $acteur->logo());
        $requete->bindValue(':id', $acteur->idActeur(), \PDO::PARAM_INT);

        $requete->execute();
    }
}
