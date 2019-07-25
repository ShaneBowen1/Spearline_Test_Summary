<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserSession $userSession
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List User Session'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="userSession form large-9 medium-8 columns content">
    <?= $this->Form->create($userSession) ?>
    <fieldset>
        <legend><?= __('Add User Session') ?></legend>
        <?php
            echo $this->Form->control('login_time');
            echo $this->Form->control('browser');
            echo $this->Form->control('platform');
            echo $this->Form->control('user_agent');
            echo $this->Form->control('public_ip');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
