<?php
namespace Fram;

abstract class FormBuilder
{
    protected $form;

    public function __construct(Entity $entity) {
        $this->setForm(new Form($entity));
    }

    /**
     * Construction du formulaire
     *
     * @return void
     */
    abstract public function build();

    // SETTER //

    public function setForm(Form $form) {
        $this->form = $form;
    }

    // GETTER //
    public function form() :Form {
        return $this->form;
    }
}