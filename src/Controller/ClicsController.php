<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Clics Controller
 *
 * @property \App\Model\Table\ClicsTable $Clics
 */
class ClicsController extends AppController
{

    public function initialize() {
        parent::initialize();

        // On récupère les composants pour la Pagination, le renvoi de JSON....
        $this->loadComponent('RequestHandler');

        $session = $this->request->session();
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('clics', $this->paginate($this->Clics));
        $this->set('_serialize', ['clics']);
    }

    /**
     * View method
     *
     * @param string|null $id Clic id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clic = $this->Clics->get($id, [
            'contain' => []
        ]);
        $this->set('clic', $clic);
        $this->set('_serialize', ['clic']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->autoRender = false;
        $this->layout = null;
        $this->RequestHandler->renderAs($this, 'json');

        $clic = $this->Clics->newEntity();
        if ($this->request->is('post')) {
            $all_clics = $this->Clics->find('all')->where(['name' => $this->request->data['name']])->toArray();

            $clic = $all_clics[0];

            $counter = $clic->counter + 1;

            $this->request->data['counter'] = $counter;            

            $clic = $this->Clics->patchEntity($clic, $this->request->data);
            if ($this->Clics->save($clic)) {
                $this->Flash->success(__('The clic has been saved.'));
                $check = 'ok';
            } else {
                $check = 'ko';
                $this->Flash->error(__('The clic could not be saved. Please, try again.'));
            }
        }

         echo json_encode($check);
    }

    /**
     * Edit method
     *
     * @param string|null $id Clic id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clic = $this->Clics->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clic = $this->Clics->patchEntity($clic, $this->request->data);
            if ($this->Clics->save($clic)) {
                $this->Flash->success(__('The clic has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The clic could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('clic'));
        $this->set('_serialize', ['clic']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Clic id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clic = $this->Clics->get($id);
        if ($this->Clics->delete($clic)) {
            $this->Flash->success(__('The clic has been deleted.'));
        } else {
            $this->Flash->error(__('The clic could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
