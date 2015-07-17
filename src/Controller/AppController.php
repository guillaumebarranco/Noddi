<?php
namespace App\Controller;

use Cake\Controller\Controller;

class AppController extends Controller
{

    public function initialize() {
        parent::initialize();
        $this->loadComponent('Flash');
        $this->loadComponent('RequestHandler');
        $this->loadModel('Users');
        $this->loadModel('Modeuses');
        $this->loadModel('Brands');
    }

    function checkSession() {
        $session = $this->request->session();

        //if($session->read('user') == null) {
        return $this->redirect(
            ['controller' => 'Users', 'action' => 'login']
        );
       // }
    }

    function Jsonification() {
        $this->autoRender = false;
        $this->layout = null;
        $this->RequestHandler->renderAs($this, 'json');
        return 'KO';
    }

    function getResponse($check = 'KO') {
        $response = array();
        $response['check'] = $check;
        return json_encode($response);
    }

    public function getCurrentOffer() {
        $session = $this->request->session();

        $brand = $this->Brands->find('all')->where(['user_id' => $session->read('user_id')])->toArray();
        
        $offers = $this->Offers->find('all')->where(['brand_id' => $brand[0]['id'], 'modeuse_id IS' => null])->contain(['Types'])->toArray();
        return $offers;
    }

    function writeSession($get_user) {
        $session = $this->request->session();
        $session->write('user', true);
        $session->write('username', $get_user['username']);
        $session->write('password', $get_user['password']);
        $session->write('user_id', $get_user['id']);
        $session->write('type', $get_user['type']);
    }
}
