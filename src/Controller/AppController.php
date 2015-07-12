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
}
