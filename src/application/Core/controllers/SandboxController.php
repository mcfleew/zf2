<?php
/**
 * Created by PhpStorm.
 * User: Fleury Timbe
 * Date: 07/08/14
 * Time: 09:57
 */

class Core_SandboxController extends Zend_Controller_Action {

    public function init() {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        
        $auth = Zend_Auth::getInstance();
        var_dump($auth->getIdentity());
    }

    public function indexAction() {
        $acl = new Zend_Acl();
        $acl = Zend_Registry::get('Zend_Acl');
        echo '
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

            <!-- Optional theme -->
            <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

            <!-- Latest compiled and minified JavaScript -->
            <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
            <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>';

        echo '
            <div class="container-fluid">
            <h1>Some Fries Motherfucker</h1>
        <!-- Button trigger modal -->
        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
          Launch demo modal
        </button>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
              </div>
              <div class="modal-body">
              <div class="bs-example bs-example-tabs">
                <ul id="myTab" class="nav nav-tabs" role="tablist">
                  <li class="active"><a href="#home" role="tab" data-toggle="tab">Roles</a></li>
                  <li><a href="#profile" role="tab" data-toggle="tab">Ressources</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                  <div class="tab-pane fade in active" id="home">';
                    var_dump($acl->getRoles());
                  echo '</div>
                  <div class="tab-pane fade" id="profile">';
                    var_dump($acl->getResources());
                  echo '</div>
                </div>
              </div>
              <div class="progress">
                <div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                  <span>Role Definition Complete</span>
                </div>
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>';
    }
}