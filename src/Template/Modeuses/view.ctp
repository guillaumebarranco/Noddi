<section class="page page_viewProfile">
    <header class="headerPage">
        <h2 class="titlePage">Modeuse</h2>
        <!-- <div class="previousStepMenu"><a href="#">Précédent</a></div> -->
    </header>

    <div class="page_home"></div>

    <section class="page_modeuse modeuse_infos">

        <header class="globalInfo">
            <div class="profile_picture" style="background-image:url('<?=$modeuse->user->picture?>');"></div>
            <div class="contentInfos">

                <h3><?= h($modeuse->firstname) ?>  <?= h($modeuse->lastname) ?></h3>

                <p class="user"><?= h($modeuse->age) ?> - <?= h($modeuse->city) ?></p>
                <p class="bio">
                    <?php 
                        if($modeuse->has_blog == 1 && $modeuse->brandExperience == 1){
                            echo 'Possède un blog et a déjà collaboré avec des marques';
                        } elseif($modeuse->has_blog == 1 && $modeuse->brandExperience == 0){
                            echo 'Possède un blog et n\'a jamais collaboré avec une marque';
                        } elseif($modeuse->has_blog == 0 && $modeuse->brandExperience == 1){
                            echo 'Ne possède pas de blog et a déjà collaboré avec une marque';
                        } elseif($modeuse->has_blog == 0 && $modeuse->brandExperience == 0){
                            echo 'Ne possède pas de blog et n\'a jamais collaboré avec une marque';
                        }
                    ?>
                </p>
            </div>
            <div class="notifications"></div>
        </header>
        <div class="content">
            <ul id="tabsProfile" class="tabsProfile">
                <li id="UserDescription">Description</li>
                <li id="UserReputation">Notoriété</li>
                <li id="UserPosts">Publication</li>
            </ul>
            <div class="viewTab" id="viewUserDescription">
                <p><?= $modeuse->user->bio ?></p>  
                <div class="hobbies iconsUser">
                    <h4>Centres d'intérêt</h4>
                    <p><?= str_replace("_", " ", $modeuse->hobbies) ?></p>
                </div>  
                <div class="personality iconsUser">
                    <h4>Personnalité</h4>
                    <p><?= $modeuse->personality ?></p>
                </div>  
                <div class="style iconsUser">
                    <h4>Style</h4>
                    <p><?= $modeuse->lifestyle ?></p>
                </div>          
            </div>
                
            <div class="viewTab" id="viewUserReputation">
                <h2>Audience</h2>

                <ul>
                    <li><?=$modeuse->facebook_followers?> Amis Facebook</li>
                    <li><?=$modeuse->twitter_followers?> followers Twitter</li>
                    <li><?=$modeuse->insta_followers?> followers Instagram</li>
                </ul>
                    
                <p>
                    <b>Moyenne de portée des publications :</b> <?= $modeuse->noddi_rank ?>%
                </p> 

                Présence sur les Réseaux Sociaux
                
                <div>
                    <b>Instagram</b>
                    <a href="https://twitter.com/<?=$modeuse->twitter?>" target="_blank">
                        https://twitter.com/<?=$modeuse->twitter?>
                    </a>
                </div>

                <div>
                    <b>Twitter</b>
                    <a href="https://twitter.com/<?=$modeuse->twitter?>" target="_blank">
                        https://twitter.com/<?=$modeuse->twitter?>
                    </a>
                </div>

                <div>
                    <b>Facebook</b>
                    <a href="https://facebook.com/<?=$modeuse->user->id_facebook?>" target="_blank">
                        https://facebook.com/<?=$modeuse->user->id_facebook?>
                    </a>
                </div>
            </div>

            <div class="viewTab" id="viewUserPosts">
                <section class="page_modeuse modeuse_socials">
                    <?php 

                        $tab_socials = array();
                        $tab_socials[0] = 'instagram';
                        $tab_socials[1] = 'twitter';
                        $tab_socials[2] = 'facebook';

                        for ($i=0; $i < 3; $i++) { 
                           
                            echo '<b>Dernières publications '.ucfirst($tab_socials[$i]).'</b>';

                            foreach ($posts as $key => $post) { 

                                if($post->social == $tab_socials[$i]) { ?>
                                    
                                    <div class="post">
                                        <div class="post_picture">
                                        <?php if($post->picture != '' && $post->picture != null) { ?>
                                            <img src="<?=$post->picture?>" alt="" width="100" />
                                        <?php } ?>
                                        </div>

                                        <div class="post_content">
                                            <?= $post->content ?>
                                        </div>
                                    </div>
                               <?php }
                            } 

                        }
                    ?>
                    
                </section>
            </div>
        </div>
        
    </section>
    
</section>

<?php if(!empty($offer)) { ?>
    <button class="apply_offer button" data-offer="<?=$offer->id?>" data-fromwho="<?=$this->request->session()->read('type')?>" data-modeuse="<?=$modeuse->id?>">Proposer mon offre</button>
<?php } ?>

  