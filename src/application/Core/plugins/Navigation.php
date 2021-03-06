<?php
/**
 * Description of Navigation
 *
 * @author Fleury Timbe
 */
class Core_Plugin_Navigation extends Zend_Controller_Plugin_Abstract {
    
    public function routeShutdown(Zend_Controller_Request_Abstract $request) {
        $blogSvc = new Core_Service_Blog();
        $categories = $blogSvc->fetchCategories();
        
        $nav = Zend_Registry::get('Zend_Navigation');
        $categorieNav = $nav->findById('coreArticleCategories');
        
        
        foreach ($categories as $categorie) {
            $categoriePage = Zend_Navigation_Page::factory(
                    array(
                        'type' => 'mvc',
                        'module' => 'Core',
                        'controller' => 'article',
                        'action' => 'categorieview',
                        'params' => array('id' => $categorie->getId()),
                        'route' => 'coreArticleCategorieview',
                        'visible' => true,
                        'label' => $categorie->getNom()
 			)
            );
            // Injecte la nouvelle page dans le sous conteneur Articles 
            $categorieNav->addPage($categoriePage);
        }
    }
}
