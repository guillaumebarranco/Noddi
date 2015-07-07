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
        $this->loadModel('Activities');
        $this->loadModel('Offers');

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

        if($session->read('type') == 'modeuse') {

            $modeuse = $this->Modeuses->find('all', array(
                'conditions' => array(
                    'Modeuses.user_id' => $session->read('user_id')
                )
            ))->contain(['Users'])->toArray()[0];

            // var_dump($modeuse['user']);
            // die;

            $this->set('modeuse', $modeuse);
            $this->set('_serialize', ['modeuse']);

        } else {

            $brand = $this->Brands->find('all', array(
                'conditions' => array(
                    'Brands.user_id' => $session->read('user_id')
                )
            ))->contain(['Users'])->toArray()[0];

            $activities = $this->Brands->Activities->find('list', ['limit' => 200]);

            $offers = $this->Offers->find()->where(['brand_id' => $brand->id]);

            $this->set(array(
                'activities' => $activities,
                'brand' => $brand,
                'offers' => $offers
            ));
            
            $this->set('_serialize', ['brand', 'activities','offers']);
        }
    }

    public function update() {

        $session = $this->request->session();

        $user = $this->Users->get($session->read('user_id'));
    }
}
