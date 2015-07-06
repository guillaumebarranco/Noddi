<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $offer->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $offer->id)]
            )
        ?></li>
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
        <legend><?= __('Edit Offer') ?></legend>
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
