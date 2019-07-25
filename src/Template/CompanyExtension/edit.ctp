<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompanyExtension $companyExtension
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $companyExtension->company_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $companyExtension->company_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Company Extension'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="companyExtension form large-9 medium-8 columns content">
    <?= $this->Form->create($companyExtension) ?>
    <fieldset>
        <legend><?= __('Edit Company Extension') ?></legend>
        <?php
            echo $this->Form->control('company_type_id');
            echo $this->Form->control('account_manager_id', ['options' => $user, 'empty' => true]);
            echo $this->Form->control('manual_test_timeout');
            echo $this->Form->control('gsm_on_manual_test');
            echo $this->Form->control('api_doc_access');
            echo $this->Form->control('management_report_access');
            echo $this->Form->control('has_gsm');
            echo $this->Form->control('view_passcode_tag');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
