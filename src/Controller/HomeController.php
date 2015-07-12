<?php
namespace App\Controller;

use App\Controller\AppController;

class HomeController extends AppController
{

    public function initialize() {
        parent::initialize();

        $this->loadModel('Offers');

        $session = $this->request->session();

        // if(null != ($session->read('user')) && $session->read('user') == true) {

        // } else {
        //     return $this->redirect(
        //         ['controller' => 'Users', 'action' => 'login']
        //     );
        // }
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
        }
    }

    public function display() {

    }
}
