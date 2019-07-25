<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserSession[]|\Cake\Collection\CollectionInterface $userSession
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New User Session'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="userSession index large-9 medium-8 columns content">
    <h3><?= __('User Session') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('login_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('browser') ?></th>
                <th scope="col"><?= $this->Paginator->sort('platform') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_agent') ?></th>
                <th scope="col"><?= $this->Paginator->sort('public_ip') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userSession as $userSession): ?>
            <tr>
                <td><?= $this->Number->format($userSession->user_id) ?></td>
                <td><?= h($userSession->login_time) ?></td>
                <td><?= h($userSession->browser) ?></td>
                <td><?= h($userSession->platform) ?></td>
                <td><?= h($userSession->user_agent) ?></td>
                <td><?= $this->Number->format($userSession->public_ip) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $userSession->user_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userSession->user_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userSession->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $userSession->user_id)]) ?>
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
