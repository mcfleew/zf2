<?php
/**
 * Description of Addarticle
 *
 * @author Fleury Timbe
 */
class Core_Form_Auth extends Zend_Form {
    
    public function init() {        
        $this->addElement('text', 'email', array( 'label' => 'E-mail' ));
        $this->getElement('email')
             ->setRequired(true)
             ->addValidator(new Zend_Validate_EmailAddress());
        
        $this->addElement('password', 'password', array( 'label' => 'Mot de passe' ));
        $this->getElement('password')
             ->setRequired(true)
             ->addValidator(new Zend_Validate_NotEmpty());
        
        $this->addElement('checkbox', 'remember', array( 'label' => 'Rester connecté' ));
        
        $this->addElement('submit', 'connect', array( 'label' => 'Connexion' ));
    }
}

