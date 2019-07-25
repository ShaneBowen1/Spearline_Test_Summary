<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RoleWithRight $roleWithRight
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Role With Right'), ['action' => 'edit', $roleWithRight->role_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Role With Right'), ['action' => 'delete', $roleWithRight->role_id], ['confirm' => __('Are you sure you want to delete # {0}?', $roleWithRight->role_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Role With Right'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role With Right'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Role'), ['controller' => 'Role', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Role', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Right'), ['controller' => 'Right', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Right'), ['controller' => 'Right', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="roleWithRight view large-9 medium-8 columns content">
    <h3><?= h($roleWithRight->role_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= $roleWithRight->has('role') ? $this->Html->link($roleWithRight->role->name, ['controller' => 'Role', 'action' => 'view', $roleWithRight->role->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Right') ?></th>
            <td><?= $roleWithRight->has('right') ? $this->Html->link($roleWithRight->right->name, ['controller' => 'Right', 'action' => 'view', $roleWithRight->right->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $roleWithRight->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
