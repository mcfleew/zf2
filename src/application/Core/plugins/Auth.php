<?php
/**
 * Description of Navigation
 *
 * @author Fleury Timbe
 */
class Core_Plugin_Auth extends Zend_Controller_Plugin_Abstract {
    
    public function routeShutdown(Zend_Controller_Request_Abstract $request) {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $request->setModuleName('Core')
                    ->setControllerName('index')
                    ->setActionName('signin')
                    ->setDispatched(true);
        }
    }
}
