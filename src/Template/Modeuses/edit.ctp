<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $modeus->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $modeus->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Modeuses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="modeuses form large-10 medium-9 columns">
    <?= $this->Form->create($modeus) ?>
    <fieldset>
        <legend><?= __('Edit Modeus') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('firstname');
            echo $this->Form->input('lastname');
            echo $this->Form->input('instagram');
            echo $this->Form->input('twitter');
            echo $this->Form->input('facebook');
            echo $this->Form->input('pinterest');
            echo $this->Form->input('activity_searched');
            echo $this->Form->input('insta_followers');
            echo $this->Form->input('noddi_rank');
            echo $this->Form->input('offers_attempted');
            echo $this->Form->input('offers_accepted');
            echo $this->Form->input('hobbies');
            echo $this->Form->input('city');
            echo $this->Form->input('age');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
