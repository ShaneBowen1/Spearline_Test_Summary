<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SpearlineApplication[]|\Cake\Collection\CollectionInterface $spearlineApplication
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Spearline Application'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="spearlineApplication index large-9 medium-8 columns content">
    <h3><?= __('Spearline Application') ?></h3>
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
            <?php foreach ($spearlineApplication as $spearlineApplication): ?>
            <tr>
                <td><?= $this->Number->format($spearlineApplication->id) ?></td>
                <td><?= h($spearlineApplication->name) ?></td>
                <td><?= h($spearlineApplication->description) ?></td>
                <td><?= $this->Number->format($spearlineApplication->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $spearlineApplication->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $spearlineApplication->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $spearlineApplication->id], ['confirm' => __('Are you sure you want to delete # {0}?', $spearlineApplication->id)]) ?>
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
