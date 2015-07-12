<h2>Proposer une offre</h2>

<?= $this->Form->create($offer) ?>

    <p>
        Je recherche une modeuse 
        <select name="" id="">
            <option value="peu importe">peu importe</option>
        </select>
        avec un style
        <select name="" id="">
            <option value="indifférent">indifférent</option>
        </select>
        pour promouvoir mon entreprise à partir de 
        <select name="" id="">
            <option value="maintenant">maintenant</option>
        </select>

        <div class="style_input">
            <select name="" id="">
                <option value="Type d'offre">Type d'offre</option>
            </select>
        </div>

        <div class="style_input">
            <select name="" id="">
                <option value="Type d'echange">Type d'echange</option>
            </select>
        </div>
        
        <button class="button">Télécharger des images de l'offre</button>

        <img src="" class="offer_picture offer_picture_one" />
        <img src="" class="offer_picture offer_picture_two" />
        <img src="" class="offer_picture offer_picture_three" />
    </p>

<?= $this->Form->button(__('Valider mon offre')) ?>
<?= $this->Form->end() ?>


<!-- <div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Offers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Brands'), ['controller' => 'Brands', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Brand'), ['controller' => 'Brands', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Activities'), ['controller' => 'Activities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activities', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="offers form large-10 medium-9 columns">
    <?= $this->Form->create($offer) ?>
    <fieldset>
        <legend><?= __('Add Offer') ?></legend>
        <?php
            echo $this->Form->input('brand_id', ['options' => $brands]);
            echo $this->Form->input('activity_id', ['options' => $activities]);
            echo $this->Form->input('date_begin');
            echo $this->Form->input('date_end');
            echo $this->Form->input('multiple_targets');
            echo $this->Form->input('expected_targets');
            echo $this->Form->input('title');
            echo $this->Form->input('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
 -->