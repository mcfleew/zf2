<?php
/**
 * Description of Addarticle
 *
 * @author Fleury Timbe
 */
class Core_Form_Addarticle extends Zend_Form {
    
    public function init() {
        $this->addElement('select', 'categorie');
        $blogSvc = new Core_Service_Blog();
        $data = $blogSvc->fetchCategories(true);
        $this->getElement('categorie')
             ->setLabel('Catégorie')
             ->addMultiOptions($data);
        
        $this->addElement('select', 'auteur');
        $blogSvc = new Core_Service_Blog();
        $data = $blogSvc->fetchAuteurs(true);
        $this->getElement('auteur')
             ->setLabel('Auteur')
             ->addMultiOptions($data);
        
        $this->addElement('text', 'title', array( 'label' => 'Titre' ));
        $this->getElement('title')
             ->setRequired(true)
             ->addValidator(new Zend_Validate_NotEmpty());
        
        $this->addElement('textarea', 'desc', array( 'label' => 'Descripion', 'rows' => 6 ));
        
        $this->addElement('submit', 'send', array( 'label' => 'Enregistrer' ));
        $this->getElement('title');
    }
}

