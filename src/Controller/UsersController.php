<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Security;
use Cake\Controller\Component\CookieComponent;
use Cake\Core\Configure;

class UsersController extends AppController
{

    public function initialize() {
        parent::initialize();

        // On récupère les composants pour la Pagination, le renvoi de JSON....
        $this->loadModel('Activities');
    }

    /*
    *   *** CONNEXION ***
    *
    *   FONCTIONNELLE
    */

    public function index() {
        return $this->redirect(
            ['controller' => 'Home', 'action' => 'index']
        );
    }

    public function login() {

        $session = $this->request->session();

        if(null != ($session->read('user')) && $session->read('user') == true) {

            return $this->redirect(
                ['controller' => 'Home', 'action' => 'index']
            );
        }

        $session = $this->request->session();

        // Si un formulaire a été envoyé
        if(isset($this->request->data) && $this->request->data) {

            $data = $this->request->data;

            // On récupère le user de la base de données
            
            $get_user = $this->Users->findByUsername($data['username'])->toArray();
            
            if($get_user) {
                $get_user = $get_user[0];

                $data['password'] = Security::hash($data['password'], 'sha1', true);

                // On compare les informations rentrées dans le formulaire à celles de l'admin en base
                if($data['username'] == $get_user['username'] && $data['password'] == $get_user['password']) {
                        
                    // Si c'est bon, on met dans la session que l'utilisateur est admin, il n'aura plus besoin de s'authentifier
                    $session->write('user', true);
                    $session->write('username', $get_user['username']);
                    $session->write('password', $get_user['password']);
                    $session->write('user_id', $get_user['id']);
                    $session->write('type', $get_user['type']);

                    $brand_id = $brand = $this->Brands->find('all')->where(['user_id' => $session->read('user_id')])->toArray()[0]['id'];

                    $session->write('brand_id', $brand_id);

                    return $this->redirect(
                        ['controller' => 'Home', 'action' => 'index']
                    );
                }

                $this->Flash->error(__('Le mot de passe ne correspond pas.'));

            } else {
                $this->Flash->error(__('Les informations rentrées ne correspondent à aucun utilisateur.'));
            }
        }
    }

    public function loginFB() {

        $check = $this->Jsonification();

        $session = $this->request->session();

        if(isset($this->request->data) && $this->request->data) {

            $data = $this->request->data;

            $get_user = $this->Users->find('all')->where(['id_facebook' => $data['fb_id']])->toArray();

            if($get_user) {
                $get_user = $get_user[0];

                $session->write('user', true);
                $session->write('username', $get_user['username']);
                $session->write('password', $get_user['password']);
                $session->write('user_id', $get_user['id']);
                $session->write('type', $get_user['type']);

                $check = 'OK';
            }
        }

        echo $this->getResponse($check);
    }

    /*
    *   *** DECONNEXION ***
    *
    *   FONCTIONNELLE
    */

    public function disconnect() {

        $session = $this->request->session();

        $session->destroy();

        if($this->Cookie && $this->Cookie->read('user')) {
            $this->Cookie->delete('user');
            $this->Cookie->delete('username');
            $this->Cookie->delete('password');
        }

        return $this->redirect(
            ['controller' => 'Home', 'action' => 'index']
        );
    }

    /*
    *   *** INSCRIPTION ***
    *
    *   VERIFICATION USER DEJA EXISTANT = Fait, à tester
    *   ENREGISTREMENT USER DANS LA BDD = Fait, à tester
    *   CREER MARQUE OU MODEUSE = Fait, à tester

    *   SESSION = Fait, à tester
    *   COOKIES = Fait, à tester
    *   
    *   REDIRECTION CREATION DU PROFIL = Fait, à tester
    *
    */

    public function sign_in() {

    }

    public function sign_in_modeuse() {

        $user = $this->Users->newEntity();

        if($this->request->is('post')) {

            $data = $this->request->data;

            $check_user = $this->Users->findByUsername($data['username'])->toArray();

            // On vérifie qu'il n'existe pas déjà un user avec le même username
            if(!$check_user) {

                $user = $this->Users->patchEntity($user, $data);

                $data['password'] = Security::hash($data['password'], 'sha1', true);

                if($this->Users->save($user)) {

                    $session = $this->request->session();

                    // On créé la session
                    $session->write('user', true);
                    $session->write('username', $data['username']);
                    $session->write('password', $data['password']);

                    // On créé les cookies
                    // $this->Cookie->config('path', '/');
                    // $this->Cookie->config([
                    //     'expires' => '+10 days',
                    //     'httpOnly' => true
                    // ]);

                    // $this->Cookie->write('user', true);
                    // $this->Cookie->write('username', $data['username']);
                    // $this->Cookie->write('password', $data['password']);

                    $user = $this->Users->find()->where(['username' => $data['username']])->toArray();

                    $data['user_id'] = $user[0]['id'];

                    $session->write('user_id', $data['user_id']);

                    $data['offers_attempted'] = 0;
                    $data['offers_accepted'] = 0;

                    $modeuse = $this->Modeuses->newEntity();
                    $modeuse = $this->Modeuses->patchEntity($modeuse, $data);

                
                    if(!$this->Modeuses->save($modeuse)) {
                        $this->Flash->error(__('The modeuse could not be saved. Please, try again.'));
                    }

                    $session->write('type', $data['type']);

                    $modeuse_id = $this->Modeuses->find('all')->where(['user_id' => $session->read('user_id')])->toArray()[0]['id'];

                    $session->write('modeuse_id', $modeuse_id);
                    $session->write('type', $data['type']);
                }

            } else {
                $this->Flash->error(__('Cet username a déjà été pris.'));
                return $this->redirect(['action' => 'sign_in']);
            }

            return $this->redirect(
                ['controller' => 'Profil', 'action' => 'index']
            );
        }
    }

