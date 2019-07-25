<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RoleWithRight[]|\Cake\Collection\CollectionInterface $roleWithRight
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Role With Right'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Role'), ['controller' => 'Role', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Role', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Right'), ['controller' => 'Right', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Right'), ['controller' => 'Right', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="roleWithRight index large-9 medium-8 columns content">
    <h3><?= __('Role With Right') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('role_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('right_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roleWithRight as $roleWithRight): ?>
            <tr>
                <td><?= $roleWithRight->has('role') ? $this->Html->link($roleWithRight->role->name, ['controller' => 'Role', 'action' => 'view', $roleWithRight->role->id]) : '' ?></td>
                <td><?= $roleWithRight->has('right') ? $this->Html->link($roleWithRight->right->name, ['controller' => 'Right', 'action' => 'view', $roleWithRight->right->id]) : '' ?></td>
                <td><?= h($roleWithRight->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $roleWithRight->role_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $roleWithRight->role_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $roleWithRight->role_id], ['confirm' => __('Are you sure you want to delete # {0}?', $roleWithRight->role_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
