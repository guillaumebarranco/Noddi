<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Security;

class OffersController extends AppController
{

    public function initialize() {
        parent::initialize();

        $this->loadModel('Types');
        $this->loadModel('Applies');
    }

    /*
    *   On récupère pour une marque les offres en cours et terminées avec les détails, et pour une modeuses ses propositions et son boost
    */

    public function index() {

        $session = $this->request->session();

        if($session->read('type') == 'brand') {

            $current_offer = $this->Offers
                ->find('all')
                ->where(['brand_id' => $session->read('brand_id'), 'finished' => 0])
                ->contain(['Types'])
                ->toArray()[0];

            $finished_offers = $this->Offers->find('all')->where(['brand_id' => $session->read('brand_id'), 'finished' => 1]);

            $this->set(array(
                'current_offer' => $current_offer,
                'finished_offers' => $finished_offers
            ));

            $this->set('_serialize', ['current_offer, finished_offers']);

        } else {

            $modeuse = $this->Modeuses->get($session->read('modeuse_id'));

            $this->set(array(
                'modeuse' => $modeuse
            ));

            $this->set('_serialize', ['modeuse']);
        }

        
    }

    public function add()
    {
        $session = $this->request->session();
        $offer = $this->Offers->newEntity();
        if ($this->request->is('post')) {

            $brand = $this->Brands->find('all')->where(['user_id' => $session->read('user_id')])->toArray()[0];

            $this->request->data['brand_id'] = $brand['id'];

            $offer = $this->Offers->patchEntity($offer, $this->request->data);

            if ($this->Offers->save($offer)) {
                return $this->redirect(['controller' => 'Home', 'action' => 'index']);
            } else {
                $this->Flash->error(__('The offer could not be saved. Please, try again.'));
            }
        }

        $brands = $this->Offers->Brands->find('list', ['limit' => 200]);
        $types = $this->Offers->Types->find('list', ['limit' => 200]);
        $this->set(compact('offer', 'brands', 'types'));
        $this->set('_serialize', ['offer']);
    }

    /*
    *   On va créer une Offre en AJAX
    */

    public function create() {

        $check = $this->Jsonification();

        if(isset($this->request->data)) {
            $data = $this->request->data;

            $data['date_begin'] = date_create($data['date_begin']);
            $data['date_end'] = date_create($data['date_end']);

            $data['updated'] = date_create();

            $offer = $this->Offers->newEntity();
            $offer = $this->Offers->patchEntity($offer, $data);

            if($this->Offers->save($offer)) {
                $check = 'OK';
            }
        }

        echo $this->getResponse($check);
    }

    public function update() {

        $check = $this->Jsonification();

        if(isset($this->request->data)) {
            $data = $this->request->data;

            $offer = $this->Offers->get($data['id']);

            if($offer && !$offer->$match) {

                $offer = $this->Offers->patchEntity($offer, $this->request->data);

                if($this->Offers->save($offer)) {
                    $check = 'OK';
                }
            }
        }

        echo $this->getResponse($check);
    }

    // public function delete() {
        
    //     $check = $this->Jsonification();

    //     if(isset($this->request->data)) {
    //         $offer = $this->Offers->get(12);

    //         if(!$offer->$match) {
    //             $this->Offers->delete($offer);
    //             $check = 'OK';
    //         }
    //     }

    //     echo $this->getResponse($check);
    // }


    public function view($id = null) {

        $session = $this->request->session();

        if($session->read('type') == 'modeuse') {
            if($this->Modeuses->get($session->read('modeuse_id'))->boost == 0) {
                return $this->redirect(
                    ['controller' => 'Offers', 'action' => 'index']
                );
            }
        }

        $offer = $this->Offers->get($id, [
            'contain' => ['Brands']
        ]);
        $this->set('offer', $offer);
        $this->set('_serialize', ['offer']);
    }

    public function getOffers() {
        $check = $this->Jsonification();

        $offers = $this->Offers->find('all')
            //->where(['modeuse_id' => NULL])
        ;

        $response = array();
        $response['offers'] = $offers;

        $this->response->body(json_encode($response));
        return $this->response;
    }

    public function applyOffer() {

        $check = $this->Jsonification();

        if($this->request->data) {
            $data = $this->request->data;

            $apply = $this->Applies->newEntity();
            $apply = $this->Applies->patchEntity($apply, $data);

            if ($this->Applies->save($apply)) {
                $modeuse = $this->Modeuses->get($data['modeuse_id']);
                $modeuse->boost = 0;
                $this->Modeuses->save($modeuse);
                $check = 'OK';
            }

        }

        echo $this->getResponse($check);
    }


}
?>