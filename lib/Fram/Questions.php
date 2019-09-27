<?php
namespace Fram;

class Questions {

    /**
     * Création du tableau de questions
     *
     * @return array
     */
    public function questions() :array {
        $question = [
            'Quelle est le nom de jeune fille de votre mère ?',
            'Comment s\'appelait votre premier animal de compagnie ?',
            'Quelle est votre couleur préférée ?',
            'Quelle est votre ville favorite ?',
            'Quelle est votre équipe sportive favorite ?',
            'Quel était le nom de votre école primaire ?',
            'Quel est le premier film que vous avez vu au cinéma ?',
            'Quel était le métier de votre grand-père ?',
        ];
        return $question;
    }
}