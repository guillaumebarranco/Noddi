<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 */
class MessagesController extends AppController {



    /*
    *   On affiche les Messages en fonction de l'utilisateur connecté
    */
    public function index() {

        $session = $this->request->session();

        if($session->read('type') === 'brand') {
            $messages = $this->Messages->find('all')->contain(['Offers', 'Offers.Modeuses']);

            $tab_offers = array();

            foreach ($messages as $key => $message) {

                //var_dump($message->offer->modeus->firstname);

                if(isset($message->offer->modeus->firstname)) {

                    if(!isset($tab_offers[$message->offer->id])) {

                        $tab_offers[$message->offer->id] = array();
                        $tab_offers[$message->offer->id]['created'] = $message->created;
                        $tab_offers[$message->offer->id]['message'] = $message->content;
                        $tab_offers[$message->offer->id]['firstname'] = $message->offer->modeus->firstname;
                        $tab_offers[$message->offer->id]['lastname'] = $message->offer->modeus->lastname;
                        $tab_offers[$message->offer->id]['id'] = $message->offer->id;
                    } else {
                        if($message->created > $tab_offers[$message->offer->id]) {
                            $tab_offers[$message->offer->id]['created'] = $message->created;
                            $tab_offers[$message->offer->id]['message'] = $message->content;
                            $tab_offers[$message->offer->id]['firstname'] = $message->offer->modeus->firstname;
                            $tab_offers[$message->offer->id]['lastname'] = $message->offer->modeus->lastname;
                            $tab_offers[$message->offer->id]['id'] = $message->offer->id;
                        }
                    }
                }
            }

        } else {
            $messages = $this->Messages->find('all')->where(['modeuse_id' => $session->read('modeuse_id')])->contain(['Brands', 'Modeuses']);
        }

        $this->set(array(
            'messages' => $messages,
            'tab_offers' => $tab_offers
        ));

        $this->set('_serialize', ['messages, tab_offers']);
    }

    public function getMessagesByOffer() {

        $this->Jsonification();

        $data = $this->request->data;

        $messages = $this->Messages->find('all')->where(['offer_id' => $data['offer_id']])->contain(['Offers', 'Offers.Modeuses']);

        $response = array();
        $response['messages'] = $messages;

        $this->response->body(json_encode($response));
        return $this->response;
    }







    public function view($id = null) {
        $message = $this->Messages->get($id, [
            'contain' => ['Brands', 'Modeuses']
        ]);
        $this->set('message', $message);
        $this->set('_serialize', ['message']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $check = $this->Jsonification();
        $message = $this->Messages->newEntity();

        if ($this->request->is('post')) {

            $this->request->data['from_who'] = $this->request->session()->read('type');

            $message = $this->Messages->patchEntity($message, $this->request->data);

            if ($this->Messages->save($message)) {
                $check = 'OK';
            } else {
                $this->Flash->error(__('The message could not be saved. Please, try again.'));
            }
        }

        echo $this->getResponse($check);
    }

    /**
     * Delete method
     *
     * @param string|null $id Message id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $message = $this->Messages->get($id);
        if ($this->Messages->delete($message)) {
            $this->Flash->success(__('The message has been deleted.'));
        } else {
            $this->Flash->error(__('The message could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function updateView() {
        $check = $this->Jsonification();

        $message = $this->Messages->get($this->request->data['message_id']);
        $message->viewed = 1;
        if($this->Messages->save($message)) {
            $check = 'OK';
        }

        echo $this->getResponse($check);
    }

    public function updateAnswer() {
        $check = $this->Jsonification();

        $message = $this->Messages->get($this->request->data['message_id']);
        $message->answered = 1;
        if($this->Messages->save($message)) {
            $check = 'OK';
        }

        echo $this->getResponse($check);
    }
}
