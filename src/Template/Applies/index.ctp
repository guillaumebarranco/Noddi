<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Apply'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Modeuses'), ['controller' => 'Modeuses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Modeus'), ['controller' => 'Modeuses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Offers'), ['controller' => 'Offers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Offer'), ['controller' => 'Offers', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="applies index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('modeuse_id') ?></th>
            <th><?= $this->Paginator->sort('offer_id') ?></th>
            <th><?= $this->Paginator->sort('message') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('viewed') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($applies as $apply): ?>
        <tr>
            <td><?= $this->Number->format($apply->id) ?></td>
            <td>
                <?= $apply->has('modeus') ? $this->Html->link($apply->modeus->id, ['controller' => 'Modeuses', 'action' => 'view', $apply->modeus->id]) : '' ?>
            </td>
            <td>
                <?= $apply->has('offer') ? $this->Html->link($apply->offer->title, ['controller' => 'Offers', 'action' => 'view', $apply->offer->id]) : '' ?>
            </td>
            <td><?= h($apply->message) ?></td>
            <td><?= h($apply->created) ?></td>
            <td><?= $this->Number->format($apply->viewed) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $apply->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $apply->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $apply->id], ['confirm' => __('Are you sure you want to delete # {0}?', $apply->id)]) ?>
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
