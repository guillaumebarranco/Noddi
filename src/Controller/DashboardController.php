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

        $offer = $this->Offers->find('all')->where(['brand_id' => $session->read('brand_id'), 'modeuse_id IS' => null])->contain(['Brands'])->toArray()[0];

        $applies_modeuse = $this->Applies->find('all')->where(['offer_id' => $offer['id'], 'from_who' => 'modeuse'])->contain(['Modeuses', 'Modeuses.Users']);

        $applies_brand = $this->Applies->find('all')->where(['offer_id' => $offer['id'], 'from_who' => 'brand'])->contain(['Modeuses', 'Modeuses.Users']);
    
        $this->set(array(
        	'offer' => $offer,
        	'applies_modeuse' => $applies_modeuse,
        	'applies_brand' => $applies_brand
        ));

        $this->set('_serialize', ['offers', 'applies_modeuse', 'applies_brand']);
    }

}