<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Landing'), ['action' => 'edit', $landing->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Landing'), ['action' => 'delete', $landing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $landing->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Landings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Landing'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="landings view large-10 medium-9 columns">
    <h2><?= h($landing->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Email') ?></h6>
            <p><?= h($landing->email) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($landing->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($landing->created) ?></p>
        </div>
    </div>
</div>
