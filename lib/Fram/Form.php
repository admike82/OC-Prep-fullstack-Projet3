<?php

namespace Fram;

class Form
{
    protected $entity;
    protected $fields = [];

    public function __construct(Entity $entity)
    {
        $this->setEntity($entity);
    }

    /**
     * Ajout d'un champs au formulaire
     *
     * @param Field $field
     * @return Form
     */
    public function add(Field $field)
    {
        $attr = $field->name(); // On récupère le nom du champ.
        $field->setValue( $this->entity->$attr() ? $this->entity->$attr() : '' ); // On assigne la valeur correspondante au champ.
        $this->fields[] = $field; // On ajoute le champ passé en argument à la liste des champs.
        return $this;
    }

    /**
     * Génération du formulaire
     *
     * @return string
     */
    public function createView(): string
    {
        $view = '';
        // On génère un par un les champs du formulaire.
        foreach ($this->fields as $field) {
            $view .= $field->buildWidget() . '<br />';
        }
        return $view;
    }

    /**
     * Vérification de la validité du formulaire
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        $valid = true;
        // On vérifie que tous les champs sont valides.
        foreach ($this->fields as $field) {
            if (!$field->isValid()) {
                $valid = false;
            }
        }
        return $valid;
    }

    // GETTER //

    /**
     * Retourne l'entité
     *
     * @return Entity
     */
    public function entity(): Entity
    {
        return $this->entity;
    }

    // SETTER //

    /**
     * Renseigne l'entité
     *
     * @param Entity $entity
     * @return void
     */
    public function setEntity(Entity $entity)
    {
        $this->entity = $entity;
    }
}
