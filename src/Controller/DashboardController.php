<?php
namespace App\Controller;

use App\Controller\AppController;

class DashboardController extends AppController {

	public function initialize() {
        parent::initialize();

        $this->loadModel('Messages');
        $this->loadModel('Offers');
        $this->loadModel('Applies');
    }

    public function index() {

        $session = $this->request->session();
        if($session->read('user') == null) {
            return $this->redirect(
                ['controller' => 'Users', 'action' => 'login']
            );
        }

        $offer = $this->getCurrentOffer()[0];

        if(empty($offer)) {
            if($session->read('type') == 'brand') {
                return $this->redirect(
                    ['controller' => 'Home', 'action' => 'index']
                );
            }
        }

        $applies_modeuse = $this->Applies->find('all')->where(['offer_id' => $offer['id'], 'from_who' => 'modeuse'])->contain(['Modeuses', 'Modeuses.Users'])->toArray();
        $applies_brand = $this->Applies->find('all')->where(['offer_id' => $offer['id'], 'from_who' => 'brand'])->contain(['Modeuses', 'Modeuses.Users'])->toArray();

        $finished_offers = $this->Offers->find('all')->where(['brand_id' => $session->read('brand_id'), 'modeuse_id IS NOT' => null])->toArray();
        
        $this->set(array(
        	'offer' => $offer,
            'finished_offers' => $finished_offers,
            'applies_brand' => $applies_brand,
            'applies_modeuse' => $applies_modeuse
        ));

        $this->set('_serialize', ['offers', 'finished_offers', 'applies_modeuse', 'applies_brand']);
    }

    /*
    *
    *
    *
    *   VIEW
    */

    public function view($id = null) {

        if($id == null) {
            return $this->redirect(
                ['controller' => 'Dashboard', 'action' => 'index']
            );

        } else {

            $session = $this->request->session();

            if($session->read('user') == null) {
                return $this->redirect(
                    ['controller' => 'Users', 'action' => 'login']
                );
            }

            $offer = $this->Offers->find('all')->where(['Offers.id' => $id])->contain(['Types'])->toArray()[0];

            if(empty($offer)) {
                if($session->read('type') == 'brand') {
                    return $this->redirect(
                        ['controller' => 'Home', 'action' => 'index']
                    );
                }
            }

            $applies_modeuse = $this->Applies->find('all')->where(['offer_id' => $offer->id, 'from_who' => 'modeuse'])->contain(['Modeuses', 'Modeuses.Users'])->toArray();
            $applies_brand = $this->Applies->find('all')->where(['offer_id' => $offer->id, 'from_who' => 'brand'])->contain(['Modeuses', 'Modeuses.Users'])->toArray();
            
            $this->set(array(
                'offer' => $offer,
                'applies_modeuse' => $applies_modeuse,
                'applies_brand' => $applies_brand
            ));

            $this->set('_serialize', ['offers', 'applies_modeuse', 'applies_brand']);
        }
    }


    public function acceptApply() {

        $check = $this->Jsonification();

        $data = $this->request->data;

        $offer = $this->Offers->get($data['offer_id']);
        $offer->modeuse_id = $data['modeuse_id'];
        $this->Offers->save($offer);

        $apply = $this->Applies->get($data['apply_id']);
        $apply->accepted = 1;
        $this->Applies->save($apply);

        $check = 'OK';

        echo $this->getResponse();
    }

    public function refuseApply() {

        $check = $this->Jsonification();

        $data = $this->request->data;

        $apply = $this->Applies->get($data['apply_id']);
        $apply->accepted = 2;
        $this->Applies->save($apply);

        $check = 'OK';

        echo $this->getResponse();
    }

}