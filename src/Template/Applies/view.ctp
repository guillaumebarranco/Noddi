<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Apply'), ['action' => 'edit', $apply->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Apply'), ['action' => 'delete', $apply->id], ['confirm' => __('Are you sure you want to delete # {0}?', $apply->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Applies'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Apply'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Modeuses'), ['controller' => 'Modeuses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Modeus'), ['controller' => 'Modeuses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Offers'), ['controller' => 'Offers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Offer'), ['controller' => 'Offers', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="applies view large-10 medium-9 columns">
    <h2><?= h($apply->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Modeus') ?></h6>
            <p><?= $apply->has('modeus') ? $this->Html->link($apply->modeus->id, ['controller' => 'Modeuses', 'action' => 'view', $apply->modeus->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Offer') ?></h6>
            <p><?= $apply->has('offer') ? $this->Html->link($apply->offer->title, ['controller' => 'Offers', 'action' => 'view', $apply->offer->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Message') ?></h6>
            <p><?= h($apply->message) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($apply->id) ?></p>
            <h6 class="subheader"><?= __('Viewed') ?></h6>
            <p><?= $this->Number->format($apply->viewed) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($apply->created) ?></p>
        </div>
    </div>
</div>
