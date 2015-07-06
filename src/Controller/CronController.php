<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Security;

class CronController extends AppController
{

    public function initialize() {
        parent::initialize();
    }

    function Jsonification() {
        $this->autoRender = false;
        $this->layout = null;
        $this->RequestHandler->renderAs($this, 'json');
    }

    function getInstaDatas() {
        
    }

    function getFacebookDatas() {
        
    }

    function getTwitterDatas() {
        
    }

    function matching() {
        
    }

}
