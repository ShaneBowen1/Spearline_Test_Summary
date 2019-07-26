<?php
$this->Form->templates([
    'inputContainer' => '{{content}}',
    'submitContainer' => '{{content}}'
]);

?>

<div id='login-window-inner'>
    <div id='login-header'><div style='display:inline;padding-left: 5%'>Log in</div><div id='close' class="hiddenelem">X</div></div>
    <div id='login-logo'><?= $this->Html->image("spearline_login_logo.png", []); ?></div>
    <div id="flashbox">
        <?= $this->Flash->render() ?>
    </div>
    <div id='login-credentials'>
        <?= $this->Form->create() ?>
        <?= $this->Form->input('email', ['placeholder' => 'Enter your email','label' => false]) ?>
        <?= $this->Form->input('password', ['placeholder' => 'Enter your password','label' => false]) ?>
        <?= $this->Form->input('Login', ['type' => 'submit']) ?>
        <div id="remember_div">
            <?= $this->Form->input('rememberme', ['value' => 1, 'type' => 'checkbox', 'label' => 'Remember me']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>

    <div id='login-footer' class="hiddenelem">
        <div id='credentials-forget'><?= __('Please enter your user email address:') ?></div>
        <?php echo $this->Form->create(null, [
                    'url' => ['controller' => 'user', 'action' => 'forgotPassword']
                ]); ?>
        <?= $this->Form->input('email', ['placeholder' => 'Enter your email', 'label' => ''] )?>
        <?= $this->Form->input('Reset Password', ['id' => 'resetPasswordButton', 'type' => 'submit']) ?>

        <?= $this->Form->end() ?>
    </div>

    <div id='login-forgotpassword'>
        <div id='text-forgotpassword'><?= __('Forgot your ') . '<span class="blue">' .  __('password') . '? </span>' ?></div>
        <div id='text-forgotpassword_login' class="hiddenelem"><?= '<span class="blue">' . __('Login') . '</span>' ?></div>
    </div>
</div>