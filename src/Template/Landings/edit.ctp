<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $landing->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $landing->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Landings'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="landings form large-10 medium-9 columns">
    <?= $this->Form->create($landing) ?>
    <fieldset>
        <legend><?= __('Edit Landing') ?></legend>
        <?php
            echo $this->Form->input('email');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
