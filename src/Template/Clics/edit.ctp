<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $clic->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $clic->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Clics'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="clics form large-10 medium-9 columns">
    <?= $this->Form->create($clic) ?>
    <fieldset>
        <legend><?= __('Edit Clic') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('counter');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
