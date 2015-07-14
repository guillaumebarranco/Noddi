

<h2>Proposer une offre</h2>

<?= $this->Form->create($offer) ?>
    <p>
        Je recherche une modeuse 
        <select name="personnality" id="">
            <option value="peu importe">peu importe</option>
            <?php foreach ($tab_personnality as $personnality) { ?>
                <option value="<?=$personnality['value']?>"><?=$personnality['name']?></option>
            <?php } ?>
        </select>
        avec un style
        <select name="lifestyle" id="">
            <option value="indifférent">indifférent</option>
            <?php foreach ($tab_lifestyle as $lifestyle) { ?>
                <option value="<?=$lifestyle['value']?>"><?=$lifestyle['name']?></option>
            <?php } ?>
        </select>
        pour promouvoir mon entreprise à partir de 

        <select name="" id="">
            <option value="maintenant">maintenant</option>
        </select>

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
        
        <button class="button">Télécharger des images de l'offre</button>

        <img src="" class="offer_picture offer_picture_one" />
        <img src="" class="offer_picture offer_picture_two" />
        <img src="" class="offer_picture offer_picture_three" />
    </p>

<?= $this->Form->button(__('Valider mon offre')) ?>
<?= $this->Form->end() ?>
