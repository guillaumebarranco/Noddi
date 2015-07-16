<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Applies Controller
 *
 * @property \App\Model\Table\AppliesTable $Applies
 */
class AppliesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Modeuses', 'Offers']
        ];
        $this->set('applies', $this->paginate($this->Applies));
        $this->set('_serialize', ['applies']);
    }

    /**
     * View method
     *
     * @param string|null $id Apply id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $apply = $this->Applies->get($id, [
            'contain' => ['Modeuses', 'Offers']
        ]);
        $this->set('apply', $apply);
        $this->set('_serialize', ['apply']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $apply = $this->Applies->newEntity();
        if ($this->request->is('post')) {
            $apply = $this->Applies->patchEntity($apply, $this->request->data);
            if ($this->Applies->save($apply)) {
                $this->Flash->success(__('The apply has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The apply could not be saved. Please, try again.'));
            }
        }
        $modeuses = $this->Applies->Modeuses->find('list', ['limit' => 200]);
        $offers = $this->Applies->Offers->find('list', ['limit' => 200]);
        $this->set(compact('apply', 'modeuses', 'offers'));
        $this->set('_serialize', ['apply']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Apply id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $apply = $this->Applies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $apply = $this->Applies->patchEntity($apply, $this->request->data);
            if ($this->Applies->save($apply)) {
                $this->Flash->success(__('The apply has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The apply could not be saved. Please, try again.'));
            }
        }
        $modeuses = $this->Applies->Modeuses->find('list', ['limit' => 200]);
        $offers = $this->Applies->Offers->find('list', ['limit' => 200]);
        $this->set(compact('apply', 'modeuses', 'offers'));
        $this->set('_serialize', ['apply']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Apply id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $apply = $this->Applies->get($id);
        if ($this->Applies->delete($apply)) {
            $this->Flash->success(__('The apply has been deleted.'));
        } else {
            $this->Flash->error(__('The apply could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
