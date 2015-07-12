<button class="button show_modeuse_infos">Informations générales</button>
<button class="button show_modeuse_socials">Performance réseaux sociaux</button>

<section class="page_modeuse modeuse_infos">
    <img src="<?=$modeus->user->picture?>" width="150" />
    <h3><?= h($modeus->firstname) ?>  <?= h($modeus->lastname) ?></h3>

    Description

    <p><?= h($modeus->user->bio) ?></p>

    Style vestimentaire

    <p>
        
    </p>

    Personnalité

    <p>
        
    </p>

    Blog : Oui

    Collaborations antérieures avec des entreprises : Oui
</section>

<section class="page_modeuse modeuse_socials">
    Audience

    <ul>
        <li>251 Amis Facebook</li>
        <li><?=$modeus->twitter_followers?> followers Twitter</li>
        <li><?=$modeus->insta_followers?> followers Instagram</li>
    </ul>

    Dernières publications postées

    <div class="post">
        <div class="post_picture">
            <img src="" alt="" />
        </div>

        <div class="post_content">
            lorem ipsum
        </div>
    </div>

    <div class="post">
        <div class="post_picture">
            <img src="" alt="" />
        </div>

        <div class="post_content">
            lorem ipsum
        </div>
    </div>

    <div class="post post_large">

        <div class="post_author">
            <h4>Lucie Potier</h4>
            <b>@<?=$modeus->twitter?></b>
        </div>

        <div class="post_content">
            lorem ipsum
        </div>
    </div>

    Moyenne de portée des publications

    <div>83%</div>

    Présence sur les Réseaux Sociaux

    <a href="https://twitter.com/<?=$modeus->twitter?>" target="_blank">
        https://twitter.com/<?=$modeus->twitter?>
    </a>

</section>

<button class="button send_offer">Envoyer mon offre</button>