<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PlatformAction $platformAction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Platform Action'), ['action' => 'edit', $platformAction->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Platform Action'), ['action' => 'delete', $platformAction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $platformAction->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Platform Action'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Platform Action'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="platformAction view large-9 medium-8 columns content">
    <h3><?= h($platformAction->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($platformAction->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($platformAction->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($platformAction->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Platform Controller Id') ?></th>
            <td><?= $this->Number->format($platformAction->platform_controller_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($platformAction->status) ?></td>
        </tr>
    </table>
</div>
