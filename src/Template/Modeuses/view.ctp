<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Modeus'), ['action' => 'edit', $modeus->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Modeus'), ['action' => 'delete', $modeus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $modeus->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Modeuses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Modeus'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="modeuses view large-10 medium-9 columns">
    <h2><?= h($modeus->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $modeus->has('user') ? $this->Html->link($modeus->user->id, ['controller' => 'Users', 'action' => 'view', $modeus->user->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Firstname') ?></h6>
            <p><?= h($modeus->firstname) ?></p>
            <h6 class="subheader"><?= __('Lastname') ?></h6>
            <p><?= h($modeus->lastname) ?></p>
            <h6 class="subheader"><?= __('Instagram') ?></h6>
            <p><?= h($modeus->instagram) ?></p>
            <h6 class="subheader"><?= __('Twitter') ?></h6>
            <p><?= h($modeus->twitter) ?></p>
            <h6 class="subheader"><?= __('Facebook') ?></h6>
            <p><?= h($modeus->facebook) ?></p>
            <h6 class="subheader"><?= __('Pinterest') ?></h6>
            <p><?= h($modeus->pinterest) ?></p>
            <h6 class="subheader"><?= __('Activity Searched') ?></h6>
            <p><?= h($modeus->activity_searched) ?></p>
            <h6 class="subheader"><?= __('Hobbies') ?></h6>
            <p><?= h($modeus->hobbies) ?></p>
            <h6 class="subheader"><?= __('City') ?></h6>
            <p><?= h($modeus->city) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($modeus->id) ?></p>
            <h6 class="subheader"><?= __('Insta Followers') ?></h6>
            <p><?= $this->Number->format($modeus->insta_followers) ?></p>
            <h6 class="subheader"><?= __('Noddi Rank') ?></h6>
            <p><?= $this->Number->format($modeus->noddi_rank) ?></p>
            <h6 class="subheader"><?= __('Offers Attempted') ?></h6>
            <p><?= $this->Number->format($modeus->offers_attempted) ?></p>
            <h6 class="subheader"><?= __('Offers Accepted') ?></h6>
            <p><?= $this->Number->format($modeus->offers_accepted) ?></p>
            <h6 class="subheader"><?= __('Age') ?></h6>
            <p><?= $this->Number->format($modeus->age) ?></p>
        </div>
    </div>
</div>
