<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Offer'), ['action' => 'edit', $offer->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Offer'), ['action' => 'delete', $offer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $offer->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Offers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Offer'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Brands'), ['controller' => 'Brands', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Brand'), ['controller' => 'Brands', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Activities'), ['controller' => 'Activities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activities', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="offers view large-10 medium-9 columns">
    <h2><?= h($offer->title) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Brand') ?></h6>
            <p><?= $offer->has('brand') ? $this->Html->link($offer->brand->name, ['controller' => 'Brands', 'action' => 'view', $offer->brand->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Activity') ?></h6>
            <p><?= $offer->has('activity') ? $this->Html->link($offer->activity->name, ['controller' => 'Activities', 'action' => 'view', $offer->activity->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Title') ?></h6>
            <p><?= h($offer->title) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($offer->id) ?></p>
            <h6 class="subheader"><?= __('Multiple Targets') ?></h6>
            <p><?= $this->Number->format($offer->multiple_targets) ?></p>
            <h6 class="subheader"><?= __('Expected Targets') ?></h6>
            <p><?= $this->Number->format($offer->expected_targets) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Date Begin') ?></h6>
            <p><?= h($offer->date_begin) ?></p>
            <h6 class="subheader"><?= __('Date End') ?></h6>
            <p><?= h($offer->date_end) ?></p>
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($offer->created) ?></p>
            <h6 class="subheader"><?= __('Updated') ?></h6>
            <p><?= h($offer->updated) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Description') ?></h6>
            <?= $this->Text->autoParagraph(h($offer->description)) ?>
        </div>
    </div>
</div>