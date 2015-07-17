<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Security;
use Twitter\twitter\TwitterAPIExchange;

class CronController extends AppController
{

    public function initialize() {
        parent::initialize();

        $this->loadModel('Posts');
        $this->Jsonification();
    }

    /*
    *   Fonction qui va servir à renvoyer un JSON depuis une URL donnée
    */

    function getJsonUrl($url) {
        $get = file_get_contents($url);
        $json = json_decode($get);
        return $json;
    }

    /*
    *   IDEM qu'au-dessus, avec cependant plus de spécifications
    */

    function getEndpoint($endpoint) {
        $curl = curl_init($endpoint);

        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $json = curl_exec($curl);

        $insta_datas = json_decode($json, true);
        return $insta_datas;
    }

    /*
    *   Fonction qui prépare la requête à Twitter et retourne les statuses pour un user
    */

    function requestTwitter($modeuse_twitter) {

        $settings = array(
            'oauth_access_token' => "2538080443-DumgtCTU5i7SrlKZKq65Em7fhXHoJyLPpM5tQ2F",
            'oauth_access_token_secret' => "WiCcmfos8s4enGJfKNDuVlfIC81l1XsvjQdhRSyKZsT8G",
            'consumer_key' => "4s5F89RTeHhreISVbZT9BmSPn",
            'consumer_secret' => "AIvRHR6Aopnj8GyFx8j7KkaGjYc6Yw3I5RYcXrc75sWlwax69p"
        );

        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name='.$modeuse_twitter;
        $requestMethod = 'GET';

        $twitter = new TwitterAPIExchange($settings);

        $json_twitter = $twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest();

        $twitter_datas = json_decode($json_twitter, true);
        return $twitter_datas;
    }




    /*
    *   FONCTION PRINCIPALE QUI LANCE TOUTES LES FONCTIONS DU CRON
    */

    function launch() {
        $this->getInstaDatas();
        $this->getTwitterDatas();
        $this->getFacebookDatas();
        $this->calculReach();
    }




    /*
    *   Fonction pour récupérer les followers, posts et KPI's par modeuse pour INSTAGRAM
    */

