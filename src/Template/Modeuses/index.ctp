<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Modeus'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="modeuses index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('user_id') ?></th>
            <th><?= $this->Paginator->sort('firstname') ?></th>
            <th><?= $this->Paginator->sort('lastname') ?></th>
            <th><?= $this->Paginator->sort('instagram') ?></th>
            <th><?= $this->Paginator->sort('twitter') ?></th>
            <th><?= $this->Paginator->sort('facebook') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($modeuses as $modeus): ?>
        <tr>
            <td><?= $this->Number->format($modeus->id) ?></td>
            <td>
                <?= $modeus->has('user') ? $this->Html->link($modeus->user->id, ['controller' => 'Users', 'action' => 'view', $modeus->user->id]) : '' ?>
            </td>
            <td><?= h($modeus->firstname) ?></td>
            <td><?= h($modeus->lastname) ?></td>
            <td><?= h($modeus->instagram) ?></td>
            <td><?= h($modeus->twitter) ?></td>
            <td><?= h($modeus->facebook) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $modeus->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $modeus->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $modeus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $modeus->id)]) ?>
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
