<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ApplicationForCompany $applicationForCompany
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $applicationForCompany->company_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $applicationForCompany->company_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Application For Company'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Company'), ['controller' => 'Company', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Company', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicationForCompany form large-9 medium-8 columns content">
    <?= $this->Form->create($applicationForCompany) ?>
    <fieldset>
        <legend><?= __('Edit Application For Company') ?></legend>
        <?php
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
