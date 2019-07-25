<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RoleWithRight $roleWithRight
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $roleWithRight->role_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $roleWithRight->role_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Role With Right'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Role'), ['controller' => 'Role', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Role', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Right'), ['controller' => 'Right', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Right'), ['controller' => 'Right', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="roleWithRight form large-9 medium-8 columns content">
    <?= $this->Form->create($roleWithRight) ?>
    <fieldset>
        <legend><?= __('Edit Role With Right') ?></legend>
        <?php
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
