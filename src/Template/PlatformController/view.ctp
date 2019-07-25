<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PlatformController $platformController
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Platform Controller'), ['action' => 'edit', $platformController->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Platform Controller'), ['action' => 'delete', $platformController->id], ['confirm' => __('Are you sure you want to delete # {0}?', $platformController->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Platform Controller'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Platform Controller'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Platform Action'), ['controller' => 'PlatformAction', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Platform Action'), ['controller' => 'PlatformAction', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="platformController view large-9 medium-8 columns content">
    <h3><?= h($platformController->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($platformController->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($platformController->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($platformController->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($platformController->status) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Platform Action') ?></h4>
        <?php if (!empty($platformController->platform_action)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Platform Controller Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($platformController->platform_action as $platformAction): ?>
            <tr>
                <td><?= h($platformAction->id) ?></td>
                <td><?= h($platformAction->platform_controller_id) ?></td>
                <td><?= h($platformAction->name) ?></td>
                <td><?= h($platformAction->description) ?></td>
                <td><?= h($platformAction->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PlatformAction', 'action' => 'view', $platformAction->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PlatformAction', 'action' => 'edit', $platformAction->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PlatformAction', 'action' => 'delete', $platformAction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $platformAction->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
