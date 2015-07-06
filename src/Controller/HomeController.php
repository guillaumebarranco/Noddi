<?php
namespace App\Controller;

use App\Controller\AppController;

class HomeController extends AppController
{

    public function initialize() {
        parent::initialize();

        // On récupère les composants pour la Pagination, le renvoi de JSON....
        $this->loadComponent('RequestHandler');

        $session = $this->request->session();

        if(null != ($session->read('user')) && $session->read('user') == true) {

        } else {
            return $this->redirect(
                ['controller' => 'Users', 'action' => 'login']
            );
        }
    }

    function Jsonification() {
        $this->autoRender = false;
        $this->layout = null;
        $this->RequestHandler->renderAs($this, 'json');
    }

    public function index() {

    }

    public function display() {

    }
}
