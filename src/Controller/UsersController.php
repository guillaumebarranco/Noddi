<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Security;

class UsersController extends AppController
{

    public function initialize() {
        parent::initialize();

        // On récupère les composants pour la Pagination, le renvoi de JSON....
        $this->loadComponent('RequestHandler');

        $session = $this->request->session();

        if(null != ($session->read('user')) && $session->read('user') == true) {

            return $this->redirect(
                ['controller' => 'Home', 'action' => 'index']
            );
        }
    }

    function Jsonification() {
        $this->autoRender = false;
        $this->layout = null;
        $this->RequestHandler->renderAs($this, 'json');
    }

    /*
    *   *** CONNEXION ***
    *
    *   FONCTIONNELLE
    */

    public function login() {

        $session = $this->request->session();

        // Si un formulaire a été envoyé
        if(isset($this->request->data) && $this->request->data) {

            $data = $this->request->data;

            // On récupère l'admin de la base de données
            
            // $user_admin = $this->Users->findByUsername($data['username'])->toArray();
            // $user_admin = $user_admin[0];
            $user_admin = array();
            $user_admin['username'] = 'test';
            $user_admin['password'] = Security::hash('test', 'sha1', true);

            if($user_admin) {

                $data['password'] = Security::hash($data['password'], 'sha1', true);

                // On compare les informations rentrées dans le formulaire à celles de l'admin en base
                
                //if($data['username'] == $user_admin->username && $data['password'] == $user_admin->password) {
                if($data['username'] == $user_admin['username'] && $data['password'] == $user_admin['password']) {
                        
                    // Si c'est bon, on met dans la session que l'utilisateur est admin, il n'aura plus besoin de s'authentifier
                    $session->write('user', true);
                }
            }           

            return $this->redirect(
                ['controller' => 'Home', 'action' => 'index']
            );
        }
    }

    /*
    *   *** DECONNEXION ***
    *
    *   FONCTIONNELLE
    */

    public function disconnect() {

        $session = $this->request->session();

        $session->destroy();
        $this->Cookie->delete('user');
        $this->Cookie->delete('username');
        $this->Cookie->delete('password');

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

        $session = $this->request->session();

        $user = $this->Users->newEntity();

        if($this->request->is('post')) {

            $data = $this->request->data;

            // $user_admin = $this->Users->findByUsername($data['user']['username'])->toArray();
            // $user_admin = $user_admin[0];

            // On vérifie qu'il n'existe pas déjà un user avec le même username
            if(!$user_admin) {

                $user = $this->Users->patchEntity($user, $data['user']);

                if($this->Users->save($user)) {

                    // On créé la session
                    $session->write('user', true);
                    $session->write('username', $data['user']['username']);
                    $session->write('password', $data['user']['password']);

                    // On créé les cookies
                    $this->Cookie->config('path', '/');
                    $this->Cookie->config([
                        'expires' => '+10 days',
                        'httpOnly' => true
                    ]);
                    $this->Cookie->write('user', true);
                    $this->Cookie->write('username', $data['user']['username']);
                    $this->Cookie->write('password', $data['user']['password']);

                    // On créé le type
                    if($data['type'] == 'modeuse') {

                        $modeuse = $this->Modeuses->newEntity();

                        $modeuse = $this->Modeuses->patchEntity($modeuse, $data['modeuse']);
                    
                        if ($this->Modeuses->save($modeuse)) {
                            $this->Flash->success(__('The modeuse has been saved.'));
                        } else {
                            $this->Flash->error(__('The modeuse could not be saved. Please, try again.'));
                        }

                    } elseif($data['type'] == 'brand') {

                        $brand = $this->Brands->newEntity();

                        $brand = $this->Brands->patchEntity($brand, $data['brand']);
                    
                        if ($this->Brands->save($brand)) {
                            $this->Flash->success(__('The brand has been saved.'));
                        } else {
                            $this->Flash->error(__('The brand could not be saved. Please, try again.'));
                        }
                    }
                }

            } else {
                $this->Flash->error(__('Cet username a déjà été pris.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        return $this->redirect(
            ['controller' => 'Profil', 'action' => 'index']
        );
    }

    public function sendMail($email = null, $message = null) {

    }

}
