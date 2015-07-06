<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Activity'), ['action' => 'edit', $activity->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Activity'), ['action' => 'delete', $activity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $activity->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Activities'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Brands'), ['controller' => 'Brands', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Brand'), ['controller' => 'Brands', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Offers'), ['controller' => 'Offers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Offer'), ['controller' => 'Offers', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="activities view large-10 medium-9 columns">
    <h2><?= h($activity->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($activity->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($activity->id) ?></p>
            <h6 class="subheader"><?= __('Counter') ?></h6>
            <p><?= $this->Number->format($activity->counter) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Description') ?></h6>
            <?= $this->Text->autoParagraph(h($activity->description)) ?>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Brands') ?></h4>
    <?php if (!empty($activity->brands)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('User Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Activity Id') ?></th>
            <th><?= __('Offers Created') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($activity->brands as $brands): ?>
        <tr>
            <td><?= h($brands->id) ?></td>
            <td><?= h($brands->user_id) ?></td>
            <td><?= h($brands->name) ?></td>
            <td><?= h($brands->activity_id) ?></td>
            <td><?= h($brands->offers_created) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Brands', 'action' => 'view', $brands->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Brands', 'action' => 'edit', $brands->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Brands', 'action' => 'delete', $brands->id], ['confirm' => __('Are you sure you want to delete # {0}?', $brands->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Offers') ?></h4>
    <?php if (!empty($activity->offers)): ?>
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
        <?php foreach ($activity->offers as $offers): ?>
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
