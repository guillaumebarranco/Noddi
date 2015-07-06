<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Brand'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Activities'), ['controller' => 'Activities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Offers'), ['controller' => 'Offers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Offer'), ['controller' => 'Offers', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="brands index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('user_id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('activity_id') ?></th>
            <th><?= $this->Paginator->sort('offers_created') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($brands as $brand): ?>
        <tr>
            <td><?= $this->Number->format($brand->id) ?></td>
            <td>
                <?= $brand->has('user') ? $this->Html->link($brand->user->id, ['controller' => 'Users', 'action' => 'view', $brand->user->id]) : '' ?>
            </td>
            <td><?= h($brand->name) ?></td>
            <td>
                <?= $brand->has('activity') ? $this->Html->link($brand->activity->name, ['controller' => 'Activities', 'action' => 'view', $brand->activity->id]) : '' ?>
            </td>
            <td><?= $this->Number->format($brand->offers_created) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $brand->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $brand->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $brand->id], ['confirm' => __('Are you sure you want to delete # {0}?', $brand->id)]) ?>
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
