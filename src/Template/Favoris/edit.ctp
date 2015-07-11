<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $favori->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $favori->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Favoris'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Brands'), ['controller' => 'Brands', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Brand'), ['controller' => 'Brands', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Modeuses'), ['controller' => 'Modeuses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Modeus'), ['controller' => 'Modeuses', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="favoris form large-10 medium-9 columns">
    <?= $this->Form->create($favori) ?>
    <fieldset>
        <legend><?= __('Edit Favori') ?></legend>
        <?php
            echo $this->Form->input('brand_id', ['options' => $brands]);
            echo $this->Form->input('modeuse_id', ['options' => $modeuses]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
