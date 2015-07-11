<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Favori'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Brands'), ['controller' => 'Brands', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Brand'), ['controller' => 'Brands', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Modeuses'), ['controller' => 'Modeuses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Modeus'), ['controller' => 'Modeuses', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="favoris index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('brand_id') ?></th>
            <th><?= $this->Paginator->sort('modeuse_id') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($favoris as $favori): ?>
        <tr>
            <td><?= $this->Number->format($favori->id) ?></td>
            <td>
                <?= $favori->has('brand') ? $this->Html->link($favori->brand->name, ['controller' => 'Brands', 'action' => 'view', $favori->brand->id]) : '' ?>
            </td>
            <td>
                <?= $favori->has('modeus') ? $this->Html->link($favori->modeus->id, ['controller' => 'Modeuses', 'action' => 'view', $favori->modeus->id]) : '' ?>
            </td>
            <td><?= h($favori->created) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $favori->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $favori->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $favori->id], ['confirm' => __('Are you sure you want to delete # {0}?', $favori->id)]) ?>
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
