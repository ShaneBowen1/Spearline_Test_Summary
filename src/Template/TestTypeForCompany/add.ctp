<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TestTypeForCompany $testTypeForCompany
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Test Type For Company'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Company'), ['controller' => 'Company', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Company', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Test Type'), ['controller' => 'TestType', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Test Type'), ['controller' => 'TestType', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="testTypeForCompany form large-9 medium-8 columns content">
    <?= $this->Form->create($testTypeForCompany) ?>
    <fieldset>
        <legend><?= __('Add Test Type For Company') ?></legend>
        <?php
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
