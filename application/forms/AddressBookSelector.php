<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AddressBookSelector
 *
 * @author Lee Boynton
 */
class Default_Form_AddressBookSelector extends Zend_Form
{
    public function init()
    {
        $this->setMethod('get');

        $this->addElement('text', 'name', array(
            'label'      => 'Name',
            'class'     => 'text',
            'decorators'  => array('ViewHelper', 'Label')
        ));

        $addressBook = new Default_Model_AddressBook();
        $addressBooks = $addressBook->getNames();

        $this->addElement('select', 'addressbook', array(
            'multiOptions' => $addressBooks,
            'label'      => false,
            'decorators'  => array('ViewHelper')
        ));

        $this->getElement('addressbook')->addMultiOption('0', 'All');

        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'View',
            'decorators'  => array('ViewHelper', array(array('data'=>'HtmlTag'), array('tag' => 'noscript'))),
        ));

        $this->setName('address_book_form');
    }
}
