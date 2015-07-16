<?php
namespace App\Controller;

use App\Controller\AppController;

class HomeController extends AppController {

    public function initialize() {
        parent::initialize();

        $this->loadModel('Offers');
    }

    public function index() {

        $session = $this->request->session();

        if($session->read('type') == 'brand') {

            $brand = $this->Brands->find('all')->where(['user_id' => $session->read('user_id')])->toArray();
            $offers = $this->Offers->find('all')->where(['brand_id' => $brand[0]['id']])->toArray();

            // On voit si la marque a déjà une offre en cours ou non

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
}
