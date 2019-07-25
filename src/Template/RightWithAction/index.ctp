<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RightWithAction[]|\Cake\Collection\CollectionInterface $rightWithAction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Right With Action'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Right'), ['controller' => 'Right', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Right'), ['controller' => 'Right', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Platform Action'), ['controller' => 'PlatformAction', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Platform Action'), ['controller' => 'PlatformAction', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rightWithAction index large-9 medium-8 columns content">
    <h3><?= __('Right With Action') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('right_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('platform_action_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rightWithAction as $rightWithAction): ?>
            <tr>
                <td><?= $rightWithAction->has('right') ? $this->Html->link($rightWithAction->right->name, ['controller' => 'Right', 'action' => 'view', $rightWithAction->right->id]) : '' ?></td>
                <td><?= $rightWithAction->has('platform_action') ? $this->Html->link($rightWithAction->platform_action->name, ['controller' => 'PlatformAction', 'action' => 'view', $rightWithAction->platform_action->id]) : '' ?></td>
                <td><?= h($rightWithAction->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $rightWithAction->right_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rightWithAction->right_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rightWithAction->right_id], ['confirm' => __('Are you sure you want to delete # {0}?', $rightWithAction->right_id)]) ?>
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