    function getInstaDatas() {

        echo '----------------- BEGIN INSTAGRAM ---------------- <br />';

        $instagramClientId = "e7b008f986f64a8c9f94642520b4e0ea";

        $modeuses = $this->Modeuses->find('all')->contain(['Users']);

        foreach ($modeuses as $key => $modeuse) {
            if($modeuse->instagram != null) {

                $url = 'https://api.instagram.com/v1/users/search?q='.$modeuse->instagram.'&client_id='.$instagramClientId;
                $json = $this->getJsonUrl($url);

                foreach($json->data as $user) { 
                    if(strtolower($user->username) == strtolower($modeuse->instagram)) {
                        $userId = $user->id;
                    }
                }

                if (isset($userId)) {

                    $endpoint = 'https://api.instagram.com/v1/users/'.$userId.'/media/recent?client_id='.$instagramClientId;
                    $insta_datas = $this->getEndpoint($endpoint);

                    // GESTION DES DONNEES RETOURNEES

                    if ($insta_datas['data'][0]['user']['username']) {

                        // GET FOLLOWERS

                        $get_followers = 'https://api.instagram.com/v1/users/'.$userId.'/?client_id='.$instagramClientId;
                        $followers = $this->getEndpoint($get_followers);

                        $k = 1;

                        $the_modeuse = $this->Modeuses->get($modeuse->id);
                        $the_modeuse->insta_followers = $followers['data']['counts']['followed_by'];
                        
                        // On check si la sauvegarde des followers se fait correctement
                        if($this->Modeuses->save($the_modeuse)) {
                            echo '[SUCCESS] Modeuse '.$modeuse->id.' : insta_followers saved.<br />';
                        } else {
                            echo '[ERROR] Modeuse '.$modeuse->id.' : insta_followers not saved.<br />';
                        }

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

                                        } else {
                                            $search_post = $this->Posts->newEntity();                                            
                                        }

                                        $search_post->modeuse_id = $modeuse->id;
                                        $search_post->social = 'instagram';
                                        $search_post->title = $the_data['link'];
                                        $search_post->content = $the_data['caption']['text'];
                                        $search_post->picture = $the_data['images']['standard_resolution']['url'];
                                        $search_post->number = $k;
                                        $search_post->likes = $the_data['likes']['count'];
                                        $search_post->comments = $the_data['comments']['count'];
                                        $search_post->shares = '';

                                        if($this->Posts->save($search_post)) {

                                            if($this->Posts->save($search_post)) {
                                                echo '[SUCCESS] Modeuse '.$modeuse->id.' NEW post instagram '.$search_post->number.' saved !<br />';
                                            } else {
                                                echo '[ERROR] Modeuse '.$modeuse->id.' NEW post instagram '.$search_post->number.' failed saved.<br />';
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
        echo '----------------- END INSTAGRAM ----------------<br /><br />';
    }



    /*
    *   Fonction pour récupérer les followers, posts et KPI's par modeuse pour TWITTER
    */

    function getTwitterDatas() {

        echo '----------------- BEGIN TWITTER ----------------<br />';

        $modeuses = $this->Modeuses->find('all')->contain(['Users']);

        foreach ($modeuses as $key => $modeuse) {
            if($modeuse->twitter != null) {

                $twitter_datas = $this->requestTwitter($modeuse->twitter);

                if (isset($twitter_datas[0]['user']['screen_name'])) {

                    $the_modeuse = $this->Modeuses->get($modeuse->id);
                    $the_modeuse->twitter_followers = $twitter_datas[0]['user']['followers_count'];

                    if($this->Modeuses->save($the_modeuse)) {
                        echo '[SUCCESS] Modeuse '.$modeuse->id.' : twitter_followers saved.<br />';
                    } else {
                        echo '[ERROR] Modeuse '.$modeuse->id.' : twitter_followers not saved.<br />';
                    }

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

                                } else {
                                    $search_post = $this->Posts->newEntity();
                                }

                                $search_post->social = 'twitter';
                                    $search_post->title = 'https://twitter.com/'.$modeuse->twitter.'/status/'.$status['id_str'];
                                    $search_post->content = $status['text'];
                                    $search_post->picture = '';
                                    $search_post->likes = $status['favorite_count'];
                                    $search_post->comments = $status['retweet_count'];
                                    $search_post->shares = '';
                                    $search_post->nb_tweets = $status['user']['statuses_count'];
                                $t++;

                                if($this->Posts->save($search_post)) {
                                    echo '[SUCCESS] Modeuse '.$modeuse->id.' NEW post twitter '.$search_post->number.' saved !<br />';
                                } else {
                                    echo '[ERROR] Modeuse '.$modeuse->id.' NEW post twitter '.$search_post->number.' failed saved.<br />';
                                }
                            }
                        }
                    }
                }
            }
        }

        echo '----------------- END TWITTER ----------------<br /><br />';
    }


    /*
    *   Fonction pour récupérer les followers, posts et KPI's par modeuse pour FACEBOOK
    */

    function getFacebookDatas() {

        echo '----------------- BEGIN FACEBOOK ----------------<br />';

        $modeuses = $this->Modeuses->find('all')->contain(['Users']);
        
        foreach ($modeuses as $key => $modeuse) {

            if($modeuse->user->id_facebook != null && $modeuse->user->id_facebook != '') {

                $url="https://graph.facebook.com/".$modeuse->user->id_facebook."/friends?access_token=".$modeuse->fb_token."&limit=3";
                
                $page = $this->getEndpoint($url);

                if($page) {
                    if(isset($page['summary'])) {
                        $the_modeuse = $this->Modeuses->get($modeuse->id);
                        $the_modeuse->facebook_followers = $page['summary']['total_count'];

                        if($this->Modeuses->save($the_modeuse)) {
                            echo '[SUCCESS] Modeuse '.$modeuse->id.' : facebook_followers saved.<br />';
                        } else {
                            echo '[ERROR] Modeuse '.$modeuse->id.' : facebook_followers not saved.<br />';
                        }
                    }
                }

                $url="https://graph.facebook.com/".$modeuse->user->id_facebook."/posts?limit=3&fields=object_id,likes.summary(true),comments.summary(true),message&access_token=".$modeuse->fb_token."&limit=3";

                $page = $this->getEndpoint($url);

                if($page && isset($page['data']) && !isset($page['error'])) {

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
                            
                        } else {
                            $search_post = $this->Posts->newEntity();
                        }

                        $search_post->social = 'facebook';
                        $search_post->title = $the_post['message'];
                        $search_post->content = $the_post['message'];
                        $search_post->picture = '';
                        $search_post->likes = $the_post['likes']['summary']['total_count'];
                        $search_post->comments = $the_post['likes']['summary']['total_count'];
                        $search_post->shares = '';

                        if($this->Posts->save($search_post)) {
                            echo '[SUCCESS] Modeuse '.$modeuse->id.' NEW post facebook '.$search_post->number.' saved !<br />';
                        } else {
                            echo '[ERROR] Modeuse '.$modeuse->id.' NEW post facebook '.$search_post->number.' failed saved.<br />';
                        }

                        $t++;
                    }
                }
            }
        }

        echo '----------------- END FACEBOOK ----------------<br /><br />';
    }

    /*
    *   Fonction pour calculer la portée d'une modeuse par rapport à ses posts et likes/comments
    */

    function calculReach() {

        echo '----------------- BEGIN CALCUL REACH ----------------<br />';

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

        echo '----------------- END CALCUL REACH ----------------<br /><br />';
    }

}
