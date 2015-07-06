<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Security;

class ProfilController extends AppController
{

    public function initialize() {
        parent::initialize();

        // On récupère les composants pour la Pagination, le renvoi de JSON....
        $this->loadComponent('RequestHandler');
        $this->loadModel('Users');
        $this->loadModel('Modeuses');
        $this->loadModel('Brands');

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

        $session = $this->request->session();

        $modeuse = $this->Modeuses->find()->where(['user_id', $session->read('user_id')]);

        $this->set('modeuse', $modeuse);
        $this->set('_serialize', ['modeuse']);
    }

    public function update() {

        $session = $this->request->session();

        $user = $this->Users->get($session->read('user_id'));
    }
}
