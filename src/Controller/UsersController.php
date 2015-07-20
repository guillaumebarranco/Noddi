<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Security;
use Cake\Controller\Component\CookieComponent;
use Cake\Core\Configure;
use App\Controller\CronController;

class UsersController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->loadModel('Activities');
        $this->loadModel('Favoris');
        $this->loadModel('Offers');
    }

    // Si l'utilisateur arrive sur la page index de Users, on le redirige sur la Home
    public function index() {
        $this->Jsonification();
        return $this->redirect(
            ['controller' => 'Home', 'action' => 'index']
        );
    }

    /*
    *   *** CONNEXION  MARQUE ***
    */

    public function login() {

        $session = $this->request->session();

        if($session->read('user') == true) {
            return $this->redirect(
                ['controller' => 'Offers', 'action' => 'index']
            );
        }

        // Si un formulaire a été envoyé
        if(isset($this->request->data) && $this->request->data) {

            $data = $this->request->data;

            // On récupère le user de la base de données
            $get_user = $this->Users->findByUsername($data['username'])->toArray();
            
            // Si le User existe bien
            if($get_user) {
                $get_user = $get_user[0];

                $data['password'] = Security::hash($data['password'], 'sha1', true);

                // On compare les informations rentrées dans le formulaire à celles de l'admin en base
                if($data['username'] == $get_user['username'] && $data['password'] == $get_user['password']) {

                    // On récupère le brand_id
                    $brand = $brand = $this->Brands->find('all')->where(['user_id' => $get_user->id])->toArray()[0];
                    $session->write('brand_id', $brand['id']);

                    // Si c'est bon, on met dans la session que l'utilisateur est admin, il n'aura plus besoin de s'authentifier
                    $this->writeSession($get_user, $brand);

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


    /*
    *   CONNEXION MODEUSE
    */

    public function loginFB() {

        $check = $this->Jsonification();
        $session = $this->request->session();

        if(isset($this->request->data) && $this->request->data) {

            $data = $this->request->data;
            $get_user = $this->Users->find('all')->where(['id_facebook' => $data['fb_id']])->toArray();

            // Si on trouve bien la modeuse
            if($get_user) {
                $get_user = $get_user[0];

                // On récupère l'id de la modeuse
                $modeuse = $this->Modeuses->find('all')->where(['user_id' => $get_user['id']])->toArray()[0];

                $this->writeSession($get_user, $modeuse);

                $save_modeuse = $this->Modeuses->get($modeuse['id']);
                $save_modeuse->fb_token = $data['fb_token'];

                $this->Modeuses->save($save_modeuse);

                $session->write('modeuse_id', $modeuse->id);
                $check = 'OK';
            }
        }

        echo $this->getResponse($check);
    }

    /*
    *   *** DECONNEXION ***
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


    public function sign_in() {

        $session = $this->request->session();

        if($session->read('user') == true) {
            return $this->redirect(
                ['controller' => 'Offers', 'action' => 'index']
            );
        }

    }


    /*
    *   *** INSCRIPTION  MODEUSE ***
    */

    public function sign_in_modeuse() {

        $session = $this->request->session();

        if($session->read('user') == true) {
            return $this->redirect(
                ['controller' => 'Offers', 'action' => 'index']
            );
        }

        $user = $this->Users->newEntity();

        if($this->request->is('post')) {

            $data = $this->request->data;

            $check_user = $this->Users->findByIdFacebook($data['id_facebook'])->toArray();

            // On vérifie qu'il n'existe pas déjà un user avec le même username
            if(!$check_user) {

                $check = $this->Jsonification();

                $user = $this->Users->patchEntity($user, $data);

                $data['password'] = Security::hash($data['password'], 'sha1', true);

                if($this->Users->save($user)) {

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
                    $data['id'] = $user[0]['id'];

                    // On se prépare à insérer la modeuse en BDD
                    $data['offers_attempted'] = 0;
                    $data['offers_accepted'] = 0;

                    $tabs_implode = array();
                    $tabs_implode[] = "lifestyle";
                    $tabs_implode[] = "personnality";
                    $tabs_implode[] = "hobbies";
                    $tabs_implode[] = "socialPresence";

                    for ($i=0; $i < count($tabs_implode); $i++) { 
                        $data[$tabs_implode[$i]] = implode(",", $data[$tabs_implode[$i]]);
                        str_replace("_", " ", $data[$tabs_implode[$i]]);
                    }

                    $data['boost'] = 1;

                    $modeuse = $this->Modeuses->newEntity();
                    $modeuse = $this->Modeuses->patchEntity($modeuse, $data);
                    

                    // On vériéfie que la sauvegarde a bien marché
                    if($this->Modeuses->save($modeuse)) {

                        $modeuse = $this->Modeuses->find('all')->where(['user_id' => $data['user_id']])->toArray()[0];
                        $modeuse_id = $modeuse->id;

                        $this->writeSession($data, $modeuse);

                        $session = $this->request->session();
                        $session->write('modeuse_id', $modeuse_id);

                        $check = 'OK';

                        // On met à jour les informations des RS de la Modeuse
                        $cron = new CronController();
                        $cron->launchModeuse($modeuse_id);
                    }

                    echo $this->getResponse($check);
                }

            } else {
                $this->Flash->error(__('Cet username a déjà été pris.'));
                return $this->redirect(['action' => 'sign_in']);
            }
        }
    }

    public function checkInstaFollowers($instagram = null) {

        $check = $this->Jsonification();

        $instagramClientId = "e7b008f986f64a8c9f94642520b4e0ea";
        $url = 'https://api.instagram.com/v1/users/search?q='.$instagram.'&client_id='.$instagramClientId;
        $json = $this->getJsonUrl($url);

        foreach($json->data as $user) { 
            if(strtolower($user->username) == strtolower($instagram)) {
                $userId = $user->id;
            }
        }

        if(isset($userId)) {

            $endpoint = 'https://api.instagram.com/v1/users/'.$userId.'/media/recent?client_id='.$instagramClientId;
            $insta_datas = $this->getEndpoint($endpoint);

            // GESTION DES DONNEES RETOURNEES

            if(isset($insta_datas['data'])) {

                if($insta_datas['data'][0]['user']['username']) {

                    // GET FOLLOWERS

                    $get_followers = 'https://api.instagram.com/v1/users/'.$userId.'/?client_id='.$instagramClientId;
                    $followers = $this->getEndpoint($get_followers);

                    if($followers['data']['counts']['followed_by'] > 199) {
                        $check = 'OK';
                    }
                }
            }
        }

        echo $this->getResponse($check);
    }

    /*
    *   INSCRIPTION BRAND
    */

    public function sign_in_brand() {

        $session = $this->request->session();

        if($session->read('user') == true) {
            return $this->redirect(
                ['controller' => 'Offers', 'action' => 'index']
            );
        }

        $user = $this->Users->newEntity();

        if($this->request->is('post')) {

            $data = $this->request->data;
            $check_user = $this->Users->findByUsername($data['username'])->toArray();

            // On vérifie qu'il n'existe pas déjà un user avec le même username
            if(!$check_user) {

                // On prépare l'insertion du User en BDD

                $data['id_facebook'] = '';
                $data['password'] = Security::hash($data['password'], 'sha1', true);

                $user = $this->Users->patchEntity($user, $data);

                if($this->Users->save($user)) {

                    $session = $this->request->session();

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
                    $data['id'] = $user[0]['id'];

                    $brand = $this->Brands->newEntity();
                    $brand = $this->Brands->patchEntity($brand, $data);

                    if (!$this->Brands->save($brand)) {
                        $this->Flash->error(__('The brand could not be saved. Please, try again.'));
                    }

                    $brand = $brand = $this->Brands->find('all')->where(['user_id' => $data['user_id']])->toArray()[0];
                    $brand_id = $brand->id;

                    $session->write('brand_id', $brand_id);

                    // Si c'est bon, on met dans la session que l'utilisateur est admin, il n'aura plus besoin de s'authentifier
                    $this->writeSession($data, $brand);
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

    /*
    *   FONCTION POUR RECUPERER LES MODEUSES SUR LA PAGE NODDIZ
    */

    public function getModeuses() {

        $this->Jsonification();
        $session = $this->request->session();

        if(isset($this->request->data) && $this->request->data) {
            $data = $this->request->data;

            $modeuses = $this->Modeuses->find('all')->contain(['Users']);

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

            $offer = $this->Offers->find('all')->where(['brand_id' => $session->read('brand_id'), 'modeuse_id IS' => null])->contain(['Brands'])->toArray()[0];

            $modeuses = $this->Modeuses->find('all')->contain(['Users'])->toArray();

            $tab_modeuses = array();
            $tab_id = array();

            foreach ($modeuses as $key => $modeuse) {

                $favori = $this->Favoris->find('all')->where(['brand_id' => $session->read('brand_id'), 'modeuse_id' => $modeuse->id])->toArray();

                // Si trop de followers pour un réseau, on rajoute un "k" pour 1000 ou un "M" pour 1 000 000

                if($modeuse->insta_followers > 1000 && $modeuse->insta_followers < 1000000) {
                    $modeuse->insta_followers = round($modeuse->insta_followers/1000, 0, PHP_ROUND_HALF_UP).'k';
                } else if($modeuse->insta_followers > 1000000) {
                    $modeuse->insta_followers = round($modeuse->insta_followers/1000000, 0, PHP_ROUND_HALF_UP).'M';
                }

                if($modeuse->twitter_followers > 1000 && $modeuse->twitter_followers < 1000000) {
                    $modeuse->twitter_followers = round($modeuse->twitter_followers/1000, 0, PHP_ROUND_HALF_UP).'k';
                } else if($modeuse->twitter_followers > 1000000) {
                    $modeuse->twitter_followers = round($modeuse->twitter_followers/1000000, 0, PHP_ROUND_HALF_UP).'M';
                }

                if($modeuse->facebook_followers > 1000 && $modeuse->facebook_followers < 1000000) {
                    $modeuse->facebook_followers = round($modeuse->facebook_followers/1000, 0, PHP_ROUND_HALF_UP).'k';
                } else if($modeuse->facebook_followers > 1000000) {
                    $modeuse->facebook_followers = round($modeuse->facebook_followers/1000000, 0, PHP_ROUND_HALF_UP).'M';
                }
                
                if(!empty($favori[0])) {
                    $modeuse['already_favori'] = true;
                    $modeuse['favori_id'] = $favori[0]['id'];
                } else {
                    $modeuse['already_favori'] = false;
                }

                $tab_lifestyle = explode(',', $modeuse->lifestyle);
                
                if(in_array($offer->lifestyle, $tab_lifestyle)) {
                    if(!in_array($modeuse->id, $tab_id)) {
                        $tab_id[] = $modeuse->id;
                        $tab_modeuses[] = $modeuse;
                    }
                } else {
                    if(!in_array($modeuse->id, $tab_id) && $offer->lifestyle == 'indifférent') {
                        $tab_id[] = $modeuse->id;
                        $tab_modeuses[] = $modeuse;
                    }
                }

                $tab_personnality = explode(',', $modeuse->personnality);

                if(in_array($offer->personnality, $tab_personnality)) {
                    if(!in_array($modeuse->id, $tab_id)) {
                        $tab_id[] = $modeuse->id;
                        $tab_modeuses[] = $modeuse;
                    }
                } else {
                    if(!in_array($modeuse->id, $tab_id) && $offer->personnality == 'peu importe') {
                        $tab_id[] = $modeuse->id;
                        $tab_modeuses[] = $modeuse;
                    }
                }
            }
        }

        $response = array();
        $response['modeuses'] = $tab_modeuses;

        $this->response->body(json_encode($response));
        return $this->response;
    }

    public function checkModeuse() {
        $check = $this->Jsonification();


        $data = $this->request->data;

        $user = $this->Users->find('all')->where(['id_facebook' => $data['id']])->toArray();

        if(!isset($user[0])) {
            $check = 'OK';
        }

        echo $this->getResponse($check);
    }

}
