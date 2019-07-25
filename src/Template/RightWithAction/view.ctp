<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RightWithAction $rightWithAction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Right With Action'), ['action' => 'edit', $rightWithAction->right_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Right With Action'), ['action' => 'delete', $rightWithAction->right_id], ['confirm' => __('Are you sure you want to delete # {0}?', $rightWithAction->right_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Right With Action'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Right With Action'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Right'), ['controller' => 'Right', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Right'), ['controller' => 'Right', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Platform Action'), ['controller' => 'PlatformAction', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Platform Action'), ['controller' => 'PlatformAction', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rightWithAction view large-9 medium-8 columns content">
    <h3><?= h($rightWithAction->right_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Right') ?></th>
            <td><?= $rightWithAction->has('right') ? $this->Html->link($rightWithAction->right->name, ['controller' => 'Right', 'action' => 'view', $rightWithAction->right->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Platform Action') ?></th>
            <td><?= $rightWithAction->has('platform_action') ? $this->Html->link($rightWithAction->platform_action->name, ['controller' => 'PlatformAction', 'action' => 'view', $rightWithAction->platform_action->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $rightWithAction->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
