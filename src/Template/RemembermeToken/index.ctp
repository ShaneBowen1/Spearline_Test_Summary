<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RemembermeToken[]|\Cake\Collection\CollectionInterface $remembermeToken
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Rememberme Token'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="remembermeToken index large-9 medium-8 columns content">
    <h3><?= __('Rememberme Token') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('token') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ip') ?></th>
                <th scope="col"><?= $this->Paginator->sort('browser') ?></th>
                <th scope="col"><?= $this->Paginator->sort('expires_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($remembermeToken as $remembermeToken): ?>
            <tr>
                <td><?= $remembermeToken->has('user') ? $this->Html->link($remembermeToken->user->name, ['controller' => 'User', 'action' => 'view', $remembermeToken->user->id]) : '' ?></td>
                <td><?= h($remembermeToken->token) ?></td>
                <td><?= $this->Number->format($remembermeToken->ip) ?></td>
                <td><?= h($remembermeToken->browser) ?></td>
                <td><?= h($remembermeToken->expires_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $remembermeToken->user_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $remembermeToken->user_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $remembermeToken->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $remembermeToken->user_id)]) ?>
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
