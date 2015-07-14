<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Modeuses Controller
 *
 * @property \App\Model\Table\ModeusesTable $Modeuses
 */
class ModeusesController extends AppController
{

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

    /**
     * View method
     *
     * @param string|null $id Modeus id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
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

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $modeus = $this->Modeuses->newEntity();
        if ($this->request->is('post')) {
            $modeus = $this->Modeuses->patchEntity($modeus, $this->request->data);
            if ($this->Modeuses->save($modeus)) {
                $this->Flash->success(__('The modeus has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The modeus could not be saved. Please, try again.'));
            }
        }
        $users = $this->Modeuses->Users->find('list', ['limit' => 200]);
        $this->set(compact('modeus', 'users'));
        $this->set('_serialize', ['modeus']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Modeus id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $modeus = $this->Modeuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $modeus = $this->Modeuses->patchEntity($modeus, $this->request->data);
            if ($this->Modeuses->save($modeus)) {
                $this->Flash->success(__('The modeus has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The modeus could not be saved. Please, try again.'));
            }
        }
        $users = $this->Modeuses->Users->find('list', ['limit' => 200]);
        $this->set(compact('modeus', 'users'));
        $this->set('_serialize', ['modeus']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Modeus id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $modeus = $this->Modeuses->get($id);
        if ($this->Modeuses->delete($modeus)) {
            $this->Flash->success(__('The modeus has been deleted.'));
        } else {
            $this->Flash->error(__('The modeus could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
