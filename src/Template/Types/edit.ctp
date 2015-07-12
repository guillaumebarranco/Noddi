<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $type->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $type->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Types'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Offers'), ['controller' => 'Offers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Offer'), ['controller' => 'Offers', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="types form large-10 medium-9 columns">
    <?= $this->Form->create($type) ?>
    <fieldset>
        <legend><?= __('Edit Type') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
