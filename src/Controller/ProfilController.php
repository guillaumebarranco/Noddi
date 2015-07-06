<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Security;

class UsersController extends AppController
{

    public function initialize() {
        parent::initialize();

        // On récupère les composants pour la Pagination, le renvoi de JSON....
        $this->loadComponent('RequestHandler');

        $session = $this->request->session();

        if(null != ($session->read('user')) && $session->read('user') == true) {

            return $this->redirect(
                ['controller' => 'Home', 'action' => 'index']
            );
        }
    }

    function Jsonification() {
        $this->autoRender = false;
        $this->layout = null;
        $this->RequestHandler->renderAs($this, 'json');
    }

    public function index() {

        $session = $this->request->session();

        $user = $this->Users->get($session->read('user_id'));

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    public function update() {

        $session = $this->request->session();

        $user = $this->Users->get($session->read('user_id'));
    }

}
