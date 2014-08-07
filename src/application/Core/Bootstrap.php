<?php

class Core_Bootstrap extends Zend_Application_Module_Bootstrap {
    
    protected function _initAutoLoading() {
        $loader = new Zend_Application_Module_Autoloader(
            array(
                'namespace' => 'Core',
                'basePath' => APP_PATH . '/Core'
            ));
    }

    public function _initAcl() {
        $acl = new Zend_Acl();

        //Lorsque vous spécifiez plusieurs parents pour un rôle, 
        //conservez à l'esprit que le dernier parent listé est le premier 
        //dans lequel une règle utilisable sera recherchée.

        $acl->addRole('Invite')
            ->addRole('Staff', 'Invite')
            ->addRole('Editeur', 'Staff')
            ->addRole('Admin');

        $acl->addResource('Article')
            ->addResource('Author');


        $acl->allow('Invite', null, 'Connexion')
            ->allow('Invite', 'Article', 'Voir');

        $acl->allow('Staff', 'Article', array('Modifier', 'Soumettre', 'Relire'));

        $acl->allow('Editeur', 'Article', array('Publier', 'Archiver', 'Supprimer'));

        $acl->allow('Admin', null, null);
        $acl->deny(array('Admin', 'Staff'), null, 'Connexion');
        $acl->allow(array('Admin', 'Staff'), null, 'Deconnexion');
        
        $acl->allow('Staff', null, 'google');
		
		
        /**
         * Access Handler
         */

        $acl->addResource('Core::article::addarticle');
        $acl->addResource('Core::article::archiver');
        $acl->addResource('Core::article::categories');
        $acl->addResource('Core::article::categorieview');
        $acl->addResource('Core::article::index');
        $acl->addResource('Core::article::view');

        $acl->addResource('Core::index::index');
        $acl->addResource('Core::index::signin');
        $acl->addResource('Core::index::logout');
        $acl->addResource('Core::sandbox::index');

        $acl->addResource('Core::error::error');

        $acl->allow(null, null, 'access');
		
        $acl->allow('staff', null, 'google');

        /**
         * Access Handler
         */
        $acl->addResource('Core::article::addarticle');
        $acl->addResource('Core::article::archiver');
        $acl->addResource('Core::article::categories');
        $acl->addResource('Core::article::categorieview');
        $acl->addResource('Core::article::index');
        $acl->addResource('Core::article::view');

        $acl->addResource('Core::index::index');
        $acl->addResource('Core::index::signin');
        $acl->addResource('Core::index::logout');
        $acl->addResource('Core::sandbox::index');

        $acl->addResource('Core::error::error');

        $acl->allow(null, null, 'access');

        $acl->allow(null, null, null, new Core_Assert_CleanIp());

        Zend_Registry::set('Zend_Acl', $acl);
    }

    /* public function _initAcl() {
      $acl = new Zend_Acl();

      $acl->addRole('Parent')
      ->addRole('Stan', 'Parent')
      ->addRole('Francine', 'Parent')
      ->addRole('Enfant')
      ->addRole('Steve', 'Enfant')
      ->addRole('Ellie', 'Enfant')
      ->addRole('Autre', array('Parent', 'Enfant'))
      ->addRole('Roger')
      ->addRole('Clause');

      $acl->addResource('Television')
      ->addResource('Voiture')
      ->addResource('Frigo')
      ->addResource('Sofa')
      ->addResource('Parent')
      ->addResource('Stan')
      ->addResource('Francine')
      ->addResource('Enfant')
      ->addResource('Steve')
      ->addResource('Ellie')
      ->addResource('Autre')
      ->addResource('Roger')
      ->addResource('Claus');

      $acl->allow(null, 'Television', 'canal+');

      Zend_Registry::set('Zend_Acl', $acl);
      } */

    public function _initPlugins() {
        $fc = Zend_Controller_Front::getInstance();
        $fc->registerPlugin(new Core_Plugin_Navigation);
        $fc->registerPlugin(new Core_Plugin_Auth);
        $fc->registerPlugin(new Core_Plugin_AccessHandler, 80);
    }

}
