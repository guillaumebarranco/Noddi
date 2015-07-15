<?php if($this->request->session()->read('type') == 'brand') { ?>
    <button class="buttons_offers button get_current_offer">Offre en cours</button>
    <button class="buttons_offers button get_finished_offers">Offres terminées</button>

    <section class="finished_offers">

        <ul>
            <?php foreach ($finished_offers as $key => $offer) { ?>
                <li><?=$offer->title?></li>
            <?php } ?>
        </ul>

    </section>

    <section class="current_offer">

        <div>

            <div class="offer_picture">
                <img src="img/offers/<?=$current_offer->id?>/1.jpg" alt="" />
            </div>

            <div class="offer_content">
                <?=$current_offer->type->name?>

                <?=$current_offer->exchange?>
            </div>
            
        </div>

    </section>


<?php } else { ?>

    <?php if($modeuse->boost == 1) { ?>

        <h2>Propositions</h2>

        <p>
            <b>Tu n'as plus de propositions pour le moment.</b> <br /><br />

            Tu recevras un nouvel email d'alerte lorsqu'une autre marque sera intéressée par ton profil. <br /> <br />

            Néanmoins, il te reste encore une chance de prouver ta motivation auprès d'une marque pour tenter de collaborer avec elle.
            
        </p>

        <div>
            <button class="button">Voir les propositions</button>
        </div>

    <?php } else { ?>

        <p>
            <b>Si la marque est intéressée par ton offre, tu recevras un mail de confirmation dans ta boîte perso</b> <br /><br />

            Samedi prochain, tu recevras de nouveau un Boost que tu pourras utiliser sur l'offre de ton choix. <br /><br />

            D'ici-là, suis-nous sur les réseaux sociaux pour continuer à recevoir plein de bons plans !
        </p>

    <?php } ?>


<?php } ?>









<?=$this->Html->script('offers')?>