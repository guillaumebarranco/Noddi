<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Brand'), ['action' => 'edit', $brand->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Brand'), ['action' => 'delete', $brand->id], ['confirm' => __('Are you sure you want to delete # {0}?', $brand->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Brands'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Brand'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Activities'), ['controller' => 'Activities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Offers'), ['controller' => 'Offers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Offer'), ['controller' => 'Offers', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="brands view large-10 medium-9 columns">
    <h2><?= h($brand->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $brand->has('user') ? $this->Html->link($brand->user->id, ['controller' => 'Users', 'action' => 'view', $brand->user->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($brand->name) ?></p>
            <h6 class="subheader"><?= __('Activity') ?></h6>
            <p><?= $brand->has('activity') ? $this->Html->link($brand->activity->name, ['controller' => 'Activities', 'action' => 'view', $brand->activity->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($brand->id) ?></p>
            <h6 class="subheader"><?= __('Offers Created') ?></h6>
            <p><?= $this->Number->format($brand->offers_created) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Offers') ?></h4>
    <?php if (!empty($brand->offers)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Brand Id') ?></th>
            <th><?= __('Activity Id') ?></th>
            <th><?= __('Date Begin') ?></th>
            <th><?= __('Date End') ?></th>
            <th><?= __('Multiple Targets') ?></th>
            <th><?= __('Expected Targets') ?></th>
            <th><?= __('Title') ?></th>
            <th><?= __('Description') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Updated') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($brand->offers as $offers): ?>
        <tr>
            <td><?= h($offers->id) ?></td>
            <td><?= h($offers->brand_id) ?></td>
            <td><?= h($offers->activity_id) ?></td>
            <td><?= h($offers->date_begin) ?></td>
            <td><?= h($offers->date_end) ?></td>
            <td><?= h($offers->multiple_targets) ?></td>
            <td><?= h($offers->expected_targets) ?></td>
            <td><?= h($offers->title) ?></td>
            <td><?= h($offers->description) ?></td>
            <td><?= h($offers->created) ?></td>
            <td><?= h($offers->updated) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Offers', 'action' => 'view', $offers->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Offers', 'action' => 'edit', $offers->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Offers', 'action' => 'delete', $offers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $offers->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
