<?php

namespace Fram;

abstract class FormBuilder
{
    protected $form;

    public function __construct(Entity $entity)
    {
        $this->setForm(new Form($entity));
    }

    /**
     * Construction du formulaire
     *
     * @return void
     */
    abstract public function build();

    // SETTER //

    /**
     * Renseigne le formulaire
     *
     * @param Form $form
     * @return void
     */
    public function setForm(Form $form)
    {
        $this->form = $form;
    }

    // GETTER //

    /**
     * Retourn le formulaire
     *
     * @return Form
     */
    public function form(): Form
    {
        return $this->form;
    }
}
