<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Message'), ['action' => 'edit', $message->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Message'), ['action' => 'delete', $message->id], ['confirm' => __('Are you sure you want to delete # {0}?', $message->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Messages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Message'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Brands'), ['controller' => 'Brands', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Brand'), ['controller' => 'Brands', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Modeuses'), ['controller' => 'Modeuses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Modeus'), ['controller' => 'Modeuses', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="messages view large-10 medium-9 columns">
    <h2><?= h($message->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Brand') ?></h6>
            <p><?= $message->has('brand') ? $this->Html->link($message->brand->name, ['controller' => 'Brands', 'action' => 'view', $message->brand->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Modeus') ?></h6>
            <p><?= $message->has('modeus') ? $this->Html->link($message->modeus->id, ['controller' => 'Modeuses', 'action' => 'view', $message->modeus->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Content') ?></h6>
            <p><?= h($message->content) ?></p>
            <h6 class="subheader"><?= __('From') ?></h6>
            <p><?= h($message->from) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($message->id) ?></p>
            <h6 class="subheader"><?= __('Viewed') ?></h6>
            <p><?= $this->Number->format($message->viewed) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($message->created) ?></p>
        </div>
    </div>
</div>
