<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Company $company
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Company'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Company'), ['controller' => 'Company', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Company', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="company form large-9 medium-8 columns content">
    <?= $this->Form->create($company) ?>
    <fieldset>
        <legend><?= __('Add Company') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('address');
            echo $this->Form->control('city');
            echo $this->Form->control('country_code_id');
            echo $this->Form->control('phone');
            echo $this->Form->control('email');
            echo $this->Form->control('logo');
            echo $this->Form->control('report_logo');
            echo $this->Form->control('parent_company_id', ['options' => $company, 'empty' => true]);
            echo $this->Form->control('style_id');
            echo $this->Form->control('url');
            echo $this->Form->control('currency_code_id');
            echo $this->Form->control('no_of_users_allowed');
            echo $this->Form->control('campaign_style');
            echo $this->Form->control('api_key');
            echo $this->Form->control('show_benchmarks');
            echo $this->Form->control('ivr_traversal_id');
            echo $this->Form->control('has_campaign_report');
            echo $this->Form->control('status');
            echo $this->Form->control('expire_on');
            echo $this->Form->control('created_by');
            echo $this->Form->control('created_on');
            echo $this->Form->control('old_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
