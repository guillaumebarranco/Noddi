<?php
    $tab_lifestyle = array();
    $tab_lifestyle[] = "Bohème";
    $tab_lifestyle[] = "Hippie Chic";
    $tab_lifestyle[] = "Chic";
    $tab_lifestyle[] = "Casual";
    $tab_lifestyle[] = "Street fashion";
    $tab_lifestyle[] = "Excentrique";
    $tab_lifestyle[] = "Pinup";
    $tab_lifestyle[] = "Rétro vintage";
    $tab_lifestyle[] = "Glam rock";
    $tab_lifestyle[] = "Baroque";
    $tab_lifestyle[] = "Flashy";
    $tab_lifestyle[] = "Old School";
    $tab_lifestyle[] = "Romantique";

    function getValue($text) {
        $text = str_replace(" ", "_", $text);
        return $text;
    }


    $i = 0;
    foreach ($tab_lifestyle as $key => $lifestyle) {
        $tab_lifestyle[$i] = array();
        $tab_lifestyle[$i]['name'] = $lifestyle;
        $tab_lifestyle[$i]['value'] = getValue($lifestyle);
        $i++;
    }

    $tab_personnality = array();
    $tab_personnality[] = "Amusante";
    $tab_personnality[] = "Bavarde";
    $tab_personnality[] = "Curieuse";
    $tab_personnality[] = "Sincère";
    $tab_personnality[] = "Gourmande";
    $tab_personnality[] = "Joueuse";
    $tab_personnality[] = "optimiste";
    $tab_personnality[] = "Patiente";
    $tab_personnality[] = "Sensible";
    $tab_personnality[] = "Réfléchie";
    $tab_personnality[] = "Sociable";
    $tab_personnality[] = "Spontanée";
    $tab_personnality[] = "Rêveuse";

    $i = 0;
    foreach ($tab_personnality as $key => $personnality) {
        $tab_personnality[$i] = array();
        $tab_personnality[$i]['name'] = $personnality;
        $tab_personnality[$i]['value'] = getValue($personnality);
        $i++;
    }

    $tab_echange = array();
    $tab_echange[] = "Don";
    $tab_echange[] = "Prêt";
    $tab_echange[] = "Invitation";
    $tab_echange[] = "Dégustation offerte";
    $tab_echange[] = "Boisson offerte";

    $i = 0;
    foreach ($tab_echange as $key => $echange) {
        $tab_echange[$i] = array();
        $tab_echange[$i]['name'] = $echange;
        $tab_echange[$i]['value'] = getValue($echange);
        $i++;
    }
?>

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
