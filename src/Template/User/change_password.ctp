<h3><i class='fa fa-key'></i> <?= __('Change Password') ?></h3>
<?= $this->Form->create() ?>
<fieldset>
    <?= $this->Form->input('old_password',['type' => 'password' , 'label'=>'Old password'])?>
    <?= $this->Form->input('new_password',['type'=>'password' ,'label'=>'Password']) ?>
    <?= $this->Form->input('confirm_password',['type' => 'password' , 'label'=>'Repeat password'])?>
</fieldset>

<div class="edit-buttons">
    <?= $this->Form->button(__('Update'), array('class' => 'submit_button','value' => 'Update')) ?>
    <?= $this->Form->button(__('Close'), array( 'type' => 'button','class' => 'cancel_button')) ?>
</div>
<?= $this->Form->end() ?>
