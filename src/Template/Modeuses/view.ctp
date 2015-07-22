<section class="page page_viewProfile">
    <header class="headerPage">
        <h2 class="titlePage">Modeuse</h2>
        <!-- <div class="previousStepMenu"><a href="#">Précédent</a></div> -->
    </header>

    <div class="page_home"></div>

    <section class="page_modeuse modeuse_infos">

        <header class="globalInfo">
            <?php if(substr($modeuse->user->picture, 0, 4) != 'http') {
                $modeuse->user->picture = $this->request->base.'/'.$modeuse->user->picture;
            } ?>
            <div class="profile_picture" style="background-image:url('<?=$modeuse->user->picture?>');"></div>
            <div class="contentInfos">

                <h3><?= h($modeuse->firstname) ?>  <?= h($modeuse->lastname) ?></h3>

                <p class="user"><?= h($modeuse->age) ?> ans - <?= h($modeuse->city) ?></p>
                <p class="bio has_blog">
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
                <li id="UserDescription" class="active">Description</li>
                <li id="UserReputation">Notoriété</li>
                <li id="UserPosts">Publication</li>
            </ul>

            <div class="specialDesktop">
                <div class="viewTab" id="viewUserDescription">
                    <h2>Description</h2>

                    <p class="checkDescription"><?= $modeuse->user->bio ?></p>

                    <div class="hobbies iconsUser">
                        <h4>Centres d'intérêt</h4>
                        <p><?= str_replace(",", ", ", str_replace("_", " ", $modeuse->hobbies)) ?></p>
                    </div>  
                    <div class="personality iconsUser">
                        <h4>Personnalité</h4>
                        <p><?= str_replace(",", ", ", str_replace("_", " ", $modeuse->personnality)) ?></p>
                    </div>  
                    <div class="style iconsUser">
                        <h4>Style</h4>
                        <p><?= str_replace(",", ", ", str_replace("_", " ", $modeuse->lifestyle)) ?></p>
                    </div>          
                </div>
                    
                <div class="viewTab" id="viewUserReputation">
                    <h2>Audience</h2>
                    <ul class="socialStats">
                    <?php if($modeuse->insta_followers > 1000 && $modeuse->insta_followers < 1000000) {
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

                    ?>
                        <li class="facebook"><?=$modeuse->facebook_followers?> <small>Amis</small></li>
                        <li class="twitter"><?=$modeuse->twitter_followers?> <small>followers</small></li>
                        <li class="instagram"><?=$modeuse->insta_followers?> <small>followers</small></li>
                    </ul>
                    <ul class="all_socials">
                        <?php if(isset($modeuse->socialPresence)){
                            $tab_networks = explode(',', $modeuse->socialPresence);
                            foreach ($tab_networks as $key => $net) { 
                                if($net != 'instagram' && $net != 'twitter' && $net != 'facebook') { ?>

                                    <li>
                                        <?=$net?>
                                    </li>
                            <?php }
                            }
                        } ?>
                    </ul>
                    
                    <h2>Moyenne de portée des publications</h2>
                    <div class="backReach">
                        <div class="reach" style="width:<?= $modeuse->noddi_rank ?>%;">
                            <small><?= $modeuse->noddi_rank ?>%</small>
                        </div>
                    </div>
                </div>
            </div>

            



            <div class="viewTab" id="viewUserPosts">
                <section class="page_modeuse modeuse_socials">
                    <?php 

                        $tab_socials = array();
                        $tab_socials[0] = 'instagram';
                        $tab_socials[1] = 'twitter';
                        $tab_socials[2] = 'facebook';

                        for ($i=0; $i < 3; $i++) { ?>
                            
                            <div class="hr"></div>
                            <div class="mySquad mySquad_<?=$tab_socials[$i]?>"></div>

                            <?php foreach ($posts as $key => $post) { 

                                if($post->social == $tab_socials[$i]) { ?>
                                    
                                    <article class="post">
                                        <?php if($post->picture != '' && $post->picture != null) { ?>
                                        <header class="post_picture" style="background-image:url('<?=$post->picture?>');">
                                        </header>
                                        <?php } ?>
                                        
                                        <?php if($post->content != '' && $post->content != null) { ?>
                                        <div class="post_content">
                                            <?= $post->content ?>
                                        </div>
                                        <?php } ?>

                                        <footer class="statsPosts">
                                            <ul>
                                                <?php 
                                                if($post->likes != '' && $post->likes != null) { 
                                                    echo "<li class=\"likes\">$post->likes </li>";
                                                } 
                                                if($post->comments != '' && $post->comments != null) { 
                                                    echo "<li class=\"comments\">$post->comments </li>";
                                                } 
                                                // if($post->shares != '' && $post->shares != null) { 
                                                //     echo "<li class=\"share\">$post->shares </li>";
                                                // } 

                                                ?>
                                            </ul>
                                        </footer>
                                    </article>
                               <?php }
                            } 

                        }
                    ?>
                    
                </section>
            </div>

            <?php if(!empty($offer)) { 

            if($can_apply) { ?>
                <div class="apply_offer button reversed" data-offer="<?=$offer->id?>" data-fromwho="<?=$this->request->session()->read('type')?>" data-modeuse="<?=$modeuse->id?>">Proposer mon offre</div>
            <?php } else {
                echo "<p style='text-align:center;'>Vous avez déjà proposé votre offre à cette modeuse !</p>";
            }

            ?>
        </div>
        
    </section>
    
</section>



<?php } ?>

<?= $this->Html->script('offers') ?>