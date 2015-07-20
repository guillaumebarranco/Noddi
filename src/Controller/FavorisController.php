<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Favoris Controller
 *
 * @property \App\Model\Table\FavorisTable $Favoris
 */
class FavorisController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $session = $this->request->session();

        if($session->read('user') == null) {
            return $this->redirect(
                ['controller' => 'Users', 'action' => 'login']
            );
        }

        $favoris = $this->Favoris->find('all')->where(['brand_id' => $session->read('brand_id')])->contain(['Modeuses', 'Modeuses.Users', 'Brands'])->toArray();

        // Si trop de followers pour un réseau, on rajoute un "k" pour 1000 ou un "M" pour 1 000 000
        foreach ($favoris as $key => $favori) {
            if($favori->modeus->insta_followers > 1000 && $favori->modeus->insta_followers < 1000000) {
                $favori->modeus->insta_followers = round($favori->modeus->insta_followers/1000, 0, PHP_ROUND_HALF_UP).'k';
            } else if($favori->modeus->insta_followers > 1000000) {
                $favori->modeus->insta_followers = round($favori->modeus->insta_followers/1000000, 0, PHP_ROUND_HALF_UP).'M';
            }

            if($favori->modeus->twitter_followers > 1000 && $favori->modeus->twitter_followers < 1000000) {
                $favori->modeus->twitter_followers = round($favori->modeus->twitter_followers/1000, 0, PHP_ROUND_HALF_UP).'k';
            } else if($favori->modeus->twitter_followers > 1000000) {
                $favori->modeus->twitter_followers = round($favori->modeus->twitter_followers/1000000, 0, PHP_ROUND_HALF_UP).'M';
            }

            if($favori->modeus->facebook_followers > 1000 && $favori->modeus->facebook_followers < 1000000) {
                $favori->modeus->facebook_followers = round($favori->modeus->facebook_followers/1000, 0, PHP_ROUND_HALF_UP).'k';
            } else if($favori->modeus->facebook_followers > 1000000) {
                $favori->modeus->facebook_followers = round($favori->modeus->facebook_followers/1000000, 0, PHP_ROUND_HALF_UP).'M';
            }
            
        }

        $this->set('favoris', $favoris);
        $this->set('_serialize', ['favoris']);
    }

    /**
     * View method
     *
     * @param string|null $id Favori id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $favori = $this->Favoris->get($id, [
            'contain' => ['Brands', 'Modeuses']
        ]);
        $this->set('favori', $favori);
        $this->set('_serialize', ['favori']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $check = $this->Jsonification();

        $favori = $this->Favoris->newEntity();
        if ($this->request->is('post')) {
            $favori = $this->Favoris->patchEntity($favori, $this->request->data);
            if ($this->Favoris->save($favori)) {
                $check = 'OK';
            } else {
                $this->Flash->error(__('The favori could not be saved. Please, try again.'));
            }
        }
        echo $this->getResponse($check);
    }

    /**
     * Delete method
     *
     * @param string|null $id Favori id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $check = $this->Jsonification();

        if ($this->request->is('post')) {
            $favori = $this->Favoris->get($id);
            if ($this->Favoris->delete($favori)) {
                $check = 'OK';
            } else {
                $this->Flash->error(__('The favori could not be deleted. Please, try again.'));
            }
        }
        
        echo $this->getResponse($check);
    }
}
