<?php

class IndexController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $addressBook = new Default_Model_AddressBook();
        $contact = new Default_Model_Contact();

        $id = (int) $this->getRequest()->getParam('addressbook');
        $name = (string) $this->getRequest()->getParam('name');
        
        if($id > 0)
        {
            $this->view->contacts = $addressBook->getContacts($id);
        }
        else
        {
            $this->view->contacts = $contact->fetchAll();
        }

        $form = new Default_Form_AddressBookSelector();
        $form->populate(array('addressbook' => $id));
        $this->view->form = $form;
    }
}