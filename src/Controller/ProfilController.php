<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Security;

class ProfilController extends AppController{

    public function initialize() {
        parent::initialize();

        $this->loadModel('Activities');
        $this->loadModel('Offers');
    }

    public function index() {

        $session = $this->request->session();

        if(null != ($session->read('user')) && $session->read('user') == true) {

        } else {
            return $this->redirect(
                ['controller' => 'Users', 'action' => 'login']
            );
        }
        
        if($session->read('type') == 'modeuse') {

            $modeuse = $this->Modeuses->find('all', array(
                'conditions' => array(
                    'Modeuses.user_id' => $session->read('user_id')
                )
            ))->contain(['Users'])->toArray()[0];

            $this->set('modeuse', $modeuse);
            $this->set('_serialize', ['modeuse']);

        } else {

            $brand = $this->Brands->find('all', array(
                'conditions' => array(
                    'Brands.user_id' => $session->read('user_id')
                )
            ))->contain(['Users'])->toArray()[0];

            $activities = $this->Brands->Activities->find('list', ['limit' => 200])->toArray();

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

        $check = $this->Jsonification();

        if($this->request->data) {
            $data = $this->request->data;

            if($session->read('type') == 'modeuse') {

                $modeuse = $this->Modeuses->get($data['modeuse_id']);
                $modeuse = $this->Modeuses->patchEntity($modeuse, $data);
                if ($this->Modeuses->save($modeuse)) {
                    $check = 'OK';
                }

            } else if($session->read('type') == 'brand') {

                $brand = $this->Brands->get($data['brand_id']);
                $brand = $this->Brands->patchEntity($brand, $data);
                if ($this->Brands->save($brand)) {
                    $check = 'OK';
                }
            }
        }

        echo $this->getResponse($check);
    }
}
