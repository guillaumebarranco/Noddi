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

            $offers = $this->getCurrentOffer();

            // On voit si la marque a déjà une offre en cours ou non

            if(empty($offers)) {
                $can_make_offer = true;

                $this->set(array(
                    'can_make_offer' => $can_make_offer
                ));
                $this->set('_serialize', ['can_make_offer']);

            } else {
                $can_make_offer = false;

                $offer = $offers[0];

                $this->set(array(
                    'can_make_offer' => $can_make_offer,
                    'offer' => $offer
                ));
                $this->set('_serialize', ['can_make_offer, offer']);
            }
        }
    }
}
