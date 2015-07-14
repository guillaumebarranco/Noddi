<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Security;
use Twitter\twitter\TwitterAPIExchange;

class CronController extends AppController
{

    public function initialize() {
        parent::initialize();

        $this->loadModel('Users');
        $this->loadModel('Modeuses');
        $this->loadModel('Brands');
        $this->loadModel('Posts');

        $this->loadComponent('RequestHandler');
    }

    function Jsonification() {
        $this->autoRender = false;
        $this->layout = null;
        $this->RequestHandler->renderAs($this, 'json');
    }

    function launch() {
        $this->getInstaDatas();
        $this->getTwitterDatas();
        die;
    }


    /*
    *   RETOURNE UN TABLEAU DE PHOTOS PAR MODEUSE POUR CHAQUE MODEUSE AYANT UN COMPTE INSTAGRAM
    */
    function getInstaDatas() {

        $instagramClientId = "e7b008f986f64a8c9f94642520b4e0ea";

        $this->Jsonification();

        $modeuses = $this->Modeuses->find('all')->contain(['Users']);

        $datas = array();
        $datas['instagram'] = array();
        
        foreach ($modeuses as $key => $modeuse) {
            if($modeuse->instagram != null) {

                $url = 'https://api.instagram.com/v1/users/search?q='.$modeuse->instagram.'&client_id='.$instagramClientId;
                $get = file_get_contents($url);
                $json = json_decode($get);

                foreach($json->data as $user) { 
                    if(strtolower($user->username) == strtolower($modeuse->instagram)) {
                        $userId = $user->id;
                    }       
                }

                if (isset($userId)) {

                    $endpoint = 'https://api.instagram.com/v1/users/'.$userId.'/media/recent?client_id='.$instagramClientId;

                    $curl = curl_init($endpoint);
                    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 3);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

                    $json = curl_exec($curl);

                    $insta_datas = json_decode($json, true);

                    // GESTION DES DONNEES RETOURNEES

                    if ($insta_datas['data'][0]['user']['username']) {

                        // GET FOLLOWERS

                        $get_followers = 'https://api.instagram.com/v1/users/'.$userId.'/?client_id='.$instagramClientId;

                        $curl = curl_init($get_followers);
                        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 3);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

                        $json = curl_exec($curl);

                        $followers = json_decode($json, true);

                        // DATAS
                        $datas['instagram'][$modeuse->instagram] = array();
                        $datas['instagram'][$modeuse->instagram]['nb_followers'] = $followers['data']['counts']['followed_by'];
                        $datas['instagram'][$modeuse->instagram]['username'] = $insta_datas['data'][0]['user']['username'];
                        $k = 1;

                        $the_modeuse = $this->Modeuses->get($modeuse->id);
                        $the_modeuse->insta_followers = $datas['instagram'][$modeuse->instagram]['nb_followers'];
                        $this->Modeuses->save($the_modeuse);

                        foreach ($insta_datas as $key => $insta) {
                            foreach ($insta as $key => $the_data) {
                                if(isset($the_data['images']['standard_resolution']) && $the_data['images']['standard_resolution'] != null) {

                                    if($k < 4) {
                                        $search_post = $this->Posts
                                            ->find('all')
                                            ->where(['modeuse_id' => $modeuse->id, 'number' => $k, 'social' => 'instagram'])
                                            ->toArray();

                                        if(!empty($search_post)) {
                                            $search_post = $search_post[0];

                                            $this->Posts->id = $search_post['id'];
                                            $search_post->social = 'instagram';
                                            $search_post->title = $the_data['link'];
                                            $search_post->content = $the_data['caption']['text'];
                                            $search_post->picture = $the_data['images']['standard_resolution']['url'];

                                            $this->Posts->save($search_post);
                                        } else {
                                            $post = $this->Posts->newEntity();
                                            $post->modeuse_id = $modeuse->id;
                                            $post->social = 'instagram';
                                            $post->title = $the_data['link'];
                                            $post->content = $the_data['caption']['text'];
                                            $post->picture = $the_data['images']['standard_resolution']['url'];
                                            $post->number = $k;

                                            if($this->Posts->save($post)) {
                                                $search_post = $this->Posts
                                                    ->find('all')
                                                    ->where(['modeuse_id' => $modeuse->id, 'number' => $k, 'social' => 'instagram'])
                                                    ->toArray();
                                            }
                                        }
                                        $k++;
                                    }
                                }
                            }
                        }
                    }
                }
            }

            
        }
    }

    function getFacebookDatas() {
        
    }

    function getTwitterDatas() {

        $settings = array(
            'oauth_access_token' => "2538080443-DumgtCTU5i7SrlKZKq65Em7fhXHoJyLPpM5tQ2F",
            'oauth_access_token_secret' => "WiCcmfos8s4enGJfKNDuVlfIC81l1XsvjQdhRSyKZsT8G",
            'consumer_key' => "4s5F89RTeHhreISVbZT9BmSPn",
            'consumer_secret' => "AIvRHR6Aopnj8GyFx8j7KkaGjYc6Yw3I5RYcXrc75sWlwax69p"
        );

        $this->Jsonification();

        $modeuses = $this->Modeuses->find('all')->contain(['Users']);

        $datas = array();
        $datas['twitter'] = array();
        
        foreach ($modeuses as $key => $modeuse) {
            if($modeuse->twitter != null) {

                $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
                $getfield = '?screen_name='.$modeuse->twitter;
                $requestMethod = 'GET';

                $twitter = new TwitterAPIExchange($settings);

                $json_twitter = $twitter->setGetfield($getfield)
                    ->buildOauth($url, $requestMethod)
                    ->performRequest();

                $twitter_datas = json_decode($json_twitter, true);

                if (isset($twitter_datas[0]['user']['screen_name'])) {

                    $datas['twitter'][$modeuse->twitter] = array();
                    $datas['twitter'][$modeuse->twitter]['nb_followers'] = $twitter_datas[0]['user']['followers_count'];
                    $datas['twitter'][$modeuse->twitter]['username'] = $twitter_datas[0]['user']['screen_name'];


                    $the_modeuse = $this->Modeuses->get($modeuse->id);
                    $the_modeuse->twitter_followers = $datas['twitter'][$modeuse->twitter]['nb_followers'];
                    $this->Modeuses->save($the_modeuse);

                    $t = 1;

                    foreach ($twitter_datas as $key => $status) {
                        if(empty($status['retweeted_status']) && $status['in_reply_to_status_id'] === null) {

                            if($t < 4) {
                                $search_post = $this->Posts
                                    ->find('all')
                                    ->where(['modeuse_id' => $modeuse->id, 'number' => $t, 'social' => 'twitter'])
                                    ->toArray();

                                if(!empty($search_post)) {
                                    $search_post = $search_post[0];

                                    $this->Posts->id = $search_post['id'];
                                    $search_post->social = 'twitter';
                                    $search_post->title = 'https://twitter.com/'.$modeuse->twitter.'/status/'.$status['id_str'];
                                    $search_post->content = $status['text'];
                                    $search_post->picture = $status['text'];

                                    $this->Posts->save($search_post);
                                } else {
                                    $post = $this->Posts->newEntity();
                                    $post->modeuse_id = $modeuse->id;
                                    $post->social = 'twitter';
                                    $post->title = 'https://twitter.com/'.$modeuse->twitter.'/status/'.$status['id_str'];
                                    $post->content = $status['text'];
                                    $post->picture = $status['text'];
                                    $post->number = $t;

                                    if($this->Posts->save($post)) {
                                        $search_post = $this->Posts
                                            ->find('all')
                                            ->where(['modeuse_id' => $modeuse->id, 'number' => $t, 'social' => 'instagram'])
                                            ->toArray();
                                    }
                                }
                                $t++;
                            }
                        }
                    }
                }
            }
        }
    }

    function matching() {
        
    }

}
