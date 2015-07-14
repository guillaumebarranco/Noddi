<?php
namespace App\Controller;

use App\Controller\AppController;

class ModeusesController extends AppController {

    public function initialize() {
        parent::initialize();

        // On récupère les composants pour la Pagination, le renvoi de JSON....
        $this->loadModel('Posts');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $this->set('modeuses', $this->paginate($this->Modeuses));
        $this->set('_serialize', ['modeuses']);
    }

    public function view($id = null) {
        $posts = $this->Posts->find('all')->where(['modeuse_id' => $id]);

        $modeuse = $this->Modeuses->get($id, [
            'contain' => ['Users']
        ]);

        $this->set(array(
            'modeuse'=> $modeuse,
            'posts' => $posts
        ));
        $this->set('_serialize', ['modeuse, posts']);
    }
}
