<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PlatformAction[]|\Cake\Collection\CollectionInterface $platformAction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Platform Action'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="platformAction index large-9 medium-8 columns content">
    <h3><?= __('Platform Action') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('platform_controller_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($platformAction as $platformAction): ?>
            <tr>
                <td><?= $this->Number->format($platformAction->id) ?></td>
                <td><?= $this->Number->format($platformAction->platform_controller_id) ?></td>
                <td><?= h($platformAction->name) ?></td>
                <td><?= h($platformAction->description) ?></td>
                <td><?= $this->Number->format($platformAction->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $platformAction->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $platformAction->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $platformAction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $platformAction->id)]) ?>
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
