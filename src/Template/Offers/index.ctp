<section class="page page_offers page_viewOffer">
<header class="headerPage">
    <h2 class="titlePage">Propositions</h2>
    <div class="previousStepMenu">
        <a href="<?=$this->request->base?>/offers">
            Précédent
        </a>
    </div>
</header>
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
                <img src="img/offers/<?=$current_offer->id?>/1.png" alt="" />
            </div>

            <div class="offer_content">
                <?=$current_offer->type->name?>

                <?=$current_offer->exchange?>
            </div>
        </div>

    </section>

<?php } else { ?>

    <?php if(!empty($applies[0])) { 
        $k = 0;
        foreach ($applies as $key => $apply) { 

            if($k==0) { echo'<div>'; } else { echo '<div style="display:none">'; } ?>

            <div class="content">
                <article class="offer">
                    <header style="background-image:url('<?=$this->request->base?>/img/offers/<?=$apply->offer->uniquid?>/1.png');"></header>
                    <div class="contentArticle">
                        <h3>Informations générales</h3>
                        <div class="infoBrand">
                            <img src="<?=$apply->offer->brand->user->picture?>" alt="Brand">
                            <div class="infoBranText">
                                <h4><?=$apply->offer->brand->name?></h4>
                                <p><?=$apply->offer->brand->activity->name?></p>
                                <p><?=$apply->offer->brand->city?></p>
                            </div>
                        </div>
                    </div>
                    <footer>
                        <h3>Informations sur l'offre <small><?=$apply->offer->title?></small></h3>
                        <p><?=$apply->offer->description?></p>
                        <p>En échange de <strong><?=$apply->offer->type->name?></strong> (<strong><?=str_replace("_", " ", $apply->offer->exchange)?></strong> de <strong><?=$apply->offer->brand->name?></strong> ), tu t'engages à partager le bon plan à ta communauté.</p>
                        <p>Disponibilité : A partir de maintenant</p>
                        <div class="flexButtons">
                            <div class="button acceptApply reversed" data-apply="<?=$apply->id?>" data-offer="<?=$apply->offer->id?>" data-modeuse="<?=$modeuse->id?>">Accepter</div>
                            <div class="button removeApplyOffer reversed" data-apply="<?=$apply->id?>">Décliner</div>
                        </div>
                    </footer>
                </article>
            </div>

        <?php $k++; }
   
    } else {

        if($modeuse->boost == 1) { ?>
        <div class="content">
            <p><strong>Tu n'as plus de propositions pour le moment.</strong></p>
            <p>Tu recevras un nouvel email d'alerte lorsqu'une autre marque sera intéressée par ton profil.</p>
            <p>Néanmoins, il te reste encore une chance de prouver ta motivation auprès d'une marque pour tenter de collaborer avec elle.</p>
            <div class="button get_offers reversed">Voir les propositions</div>

            
           <section class="section_home">
               <ul class="all_offers"></ul>
           </section>

            
        </div>
        <?php } else { ?>

            <div class="content">
                <p><strong>Si la marque est intéressée par ton profil, tu recevras un mail de confirmation dans ta boîte perso</strong></p>
                <p>Samedi prochain, tu recevras de nouveau un Boost que tu pourras utiliser sur l'offre de ton choix.</p>
                <p>D'ici-là, suis-nous sur les réseaux sociaux pour continuer à recevoir plein de bons plans !</p>
            </div>

        <?php }
    }
 } ?>
</section>


<?=$this->Html->script('offers')?>