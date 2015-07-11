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
    public function index()
    {
        $this->paginate = [
            'contain' => ['Brands', 'Modeuses']
        ];
        $this->set('favoris', $this->paginate($this->Favoris));
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
        $favori = $this->Favoris->newEntity();
        if ($this->request->is('post')) {
            $favori = $this->Favoris->patchEntity($favori, $this->request->data);
            if ($this->Favoris->save($favori)) {
                $this->Flash->success(__('The favori has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The favori could not be saved. Please, try again.'));
            }
        }
        $brands = $this->Favoris->Brands->find('list', ['limit' => 200]);
        $modeuses = $this->Favoris->Modeuses->find('list', ['limit' => 200]);
        $this->set(compact('favori', 'brands', 'modeuses'));
        $this->set('_serialize', ['favori']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Favori id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $favori = $this->Favoris->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $favori = $this->Favoris->patchEntity($favori, $this->request->data);
            if ($this->Favoris->save($favori)) {
                $this->Flash->success(__('The favori has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The favori could not be saved. Please, try again.'));
            }
        }
        $brands = $this->Favoris->Brands->find('list', ['limit' => 200]);
        $modeuses = $this->Favoris->Modeuses->find('list', ['limit' => 200]);
        $this->set(compact('favori', 'brands', 'modeuses'));
        $this->set('_serialize', ['favori']);
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
        $this->request->allowMethod(['post', 'delete']);
        $favori = $this->Favoris->get($id);
        if ($this->Favoris->delete($favori)) {
            $this->Flash->success(__('The favori has been deleted.'));
        } else {
            $this->Flash->error(__('The favori could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
