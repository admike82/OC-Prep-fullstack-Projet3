<?php
namespace Fram;

class Questions {
    protected $questions = [
        'Quelle est le nom de jeune fille de votre mère ?',
        'Comment s\'appelait votre premier animal de compagnie ?',
        'Quelle est votre couleur préférée ?',
        'Quelle est votre ville favorite ?',
        'Quelle est votre équipe sportive favorite ?',
        'Quel était le nom de votre école primaire ?',
        'Quel est le premier film que vous avez vu au cinéma ?',
        'Quel était le métier de votre grand-père ?',
    ];

    public function questions() :array {
        return $this->questions;
    }
}