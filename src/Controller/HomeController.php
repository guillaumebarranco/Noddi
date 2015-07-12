<?php
namespace App\Controller;

use App\Controller\AppController;

class HomeController extends AppController
{

    public function initialize() {
        parent::initialize();

        // On récupère les composants pour la Pagination, le renvoi de JSON....
        $this->loadComponent('RequestHandler');
        $this->loadModel('Brands');
        $this->loadModel('Offers');
        $this->loadModel('Users');

        $session = $this->request->session();

        // if(null != ($session->read('user')) && $session->read('user') == true) {

        // } else {
        //     return $this->redirect(
        //         ['controller' => 'Users', 'action' => 'login']
        //     );
        // }
    }

    function Jsonification() {
        $this->autoRender = false;
        $this->layout = null;
        $this->RequestHandler->renderAs($this, 'json');
    }

    public function index() {

        $session = $this->request->session();

        if($session->read('type') == 'brand') {

            $brand = $this->Brands->find('all')->where(['user_id' => $session->read('user_id')])->toArray();

            $offers = $this->Offers->find('all')->where(['brand_id' => $brand[0]['id']])->toArray();

            $can_make_offer = false;
            if(empty($offers)) {
                $can_make_offer = true;
            }

            $this->set(array(
                'can_make_offer' => $can_make_offer
            ));
            $this->set('_serialize', ['can_make_offer']);

           // $this->Offers->find('all')->where(['brand_id'] => $this->session->read('brand_id'))
        }
    }

    public function display() {

    }
}
