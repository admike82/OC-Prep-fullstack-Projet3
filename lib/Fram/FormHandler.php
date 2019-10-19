<?php

namespace Fram;

class FormHandler
{
    protected $form;
    protected $manager;
    protected $request;

    public function __construct(Form $form, Manager $manager, HTTPRequest $request)
    {
        $this->setForm($form);
        $this->setManager($manager);
        $this->setRequest($request);
    }

    /**
     * Enregistrement des données du formulaire
     *
     * @return boolean
     */
    public function process(): bool
    {
        if ($this->request->method() == 'POST' && $this->form->isValid()) {
            $this->manager->save($this->form->entity());
            return true;
        }
        return false;
    }

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

    /**
     * Renseigne le manager
     *
     * @param Manager $manager
     * @return void
     */
    public function setManager(Manager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Renseigne la requete
     *
     * @param HTTPRequest $request
     * @return void
     */
    public function setRequest(HTTPRequest $request)
    {
        $this->request = $request;
    }
}
