
<div id='login-window-inner'>
    <div id='login-header'>
        <div style='display:inline;padding-left: 5%'>
            <?= __('Choose your password') ?>
        </div>
        <div id='close' class="hiddenelem">X</div>
    </div>
    <div id='login-logo'><?= $this->Html->image("spearline_login_logo.png"); ?></div>

    <div id='login-credentials'>
        <?= $this->Form->create() ?>
        <?= $this->Form->input('new_password',['type'=>'password', 'placeholder' => 'New password', 'label'=>'']) ?>
        <?= $this->Form->input('confirm_password',['type' => 'password', 'placeholder' => 'Confirm new password', 'label'=> ''])?>
        <?= $this->Form->input(__('Save password'), ['type' => 'submit']) ?>
        <?= $this->Form->end() ?>
    </div>

    <div id='login-footer' class="hiddenelem">

    </div>

    <div id='login-rememberme'>

    </div>
</div>
