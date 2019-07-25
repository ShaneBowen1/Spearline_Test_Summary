<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserSessionHistory[]|\Cake\Collection\CollectionInterface $userSessionHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New User Session History'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="userSessionHistory index large-9 medium-8 columns content">
    <h3><?= __('User Session History') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('login_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('logout_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('browser') ?></th>
                <th scope="col"><?= $this->Paginator->sort('platform') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_agent') ?></th>
                <th scope="col"><?= $this->Paginator->sort('public_ip') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_forced_logout') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userSessionHistory as $userSessionHistory): ?>
            <tr>
                <td><?= $userSessionHistory->has('user') ? $this->Html->link($userSessionHistory->user->name, ['controller' => 'User', 'action' => 'view', $userSessionHistory->user->id]) : '' ?></td>
                <td><?= h($userSessionHistory->login_time) ?></td>
                <td><?= h($userSessionHistory->logout_time) ?></td>
                <td><?= h($userSessionHistory->browser) ?></td>
                <td><?= h($userSessionHistory->platform) ?></td>
                <td><?= h($userSessionHistory->user_agent) ?></td>
                <td><?= $this->Number->format($userSessionHistory->public_ip) ?></td>
                <td><?= h($userSessionHistory->is_forced_logout) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $userSessionHistory->user_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userSessionHistory->user_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userSessionHistory->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $userSessionHistory->user_id)]) ?>
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
