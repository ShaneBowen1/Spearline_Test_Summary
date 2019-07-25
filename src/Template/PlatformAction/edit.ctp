<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PlatformAction $platformAction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $platformAction->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $platformAction->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Platform Action'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="platformAction form large-9 medium-8 columns content">
    <?= $this->Form->create($platformAction) ?>
    <fieldset>
        <legend><?= __('Edit Platform Action') ?></legend>
        <?php
            echo $this->Form->control('platform_controller_id');
            echo $this->Form->control('name');
            echo $this->Form->control('description');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
