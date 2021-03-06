<?php

class ContactController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function addAction()
    {
        $this->view->headTitle('Add Contact');

        $request = $this->getRequest();
        $form = new Default_Form_Contact();

        if ($this->getRequest()->isPost())
        {
            if ($form->isValid($request->getPost()))
            {
                $model = new Default_Model_Contact($form->getValues());
                $model->save();
                return $this->_helper->redirector('index', 'index');
            }
        }

        $this->view->form = $form;
    }

    public function viewAction()
    {
        $id = (int) $this->getRequest()->getParam('id');
        $contact = new Default_Model_Contact();

        $request = $this->getRequest();
        $form = new Default_Form_Contact();

        if ($this->getRequest()->isPost())
        {
            if ($form->isValid($request->getPost()))
            {
                $model = new Default_Model_Contact($form->getValues());
                $model->setId($id);
                $model->save();
                return $this->_helper->redirector('index', 'index');
            }
        }
        else
        {
            $form->populate($contact->getOptions($id));
        }

        $this->view->headTitle($this->view->escape($contact->getFirstName() . ' ' . $contact->getLastName()));
        $this->view->form = $form;
    }

    public function deleteAction()
    {
        if ($this->getRequest()->isPost())
        {
            $id = (int) $this->getRequest()->getParam('id');
            $contact = new Default_Model_Contact();
            $contact->delete($id);
        }

        return $this->_helper->redirector('index', 'index');
    }

    public function autocompleteAction()
    {
        $this->_helper->layout()->disableLayout();
        $name = (string) $this->getRequest()->getParam('name');
        $contact = new Default_Model_Contact();

        $this->view->contacts = $contact->search($name);
    }
}