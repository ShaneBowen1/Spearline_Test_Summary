<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SpearlineApplication $spearlineApplication
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Spearline Application'), ['action' => 'edit', $spearlineApplication->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Spearline Application'), ['action' => 'delete', $spearlineApplication->id], ['confirm' => __('Are you sure you want to delete # {0}?', $spearlineApplication->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Spearline Application'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Spearline Application'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="spearlineApplication view large-9 medium-8 columns content">
    <h3><?= h($spearlineApplication->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($spearlineApplication->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($spearlineApplication->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($spearlineApplication->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($spearlineApplication->status) ?></td>
        </tr>
    </table>
</div>
