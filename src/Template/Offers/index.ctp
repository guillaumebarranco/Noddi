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

<?=$this->Html->script('offers')?>