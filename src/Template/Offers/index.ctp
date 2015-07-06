<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Offer'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Brands'), ['controller' => 'Brands', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Brand'), ['controller' => 'Brands', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Activities'), ['controller' => 'Activities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activities', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="offers index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('brand_id') ?></th>
            <th><?= $this->Paginator->sort('activity_id') ?></th>
            <th><?= $this->Paginator->sort('date_begin') ?></th>
            <th><?= $this->Paginator->sort('date_end') ?></th>
            <th><?= $this->Paginator->sort('multiple_targets') ?></th>
            <th><?= $this->Paginator->sort('expected_targets') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($offers as $offer): ?>
        <tr>
            <td><?= $this->Number->format($offer->id) ?></td>
            <td>
                <?= $offer->has('brand') ? $this->Html->link($offer->brand->name, ['controller' => 'Brands', 'action' => 'view', $offer->brand->id]) : '' ?>
            </td>
            <td>
                <?= $offer->has('activity') ? $this->Html->link($offer->activity->name, ['controller' => 'Activities', 'action' => 'view', $offer->activity->id]) : '' ?>
            </td>
            <td><?= h($offer->date_begin) ?></td>
            <td><?= h($offer->date_end) ?></td>
            <td><?= $this->Number->format($offer->multiple_targets) ?></td>
            <td><?= $this->Number->format($offer->expected_targets) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $offer->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $offer->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $offer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $offer->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
