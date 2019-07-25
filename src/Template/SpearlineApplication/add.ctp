<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SpearlineApplication $spearlineApplication
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Spearline Application'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="spearlineApplication form large-9 medium-8 columns content">
    <?= $this->Form->create($spearlineApplication) ?>
    <fieldset>
        <legend><?= __('Add Spearline Application') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('description');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
