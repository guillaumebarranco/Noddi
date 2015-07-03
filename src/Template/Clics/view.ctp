<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Clic'), ['action' => 'edit', $clic->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Clic'), ['action' => 'delete', $clic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clic->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Clics'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Clic'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="clics view large-10 medium-9 columns">
    <h2><?= h($clic->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($clic->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($clic->id) ?></p>
            <h6 class="subheader"><?= __('Counter') ?></h6>
            <p><?= $this->Number->format($clic->counter) ?></p>
        </div>
    </div>
</div>
