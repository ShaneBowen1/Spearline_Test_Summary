<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PlatformController[]|\Cake\Collection\CollectionInterface $platformController
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Platform Controller'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Platform Action'), ['controller' => 'PlatformAction', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Platform Action'), ['controller' => 'PlatformAction', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="platformController index large-9 medium-8 columns content">
    <h3><?= __('Platform Controller') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($platformController as $platformController): ?>
            <tr>
                <td><?= $this->Number->format($platformController->id) ?></td>
                <td><?= h($platformController->name) ?></td>
                <td><?= h($platformController->description) ?></td>
                <td><?= $this->Number->format($platformController->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $platformController->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $platformController->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $platformController->id], ['confirm' => __('Are you sure you want to delete # {0}?', $platformController->id)]) ?>
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
