<?php
namespace App\Controller;

use App\Controller\AppController;

class ModeusesController extends AppController {

    public function initialize() {
        parent::initialize();
        
        $this->loadModel('Posts');
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

        $this->paginate = [
            'contain' => ['Users']
        ];
        $this->set('modeuses', $this->paginate($this->Modeuses));
        $this->set('_serialize', ['modeuses']);
    }

    public function view($id = null) {
        $session = $this->request->session();

        if($session->read('user') == null) {
            return $this->redirect(
                ['controller' => 'Users', 'action' => 'login']
            );
        }

        if($session->read('user') != 'brand') {
            return $this->redirect(
                ['controller' => 'Offers', 'action' => 'index']
            );
        }

        $session = $this->request->session();

        $posts = $this->Posts->find('all')->where(['modeuse_id' => $id]);

        $modeuse = $this->Modeuses->get($id, [
            'contain' => ['Users']
        ]);

        

        if($session->read('type') == 'brand') {
            $offer = $this->Offers->find('all')
                ->where(['brand_id' => $session->read('brand_id'), 'modeuse_id IS' => null])
                ->contain(['Brands'])->toArray();

            $can_apply = true;

            if(isset($offer[0])) {
                $offer = $offer[0];
                $apply = $this->Applies->find('all')->where(['Applies.offer_id' => $offer->id, 'Applies.modeuse_id' => $modeuse->id])->toArray();
                if(isset($apply[0])) {
                    $can_apply = false;
                }
            }

                $this->set(array(
                'modeuse'=> $modeuse,
                'posts' => $posts,
                'offer' => $offer,
                'can_apply' => $can_apply
            ));
            $this->set('_serialize', ['modeuse, posts, offer, can_apply']);
        }

        

        $this->set(array(
            'modeuse'=> $modeuse,
            'posts' => $posts
        ));
        $this->set('_serialize', ['modeuse, posts']);
    }
}
