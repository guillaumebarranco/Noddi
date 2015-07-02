<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Landings Controller
 *
 * @property \App\Model\Table\LandingsTable $Landings
 */
class LandingsController extends AppController
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
        $this->set('landings', $this->paginate($this->Landings));
        $this->set('_serialize', ['landings']);
    }

    /**
     * View method
     *
     * @param string|null $id Landing id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $landing = $this->Landings->get($id, [
            'contain' => []
        ]);
        $this->set('landing', $landing);
        $this->set('_serialize', ['landing']);
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

        $landing = $this->Landings->newEntity();
        if ($this->request->is('post')) {
            $landing = $this->Landings->patchEntity($landing, $this->request->data);
            if ($this->Landings->save($landing)) {
                $this->Flash->success(__('The landing has been saved.'));
                $check = 'ok';
                //return $this->redirect(['action' => 'index']);
            } else {
                $check = 'ko';
                $this->Flash->error(__('The landing could not be saved. Please, try again.'));
            }
        }

        echo json_encode($check);
    }

    /**
     * Edit method
     *
     * @param string|null $id Landing id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $landing = $this->Landings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $landing = $this->Landings->patchEntity($landing, $this->request->data);
            if ($this->Landings->save($landing)) {
                $this->Flash->success(__('The landing has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The landing could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('landing'));
        $this->set('_serialize', ['landing']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Landing id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $landing = $this->Landings->get($id);
        if ($this->Landings->delete($landing)) {
            $this->Flash->success(__('The landing has been deleted.'));
        } else {
            $this->Flash->error(__('The landing could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
