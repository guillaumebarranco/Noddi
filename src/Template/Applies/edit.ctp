<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $apply->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $apply->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Applies'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Modeuses'), ['controller' => 'Modeuses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Modeus'), ['controller' => 'Modeuses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Offers'), ['controller' => 'Offers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Offer'), ['controller' => 'Offers', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="applies form large-10 medium-9 columns">
    <?= $this->Form->create($apply) ?>
    <fieldset>
        <legend><?= __('Edit Apply') ?></legend>
        <?php
            echo $this->Form->input('modeuse_id', ['options' => $modeuses]);
            echo $this->Form->input('offer_id', ['options' => $offers]);
            echo $this->Form->input('message');
            echo $this->Form->input('viewed');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
