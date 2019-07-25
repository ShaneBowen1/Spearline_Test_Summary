<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PasswordResetToken[]|\Cake\Collection\CollectionInterface $passwordResetToken
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Password Reset Token'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="passwordResetToken index large-9 medium-8 columns content">
    <h3><?= __('Password Reset Token') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('token') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('expires_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('added_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('added_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($passwordResetToken as $passwordResetToken): ?>
            <tr>
                <td><?= h($passwordResetToken->token) ?></td>
                <td><?= $passwordResetToken->has('user') ? $this->Html->link($passwordResetToken->user->name, ['controller' => 'User', 'action' => 'view', $passwordResetToken->user->id]) : '' ?></td>
                <td><?= h($passwordResetToken->expires_on) ?></td>
                <td><?= h($passwordResetToken->added_on) ?></td>
                <td><?= $this->Number->format($passwordResetToken->added_by) ?></td>
                <td><?= $this->Number->format($passwordResetToken->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $passwordResetToken->token]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $passwordResetToken->token]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $passwordResetToken->token], ['confirm' => __('Are you sure you want to delete # {0}?', $passwordResetToken->token)]) ?>
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