    public function sign_in_brand() {

        $user = $this->Users->newEntity();

        if($this->request->is('post')) {

            $data = $this->request->data;
            $check_user = $this->Users->findByUsername($data['username'])->toArray();

            // On vérifie qu'il n'existe pas déjà un user avec le même username
            if(!$check_user) {

                $data['id_facebook'] = '';

                $data['password'] = Security::hash($data['password'], 'sha1', true);

                // var_dump($data);
                // die;

                $user = $this->Users->patchEntity($user, $data);

                // var_dump($user->beforeSave());
                // die;

                if($this->Users->save($user)) {

                    $session = $this->request->session();

                    // On créé la session
                    $session->write('user', true);
                    $session->write('username', $data['username']);
                    $session->write('password', $data['password']);

                    // On créé les cookies
                    // $this->Cookie->config('path', '/');
                    // $this->Cookie->config([
                    //     'expires' => '+10 days',
                    //     'httpOnly' => true
                    // ]);

                    // $this->Cookie->write('user', true);
                    // $this->Cookie->write('username', $data['username']);
                    // $this->Cookie->write('password', $data['password']);

                    $user = $this->Users->find()->where(['username' => $data['username']])->toArray();

                    $data['user_id'] = $user[0]['id'];

                    $session->write('user_id', $data['user_id']);

                    

                    $brand = $this->Brands->newEntity();

                    $brand = $this->Users->patchEntity($brand, $data);

                    if (!$this->Brands->save($brand)) {
                        $this->Flash->error(__('The brand could not be saved. Please, try again.'));
                    }

                    $brand_id = $brand = $this->Brands->find('all')->where(['user_id' => $session->read('user_id')])->toArray()[0]['id'];

                    $session->write('brand_id', $brand_id);
                    $session->write('type', $data['type']);
                
                }

            } else {
                $this->Flash->error(__('Cet username a déjà été pris.'));
                return $this->redirect(['action' => 'sign_in']);
            }

            return $this->redirect(
                ['controller' => 'Profil', 'action' => 'index']
            );
        }

        $activities = $this->Activities->find('all')->toArray();

        $this->set(array(
            'activities' => $activities
        ));
        
        $this->set('_serialize', ['activities']);
    }

    public function updatePicture() {

        $check = $this->Jsonification();

        if(isset($this->request->data)) {
            $data = $this->request->data;

            $user = $this->Users->get($data['user_id']);
            $user->picture = $data['picture'];
            $this->Users->save($user);

            $check = 'OK';
        }

        echo $this->getResponse($check);
    }

    public function sendMail($email = null, $message = null) {

    }

    public function getModeuses() {

        $this->Jsonification();

        if(isset($this->request->data) && $this->request->data) {
            $data = $this->request->data;

            $modeuses = $this->Modeuses->find('all')
            ->contain(['Users']);

            if($data['blog'] == 'yes') {
                $modeuses = $modeuses ->where(['Users.website !=' => '']);
            } elseif($data['blog'] == 'no') {
                $modeuses = $modeuses ->where(['Users.website' => '']);
            }

            if($data['audience'][0] == 'beginner') {
                $modeuses = $modeuses ->where(['Modeuses.noddi_rank' => 1]);
            } elseif($data['audience'][0] == 'medium') {
                $modeuses = $modeuses ->where(['Modeuses.noddi_rank' => 2]);
            } elseif($data['audience'][0] == 'expert') {
                $modeuses = $modeuses ->where(['Modeuses.noddi_rank' => 3]);
            }

            $modeuses = $modeuses->toArray();

        } else {
            $modeuses = $this->Modeuses->find('all')->contain(['Users'])->toArray();
        }

        $response = array();
        $response['modeuses'] = $modeuses;
        echo json_encode($response);
    }

}
