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
                                    $datas['instagram'][$modeuse->instagram][$k] = array();
                                    $datas['instagram'][$modeuse->instagram][$k]['picture'] = $the_data['images']['standard_resolution']['url'];
                                    $datas['instagram'][$modeuse->instagram][$k]['link'] = $the_data['link'];
                                    $datas['instagram'][$modeuse->instagram][$k]['title'] = $the_data['caption']['text'];
                                    $k++;
                                }
                            }
                        }
                    }
                }
            }

            
        }

        //return $datas;

        var_dump($datas);
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

                            if('ok' == 'ok') { 
                                // Filter by posts saved

                                $datas['twitter'][$modeuse->twitter][$t] = array();
                                $datas['twitter'][$modeuse->twitter][$t]['text'] = $status['text'];
                                $datas['twitter'][$modeuse->twitter][$t]['link'] = 'https://twitter.com/'.$modeuse->twitter.'/status/'.$status['id_str'];
                                $t++;
                            }
                        }
                    }
                }
            }
        }

        var_dump($datas);
    }

    function matching() {
        
    }

}
