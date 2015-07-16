<?php include('tab.php');  ?>

<section class="page page_dashboard">
    <header class="headerPage">
        <h2 class="titlePage">Proposer une offre</h2>
        <!-- <div class="previousStepMenu"><a href="#">Précédent</a></div> -->
    </header>

    <?= $this->Form->create($offer) ?>
    <div class="sentenceSelect">
        <p>Je recherche une modeuse</p>
        <select name="personnality" id="">
            <option value="peu importe">peu importe</option>
            <?php foreach ($tab_personnality as $personnality) { ?>
                <option value="<?=$personnality['value']?>"><?=$personnality['name']?></option>
            <?php } ?>
        </select>
        <p>avec un style</p>
        <select name="lifestyle" id="">
            <option value="indifférent">indifférent</option>
            <?php foreach ($tab_lifestyle as $lifestyle) { ?>
                <option value="<?=$lifestyle['value']?>"><?=$lifestyle['name']?></option>
            <?php } ?>
        </select>
        <p>pour promouvoir mon entreprise à partir de</p>
        <select name="" id="">
            <option value="maintenant">maintenant</option>
        </select>
        

    </div>
    <div class="style_input">
        <?= $this->Form->select('types._ids', $types, [ 'name' => 'types[_ids][]', 'class' => 'types', 'default' => "Type d'offre"]); ?>
    </div>

    <div class="style_input">
        <select name="exchange" id="">
            <option selected disabled>Type d'echange</option>
            <?php foreach ($tab_echange as $echange) { ?>
                <option value="<?=$echange['value']?>"><?=$echange['name']?></option>
            <?php } ?>
        </select>
    </div>

    <input type="hidden" name="uniquid" value="<?=uniqid()?>" />
    <input type="hidden" name="finished" value="0" />

    <input type="hidden" class="counter" value="1" />
        
    <input type="file" id="upload_offer" data-number="1" />Télécharger des images de l'offre

    <img src="" width="100" class="offer_picture offer_picture_1" />
    <img src="" width="100" class="offer_picture offer_picture_2" />
    <img src="" width="100" class="offer_picture offer_picture_3" />
        

    <?= $this->Form->button(__('Valider mon offre'), ["class"=> "button small"]) ?>
    <?= $this->Form->end() ?>

</section>

<?= $this->Html->script('offers'); ?>