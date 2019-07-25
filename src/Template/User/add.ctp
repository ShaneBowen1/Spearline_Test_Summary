<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List User'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Company'), ['controller' => 'Company', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Company', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="user form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->control('company_id', ['options' => $company, 'empty' => true]);
            echo $this->Form->control('name');
            echo $this->Form->control('email');
            echo $this->Form->control('sms');
            echo $this->Form->control('country_code_id');
            echo $this->Form->control('timezone_id');
            echo $this->Form->control('department_id');
            echo $this->Form->control('login_name');
            echo $this->Form->control('password');
            echo $this->Form->control('created_by');
            echo $this->Form->control('created_on');
            echo $this->Form->control('edited_on');
            echo $this->Form->control('show');
            echo $this->Form->control('status');
            echo $this->Form->control('backendadmin');
            echo $this->Form->control('old_id');
            echo $this->Form->control('role_id');
            echo $this->Form->control('api_access');
            echo $this->Form->control('login_token');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
