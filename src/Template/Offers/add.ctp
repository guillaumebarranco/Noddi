<?php include('tab.php');  ?>

<section class="page page_offers">
    <header class="headerPage">
        <h2 class="titlePage">Ma proposition</h2>
        <div class="previousStepMenu"><a href="<?=$this->request->base?>/dashboard">Précédent</a></div>
    </header>

    <?= $this->Form->create($offer) ?>
    <div class="formCreateOffer">
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

            <!-- <p>De</p>
            <select name="fromAge" id="fromAge">
                <?php for ($i=17; $i<50; $i++) {?>
                    <option value="<?=$i?>"><?=$i?></option>
                <?php } ?>
            </select>
            <p> ans à</p>
            <select name="toAge" id="toAge">
                <?php for ($j=18; $j<50; $j++) {?>
                    <option value="<?=$j?>"><?=$j?></option>
                <?php } ?>
            </select>
            <p> ans</p> -->


        </div>

        <div class="flexInput">
            <?= $this->Form->input('title', ['label' => 'Titre', 'placeholder' => "Titre de l'offre"]) ?>
        </div>
        
        <div class="regularCheckbox">
            <input type="checkbox" name="is_public" id="allowContact" class="singlecheckbox" checked>
            <label for="allowContact" class="allowContact">J'autorise les Noddiz à me contater</label>
        </div>
        
        <div class="flexInput">
            <div class="style_input select">
                <select name="type_id" id="">
                    <option selected disabled>Type d'offre</option>
                    <?php foreach ($types as $type) { ?>
                        <option value="<?=$type->id?>"><?=$type->name?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="style_input select">
                <select name="exchange" id="">
                    <option selected disabled>Type d'echange</option>
                    <?php foreach ($tab_echange as $echange) { ?>
                        <option value="<?=$echange['value']?>"><?=$echange['name']?></option>
                    <?php } ?>
                </select>
            </div>
        </div>


        <input type="hidden" name="uniquid" value="<?=uniqid()?>" />
        <input type="hidden" name="finished" value="0" />

        <input type="hidden" class="counter" value="1" />
            
        <input type="file" id="upload_offer" class="button reversed small dark" data-number="1" />Télécharger des images de l'offre

        <img src="" width="100" class="offer_picture offer_picture_1" />
        <img src="" width="100" class="offer_picture offer_picture_2" />
        <img src="" width="100" class="offer_picture offer_picture_3" />
            
        <button class="button reversed dark">Valider mon offre</button>
        <?= $this->Form->end() ?>
        
    </div>

</section>

<?= $this->Html->script('offers'); ?>