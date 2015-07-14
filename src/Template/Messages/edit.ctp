<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $message->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $message->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Messages'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Brands'), ['controller' => 'Brands', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Brand'), ['controller' => 'Brands', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Modeuses'), ['controller' => 'Modeuses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Modeus'), ['controller' => 'Modeuses', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="messages form large-10 medium-9 columns">
    <?= $this->Form->create($message) ?>
    <fieldset>
        <legend><?= __('Edit Message') ?></legend>
        <?php
            echo $this->Form->input('brand_id', ['options' => $brands]);
            echo $this->Form->input('modeuse_id', ['options' => $modeuses]);
            echo $this->Form->input('content');
            echo $this->Form->input('from');
            echo $this->Form->input('viewed');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
