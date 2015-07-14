<button class="button show_modeuse_infos">Informations générales</button>
<button class="button show_modeuse_socials">Performance réseaux sociaux</button>

<section class="page_modeuse modeuse_infos">

    <h2>Informations Générales</h2>

    <img src="<?=$modeuse->user->picture?>" width="150" />
    <h3><?= h($modeuse->firstname) ?>  <?= h($modeuse->lastname) ?></h3>

    <p><b>Description :</b> <?= $modeuse->user->bio ?></p>

    <p><b>Style vestimentaire :</b> <?= $modeuse->lifestyle ?></p>

    <p><b>Personnalité :</b> <?= $modeuse->personnality ?></p>

    <p>
        <b>Blog /</b> <?php if($modeuse->has_blog === 0) { echo 'Non'; } else { echo 'Oui'; } ?>
    </p>

    <p>
        <b>Collaborations antérieures avec des entreprises :</b> <?php if($modeuse->brandExperience === 0) { echo 'Non'; } else { echo 'Oui'; } ?>
    </p>

    
</section>

<section class="page_modeuse modeuse_socials">
    <h2>Audience</h2>

    <ul>
        <li><?=$modeuse->facebook_followers?> Amis Facebook</li>
        <li><?=$modeuse->twitter_followers?> followers Twitter</li>
        <li><?=$modeuse->insta_followers?> followers Instagram</li>
    </ul>

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


    <!-- <div class="post post_large">

        <div class="post_author">
            <h4>Lucie Potier</h4>
            <b>@<?=$modeuse->twitter?></b>
        </div>

        <div class="post_content">
            lorem ipsum
        </div>
    </div> -->

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
    



</section>

<button class="button send_offer">Envoyer mon offre</button>