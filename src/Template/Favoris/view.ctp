<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Favori'), ['action' => 'edit', $favori->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Favori'), ['action' => 'delete', $favori->id], ['confirm' => __('Are you sure you want to delete # {0}?', $favori->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Favoris'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Favori'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Brands'), ['controller' => 'Brands', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Brand'), ['controller' => 'Brands', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Modeuses'), ['controller' => 'Modeuses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Modeus'), ['controller' => 'Modeuses', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="favoris view large-10 medium-9 columns">
    <h2><?= h($favori->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Brand') ?></h6>
            <p><?= $favori->has('brand') ? $this->Html->link($favori->brand->name, ['controller' => 'Brands', 'action' => 'view', $favori->brand->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Modeus') ?></h6>
            <p><?= $favori->has('modeus') ? $this->Html->link($favori->modeus->id, ['controller' => 'Modeuses', 'action' => 'view', $favori->modeus->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($favori->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($favori->created) ?></p>
        </div>
    </div>
</div>
