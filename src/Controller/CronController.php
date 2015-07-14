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
                                            $search_post->likes = $the_data['likes']['count'];
                                            $search_post->comments = $the_data['comments']['count'];
                                            $search_post->shares = '';

                                            $this->Posts->save($search_post);
                                        } else {
                                            $post = $this->Posts->newEntity();
                                            $post->modeuse_id = $modeuse->id;
                                            $post->social = 'instagram';
                                            $post->title = $the_data['link'];
                                            $post->content = $the_data['caption']['text'];
                                            $post->picture = $the_data['images']['standard_resolution']['url'];
                                            $post->number = $k;
                                            $post->likes = $the_data['likes']['count'];
                                            $post->comments = $the_data['comments']['count'];
                                            $post->shares = '';

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
        die;
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
                                    $search_post->likes = $status['favorite_count'];
                                    $search_post->comments = $status['retweet_count'];
                                    $search_post->shares = '';
                                    $search_post->nb_tweets = $status['user']['statuses_count'];

                                    $this->Posts->save($search_post);
                                } else {
                                    $post = $this->Posts->newEntity();
                                    $post->modeuse_id = $modeuse->id;
                                    $post->social = 'twitter';
                                    $post->title = 'https://twitter.com/'.$modeuse->twitter.'/status/'.$status['id_str'];
                                    $post->content = $status['text'];
                                    $post->picture = $status['text'];
                                    $post->number = $t;
                                    $post->likes = $status['favorite_count'];
                                    $post->comments = $status['retweet_count'];
                                    $post->shares = '';
                                    $post->nb_tweets = $status['user']['statuses_count'];

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

    function getFacebookDatas() {

        $this->Jsonification();

        $modeuses = $this->Modeuses->find('all')->contain(['Users']);

        $datas = array();
        $datas['facebook'] = array();
        
        foreach ($modeuses as $key => $modeuse) {

            if($modeuse->user->id_facebook != null && $modeuse->user->id_facebook != '') {

                $myFBToken="CAAMx2YHhMr8BAGKCyUiZAthgOO9A0OXv1lcuZAw2ZAuGc2pO3Q02KZC3qKxX8N8FdFmHetu1Gc1oyN5tcwugeMwCyZA71tePFZAVWQnhVaFFO1nu3ZCXlZAiZCq9jnVBLYozLLFSlxZB1XZCljUklkL6X3HZAS5q7tu3hoVho7cMq1SaUfOrGz7hbZARKPcXpclpLWptLs3ybFabCXsDktcOT6IwSIlV0CZCr0osZD";

                $url="https://graph.facebook.com/".$modeuse->user->id_facebook."/friends?access_token=".$modeuse->fb_token."&limit=3";
                $c = curl_init($url);
                curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
                $page = json_decode(curl_exec($c), true);
                curl_close($c);

                if($page) {
                    if(isset($page['summary'])) {
                        $the_modeuse = $this->Modeuses->get($modeuse->id);
                        $the_modeuse->facebook_followers = $page['summary']['total_count'];
                        $this->Modeuses->save($the_modeuse);
                    }
                }

                $url="https://graph.facebook.com/".$modeuse->user->id_facebook."/posts?limit=3&fields=object_id,likes.summary(true),comments.summary(true),message&access_token=".$modeuse->fb_token."&limit=3";
                $c = curl_init($url);
                curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
                $page = json_decode(curl_exec($c), true);
                curl_close($c);

                if($page) {

                    $t = 1;
                    foreach ($page['data'] as $key => $the_post) {

                        if(!isset($the_post['message'])) {
                            $the_post['message'] = '';
                        }

                        $search_post = $this->Posts
                            ->find('all')
                            ->where(['modeuse_id' => $modeuse->id, 'number' => $t, 'social' => 'facebook'])
                            ->toArray();

                        if(!empty($search_post)) {
                            $search_post = $search_post[0];

                            $this->Posts->id = $search_post['id'];
                            $search_post->social = 'facebook';
                            $search_post->title = $the_post['message'];
                            $search_post->content = $the_post['message'];
                            $search_post->picture = $the_post['message'];
                            $search_post->likes = $the_post['likes']['summary']['total_count'];
                            $search_post->comments = $the_post['likes']['summary']['total_count'];
                            $search_post->shares = '';

                            $this->Posts->save($search_post);
                        } else {
                            $post = $this->Posts->newEntity();
                            $post->modeuse_id = $modeuse->id;
                            $post->social = 'facebook';
                            $post->title = $the_post['message'];
                            $post->content = $the_post['message'];
                            $post->picture = $the_post['message'];
                            $post->number = $t;
                            $post->likes = $the_post['likes']['summary']['total_count'];
                            $post->comments = $the_post['likes']['summary']['total_count'];
                            $post->shares = '';

                            $this->Posts->save($post);
                        }

                        $t++;
                    }
                }
            }
        }

        die;
    }

    function matching() {
        
    }

    // Fonction pour calculer la portée
    function calculReach() {

        $this->Jsonification();

        $modeuses = $this->Modeuses->find('all');

        foreach ($modeuses as $key => $modeuse) {

            $posts = $this->Posts->find('all')->where(['modeuse_id' => $modeuse->id]);

            $reach = 0;
            $reach_likes = 0;
            $reach_comments = 0;

            if($modeuse->insta_followers == 0) {
                $modeuse->insta_followers = 1;
            }

            foreach ($posts as $key => $post) {

                if($post['social'] == 'facebook') {

                    $reach_likes += ($post->likes / $modeuse->facebook_followers);
                    $reach_comments += ($post->comments / $modeuse->facebook_followers);

                } elseif($post['social'] == 'twitter') {

                    $reach_likes += ($post->likes / $modeuse->twitter_followers);
                    $reach_comments += ($post->comments / $modeuse->twitter_followers);

                } elseif($post['social'] == 'instagram') {

                    $reach_likes += ($post->likes / $modeuse->insta_followers);
                    $reach_comments += ($post->comments / $modeuse->insta_followers);
                }

                $reach = (($reach_likes/40)*100) + (($reach_comments/60)*100);

                $reach = $reach * 10;
            }

            $the_modeuse = $this->Modeuses->get($modeuse->id);
            $the_modeuse->noddi_rank = $reach;
            $this->Modeuses->save($the_modeuse);
        }

        die;
    }

}
