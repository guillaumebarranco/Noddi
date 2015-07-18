<?php
namespace App\Controller;

use App\Controller\AppController;

class ModeusesController extends AppController {

    public function initialize() {
        parent::initialize();
        
        $this->loadModel('Posts');
        $this->loadModel('Offers');
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

        $session = $this->request->session();

        $posts = $this->Posts->find('all')->where(['modeuse_id' => $id]);

        $modeuse = $this->Modeuses->get($id, [
            'contain' => ['Users']
        ]);

        if($session->read('type') == 'brand') {
            $offer = $this->Offers->find('all')
                ->where(['brand_id' => $session->read('brand_id'), 'modeuse_id IS' => null])
                ->contain(['Brands'])->toArray();

            if(isset($offer[0])) {
                $offer = $offer[0];
            }

                $this->set(array(
                'modeuse'=> $modeuse,
                'posts' => $posts,
                'offer' => $offer
            ));
            $this->set('_serialize', ['modeuse, posts, offer']);
        }

        

        $this->set(array(
            'modeuse'=> $modeuse,
            'posts' => $posts
        ));
        $this->set('_serialize', ['modeuse, posts']);
    }
}
